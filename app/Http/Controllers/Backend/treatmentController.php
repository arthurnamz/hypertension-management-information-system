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
class treatmentController extends Controller
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

        $Treatment= DB::table('tbl_treatments')
                            ->join('tbl_patients','tbl_patients.id','=',"tbl_treatments.patient_id")
                            ->join('tbl_employees','tbl_employees.id','=',"tbl_treatments.employee_id")
                            ->select('tbl_treatments.id AS id','tbl_patients.last_name AS plname' ,'tbl_patients.first_name AS pfname', 'tbl_employees.last_name AS elname', 'tbl_patients.email AS pemail','tbl_patients.phone_number AS pnumber','tbl_patients.gender AS pgender','tbl_employees.first_name AS efname','tbl_treatments.drug','tbl_treatments.comment', 'tbl_treatments.created_at AS tested_date', DB::raw("count(tbl_treatments.patient_id) as count"))
                          ->where("tbl_treatments.patient_id", '=', $Patient1)
                            ->groupBy('tbl_treatments.id')                          
                           ->orderBy('tbl_treatments.created_at', 'desc')
                            ->get();

        return view('treatment/treatment', compact('Treatment'));

        }else{
        $Treatment= DB::table('tbl_treatments')
                            ->join('tbl_patients','tbl_patients.id','=',"tbl_treatments.patient_id")
                            ->join('tbl_employees','tbl_employees.id','=',"tbl_treatments.employee_id")
                            ->select('tbl_treatments.id AS id','tbl_patients.last_name AS plname' ,'tbl_patients.first_name AS pfname', 'tbl_employees.last_name AS elname', 'tbl_patients.email AS pemail','tbl_patients.phone_number AS pnumber','tbl_patients.gender AS pgender','tbl_employees.first_name AS efname','tbl_treatments.drug','tbl_treatments.comment',  DB::raw("count(tbl_treatments.patient_id) as count"))
                          // ->where("tbl_treatments.patient_id", '=', $test_id)
                            ->groupBy('tbl_treatments.patient_id')                          
                           // ->orderBy('tbl_treatments.created_at', 'desc')
                            ->get();

        return view('treatment/treatment', compact('Treatment'));

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
        return view('treatment/add_treatment', compact('Patient', 'Employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Treatment = new Treatment();
        $Treatment->patient_id = $request -> patient_id; 
        $Treatment->employee_id = $request -> employee_id; 
        $Treatment->drug = $request -> drug; 
        $Treatment->comment = $request -> comment; 
        $Treatment->save(); 
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
        $tests = Treatment::with('Employee', 'Patient')->find($id);
        $test_id = $tests->Patient->id;
        $Treatment= DB::table('tbl_treatments')
                            ->join('tbl_patients','tbl_patients.id','=',"tbl_treatments.patient_id")
                            ->join('tbl_employees','tbl_employees.id','=',"tbl_treatments.employee_id")
                            ->select('tbl_patients.last_name AS plname' ,'tbl_patients.first_name AS pfname', 'tbl_employees.last_name AS elname','tbl_employees.first_name AS efname','tbl_treatments.drug','tbl_treatments.comment', 'tbl_treatments.created_at AS tested_date','tbl_treatments.id AS id')
                           ->where("tbl_treatments.patient_id", '=', $test_id)
                            //->groupBy('tbl_treatments.id')                          
                            ->orderBy('tbl_treatments.created_at', 'desc')
                            ->get();

        return view('treatment/view_treatment', compact('Treatment','Patient', 'Employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Treatment = Treatment::with('Employee', 'Patient')->find($id);
        $Patient = Patient::get();
        $Employee = Employee::get();
        return view('treatment/edit_treatment', compact('Treatment', 'Patient', 'Employee'));
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
        $Treatment = Treatment::find($id);
        $Treatment->patient_id = $request -> patient_id; 
        $Treatment->employee_id = $request -> employee_id; 
        $Treatment->drug = $request -> drug; 
        $Treatment->comment = $request -> comment; 
        $Treatment->save(); 
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
        $Treatment = Treatment::find($id);
        $Treatment -> delete();
        return redirect()->route('treatment');
    }
}
