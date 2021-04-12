<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
use App\Treatment;
use App\Urinalysis;
use App\User;

class appointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role == 'patient') {
        $Patient_natinal_id = Auth::user()->national_id;
        $Patient = Patient::where('national_id','=', $Patient_natinal_id)->first();
        $Patient1 = $Patient->id;
        $Appointment = Appointment::with('Employee', 'Patient')->where('patient_id', '=', $Patient1 )->get();
        return view('appointment/appointments', compact('Appointment'));

    }else{
        $Appointment = Appointment::with('Employee', 'Patient')->get();
        return view('appointment/appointments', compact('Appointment'));


    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Patient = Patient::get();
        $Employee = Employee::get();
        return view('appointment/add_appointment', compact('Patient', 'Employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Appointment = new Appointment();
        $Appointment->patient_id = $request -> patient_id; 
        $Appointment->employee_id = $request -> employee_id; 
        $Appointment->date = $request -> date; 
        $Appointment->time = $request -> time; 
        $Appointment->status = $request -> status; 
        $Appointment->comment = $request -> comment; 
        $Appointment->save(); 

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
        $Appointment = Appointment::with('Employee', 'Patient')->find($id);
        $Patient = Patient::get();
        $Employee = Employee::get();
        return view('appointment/edit_appointment', compact('Appointment', 'Patient', 'Employee'));
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
        
        $Appointment = Appointment::find($id);
        $Appointment->patient_id = $request -> patient_id; 
        $Appointment->employee_id = $request -> employee_id; 
        $Appointment->date = $request -> date; 
        $Appointment->time = $request -> time; 
        $Appointment->status = $request -> status; 
        $Appointment->comment = $request -> comment; 
        $Appointment->save(); 

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
        $Appointment = Appointment::find($id);
        $Appointment -> delete();
        return redirect()->back();
    }
}
