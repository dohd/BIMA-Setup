<?php

namespace App\Models\medical_insurers\Traits;

use App\Models\medical_insurers\MedicalInsurer;
use App\Models\medical_insurers\OptionRate;
use App\Models\medical_insurers\PlanOption;

trait MedicalPlanRelationship
{
    public function medical_insurer()
    {
        return $this->belongsTo(MedicalInsurer::class, 'insurer_id');
    }

    public function plan_options()
    {
        return $this->hasMany(PlanOption::class, 'plan_id');
    }

    public function option_rates()
    {
        return $this->hasMany(OptionRate::class, 'plan_id');
    }
}
