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
use DB;
use App\Treatment;
use App\Urinalysis;
use App\User;
class bpmeasurementsController extends Controller
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

        $BP_measurements= DB::table('tbl_bp_measurements')
                            ->join('tbl_patients','tbl_patients.id','=',"tbl_bp_measurements.patient_id")
                            ->join('tbl_employees','tbl_employees.id','=',"tbl_bp_measurements.employee_id")
                            ->select('tbl_bp_measurements.id AS id','tbl_patients.last_name AS plname' ,'tbl_patients.first_name AS pfname', 'tbl_employees.last_name AS elname', 'tbl_patients.email AS pemail','tbl_patients.phone_number AS pnumber','tbl_patients.gender AS pgender','tbl_employees.first_name AS efname','tbl_bp_measurements.diastolic','tbl_bp_measurements.systolic','tbl_bp_measurements.pulse_rate','tbl_bp_measurements.comment', 'tbl_bp_measurements.created_at AS tested_date', DB::raw("count(tbl_bp_measurements.patient_id) as count"))
                          ->where("tbl_bp_measurements.patient_id", '=', $Patient1)
                            ->groupBy('tbl_bp_measurements.id')                          
                           ->orderBy('tbl_bp_measurements.created_at', 'desc')
                            ->get();

        return view('tests/bp/bp_test', compact('BP_measurements'));
    }else{
        $BP_measurements= DB::table('tbl_bp_measurements')
                            ->join('tbl_patients','tbl_patients.id','=',"tbl_bp_measurements.patient_id")
                            ->join('tbl_employees','tbl_employees.id','=',"tbl_bp_measurements.employee_id")
                            ->select('tbl_bp_measurements.id AS id','tbl_patients.last_name AS plname' ,'tbl_patients.first_name AS pfname', 'tbl_employees.last_name AS elname', 'tbl_patients.email AS pemail','tbl_patients.phone_number AS pnumber','tbl_patients.gender AS pgender','tbl_employees.first_name AS efname','tbl_bp_measurements.diastolic','tbl_bp_measurements.systolic','tbl_bp_measurements.pulse_rate','tbl_bp_measurements.comment',  DB::raw("count(tbl_bp_measurements.patient_id) as count"))
                          // ->where("tbl_bp_measurements.patient_id", '=', $test_id)
                            ->groupBy('tbl_bp_measurements.patient_id')                          
                           // ->orderBy('tbl_bp_measurements.created_at', 'desc')
                            ->get();

        return view('tests/bp/bp_test', compact('BP_measurements'));
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
        return view('tests/bp/add_bp', compact('Patient', 'Employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $BP_measurements = new BP_measurements();
        $BP_measurements->patient_id = $request -> patient_id; 
        $BP_measurements->employee_id = $request -> employee_id; 
        $BP_measurements->systolic = $request -> systolic; 
        $BP_measurements->diastolic = $request -> diastolic; 
        $BP_measurements->pulse_rate = $request -> pulse_rate; 
        $BP_measurements->comment = $request -> comment; 
        $BP_measurements->save(); 
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
        
        $tests = BP_measurements::with('Employee', 'Patient')->find($id);
        $Patient = Patient::get();
        $Employee = Employee::get();
        $test_id = $tests->Patient->id;
        $test2 = $tests->patient_id;
        $BP_measurements= DB::table('tbl_bp_measurements')
                            ->join('tbl_patients','tbl_patients.id','=',"tbl_bp_measurements.patient_id")
                            ->join('tbl_employees','tbl_employees.id','=',"tbl_bp_measurements.employee_id")
                            ->select('tbl_patients.last_name AS plname' ,'tbl_patients.first_name AS pfname', 'tbl_employees.last_name AS elname','tbl_employees.first_name AS efname','tbl_bp_measurements.diastolic','tbl_bp_measurements.systolic','tbl_bp_measurements.pulse_rate','tbl_bp_measurements.comment', 'tbl_bp_measurements.created_at AS tested_date','tbl_bp_measurements.id AS id')
                           ->where("tbl_bp_measurements.patient_id", '=', $test_id)
                            //->groupBy('tbl_bp_measurements.id')                          
                            ->orderBy('tbl_bp_measurements.created_at', 'desc')
                            ->get();
                            //dd($BP_measurements);

        return view('tests/bp/view_test', compact('BP_measurements','Patient', 'Employee'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $BP_measurements = BP_measurements::with('Employee', 'Patient')->find($id);
        $Patient = Patient::get();
        $Employee = Employee::get();
        return view('tests/bp/edit_bp', compact('BP_measurements', 'Patient', 'Employee'));
    
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
        $BP_measurements = BP_measurements::find($id);
        $BP_measurements->patient_id = $request -> patient_id; 
        $BP_measurements->employee_id = $request -> employee_id; 
        $BP_measurements->systolic = $request -> systolic; 
        $BP_measurements->diastolic = $request -> diastolic; 
        $BP_measurements->pulse_rate = $request -> pulse_rate; 
        $BP_measurements->comment = $request -> comment; 
        $BP_measurements->save();

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
        $BP_measurements = BP_measurements::find($id);
        $BP_measurements -> delete();
        return redirect()->route('bp_test');
    }
}
