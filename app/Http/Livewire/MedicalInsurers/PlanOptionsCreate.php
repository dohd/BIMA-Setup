<?php

namespace App\Http\Livewire\MedicalInsurers;

use App\Models\medical_insurers\MedicalPlan;
use App\Models\medical_insurers\PlanOption;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PlanOptionsCreate extends Component
{
    public $medical_insurer;
    public $plan_id;
    public $medical_plans = [];
    public $max_fam_sizes = [];
    
    public Collection $inpatients;
    public Collection $outpatients;
    public Collection $maternities;
    public Collection $dentals;
    public Collection $opticals;

    public function mount()
    { 
        $this->medical_plans = MedicalPlan::where('insurer_id', @$this->medical_insurer->id)->get();
        $this->max_fam_sizes = [
            ['id' => 1, 'unit' => 'M+'],
            ['id' => 2, 'unit' => 'M+2'],
            ['id' => 3, 'unit' => 'M+3'],
        ];
        
        $this->fill([
            'inpatients' => new Collection([PlanOption::make()]),
            'outpatients' => new Collection([PlanOption::make()]),
            'maternities' => new Collection([PlanOption::make()]),
            'dentals' => new Collection([PlanOption::make()]),
            'opticals' => new Collection([PlanOption::make()]),
        ]);
    }

    protected $rules = [
        'plan_id' => 'required',
        'inpatients.*.limit' => 'required',
        'inpatients.*.max_fam_size_id' => 'required',
        'outpatients.*.limit' => 'required',
        'outpatients.*.max_fam_size_id' => 'required',
        'maternities.*.limit' => 'required',
        'maternities.*.max_fam_size_id' => 'required',
        'dentals.*.limit' => 'required',
        'dentals.*.max_fam_size_id' => 'required',
        'opticals.*.limit' => 'required',
        'opticals.*.max_fam_size_id' => 'required',
    ];
    
    protected $messages = [
        'plan_id.required' => 'medical plan field is required!',
        'inpatients.*.limit.required' => 'limit field is required!',
        'inpatients.*.max_fam_size_id.required' => 'max family size field is required!',
        'outpatients.*.limit.required' => 'limit field is required!',
        'outpatients.*.max_fam_size_id.required' => 'max family size field is required!',
        'maternities.*.limit.required' => 'limit field is required!',
        'maternities.*.max_fam_size_id.required' => 'max family size field is required!',
        'dentals.*.limit.required' => 'limit field is required!',
        'dentals.*.max_fam_size_id.required' => 'max family size field is required!',
        'opticals.*.limit.required' => 'limit field is required!',
        'opticals.*.max_fam_size_id.required' => 'max family size field is required!',
    ];

    public function save()
    { 
        $this->validate();

        try {
            DB::beginTransaction();

            // inpatients
            $inpatients = $this->inpatients->toArray();
            $inpatients = array_map(function($v) {
                $v = Arr::only($v, ['class', 'label', 'limit', 'max_fam_size_id']);
                return array_replace($v, [
                    'insurer_id' => $this->medical_insurer->id,
                    'plan_id' => $this->plan_id,
                    'user_id' => auth()->user()->id,
                ]);
            }, $inpatients);

            // outpatients
            $outpatients = $this->outpatients->toArray();
            $outpatients = array_map(function($v) {
                $v = Arr::only($v, ['class', 'label', 'limit', 'max_fam_size_id']);
                return array_replace($v, [
                    'insurer_id' => $this->medical_insurer->id,
                    'plan_id' => $this->plan_id,
                    'user_id' => auth()->user()->id,
                ]);
            }, $outpatients);

            // maternities
            $maternities = $this->maternities->toArray();
            $maternities = array_map(function($v) {
                $v = Arr::only($v, ['class', 'label', 'limit', 'max_fam_size_id']);
                return array_replace($v, [
                    'insurer_id' => $this->medical_insurer->id,
                    'plan_id' => $this->plan_id,
                    'user_id' => auth()->user()->id,
                ]);
            }, $maternities);

            // dentals
            $dentals = $this->dentals->toArray();
            $dentals = array_map(function($v) {
                $v = Arr::only($v, ['class', 'label', 'limit', 'max_fam_size_id']);
                return array_replace($v, [
                    'insurer_id' => $this->medical_insurer->id,
                    'plan_id' => $this->plan_id,
                    'user_id' => auth()->user()->id,
                ]);
            }, $dentals);

            // opticals
            $opticals = $this->opticals->toArray();
            $opticals = array_map(function($v) {
                $v = Arr::only($v, ['class', 'label', 'limit', 'max_fam_size_id']);
                return array_replace($v, [
                    'insurer_id' => $this->medical_insurer->id,
                    'plan_id' => $this->plan_id,
                    'user_id' => auth()->user()->id,
                ]);
            }, $opticals);
            
            $inputs = array_merge($inpatients, $outpatients, $maternities, $dentals, $opticals);
            $inputs = array_map(function($v) {
                $v['limit'] = numberClean($v['limit']);
                return $v;
            }, $inputs);
            PlanOption::where('plan_id', $this->plan_id)->delete();
            PlanOption::insert($inputs);

            DB::commit();
        } catch (\Throwable $th) {
            return errorHandler('Error updating plan options', $th);
        }
        
        return redirect(route('medical_insurers.index'))->with('success', 'Successfully updated plan options');
    }

    public function updatedPlanId($value)
    {
        $plan_options = PlanOption::where('plan_id', $value)->get();
        if ($plan_options->count()) {
            $this->fill([
                'inpatients' => new Collection($plan_options->where('class', 'Inpatient')),
                'outpatients' => new Collection($plan_options->where('class', 'Outpatient')),
                'maternities' => new Collection($plan_options->where('class', 'Maternity')),
                'dentals' => new Collection($plan_options->where('class', 'Dental')),
                'opticals' => new Collection($plan_options->where('class', 'Optical')),
            ]);
        } else {
            $this->fill([
                'inpatients' => new Collection([PlanOption::make()]),
                'outpatients' => new Collection([PlanOption::make()]),
                'maternities' => new Collection([PlanOption::make()]),
                'dentals' => new Collection([PlanOption::make()]),
                'opticals' => new Collection([PlanOption::make()]),
            ]);
        }
    }

    public function addRow($class)
    {
        switch ($class) {
            case 'inpatient': 
                $this->inpatients->push(PlanOption::make(['class' => 'Inpatient']));
                break;
            case 'outpatient':
                $this->outpatients->push(PlanOption::make(['class' => 'Outpatient'])); 
                break;
            case 'maternity': 
                $this->maternities->push(PlanOption::make(['class' => 'Maternity'])); 
                break;
            case 'dental': 
                $this->dentals->push(PlanOption::make(['class' => 'Dental'])); 
                break;
            case 'optical': 
                $this->opticals->push(PlanOption::make(['class' => 'Optical'])); 
                break;
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
