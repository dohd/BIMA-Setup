<?php

namespace App\Http\Livewire\MedicalInsurers;

use Illuminate\Support\Collection;
use Livewire\Component;

class PlanOptionsCreate extends Component
{
    public $plan_id;
    public Collection $medical_plans;
    public Collection $max_fam_sizes;
    public Collection $inpatients;
    public Collection $outpatients;
    public Collection $maternities;
    public Collection $dentals;
    public Collection $opticals;

    public function mount()
    { 
        $this->fill([
            'medical_plans' => collect([
                (object) ['id' => 1, 'plan_name' => 'Afya Jumla'],
            ]),
            'max_fam_sizes' => collect([
                (object) ['id' => 1, 'unit' => 'M+'],
            ]),
            'inpatients' => collect([
                (object) ['inpatient_label' => '', 'inpatient_option' => 0, 'inpatient_limit' => 0, 'max_fam_size_id' => 1 ],
            ]),
            'outpatients' => collect([
                (object) ['outpatient_label' => '', 'outpatient_option' => 0, 'outpatient_limit' => 0, 'max_fam_size_id' => 1 ],
            ]),
            'maternities' => collect([
                (object) ['maternity_label' => '', 'maternity_option' => 0, 'maternity_limit' => 0, 'max_fam_size_id' => 1 ],
            ]),
            'dentals' => collect([
                (object) ['dental_label' => '', 'dental_option' => 0, 'dental_limit' => 0, 'max_fam_size_id' => 1 ],
            ]),
            'opticals' => collect([
                (object) ['optical_label' => '', 'optical_option' => 0, 'optical_limit' => 0, 'max_fam_size_id' => 1 ],
            ]),
        ]);
    }

    protected $rules = [
        // 'inputs.*.plan_name' => 'required',
        'plan_id' => 'required',
    ];
    
    protected $messages = [
        // 'inputs.*.plan_name.required' => 'This plan name field is required!',
        'plan_id.required' => 'This plan name field is required',
    ];

    public function save()
    { 
        // $this->validate();
        
        // 

        return redirect(route('medical_insurers.create'))->with('success', 'Successfully updated');
    }

    public function addRow($class)
    {
        switch ($class) {
            case 'inpatient': $this->inpatients->push($this->inpatients[0]); break;
            case 'outpatient': $this->outpatients->push($this->outpatients[0]); break;
            case 'maternity': $this->maternities->push($this->maternities[0]); break;
            case 'dental': $this->dentals->push($this->dentals[0]); break;
            case 'optical': $this->opticals->push($this->opticals[0]); break;
        }
    }

    public function removeRow($class, $key)
    {
        switch ($class) {
            case 'inpatient': $this->inpatients->pull($key); break;
            case 'outpatient': $this->outpatients->pull($key); break;
            case 'maternity': $this->maternities->pull($key); break;
            case 'dental': $this->dentals->pull($key); break;
            case 'optical': $this->opticals->pull($key); break;
        }
    }

    public function render()
    {
        return view('livewire.medical-insurers.plan-options-create');
    }
}
