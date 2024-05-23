<?php

namespace App\Http\Livewire\MedicalInsurers;

use Illuminate\Support\Collection;
use Livewire\Component;

class PlanCreate extends Component
{
    public Collection $inputs;

    public function mount()
    { 
        $this->fill([
            'inputs' => collect([['plan_name' => '']]),
        ]);
    }

    protected $rules = [
        'inputs.*.plan_name' => 'required',
    ];
    
    protected $messages = [
        'inputs.*.plan_name.required' => 'This plan name field is required!',
    ];

    public function save()
    { 
        $this->validate();

        // 

        return redirect(route('medical_insurers.create'))->with('success', 'Successfully updated');
    }

    public function addRow()
    {
        $this->inputs->push(['plan_name' => '']);
    }

    public function removeRow($key)
    {
        $this->inputs->pull($key);
    }

    public function render()
    {
        return view('livewire.medical-insurers.plan-create');
    }
}
