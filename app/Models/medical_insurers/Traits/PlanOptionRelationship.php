<?php

namespace App\Models\medical_insurers\Traits;

use App\Models\medical_insurers\MedicalInsurer;
use App\Models\medical_insurers\MedicalPlan;

trait PlanOptionRelationship
{
    public function medical_insurer()
    {
        return $this->belongsTo(MedicalInsurer::class, 'insurer_id');
    }

    public function medical_plan()
    {
        return $this->belongsTo(MedicalPlan::class, 'plan_id');
    }
}
