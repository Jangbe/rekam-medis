<?php

namespace App\Http\Controllers;

use App\Exports\MedicalRecordExport;
use App\Models\History;
use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('test_curl');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $patient = Patient::count();
        $med_rec_todays = MedicalRecord::whereDate('created_at', date('Y-m-d'))->count();
        $med_recs = MedicalRecord::count();
        return view('home', compact('patient', 'med_rec_todays', 'med_recs'));
    }

    public function data_static_med_rec(){
        $now = new Carbon();
        $end_week = $now->addDay()->format('Y-m-d');
        $start_week = $now->subDays(8)->format('Y-m-d');

        $pendaftaran = MedicalRecord::select(
            DB::raw("(count(*)) as total"),
            DB::raw("(DATE_FORMAT(created_at, '%d-%m-%Y')) as my_date"),
        )->whereBetween('created_at', [$start_week, $end_week])->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"))->get();

        $data['data'] = [0,0,0,0,0,0,0];
        $periods = CarbonPeriod::create(Carbon::now()->subDays(6), Carbon::now());
        foreach ($periods as  $p) {
            $data['labels'][] = $p->isoFormat('ddd');
            $data['data'][$p->format('w')] = $pendaftaran->where('my_date', $p->format('d-m-Y'))->first()->total??0;
        }
        return response()->json($data);
    }

    public function data_static_patient(){

        $start_month = new Carbon('first day of this month');
        $start_month = $start_month->format('Y-m-d');
        $end_month = date('Y-m-d');

        $pendaftaran = MedicalRecord::select(
            DB::raw("(count(*)) as total"),
            DB::raw("(DATE_FORMAT(created_at, '%d')) as date")
        )->whereBetween('created_at', [$start_month, $end_month])->groupBy(
            DB::raw("DATE_FORMAT(created_at, '%d')"))->get();

        $periods = CarbonPeriod::create($start_month, Carbon::now());
        foreach ($periods as $i =>  $p) {
            $d = $p->format('d');
            $data['labels'][] = $d;
            $data['data'][] = $pendaftaran->where('date', $d)->first()->total??0;
        }
        return response()->json($data);
    }

    public function change_profile(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$request->user()->id.',id'
        ]);
        $request->user()->update($validate);
        return back()->with('success', 'Ganti profil berhasil');
    }

    public function change_password(Request $request)
    {
        $validate = $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
        $user = User::find($request->user()->id);
        if(!Hash::check($validate['old_password'],$user->password)){
            return back()->withErrors(['old_password'=>'Password lama salah']);
        }
        $validate['password'] = bcrypt($validate['password']);
        $user->update($validate);
        return back()->with('success', 'Ganti password berhasil');
    }

    public function laporan(Request $request)
    {
        if($request->ajax()){
            $model = History::query();
            if(!is_null($request->dates)){
                $dates = explode(' / ', $request->dates);
                $start = date('Y-m-d', strtotime($dates[0]));
                $end = date('Y-m-d', strtotime($dates[1])).' 23:59:59';
                $model = $model->whereBetween('created_at', [$start,$end]);
            }
            $dt = DataTables::collection($model->get());
            return $dt
                ->editColumn('created_at', function($patient){
                    return $patient->created_at->format('d-m-Y H:i:s');
                })
                ->editColumn('name', function($patient){
                    return '<p class="text-xs font-weight-bold mb-0">'.$patient->name .'</p>
                    <p class="text-xs text-secondary mb-0">'.$patient->no_rm.'</p>';
                })
                ->addColumn('action', function($patient){
                    return '<a href="/laporan/'.$patient->id.'" class="btn btn-primary">Detail</a>';
                })
                ->escapeColumns([''])
                ->toJson();
        }
        return view('laporan.index');
    }

    public function show(History $medical_record)
    {
        $med_recs = MedicalRecord::where('patient_id', $medical_record->med_rec->patient_id)->get();
        return view('laporan.'.auth()->user()->role, compact('medical_record','med_recs'));
    }

    public function export(Request $request)
    {
        if($request->has('printAll')){
            $name = 'Laporan Rekam Medis Semua Tanggal';
            $model = MedicalRecord::whereHas('patient')->get();
        }else{
            $request->validate([
                'dates' => 'required',
            ]);
            $dates = explode(' / ', $request->dates);
            $start = date('Y-m-d', strtotime($dates[0]));
            $end = date('Y-m-d', strtotime($dates[1]));
            if($start==$end){
                $name = 'Laporan Rekam Medis Hari Ini';
            }elseif($start==date('Y-m-d',strtotime($end)-(60*60*24*6))){
                $name = 'Laporan Rekam Medis Minggu Ini';
            }elseif($start==date('Y-m-d',strtotime($end)-(60*60*24*29))){
                $name = 'Laporan Rekam Medis Bulan Ini';
            }else{
                $name = 'Laporan Rekam Medis dari tanggal '.$start.' sampai '.$end;
            }
            $model = MedicalRecord::whereHas('patient')->whereBetween('created_at', [$start,$end.' 23:59:59'])->get();
        }
        if($request->has('pdf')){
            $pdf = Pdf::loadView('pdf.medical-record', compact('model', 'name'));
            return $pdf->stream($name.'.pdf');
        }else if($request->has('excel')){
            return Excel::download(new MedicalRecordExport($model,$name), $name.'.xlsx');
        }
    }
}
