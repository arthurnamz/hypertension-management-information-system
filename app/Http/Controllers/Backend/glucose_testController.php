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
use DB;
class glucose_testController extends Controller
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

        $Glucose_Test= DB::table('tbl_glucose_tests')
                            ->join('tbl_patients','tbl_patients.id','=',"tbl_glucose_tests.patient_id")
                            ->join('tbl_employees','tbl_employees.id','=',"tbl_glucose_tests.employee_id")
                            ->select('tbl_glucose_tests.id AS id','tbl_patients.last_name AS plname' ,'tbl_patients.first_name AS pfname', 'tbl_employees.last_name AS elname', 'tbl_patients.email AS pemail','tbl_patients.phone_number AS pnumber','tbl_patients.gender AS pgender','tbl_employees.first_name AS efname','tbl_glucose_tests.results','tbl_glucose_tests.comment', 'tbl_glucose_tests.created_at AS tested_date', DB::raw("count(tbl_glucose_tests.patient_id) as count"))
                            ->where("tbl_glucose_tests.patient_id", '=', $Patient1)
                            ->groupBy('tbl_glucose_tests.id')                          
                            ->orderBy('tbl_glucose_tests.created_at', 'desc')
                            ->get();

        return view('tests/glucose/glucose', compact('Glucose_Test'));

    }else{
        $Glucose_Test= DB::table('tbl_glucose_tests')
                            ->join('tbl_patients','tbl_patients.id','=',"tbl_glucose_tests.patient_id")
                            ->join('tbl_employees','tbl_employees.id','=',"tbl_glucose_tests.employee_id")
                            ->select('tbl_glucose_tests.id AS id','tbl_patients.last_name AS plname' ,'tbl_patients.first_name AS pfname', 'tbl_employees.last_name AS elname', 'tbl_patients.email AS pemail','tbl_patients.phone_number AS pnumber','tbl_patients.gender AS pgender','tbl_employees.first_name AS efname','tbl_glucose_tests.results','tbl_glucose_tests.comment',  DB::raw("count(tbl_glucose_tests.patient_id) as count"))
                          // ->where("tbl_glucose_tests.patient_id", '=', $test_id)
                            ->groupBy('tbl_glucose_tests.patient_id')                          
                           // ->orderBy('tbl_glucose_tests.created_at', 'desc')
                            ->get();

        return view('tests/glucose/glucose', compact('Glucose_Test'));
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
        return view('tests/glucose/add_glucose', compact('Patient', 'Employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Glucose_Test = new Glucose_Test();
        $Glucose_Test->patient_id = $request -> patient_id; 
        $Glucose_Test->employee_id = $request -> employee_id; 
        $Glucose_Test->results = $request -> results; 
        $Glucose_Test->comment = $request -> comment; 
        $Glucose_Test->save(); 
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
        $Patient = Patient::get();
        $Employee = Employee::get();
        $tests = Glucose_Test::with('Employee', 'Patient')->find($id);
        $test_id = $tests->Patient->id;
        $test2 = $tests->patient_id;
        $Glucose_Test= DB::table('tbl_glucose_tests')
                            ->join('tbl_patients','tbl_patients.id','=',"tbl_glucose_tests.patient_id")
                            ->join('tbl_employees','tbl_employees.id','=',"tbl_glucose_tests.employee_id")
                            ->select('tbl_patients.last_name AS plname' ,'tbl_patients.first_name AS pfname', 'tbl_employees.last_name AS elname','tbl_employees.first_name AS efname','tbl_glucose_tests.results','tbl_glucose_tests.comment', 'tbl_glucose_tests.created_at AS tested_date','tbl_glucose_tests.id AS id')
                           ->where("tbl_glucose_tests.patient_id", '=', $test_id)
                            //->groupBy('tbl_glucose_tests.id')                          
                            ->orderBy('tbl_glucose_tests.created_at', 'desc')
                            ->get();
                            //dd($BP_measurements);

        return view('tests/glucose/view_glucose', compact('Glucose_Test','Patient', 'Employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Glucose_Test = Glucose_Test::with('Employee', 'Patient')->find($id);
        $Patient = Patient::get();
        $Employee = Employee::get();
        return view('tests/glucose/edit_glucose', compact('Glucose_Test', 'Patient', 'Employee'));
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
        $Glucose_Test = Glucose_Test::find($id);
        $Glucose_Test->patient_id = $request -> patient_id; 
        $Glucose_Test->employee_id = $request -> employee_id; 
        $Glucose_Test->results = $request -> results; 
        $Glucose_Test->comment = $request -> comment; 
        $Glucose_Test->save(); 
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
        $Glucose_Test = Glucose_Test::find($id);
        $Glucose_Test -> delete();
        return redirect()->route('glucose_test');
    }
}
