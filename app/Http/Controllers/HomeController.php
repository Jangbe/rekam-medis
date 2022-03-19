<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Http\Request;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
        $week = ['Ming', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];

        $now = new Carbon();
        $end_week = $now->format('Y-m-d');
        $start_week = $now->subDays(6)->format('Y-m-d');

        $pendaftaran = MedicalRecord::select(
            DB::raw("(count(*)) as total"),
            DB::raw("(DATE_FORMAT(created_at, '%d-%m-%Y')) as my_date"),
            DB::raw("(DATE_FORMAT(created_at, '%w')) as week")
        )->whereBetween('created_at', [$start_week, $end_week])->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"), DB::raw("DATE_FORMAT(created_at, '%w')"))->get();

        $data['data'] = [0,0,0,0,0,0,0];
        $periods = CarbonPeriod::create(Carbon::now()->subDays(6), Carbon::now());
        foreach ($periods as  $p) {
            $w = $p->format('w');
            $data['labels'][] = $week[$w];
            $data['data'][$w] = $pendaftaran->where('week', $w)->first()->total??0;
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
            'email' => 'required|email|unique:users,email,id,'.$request->user()->id
        ]);
        $request->user()->update($validate);
        return back()->with('success', 'Ganti profil berhasil');
    }

    public function change_password(Request $request)
    {

    }
}
