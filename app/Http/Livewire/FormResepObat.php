<?php

namespace App\Http\Livewire;

use App\Models\MedicalRecord;
use App\Models\Obat;
use App\Models\Receipt;
use Livewire\Component;

class FormResepObat extends Component
{
    protected $listeners = ['setPrice'];
    public $med_rec;
    public $receipts = [ ["obat_id" => '', 'amount' => 0,'price'=>0, 'subtotal' => 0, 'max' => 0] ];
    public $obats;
    public $doctor_price = 0;

    public function addObat()
    {
        $this->receipts[] = [ "obat_id" => '', 'amount' => 0,'price'=>0, 'subtotal' => 0 , 'max' => 0];
    }

    public function mount($med_rec)
    {
        $this->med_rec = $med_rec;
        $this->obats = Obat::where('stock', '>',0)->get();
    }

    public function setPrice($i)
    {
        $obat_id = $this->receipts[$i]['obat_id'];
        $this->receipts[$i]['max'] = $this->obats->where('id',$obat_id)->first()->stock;
        $this->receipts[$i]['price'] = $this->obats->where('id', $obat_id)->first()->price??0;
    }

    public function setSubtotal($i)
    {
        $this->receipts[$i]['subtotal'] = $this->receipts[$i]['price'] * $this->receipts[$i]['amount'];
    }

    public function save()
    {
        $validasi = [
            'receipts' => 'required|array',
            'receipts.*.obat_id' => 'required',
            'doctor_price' => 'required'
        ];
        foreach($this->receipts as $i => $receipt){
            $validasi['receipts.'.$i.'.amount'] = 'required|numeric|min:1|max:'.$receipt['max'];
        }

        $this->med_rec->update(['doctor_price'=>$this->doctor_price]);
        $this->validate($validasi,[],[
            'receipts.*.obat_id' => 'Obat',
            'receipts.*.amount' => 'jumlah'
        ]);
        foreach($this->receipts as $receipt){
            $obat = Obat::find($receipt['obat_id']);
            $obat->update(['stock' => $obat->stock - $receipt['amount']]);
            Receipt::create(array_merge($receipt, ['medical_record_id'=>$this->med_rec->id]));
        }
        return redirect('apoteker/pemberian-obat')->with('success', 'Pemberian obat berhasil');
    }

    public function render()
    {
        return view('livewire.form-resep-obat');
    }
}
