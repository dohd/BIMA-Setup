<?php

use App\Models\medical_insurers\MedicalInsurer;
use App\Models\medical_insurers\MedicalPlan;
use App\Models\medical_insurers\OptionRate;
use App\Models\medical_insurers\PlanBenefit;
use App\Models\medical_insurers\PlanOption;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);
    $user = User::where('email', $request->email)->first();
    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages(['email' => ['The provided credentials are incorrect.']]);
    }
    
    return response()->json(['access_token' => $user->createToken(config('app.name'))->plainTextToken]);
});

Route::group(['middleware' => 'auth:sanctum'], function() {
    // medical insurers
    Route::get('medical_insurers', function(Request $request) {
        $medical_insurers = MedicalInsurer::get();
        return response()->json($medical_insurers);
    });
    Route::get('medical_insurers/{medical_insurer}', function(MedicalInsurer $medical_insurer) {
        return response()->json($medical_insurer);
    });
    
    // medical plans
    Route::get('medical_plans', function(Request $request) {
        $input = $request->only('insurer_id');
        $medical_plans = MedicalPlan::where($input)->get();
        return response()->json($medical_plans);
    });
    // plan benefits
    Route::get('plan_benefits', function(Request $request) {
        $input = $request->only('plan_id');
        $plan_benefits = PlanBenefit::where($input)->get();
        return response()->json($plan_benefits);
    });
    // plan options
    Route::post('plan_options', function(Request $request) {
        $input = array_filter($request->only('insurer_id', 'plan_id', 'class'));
        $plan_options = PlanOption::where($input)->get();
        return response()->json($plan_options);
    });
    // option rates
    Route::post('option_rates', function(Request $request) {
        $input = array_filter($request->only('insurer_id', 'plan_id', 'class'));
        $option_rates = OptionRate::where($input)->with('rate_variables')->get();
        return response()->json($option_rates);
    });

    // quote details
    Route::post('quote_details', function(Request $request) {
        $input = $request->only('insurer_id', 'plan_id', 'class');
        $input = array_replace($input, [
            'plan_id' => 11,
            'plan_type' => 'per_person' ?: 'shared',
            'class' => 'Inpatient',
            'principal_age' => 30,
            'spouse_age' => 40,
            'children_count' => 2,
            'limit' => 1000000,
        ]);

        if ($input['plan_type'] == 'per_person') {
            $medical_plan = MedicalPlan::find($input['plan_id']);
            $plan_option = $medical_plan->plan_options()
            ->where('class', $input['class'])
            ->where('limit', $input['limit'])
            ->first();
            
            $principal_age = $input['spouse_age'] > $input['principal_age'] ? $input['spouse_age'] : $input['principal_age'];
            $principal_opt_rate = $medical_plan->option_rates()
            ->where('age_from', '<=', $principal_age)
            ->where('age_to', '>=', $principal_age)
            ->where('class', $input['class'])
            ->first();
            if ($principal_opt_rate) {
                $spouse_opt_rate = $medical_plan->option_rates()
                ->where('limit_label', 'LIKE', '%spouse%')
                ->where('class', $input['class'])
                ->where(function($q) use($principal_opt_rate) {
                    $q->where('row_index', $principal_opt_rate->row_index+1)
                    ->orWhere('row_index', $principal_opt_rate->row_index+2);
                })
                ->first();
                $child_opt_rate = $medical_plan->option_rates()
                ->where('limit_label', 'LIKE', '%child%')
                ->where('class', $input['class'])
                ->where(function($q) use($principal_opt_rate) {
                    $q->where('row_index', $principal_opt_rate->row_index+1)
                    ->orWhere('row_index', $principal_opt_rate->row_index+2);
                })
                ->first();

                $principal_rate_var = @$principal_opt_rate->rate_variables->where('plan_option_id', $plan_option->id)->first();
                $spouse_rate_var = @$spouse_opt_rate->rate_variables->where('plan_option_id', $plan_option->id)->first();
                $child_rate_var = @$child_opt_rate->rate_variables->where('plan_option_id', $plan_option->id)->first();
                $data = [
                    'underwriter' => @$medical_plan->medical_insurer->name,
                    'medical_plan' => $medical_plan->plan_name,
                    'limit' => $input['limit'],
                    'plan_type' => $input['plan_type'],
                    'principal_premium' => +@$principal_rate_var->rate,
                    'spouse_premium' => +@$spouse_rate_var->rate,
                    'child_premium' => +@$child_rate_var->rate,
                ];
                $data['premium'] = $data['principal_premium'] + $data['spouse_premium'] + $data['child_premium'];
            }
        
        } elseif ($input['plan_type'] == 'shared') {

        }
        
        return response()->json(@$data);
    });
});
