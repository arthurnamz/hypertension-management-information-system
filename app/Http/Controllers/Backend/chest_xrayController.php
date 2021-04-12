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
class chest_xrayController extends Controller
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

        $Chest_xray= DB::table('tbl_chest_x_rays')
                            ->join('tbl_patients','tbl_patients.id','=',"tbl_chest_x_rays.patient_id")
                            ->join('tbl_employees','tbl_employees.id','=',"tbl_chest_x_rays.employee_id")
                            ->select('tbl_chest_x_rays.id AS id','tbl_patients.last_name AS plname' ,'tbl_patients.first_name AS pfname', 'tbl_employees.last_name AS elname', 'tbl_patients.email AS pemail','tbl_patients.phone_number AS pnumber','tbl_patients.gender AS pgender','tbl_employees.first_name AS efname','tbl_chest_x_rays.results','tbl_chest_x_rays.created_at AS tested_date','tbl_chest_x_rays.file_name','tbl_chest_x_rays.comment',  DB::raw("count(tbl_chest_x_rays.patient_id) as count"))
                          ->where("tbl_chest_x_rays.patient_id", '=', $Patient1)
                            ->groupBy('tbl_chest_x_rays.id')                          
                           ->orderBy('tbl_chest_x_rays.created_at', 'desc')
                            ->get();

        return view('tests/chestXray/chest_test', compact('Chest_xray'));
    }else{
         $Chest_xray= DB::table('tbl_chest_x_rays')
                            ->join('tbl_patients','tbl_patients.id','=',"tbl_chest_x_rays.patient_id")
                            ->join('tbl_employees','tbl_employees.id','=',"tbl_chest_x_rays.employee_id")
                            ->select('tbl_chest_x_rays.id AS id','tbl_patients.last_name AS plname' ,'tbl_patients.first_name AS pfname', 'tbl_employees.last_name AS elname', 'tbl_patients.email AS pemail','tbl_patients.phone_number AS pnumber','tbl_patients.gender AS pgender','tbl_employees.first_name AS efname','tbl_chest_x_rays.results','tbl_chest_x_rays.file_name','tbl_chest_x_rays.comment',  DB::raw("count(tbl_chest_x_rays.patient_id) as count"))
                          // ->where("tbl_chest_x_rays.patient_id", '=', $test_id)
                            ->groupBy('tbl_chest_x_rays.patient_id')                          
                           // ->orderBy('tbl_chest_x_rays.created_at', 'desc')
                            ->get();

        return view('tests/chestXray/chest_test', compact('Chest_xray'));
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
        return view('tests/chestXray/add_chest', compact('Patient', 'Employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Chest_xray = new Chest_xray();
        $Chest_xray->patient_id = $request -> patient_id; 
        $Chest_xray->employee_id = $request -> employee_id;         

         if($request->hasfile('file_name')){
            $file = $request->file('file_name');
            $extension = $file->getClientOriginalExtension();
            $filename = $request-> patient_id.'.'.$extension;
            $file -> move('uploads/X_ray/', $filename);
            $Chest_xray->file_name = $filename;
        }else{
//            return $request;
            $Chest_xray->file_name = 'no file';
        }

        $Chest_xray->results = $request -> results; 
        $Chest_xray->comment = $request -> comment; 
        $Chest_xray->save(); 
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
        $tests = Chest_xray::with('Employee', 'Patient')->find($id);
        $test_id = $tests->Patient->id;
        $test2 = $tests->patient_id;
        $Chest_xray= DB::table('tbl_chest_x_rays')
                            ->join('tbl_patients','tbl_patients.id','=',"tbl_chest_x_rays.patient_id")
                            ->join('tbl_employees','tbl_employees.id','=',"tbl_chest_x_rays.employee_id")
                            ->select('tbl_patients.last_name AS plname' ,'tbl_patients.first_name AS pfname', 'tbl_employees.last_name AS elname','tbl_employees.first_name AS efname','tbl_chest_x_rays.results','tbl_chest_x_rays.file_name','tbl_chest_x_rays.comment', 'tbl_chest_x_rays.created_at AS tested_date','tbl_chest_x_rays.id AS id')
                           ->where("tbl_chest_x_rays.patient_id", '=', $test_id)
                            //->groupBy('tbl_chest_x_rays.id')                          
                            ->orderBy('tbl_chest_x_rays.created_at', 'desc')
                            ->get();

        return view('tests/chestXray/view_chest', compact('Chest_xray','Patient', 'Employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Chest_xray = Chest_xray::with('Employee', 'Patient')->find($id);
        $Patient = Patient::get();
        $Employee = Employee::get();
        return view('tests/chestXray/edit_chest', compact('Chest_xray', 'Patient', 'Employee'));
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
        $Chest_xray = Chest_xray::find($id);
        $Chest_xray->patient_id = $request -> patient_id; 
        $Chest_xray->employee_id = $request -> employee_id;
        $Chest_xray->test_name = $request -> file_name; 
        $Chest_xray->results = $request -> results; 
        $Chest_xray->comment = $request -> comment; 
        $Chest_xray->save(); 
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
        $Chest_xray = Chest_xray::find($id);
        $Chest_xray -> delete();
        return redirect()->route('Chest_xray');
    }
}
