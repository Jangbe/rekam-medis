<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\Obat;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obats = Obat::all();
        return view('apoteker.obat.index', compact('obats'));
    }

    public function ajax(Request $request)
    {
        $model = Obat::query();

        return DataTables::of($model)
            ->editColumn('name', function($o){
                return '<div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">'. $o->name .'</h6>
                    </div>
                </div>';
            })
            ->editColumn('type', function($o){
                return '<p class="text-xs font-weight-bold mb-0">'. $o->type .'</p>';
            })
            ->editColumn('satuan', function($o){
                return '<span class="badge badge-sm bg-gradient-success">'.$o->satuan.'</span>';
            })
            ->editColumn('price', function($o){
                return '<span class="text-secondary text-xs font-weight-bold">Rp. '.number_format($o->price, 0, ',', '.').'</span>';
            })
            ->editColumn('action', function($o){
                return view('apoteker.obat._action', compact('o'));
            })
            ->escapeColumns([])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Obat';
        $action = route('obat.store');
        return view('apoteker.obat.editor', compact('title', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge(['price' => str_replace('.', '', $request->price)]);
        $validate = $request->validate([
            'name' => 'required',
            'unit' => 'required',
            // 'type' => 'required',
            // 'satuan' => 'required',
            'price' => 'required|numeric'
        ]);
        Obat::create($validate);
        return $request->ajax()?
            response()->json('Obat berhasil ditambahkan')
            :redirect()->route('obat.index')->with('success', 'Obat berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Obat  $obat
     * @return \Illuminate\Http\Response
     */
    public function edit(Obat $obat)
    {
        $title = 'Tambah Obat';
        $action = route('obat.update',$obat);
        $method = 'put';
        return view('apoteker.obat.editor', compact('title', 'action','method','obat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Obat  $obat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Obat $obat)
    {
        $request->merge(['price' => implode('', explode('.', $request->price))]);
        $validate = $request->validate([
            'name' => 'required',
            'unit' => 'required',
            // 'type' => 'required',
            // 'satuan' => 'required',
            'price' => 'required|numeric'
        ]);
        $obat->update($validate);
        return $request->ajax()?
            response()->json('Data obat berhasil diupdate')
            :redirect()->route('obat.index')->with('success', 'Data obat berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Obat  $obat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Obat $obat)
    {
        $obat->delete();
        return request()->ajax()?
            response()->json('Data obat berhasil dihapus')
            :back()->with('success', 'Data obat berhasil dihapus');
    }

    public function receipt()
    {
        $med_rec = MedicalRecord::whereDate('created_at', date('Y-m-d'))->where('diagnose', '!=', null)->where('rujukan',null)
                ->doesntHave('receipts')->first();
        return view('apoteker.pemberian-obat', compact('med_rec'));
    }

    public function update_stock(Request $request, Obat $obat)
    {
        $stok = $obat->stock + $request->stock;
        $obat->update(['stock'=>$stok]);
        return response()->json('Stok '.$obat->name.' berhasil ditambah');
    }
}
