<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::all();
        return view('pegawai.patient.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Data Pasien';
        $action = route('patients.store');
        return view('pegawai.patient.editor', compact('title', 'action'));
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
            'name' => 'required',
            'birth' => 'required|date',
            'father_name' => 'required',
            'mother_name' => 'required',
            'phone' => 'required|numeric',
            'provincy' => 'required',
            'regency' => 'required',
            'district' => 'required',
            'village' => 'required',
            'address' => 'required'
        ]);
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
        Patient::create($validate);
        return redirect()->route('patients.index')->with('success', 'Data pasien berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        $action = route('patients.update', $patient);
        $method = 'put';
        $title = 'Edit Data Pasien '.$patient->name;
        return view('pegawai.patient.editor', compact('patient', 'action','method', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $validate = $request->validate([
            'name' => 'required',
            'birth' => 'required|date',
            'father_name' => 'required',
            'mother_name' => 'required',
            'phone' => 'required|numeric',
            'provincy' => 'required',
            'regency' => 'required',
            'district' => 'required',
            'village' => 'required',
            'address' => 'required'
        ]);
        $patient->update($validate);
        return redirect()->route('patients.index')->with('success', 'Data pasien berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $name = $patient->name;
        $patient->delete();
        return back()->with('success', 'Pasien '.$name.' berhasil dihapus');
    }
}
