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
class kidney_testController extends Controller
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

        $Kidney_Test= DB::table('tbl_kidney_function_tests')
                            ->join('tbl_patients','tbl_patients.id','=',"tbl_kidney_function_tests.patient_id")
                            ->join('tbl_employees','tbl_employees.id','=',"tbl_kidney_function_tests.employee_id")
                            ->select('tbl_kidney_function_tests.id AS id','tbl_patients.last_name AS plname' ,'tbl_patients.first_name AS pfname', 'tbl_employees.last_name AS elname', 'tbl_patients.email AS pemail','tbl_patients.phone_number AS pnumber','tbl_patients.gender AS pgender','tbl_employees.first_name AS efname','tbl_kidney_function_tests.results','tbl_kidney_function_tests.comment', 'tbl_kidney_function_tests.created_at AS tested_date', DB::raw("count(tbl_kidney_function_tests.patient_id) as count"))
                            ->where("tbl_kidney_function_tests.patient_id", '=', $Patient1)
                            ->groupBy('tbl_kidney_function_tests.id')                          
                           ->orderBy('tbl_kidney_function_tests.created_at', 'desc')
                            ->get();

        return view('tests/kidney/kidney', compact('Kidney_Test'));
    }else{
        $Kidney_Test= DB::table('tbl_kidney_function_tests')
                            ->join('tbl_patients','tbl_patients.id','=',"tbl_kidney_function_tests.patient_id")
                            ->join('tbl_employees','tbl_employees.id','=',"tbl_kidney_function_tests.employee_id")
                            ->select('tbl_kidney_function_tests.id AS id','tbl_patients.last_name AS plname' ,'tbl_patients.first_name AS pfname', 'tbl_employees.last_name AS elname', 'tbl_patients.email AS pemail','tbl_patients.phone_number AS pnumber','tbl_patients.gender AS pgender','tbl_employees.first_name AS efname','tbl_kidney_function_tests.results','tbl_kidney_function_tests.comment',  DB::raw("count(tbl_kidney_function_tests.patient_id) as count"))
                          // ->where("tbl_kidney_function_tests.patient_id", '=', $test_id)
                            ->groupBy('tbl_kidney_function_tests.patient_id')                          
                           // ->orderBy('tbl_kidney_function_tests.created_at', 'desc')
                            ->get();

        return view('tests/kidney/kidney', compact('Kidney_Test'));
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
        return view('tests/kidney/add_kidney', compact('Patient', 'Employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Kidney_Test = new Kidney_Test();
        $Kidney_Test->patient_id = $request -> patient_id; 
        $Kidney_Test->employee_id = $request -> employee_id; 
        $Kidney_Test->results = $request -> results; 
        $Kidney_Test->comment = $request -> comment; 
        $Kidney_Test->save(); 
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
        $tests = Kidney_Test::with('Employee', 'Patient')->find($id);
        $test_id = $tests->Patient->id;
        $test2 = $tests->patient_id;
        $Kidney_Test= DB::table('tbl_kidney_function_tests')
                            ->join('tbl_patients','tbl_patients.id','=',"tbl_kidney_function_tests.patient_id")
                            ->join('tbl_employees','tbl_employees.id','=',"tbl_kidney_function_tests.employee_id")
                            ->select('tbl_patients.last_name AS plname' ,'tbl_patients.first_name AS pfname', 'tbl_employees.last_name AS elname','tbl_employees.first_name AS efname','tbl_kidney_function_tests.results','tbl_kidney_function_tests.comment', 'tbl_kidney_function_tests.created_at AS tested_date','tbl_kidney_function_tests.id AS id')
                           ->where("tbl_kidney_function_tests.patient_id", '=', $test_id)
                            //->groupBy('tbl_kidney_function_tests.id')                          
                            ->orderBy('tbl_kidney_function_tests.created_at', 'desc')
                            ->get();

        return view('tests/kidney/view_kidney', compact('Kidney_Test','Patient', 'Employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Kidney_Test = Kidney_Test::with('Employee', 'Patient')->find($id);
        $Patient = Patient::get();
        $Employee = Employee::get();
        return view('tests/kidney/edit_kidney', compact('Kidney_Test', 'Patient', 'Employee'));
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
        $Kidney_Test = Kidney_Test::find($id);
        $Kidney_Test->patient_id = $request -> patient_id; 
        $Kidney_Test->employee_id = $request -> employee_id; 
        $Kidney_Test->results = $request -> results; 
        $Kidney_Test->comment = $request -> comment; 
        $Kidney_Test->save(); 
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
        $Kidney_Test = Kidney_Test::find($id);
        $Kidney_Test -> delete();
        return redirect()->route('kidney_test');
    }
}
