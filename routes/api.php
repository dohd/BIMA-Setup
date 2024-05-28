<?php

use App\Models\medical_insurers\MedicalInsurer;
use App\Models\medical_insurers\MedicalPlan;
use App\Models\medical_insurers\OptionRate;
use App\Models\medical_insurers\PlanOption;
use App\Models\medical_insurers\RateVariable;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();
    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages(['email' => ['The provided credentials are incorrect.']]);
    }
    
    return response()->json([
        'access_token' => $user->createToken(config('app.name'))->plainTextToken
    ]) ;
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
    Route::get('medical_insurers/{medical_insurer}/medical_plans', function(MedicalInsurer $medical_insurer) {
        return response()->json($medical_insurer->plans);
    });
    
    // medical plans
    Route::get('medical_plans', function(Request $request) {
        $input = $request->only('insurer_id');
        $medical_plans = MedicalPlan::where($input)->get();
        return response()->json($medical_plans);
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
});
