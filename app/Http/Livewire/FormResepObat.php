<?php

namespace App\Http\Livewire;

use App\Models\MedicalRecord;
use App\Models\Obat;
use App\Models\Receipt;
use Livewire\Component;

class FormResepObat extends Component
{
    protected $listeners = ['setPrice'];
    public $receipts = [ ["obat_id" => '', 'amount' => 0,'price'=>0, 'subtotal' => 0] ];
    public $obats;
    public $doctor_price = 0;
    public $max = 0;

    // public function hydrate()
    // {
    //     $this->emit('select2-obat');
    // }

    public function addObat()
    {
        $this->receipts[] = [ "obat_id" => '', 'amount' => 0,'price'=>0, 'subtotal' => 0 ];
    }

    public function mount()
    {
        $this->obats = Obat::where('stock', '>',0)->get();
    }

    public function setPrice($i)
    {
        $obat_id = $this->receipts[$i]['obat_id'];
        $this->max = $this->obats->where('id',$obat_id)->first()->stock;
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
        $med_rec->update(['doctor_price'=>$this->doctor_price]);
        $validate = $this->validate([
            'receipts' => 'required|array',
            'receipts.*.obat_id' => 'required',
            'receipts.*.amount' => 'required|numeric|min:1',
            'doctor_price' => 'required'
        ],[],[
            'receipts.*.obat_id' => 'Obat'
        ]);
        foreach($this->receipts as $receipt){
            $obat = Obat::find($receipt['obat_id']);
            $obat->update(['stock' => $obat->stock - $receipt['amount']]);
            Receipt::create(array_merge($receipt, ['medical_record_id'=>$med_rec->id]));
        }
        return redirect('apoteker/pemberian-obat')->with('success', 'Pemberian obat berhasil');
    }

    public function render()
    {
        return view('livewire.form-resep-obat');
    }
}
