<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PemeriksaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $med_recs = MedicalRecord::whereDate('created_at', date('Y-m-d'))->where('diagnose', null)->get();
        return view('dokter.pemeriksaan.index', compact('med_recs'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MedicalRecord  $pemeriksaan
     * @return \Illuminate\Http\Response
     */
    public function show(MedicalRecord $pemeriksaan)
    {
        return view('dokter.pemeriksaan.show', [
            'patient' => $pemeriksaan,
        ]);
    }

    public function receipt(Request $request, MedicalRecord $pemeriksaan)
    {
        $validate = $request->validate([
            'anamnesa' => 'required',
            'physical_check' => 'required',
            'diagnose' => 'required',
            'theraphy' => 'nullable',
            'rujukan' => 'nullable|array'
        ]);
        if($request->has('rujukan')){
            $pemeriksaan->update($validate);
            return redirect('dokter/pemeriksaan')->with('Surat Rujukan Berhasil dibuat');
        }else{
            $request->session()->put(['med_rec'=>$validate]);
            return redirect()->route('pemeriksaan.receipt', $pemeriksaan);
        }
    }

    public function show_receipt(MedicalRecord $pemeriksaan)
    {
        return view('dokter.pemeriksaan.resep', compact('pemeriksaan'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MedicalRecord  $pemeriksaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MedicalRecord $pemeriksaan)
    {
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
        $pemeriksaan->update($data);
        $request->session()->forget('med_rec');
        return redirect('dokter/pemeriksaan')->with(['success'=>'Pemeriksaan dan pemberian obat telah dilakukan.']);
    }

}
