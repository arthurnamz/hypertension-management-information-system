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
class urinalysisController extends Controller
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

        $Urinalysis= DB::table('tbl_urinalysis')
                            ->join('tbl_patients','tbl_patients.id','=',"tbl_urinalysis.patient_id")
                            ->join('tbl_employees','tbl_employees.id','=',"tbl_urinalysis.employee_id")
                            ->select('tbl_urinalysis.id AS id','tbl_patients.last_name AS plname' ,'tbl_patients.first_name AS pfname', 'tbl_employees.last_name AS elname', 'tbl_patients.email AS pemail','tbl_patients.phone_number AS pnumber','tbl_patients.gender AS pgender','tbl_employees.first_name AS efname','tbl_urinalysis.result', 'tbl_urinalysis.created_at AS tested_date','tbl_urinalysis.comment',  DB::raw("count(tbl_urinalysis.patient_id) as count"))
                          ->where("tbl_urinalysis.patient_id", '=', $Patient1)
                            ->groupBy('tbl_urinalysis.patient_id')                          
                            ->orderBy('tbl_urinalysis.created_at', 'desc')
                            ->get();

        return view('tests/urinalysis/urinalysis', compact('Urinalysis'));

    }else{
        $Urinalysis= DB::table('tbl_urinalysis')
                            ->join('tbl_patients','tbl_patients.id','=',"tbl_urinalysis.patient_id")
                            ->join('tbl_employees','tbl_employees.id','=',"tbl_urinalysis.employee_id")
                            ->select('tbl_urinalysis.id AS id','tbl_patients.last_name AS plname' ,'tbl_patients.first_name AS pfname', 'tbl_employees.last_name AS elname', 'tbl_patients.email AS pemail','tbl_patients.phone_number AS pnumber','tbl_patients.gender AS pgender','tbl_employees.first_name AS efname','tbl_urinalysis.result','tbl_urinalysis.comment',  DB::raw("count(tbl_urinalysis.patient_id) as count"))
                          // ->where("tbl_urinalysis.patient_id", '=', $test_id)
                            ->groupBy('tbl_urinalysis.patient_id')                          
                           // ->orderBy('tbl_urinalysis.created_at', 'desc')
                            ->get();

        return view('tests/urinalysis/urinalysis', compact('Urinalysis'));
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
        return view('tests/urinalysis/add_urinalysis', compact('Patient', 'Employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Urinalysis = new Urinalysis();
        $Urinalysis->patient_id = $request -> patient_id; 
        $Urinalysis->employee_id = $request -> employee_id; 
        $Urinalysis->result = $request -> result; 
        $Urinalysis->comment = $request -> comment; 
        $Urinalysis->save(); 
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
        $tests = Urinalysis::with('Employee', 'Patient')->find($id);
        $test_id = $tests->Patient->id;
        $Urinalysis= DB::table('tbl_urinalysis')
                            ->join('tbl_patients','tbl_patients.id','=',"tbl_urinalysis.patient_id")
                            ->join('tbl_employees','tbl_employees.id','=',"tbl_urinalysis.employee_id")
                            ->select('tbl_patients.last_name AS plname' ,'tbl_patients.first_name AS pfname', 'tbl_employees.last_name AS elname','tbl_employees.first_name AS efname','tbl_urinalysis.result','tbl_urinalysis.comment', 'tbl_urinalysis.created_at AS tested_date','tbl_urinalysis.id AS id')
                           ->where("tbl_urinalysis.patient_id", '=', $test_id)
                            //->groupBy('tbl_urinalysis.id')                          
                            ->orderBy('tbl_urinalysis.created_at', 'desc')
                            ->get();

        return view('tests/urinalysis/view_urinalysis', compact('Urinalysis','Patient', 'Employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Urinalysis = Urinalysis::with('Employee', 'Patient')->find($id);
        $Patient = Patient::get();
        $Employee = Employee::get();
        return view('tests/urinalysis/edit_urinalysis', compact('Urinalysis', 'Patient', 'Employee'));
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
        $Urinalysis = Urinalysis::find($id);
        $Urinalysis->patient_id = $request -> patient_id; 
        $Urinalysis->employee_id = $request -> employee_id; 
        $Urinalysis->result = $request -> result; 
        $Urinalysis->comment = $request -> comment; 
        $Urinalysis->save(); 
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
        $Urinalysis = Urinalysis::find($id);
        $Urinalysis -> delete();
        return redirect()->route('urinalysis');
    }
}
