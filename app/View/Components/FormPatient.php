<?php

namespace App\View\Components;

use App\Models\Patient;
use Illuminate\View\Component;

class FormPatient extends Component
{
    public Patient $patient;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Patient $patient)
    {
        $this->patient = $patient;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-patient');
    }
}
