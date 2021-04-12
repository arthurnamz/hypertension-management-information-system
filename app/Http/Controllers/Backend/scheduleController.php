<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Allergies;
use App\Appointment;
use App\BP_measurements;
use App\Chest_xray;
use App\Employee;
use App\Glucose_Test;
use App\Hospital;
use App\Kidney_Test;
use App\Other_Test;
use App\Patient;
use App\Schedule;
use App\Treatment;
use App\Urinalysis;
use App\User;

class scheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Schedule = Schedule::with('Employee')->get();
        return view('schedule/schedule', compact('Schedule'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Employee = Employee::get();
        return view('schedule/add_schedule', compact('Employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Schedule = new Schedule();
        $Schedule->employee_id = $request -> employee_id; 
        $Schedule->available_days = $request -> available_days; 
        $Schedule->start_time = $request -> start_time; 
        $Schedule->end_time = $request -> end_time; 
        $Schedule->message = $request -> message; 
        $Schedule->status = $request -> status; 

        // dd($Schedule); 
        $Schedule->save(); 

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Schedule = Schedule::find($id);
        $Employee = Employee::get();
        return view('schedule/edit_schedule', compact('Schedule', 'Employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Schedule = Schedule::find($id);
        $Schedule->employee_id = $request -> employee_id; 
        $Schedule->available_days = $request -> available_days; 
        $Schedule->start_time = $request -> start_time; 
        $Schedule->end_time = $request -> end_time; 
        $Schedule->message = $request -> message; 
        $Schedule->status = $request -> status; 
        $Schedule->save(); 

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Schedule = Schedule::find($id);
        $Schedule -> delete();
        return redirect()->back();
    }
}
