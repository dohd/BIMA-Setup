<?php

namespace App\Http\Controllers\medical_insurers;

use App\Http\Controllers\Controller;
use App\Models\attendance\Attendance;
use App\Models\medical_insurers\MedicalInsurer;
use Illuminate\Http\Request;

class MedicalInsurersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('medical_insurers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $medical_insurers = MedicalInsurer::get();
        return view('medical_insurers.create', compact('medical_insurers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            
        ]);
       
        try {
            $input = inputClean($request->except('_token'));
            foreach ($input as $key => $value) {
                $keys = [
                    'team_total', 'guest_total', 'grant_amount', 'retreat_leader_total', 'online_meeting_team_total', 'activities_total', 'summit_leader_total',
                    'recruit_total', 'initiative_total', 'team_mission_total', 'choir_member_total', 'other_activities_total',
                ];
                if (in_array($key, $keys)) {
                    $input[$key] = numberClean($value);
                }
            }

            return redirect(route('medical_insurers.index'))->with(['success' => 'Medical Insurer created successfully']);
        } catch (\Throwable $th) {
            return errorHandler('Error creating Medical Insurer! ', $th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        return view('medical_insurers.view', compact('attendance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        return view('medical_insurers.edit', compact('attendance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    { 
        $request->validate([
            
        ]);

        try {     
            $input = inputClean($request->except('_token'));
            foreach ($input as $key => $value) {
                $keys = [
                    'team_total', 'guest_total', 'grant_amount', 'retreat_leader_total', 'online_meeting_team_total', 'activities_total', 'summit_leader_total',
                    'recruit_total', 'initiative_total', 'team_mission_total', 'choir_member_total', 'other_activities_total',
                ];
                if (in_array($key, $keys)) {
                    $input[$key] = numberClean($value);
                }
            }

            return redirect(route('medical_insurers.index'))->with(['success' => 'Medical Insurer updated successfully']);              
        } catch (\Throwable $th) {
            return errorHandler('Error updating Medical Insurer! ', $th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        try {
            $attendance->delete();
            return redirect(route('medical_insurers.index'))->with(['success' => 'Medical Insurer deleted successfully']);
        } catch (\Throwable $th) {
            return errorHandler('Error deleting Medical Insurer! ', $th);
        }
    }
}
