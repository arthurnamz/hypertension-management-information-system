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
Use \Carbon\Carbon;
use DB;
class dashboardController extends Controller
{
     public function __construct( Employee $Employee, User $User){

        $this->Employee = $Employee;
        $this->User = $User;
    }
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

       $Treatment_count = Treatment::where('patient_id', '=', $Patient1 )->count();
       $BP_count = BP_measurements::where('patient_id', '=', $Patient1 )->count();
       $Chest_count = Chest_xray::where('patient_id', '=', $Patient1 )->count();
       $Glucose_count = Glucose_Test::where('patient_id', '=', $Patient1 )->count();
       $Kidney_count = Kidney_Test::where('patient_id', '=', $Patient1 )->count();
       $Other_count = Other_Test::where('patient_id', '=', $Patient1 )->count();
       $Urinalysis_count = Urinalysis::where('patient_id', '=', $Patient1 )->count();
       $Appointment = Appointment::with('Employee', 'Patient')->where('patient_id', '=', $Patient1)->get();
        $BP_measurements= DB::table('tbl_bp_measurements')
                            ->join('tbl_patients','tbl_patients.id','=',"tbl_bp_measurements.patient_id")
                            ->join('tbl_employees','tbl_employees.id','=',"tbl_bp_measurements.employee_id")
                            ->select('tbl_bp_measurements.id AS id','tbl_patients.last_name AS plname' ,'tbl_patients.first_name AS pfname', 'tbl_employees.last_name AS elname', 'tbl_patients.email AS pemail','tbl_patients.phone_number AS pnumber','tbl_patients.gender AS pgender','tbl_employees.first_name AS efname','tbl_bp_measurements.diastolic','tbl_bp_measurements.systolic','tbl_bp_measurements.pulse_rate','tbl_bp_measurements.comment',  DB::raw("count(tbl_bp_measurements.patient_id) as count"))
                           ->where("tbl_bp_measurements.patient_id", '=',  $Patient1)
                            ->groupBy('tbl_bp_measurements.id')                          
                           ->orderBy('tbl_bp_measurements.created_at', 'desc')
                            ->get();
       //dd($BP_measurements);
       return view('dashboard/index', compact('Treatment_count', 'Appointment','BP_measurements', 'BP_count','Chest_count','Glucose_count','Kidney_count','Other_count' ,'Urinalysis_count'));
    }else{
   
        $date = Carbon::now()->format('Y-m-d');
        $nw = Carbon::today()->toDateTimeString();
        
        $Employee_count = Employee::count(); 
        $Doctors = Employee::get(); 
        $Patient_count = Patient::count(); 
        $Treatment_count = Treatment::count(); 
         
        $Appointment = Appointment::with('Employee', 'Patient')->where('date', '=', $date)->get();
        $New_patient = Patient::orderBy('created_at', 'desc')->paginate(4);
        //dd($New_patient);
        return view('dashboard/index', compact('Employee_count', 'Patient_count','Treatment_count', 'Appointment', 'Doctors','New_patient'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
