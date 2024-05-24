<?php

namespace App\Http\Livewire\MedicalInsurers;

use App\Models\medical_insurers\MedicalPlan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PlanCreate extends Component
{
    public $medical_insurer;
    public Collection $inputs;

    public function mount()
    { 
        $plans = MedicalPlan::where('insurer_id', @$this->medical_insurer->id)->get();
        if ($plans->count()) {
            $this->fill([
                'inputs' => collect($plans->toArray()),
            ]);
        } else {
            $this->fill([
                'inputs' => collect([['plan_name' => '']]),
            ]);
        }
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
        
        try {
            DB::beginTransaction();

            $data = array_map(function($v) {
                return [
                    'plan_name' => $v['plan_name'],
                    'insurer_id' => $this->medical_insurer->id,
                    'user_id' => auth()->user()->id,
                ];
            }, $this->inputs->toArray());
            
            $this->medical_insurer->plans()->delete();
            MedicalPlan::insert($data);

            DB::commit();
        } catch (\Throwable $th) {
            return errorHandler('Error updating medical plans', $th);
        }

        return redirect(route('medical_insurers.show', $this->medical_insurer))->with('success', 'Successfully updated');
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
