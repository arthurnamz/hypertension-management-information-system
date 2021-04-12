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

class allergiesController extends Controller
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

         $Allergies= DB::table('tbl_allergies')
                            ->join('tbl_patients','tbl_patients.id','=',"tbl_allergies.patient_id")
                            ->join('tbl_employees','tbl_employees.id','=',"tbl_allergies.employee_id")
                            ->select('tbl_allergies.id AS id','tbl_patients.last_name AS plname' ,'tbl_patients.first_name AS pfname', 'tbl_employees.last_name AS elname', 'tbl_patients.email AS pemail','tbl_patients.phone_number AS pnumber','tbl_patients.gender AS pgender','tbl_employees.first_name AS efname','tbl_allergies.name',  'tbl_allergies.created_at AS tested_date', DB::raw("count(tbl_allergies.patient_id) as count"))
                           ->where("tbl_allergies.patient_id", '=', $Patient1)
                            ->groupBy('tbl_allergies.id')                          
                           ->orderBy('tbl_allergies.created_at', 'desc')
                            ->get();

        return view('allergies/allergy', compact('Allergies'));

         }else{

            $Allergies= DB::table('tbl_allergies')
                            ->join('tbl_patients','tbl_patients.id','=',"tbl_allergies.patient_id")
                            ->join('tbl_employees','tbl_employees.id','=',"tbl_allergies.employee_id")
                            ->select('tbl_allergies.id AS id','tbl_patients.last_name AS plname' ,'tbl_patients.first_name AS pfname', 'tbl_employees.last_name AS elname', 'tbl_patients.email AS pemail','tbl_patients.phone_number AS pnumber','tbl_patients.gender AS pgender','tbl_employees.first_name AS efname','tbl_allergies.name',  DB::raw("count(tbl_allergies.patient_id) as count"))
                          // ->where("tbl_allergies.patient_id", '=', $test_id)
                            ->groupBy('tbl_allergies.patient_id')                          
                           // ->orderBy('tbl_allergies.created_at', 'desc')
                            ->get();

        return view('allergies/allergy', compact('Allergies'));

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
        return view('allergies/add_allergy', compact('Patient', 'Employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Allergies = new Allergies();
        $Allergies->patient_id = $request -> patient_id; 
        $Allergies->employee_id = $request -> employee_id; 
        $Allergies->name = $request -> name; 
        $Allergies->save(); 
        return redirect()->route('allergy');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->role == 'patient') {
        $Patient_natinal_id = Auth::user()->national_id;
        $Patient = Patient::where('national_id','=', $Patient_natinal_id)->first();
        $Patient1 = $Patient->id;

         $Allergies= DB::table('tbl_allergies')
                            ->join('tbl_patients','tbl_patients.id','=',"tbl_allergies.patient_id")
                            ->join('tbl_employees','tbl_employees.id','=',"tbl_allergies.employee_id")
                            ->select('tbl_allergies.id AS id','tbl_patients.last_name AS plname' ,'tbl_patients.first_name AS pfname', 'tbl_employees.last_name AS elname', 'tbl_patients.email AS pemail','tbl_patients.phone_number AS pnumber','tbl_patients.gender AS pgender','tbl_employees.first_name AS efname','tbl_allergies.name',  DB::raw("count(tbl_allergies.patient_id) as count"))
                           ->where("tbl_allergies.patient_id", '=', $Patient1)
                            ->groupBy('tbl_allergies.id')                          
                           ->orderBy('tbl_allergies.created_at', 'desc')
                            ->get();

        return view('allergies/allergy', compact('Allergies'));

         }else{
        $Patient = Patient::get();
        $Employee = Employee::get();
        $tests = Allergies::with('Employee', 'Patient')->find($id);
        $test_id = $tests->Patient->id;
        $Allergies= DB::table('tbl_allergies')
                            ->join('tbl_patients','tbl_patients.id','=',"tbl_allergies.patient_id")
                            ->join('tbl_employees','tbl_employees.id','=',"tbl_allergies.employee_id")
                            ->select('tbl_patients.last_name AS plname' ,'tbl_patients.first_name AS pfname', 'tbl_employees.last_name AS elname','tbl_employees.first_name AS efname','tbl_allergies.name', 'tbl_allergies.created_at AS tested_date','tbl_allergies.id AS id')
                           ->where("tbl_allergies.patient_id", '=', $test_id)
                            //->groupBy('tbl_allergies.id')                          
                            ->orderBy('tbl_allergies.created_at', 'desc')
                            ->get();

        return view('allergies/view_allergy', compact('Allergies','Patient', 'Employee'));
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Allergies = Allergies::with('Employee', 'Patient')->find($id);
        $Patient = Patient::get();
        $Employee = Employee::get();
        return view('allergies/edit_allergy', compact('Allergies', 'Patient', 'Employee'));
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
        $Allergies->patient_id = $request -> patient_id; 
        $Allergies->employee_id = $request -> employee_id; 
        $Allergies->name = $request -> name; 
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
        $Allergies = Allergies::find($id);
        $Allergies -> delete();
        return redirect()->route('allergy');
    }
}
