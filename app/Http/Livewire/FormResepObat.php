<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FormResepObat extends Component
{
    public $obats = [
        ["nama"=>'test']
    ];

    public function addObat()
    {
        $this->obats[] = [
            "nama" => 'test'
        ];
    }

    public function render()
    {
        return view('livewire.form-resep-obat');
    }
}
