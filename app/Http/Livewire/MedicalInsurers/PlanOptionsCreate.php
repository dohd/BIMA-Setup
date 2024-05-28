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
        $medical_insurer_id = $this->medical_insurer->id;
        $plan_id = $this->plan_id;

        try {
            DB::beginTransaction();

            function savePlanOption($input_arr, $medical_insurer_id, $plan_id) {
                // delete omitted rows
                $class = current($input_arr)['class'];
                $item_ids = array_map(fn($v) => @$v['id'], $input_arr);
                if ($item_ids) {
                    PlanOption::doesntHave('rate_variables')
                    ->where('plan_id', $plan_id)
                    ->where('class', $class)
                    ->whereNotIn('id', $item_ids)
                    ->delete();
                }
                
                foreach ($input_arr as $key => $value) {
                    $value1 = Arr::only($value, ['id', 'class', 'label', 'limit', 'max_fam_size_id']);
                    $value1 = array_replace($value1, [
                        'insurer_id' => $medical_insurer_id,
                        'plan_id' => $plan_id,
                        'user_id' => auth()->user()->id,
                        'limit' => numberClean(@$value1['limit']),
                    ]);
                    
                    $plan_option = PlanOption::firstOrNew(['id' => @$value1['id']]);
                    $plan_option->fill($value1);
                    $plan_option->save();
                }    
            }

            // inpatients
            $inpatients = $this->inpatients->toArray();
            savePlanOption($inpatients, $medical_insurer_id, $plan_id);

            // outpatients
            $outpatients = $this->outpatients->toArray();
            savePlanOption($outpatients, $medical_insurer_id, $plan_id);

            // maternities
            $maternities = $this->maternities->toArray();
            savePlanOption($maternities, $medical_insurer_id, $plan_id);

            // dentals
            $dentals = $this->dentals->toArray();
            savePlanOption($dentals, $medical_insurer_id, $plan_id);

            // opticals
            $opticals = $this->opticals->toArray();
            savePlanOption($opticals, $medical_insurer_id, $plan_id);

            DB::commit();
        } catch (\Throwable $th) {
            return errorHandler('Error updating plan options', $th);
        }
        
        return redirect(route('medical_insurers.show', $this->medical_insurer))->with('success', 'Successfully updated plan options');
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
