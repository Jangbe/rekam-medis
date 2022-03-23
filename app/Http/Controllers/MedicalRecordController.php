<?php

namespace App\Http\Controllers;

use App\Exports\MedicalRecordExport;
use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class MedicalRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $med_recs = MedicalRecord::whereDate('created_at', date('Y-m-d'))->get();
        return view('pegawai.medical-records.index', compact('med_recs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $last_registered = MedicalRecord::whereDate('created_at', date('Y-m-d'))->latest()->first('order');
        $order = 1;
        if($last_registered){
            $order += $last_registered->order;
        }
        $title = 'Tambah Data Pasien';
        $action = route('medical-records.store');
        $patients = Patient::all();
        return view('pegawai.medical-records.create', compact('title', 'action', 'order', 'patients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'status' => 'required',
            'order' => 'required',
            'name' => 'required_if:status,baru',
            'birth' => 'required_if:status,baru|nullable|date',
            'gender' => 'required_if:status,baru|in:L,P',
            'father_name' => 'required_if:status,baru',
            'mother_name' => 'required_if:status,baru',
            'phone' => 'required_if:status,baru|nullable|numeric',
            'provincy' => 'required_if:status,baru',
            'regency' => 'required_if:status,baru',
            'district' => 'required_if:status,baru',
            'village' => 'required_if:status,baru',
            'address' => 'required_if:status,baru',
            'patient_id' => 'required_if:status,lama'
        ]);
        $patient_id = $validate['patient_id'];
        if($validate['status']=='baru'){
            $char = substr($request->name, 0, 1);
            $last_rm = Patient::where('no_rm', 'like', $char.'%')->latest()->first();
            if($last_rm){
                $last_no = substr($last_rm->no_rm, -4, 4)+1;
                $last_no = strtoupper(substr("000".$last_no, -4, 4));
            }else{
                $last_no = strtoupper('0001');
            }
            $no_rm = strtoupper(substr($request->name, 0, 1)).'-'.$last_no;
            $validate['no_rm'] = $no_rm;
            $patient_id = Patient::create($validate)->id;
        }
        MedicalRecord::create([
            'patient_id' => $patient_id,
            'order' => $validate['order'],
            'physical_check' => json_encode($request->physical_check)
        ]);
        return redirect()->route('medical-records.index')->with('success', 'Pendaftaran berhasil dilakukan.');
    }

    public function pemeriksaan(Request $request)
    {
        $patient = MedicalRecord::whereDate('created_at', date('Y-m-d'))->where('diagnose', null)->first();
        if(request()->method()=='GET'){
            return view('dokter.pemeriksaan.index', compact('patient'));
        }else{
            $validate = $request->validate([
                'anamnesa' => 'required',
                'physical_check' => 'required',
                'diagnose' => 'required',
                'theraphy' => 'nullable',
                'rujukan' => 'nullable|array'
            ]);
            if($request->has('rujukan')){
                $patient->update($validate);
                return redirect('dokter/pemeriksaan');
            }else{
                $request->session()->put(['med_rec'=>$validate]);
                return redirect('dokter/resep');
            }
        }
    }

    public function surat_sakit(Request $request,MedicalRecord $patient)
    {
        $hari = $request->hari;
        $from = Carbon::now();
        $to = Carbon::now()->addDays($hari);
        $width = 11/2.54*72;
        $height = 20/2.54*72;
        $customPaper = array(0,0,$width,$height);
        $pekerjaan = $request->pekerjaan;
        $pdf = PDF::loadView('pdf.surat_sakit', compact('patient', 'pekerjaan','hari', 'from', 'to'))->setPaper($customPaper, 'portrait');
        return $pdf->stream('test.pdf');
    }

    public function surat_rujukan(MedicalRecord $patient)
    {
        $width = 11/2.54*72;
        $height = 20/2.54*72;
        $customPaper = array(0,0,$width,$height);
        $pdf = PDF::loadView('pdf.surat_rujukan', compact('patient'))->setPaper($customPaper, 'portrait');
        return $pdf->stream('test.pdf');
    }

    public function receipt(Request $request)
    {
        $med_rec = MedicalRecord::whereDate('created_at', date('Y-m-d'))->where('diagnose', null)->first();
        if($request->method()=='GET'){
            return view('dokter.pemeriksaan.resep', ['patient'=>$med_rec->patient]);
        }else{
            $image_64 = $request['receipt']; //your base64 encoded data
            $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
            $replace = substr($image_64, 0, strpos($image_64, ',')+1);

            // find substring fro replace here eg: data:image/png;base64,
            $image = str_replace($replace, '', $image_64);
            $image = str_replace(' ', '+', $image);
            $imageName = 'receipt/'.Str::random(10).'.'.$extension;
            Storage::disk('public')->put($imageName, base64_decode($image));

            $data = $request->session()->get('med_rec');
            $data['receipt'] = $imageName;
            $med_rec->update($data);
            $request->session()->forget('med_rec');
            return redirect('dokter/pemeriksaan')->with(['success'=>'Pemeriksaan dan pemberian obat telah dilakukan.']);
        }
    }

    public function laporan(Request $request)
    {
        if($request->ajax()){
            $model = MedicalRecord::whereHas('patient')->with('patient');
            if(!is_null($request->dates)){
                $dates = explode(' - ', $request->dates);
                $start = date('Y-m-d', strtotime($dates[0]));
                $end = date('Y-m-d', strtotime($dates[1]));
                $model = $model->whereBetween('created_at', [$start,$end]);
            }
            $dt = DataTables::collection($model->get());
            return $dt
                ->editColumn('created_at', function($patient){
                    return $patient->created_at->format('d-m-Y H:i:s');
                })
                ->editColumn('name', function($patient){
                    return '<p class="text-xs font-weight-bold mb-0">'.$patient->patient->name .'</p>
                    <p class="text-xs text-secondary mb-0">'.$patient->patient->no_rm.'</p>';
                })
                ->escapeColumns([''])
                ->toJson();
        }
        return view('pegawai.laporan');
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
            $dates = explode(' - ', $request->dates);
            $start = date('Y-m-d', strtotime($dates[0]));
            $end = date('Y-m-d', strtotime($dates[1]));
            $name = 'Laporan Rekam Medis dari tanggal '.$start.' sampai '.$end;
            $model = MedicalRecord::whereHas('patient')->whereBetween('created_at', [$start,$end])->get();
        }
        if($request->has('pdf')){
            $pdf = PDF::loadView('pdf.medical-record', compact('model', 'name'));
            return $pdf->stream($name.'.pdf');
        }else if($request->has('excel')){
            return Excel::download(new MedicalRecordExport($model,$name), $name.'.xlsx');
        }
    }
}
