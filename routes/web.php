<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\config\ConfigController;
use App\Http\Controllers\medical_insurers\MedicalInsurersController;
use App\Http\Controllers\user_profile\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Authentication
Auth::routes();
Route::get('/', [LoginController::class, 'index']);
Route::get('logout', [LoginController::class, 'logout']);
Route::group(['middleware' => 'auth'], function() {
    // Dashboard
    Route::get('dashboard', [HomeController::class, 'index'])->name('home');

    // Medical Insurers
    Route::resource('medical_insurers', MedicalInsurersController::class);

    // User Profiles
    Route::post('user_profiles/delete_profile_pic/{user}', [UserProfileController::class, 'delete_profile_pic'])->name('user_profiles.delete_profile_pic');
    Route::post('user_profiles/update_active_profile/{user}', [UserProfileController::class, 'update_active_profile'])->name('user_profiles.update_active_profile');
    Route::get('user_profiles/active_profile', [UserProfileController::class, 'active_profile'])->name('user_profiles.active_profile');
    Route::resource('user_profiles', UserProfileController::class);
    
    // Configuration
    Route::get('clear-cache', [ConfigController::class, 'clear_cache'])->name('config.clear_cache');
    Route::get('site-down', [ConfigController::class, 'site_down'])->name('config.site_down');
});
