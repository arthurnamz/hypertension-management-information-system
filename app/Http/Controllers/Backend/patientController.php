<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Allergies;
use App\Appointment;
use App\BP_measurements;
use App\Chest_xray;
use App\Employee;
use App\Glucose_Test;
use App\Hospital;
use DB;
use App\Kidney_Test;
use App\Other_Test;
use App\Patient;
use App\Treatment;
use App\Urinalysis;
use App\User;
class patientController extends Controller
{
     public function __construct( Patient $Patient, User $User){

        $this->Patient = $Patient;
        $this->User = $User;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Patient = Patient::with('Hospital')->where('hospital_id', '=', Auth::user()->hospital_id)->get();
        return view('patient/patients', compact('Patient'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Hospital = Hospital::get();
        return view('patient/add_patient', compact('Hospital'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Patient = new Patient();
        $Patient->hospital_id = $request -> hospital_id; 
        $Patient->first_name = $request -> first_name; 
        $Patient->middle_name = $request -> middle_name; 
        $Patient->last_name = $request -> last_name; 
        $Patient->email = $request -> email; 
        $Patient->phone_number = $request -> phone_number; 
        $Patient->gender = $request -> gender; 
        $Patient->dob = $request -> dob; 
        $Patient->village = $request -> village; 
        $Patient->T_A = $request -> T_A; 
        $Patient->district = $request -> district; 
        $Patient->next_of_kin = $request -> next_of_kin; 
        $Patient->nok_phone_number = $request -> nok_phone_number; 
        $Patient->national_id = $request -> national_id; 
        $Patient->disability = $request -> disability; 
        $Patient->save(); 

        //The code foor querying data from the employee table the last row inserted
        $user_content = $this->Patient->orderBy('id','DESC')->first();
        $user_id = $user_content->national_id;
        $hospa = $user_content->hospital_id;
        $email = $user_content->email;
        $first_name = $user_content->first_name;
        $last_name = $user_content->last_name;
        $role = $request -> role;
       
        //The code for inserting  data into user table 
        $User = User::create([
        'national_id' => $user_id, 
        'hospital_id' => $hospa, 
        'first_name' => $first_name,
        'last_name' => $last_name,
        'role' => $role,
        'email' => $email,
        'password' =>  Hash::make($request-> password)
        ]);

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
        if (Auth::user()->role == 'patient') {
        
        $Patient_natinal_id = Auth::user()->national_id;
        $Patient = Patient::where('national_id','=', $Patient_natinal_id)->first();
        $Patient1 = $Patient->id;
       //dd($Patient1);
        $Kidney_Test = Kidney_Test::with('Patient', 'Employee')->where('patient_id', '=', $Patient1)->get();
        $BP_measurements = BP_measurements::with('Patient', 'Employee')->where('patient_id', '=', $Patient1)->get();
        $Glucose_Test = Glucose_Test::with('Patient', 'Employee')->where('patient_id', '=', $Patient1)->get();
        $Chest_xray = Chest_xray::with('Patient', 'Employee')->where('patient_id', '=', $Patient1)->get();
        $Other_Test = Other_Test::with('Patient', 'Employee')->where('patient_id', '=', $Patient1)->get();
        $Urinalysis = Urinalysis::with('Patient', 'Employee')->where('patient_id', '=', $Patient1)->get();      
        $Treatment = Treatment::with('Patient', 'Employee')->where('patient_id', '=', $Patient1)->get();      
        $Allergies = Allergies::with('Patient', 'Employee')->where('patient_id', '=', $Patient1)->get();      
                           
        return view('patient/profile',compact('Patient','BP_measurements','Kidney_Test','Glucose_Test','Chest_xray','Other_Test','Urinalysis','Treatment','Allergies'));
        }else{

        $Patient = Patient::find($id);
        $Patient1 = $Patient -> id;
        $Kidney_Test = Kidney_Test::with('Patient', 'Employee')->where('patient_id', '=', $Patient1)->get();
        $BP_measurements = BP_measurements::with('Patient', 'Employee')->where('patient_id', '=', $Patient1)->get();
        $Glucose_Test = Glucose_Test::with('Patient', 'Employee')->where('patient_id', '=', $Patient1)->get();
        $Chest_xray = Chest_xray::with('Patient', 'Employee')->where('patient_id', '=', $Patient1)->get();
        $Other_Test = Other_Test::with('Patient', 'Employee')->where('patient_id', '=', $Patient1)->get();
        $Urinalysis = Urinalysis::with('Patient', 'Employee')->where('patient_id', '=', $Patient1)->get();      
        $Treatment = Treatment::with('Patient', 'Employee')->where('patient_id', '=', $Patient1)->get();      
        $Allergies = Allergies::with('Patient', 'Employee')->where('patient_id', '=', $Patient1)->get();      
                           
        return view('patient/profile',compact('Patient','BP_measurements','Kidney_Test','Glucose_Test','Chest_xray','Other_Test','Urinalysis','Treatment','Allergies'));
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
        $Patient = Patient::find($id);
        $Hospital = Hospital::get();
        return view('patient/edit_patient',compact('Patient', 'Hospital'));
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
        $Patient = Patient::find($id);
        $Patient->hospital_id = $request -> hospital_id; 
        $Patient->first_name = $request -> first_name; 
        $Patient->middle_name = $request -> middle_name; 
        $Patient->last_name = $request -> last_name; 
        $Patient->email = $request -> email; 
        $Patient->phone_number = $request -> phone_number; 
        $Patient->gender = $request -> gender; 
        $Patient->dob = $request -> dob; 
        $Patient->village = $request -> village; 
        $Patient->T_A = $request -> T_A; 
        $Patient->district = $request -> district; 
        $Patient->next_of_kin = $request -> next_of_kin; 
        $Patient->nok_phone_number = $request -> nok_phone_number; 
        $Patient->national_id = $request -> national_id; 
        $Patient->disability = $request -> disability;   
        $Patient->save(); 

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
        $Patient = Patient::find($id);
        $user_content = $this->User->Where('national_id',$nat)->first();
        $user_content-> delete();
        $Patient -> delete();
        return redirect()->back();
    }
}
