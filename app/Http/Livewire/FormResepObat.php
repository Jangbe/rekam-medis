<?php

namespace App\Http\Livewire;

use App\Models\MedicalRecord;
use App\Models\Obat;
use App\Models\Receipt;
use Livewire\Component;

class FormResepObat extends Component
{
    public $receipts = [ ["obat_id" => '', 'amount' => 0,'price'=>0, 'subtotal' => 0] ];

    public $obats;
    public $harga_dokter = 0;

    public function addObat()
    {
        $this->receipts[] = [ "obat_id" => '', 'amount' => 0,'price'=>0, 'subtotal' => 0 ];
    }

    public function mount()
    {
        $this->obats = Obat::all();
    }

    public function setPrice($i)
    {
        $obat_id = $this->receipts[$i]['obat_id'];
        $this->receipts[$i]['price'] = $this->obats->where('id', $obat_id)->first()->price??0;
    }

    public function setSubtotal($i)
    {
        $this->receipts[$i]['subtotal'] = $this->receipts[$i]['price'] * $this->receipts[$i]['amount'];
    }

    public function save()
    {
        $med_rec = MedicalRecord::whereDate('created_at', date('Y-m-d'))
                ->doesntHave('receipts')->first();
        $validate = $this->validate([
            'receipts' => 'required|array',
            'receipts.*.obat_id' => 'required',
            'receipts.*.amount' => 'required|numeric|min:1',
        ],[],[
            'receipts.*.obat_id' => 'Obat'
        ]);
        foreach($this->receipts as $receipt){
            Receipt::create(array_merge($receipt, ['medical_record_id'=>$med_rec->id]));
        }
        return redirect('apoteker/pemberian-obat')->with('success', 'Pemberian obat berhasil');
    }

    public function render()
    {
        return view('livewire.form-resep-obat');
    }
}
