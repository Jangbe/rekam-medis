<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\Patient;
use Faker\Provider\Medical;
use Illuminate\Http\Request;

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
        // dd($last_registered);
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
            'order' => $validate['order']
        ]);
        return redirect()->route('medical-records.index')->with('success', 'Pendaftaran berhasil dilakukan.');
    }

    public function pemeriksaan()
    {
        $patient = MedicalRecord::whereDate('created_at', date('Y-m-d'))->where('diagnose', null)->first();
        // dd($patient);
        return view('dokter.pemeriksaan.index', compact('patient'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MedicalRecord  $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function show(MedicalRecord $medicalRecord)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MedicalRecord  $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicalRecord $medicalRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MedicalRecord  $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MedicalRecord  $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicalRecord $medicalRecord)
    {
        //
    }
}
