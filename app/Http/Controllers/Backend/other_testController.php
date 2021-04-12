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
class other_testController extends Controller
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

        $Other_Test= DB::table('tbl_other_tests')
                            ->join('tbl_patients','tbl_patients.id','=',"tbl_other_tests.patient_id")
                            ->join('tbl_employees','tbl_employees.id','=',"tbl_other_tests.employee_id")
                            ->select('tbl_other_tests.id AS id','tbl_patients.last_name AS plname' ,'tbl_patients.first_name AS pfname', 'tbl_employees.last_name AS elname', 'tbl_patients.email AS pemail','tbl_patients.phone_number AS pnumber','tbl_patients.gender AS pgender','tbl_employees.first_name AS efname','tbl_other_tests.results','tbl_other_tests.test_name','tbl_other_tests.comment', 'tbl_other_tests.created_at AS tested_date', DB::raw("count(tbl_other_tests.patient_id) as count"))
                            ->where("tbl_other_tests.patient_id", '=', $Patient1)
                            ->groupBy('tbl_other_tests.id')                          
                            ->orderBy('tbl_other_tests.created_at', 'desc')
                            ->get();

        return view('tests/otherTest/other_test', compact('Other_Test'));

    }else{
        $Other_Test= DB::table('tbl_other_tests')
                            ->join('tbl_patients','tbl_patients.id','=',"tbl_other_tests.patient_id")
                            ->join('tbl_employees','tbl_employees.id','=',"tbl_other_tests.employee_id")
                            ->select('tbl_other_tests.id AS id','tbl_patients.last_name AS plname' ,'tbl_patients.first_name AS pfname', 'tbl_employees.last_name AS elname', 'tbl_patients.email AS pemail','tbl_patients.phone_number AS pnumber','tbl_patients.gender AS pgender','tbl_employees.first_name AS efname','tbl_other_tests.results','tbl_other_tests.test_name','tbl_other_tests.comment',  DB::raw("count(tbl_other_tests.patient_id) as count"))
                          // ->where("tbl_other_tests.patient_id", '=', $test_id)
                            ->groupBy('tbl_other_tests.patient_id')                          
                           // ->orderBy('tbl_other_tests.created_at', 'desc')
                            ->get();

        return view('tests/otherTest/other_test', compact('Other_Test'));
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
        return view('tests/otherTest/add_other', compact('Patient', 'Employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Other_Test = new Other_Test();
        $Other_Test->patient_id = $request -> patient_id; 
        $Other_Test->employee_id = $request -> employee_id; 
        $Other_Test->test_name = $request -> test_name; 
        $Other_Test->results = $request -> results; 
        $Other_Test->comment = $request -> comment; 
        $Other_Test->save(); 
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
        $tests = Other_Test::with('Employee', 'Patient')->find($id);
        $test_id = $tests->Patient->id;
        $test2 = $tests->patient_id;
        $Other_Test= DB::table('tbl_other_tests')
                            ->join('tbl_patients','tbl_patients.id','=',"tbl_other_tests.patient_id")
                            ->join('tbl_employees','tbl_employees.id','=',"tbl_other_tests.employee_id")
                            ->select('tbl_patients.last_name AS plname' ,'tbl_patients.first_name AS pfname', 'tbl_employees.last_name AS elname','tbl_employees.first_name AS efname','tbl_other_tests.results','tbl_other_tests.test_name','tbl_other_tests.comment', 'tbl_other_tests.created_at AS tested_date','tbl_other_tests.id AS id')
                           ->where("tbl_other_tests.patient_id", '=', $test_id)
                            //->groupBy('tbl_other_tests.id')                          
                            ->orderBy('tbl_other_tests.created_at', 'desc')
                            ->get();

        return view('tests/otherTest/view_other', compact('Other_Test','Patient', 'Employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Other_Test = Other_Test::with('Employee', 'Patient')->find($id);
        $Patient = Patient::get();
        $Employee = Employee::get();
        return view('tests/otherTest/edit_other', compact('Other_Test', 'Patient', 'Employee'));
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
        $Other_Test = Other_Test::find($id);
        $Other_Test->patient_id = $request -> patient_id; 
        $Other_Test->employee_id = $request -> employee_id;
        $Other_Test->test_name = $request -> test_name; 
        $Other_Test->results = $request -> results; 
        $Other_Test->comment = $request -> comment; 
        $Other_Test->save(); 
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
        $Other_Test = Other_Test::find($id);
        $Other_Test -> delete();
        return redirect()->route('other_test');
    }
}
