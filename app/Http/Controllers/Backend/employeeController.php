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
use App\Kidney_Test;
use App\Other_Test;
use App\Patient;
use App\Treatment;
use App\Urinalysis;
use App\User;
use DB;
use Carbon\Carbon;
class employeeController extends Controller
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
        $Employee = Employee::with('Hospital')->where('hospital_id', '=', Auth::user()->hospital_id)->get();

        // dd($Employee);
        return view('employee/employees', compact('Employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Hospital = Hospital::get();
        return view('employee/add_employee', compact('Hospital'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
       //The code for inserting  data into employee table
        $Employee = new Employee();
        $Employee->hospital_id = $request -> hospital_id; 
        $Employee->first_name = $request -> first_name; 
        $Employee->middle_name = $request -> middle_name; 
        $Employee->last_name = $request -> last_name; 
        $Employee->email = $request -> email; 
        $Employee->phone_number = $request -> phone_number; 
        $Employee->role = $request -> role; 
        $Employee->gender = $request -> gender; 
        $Employee->dob = $request->dob; 
        $Employee->village = $request -> village; 
        $Employee->T_A = $request -> T_A; 
        $Employee->district = $request -> district; 
        $Employee->next_of_kin = $request -> next_of_kin; 
        $Employee->nok_phone_number = $request -> nok_phone_number; 
        $Employee->national_id = $request -> national_id; 
        $Employee->disability = $request -> disability;  
        $Employee->save(); 

        //The code foor querying data from the employee table the last row inserted
        $user_content = $this->Employee->orderBy('id','DESC')->first();
        $user_id = $user_content->national_id;
        $hospa = $user_content->hospital_id;

        //dd($hospa);
        $email = $user_content->email;
        $first_name = $user_content->first_name;
        $last_name = $user_content->last_name;
        $role = $user_content->role;
       
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
        $Employee = Employee::find($id);
        return view('employee/profile', compact('Employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Employee = Employee::find($id);
         $Hospital = Hospital::get();
        return view('employee/edit_employee', compact('Employee', 'Hospital'));
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
        $Employee = Employee::find($id);
        $nat = $Employee->national_id;
        $user_content = $this->User->Where('national_id',$nat)->first();
        $user_content->national_id = $request -> national_id;
        $user_content->first_name = $request -> first_name;
        $user_content->last_name = $request -> last_name;
        $user_content->role = $request -> role;
        $user_content->email = $request -> email;

        $Employee->hospital_id = $request -> hospital_id; 
        $Employee->first_name = $request -> first_name; 
        $Employee->middle_name = $request -> middle_name; 
        $Employee->last_name = $request -> last_name; 
        $Employee->email = $request -> email; 
        $Employee->phone_number = $request -> phone_number; 
        $Employee->role = $request -> role; 
        $Employee->gender = $request -> gender; 
        $Employee->dob = $request -> dob; 
        $Employee->village = $request -> village; 
        $Employee->T_A = $request -> T/A; 
        $Employee->district = $request -> district; 
        $Employee->next_of_kin = $request -> next_of_kin; 
        $Employee->nok_phone_number = $request -> nok_phone_number; 
        $Employee->national_id = $request -> national_id; 
        $Employee->disability = $request -> disability;   
        $Employee->save(); 

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
        $Employee = Employee::find($id);

        $nat = $Employee->national_id;
        $user_content = $this->User->Where('national_id',$nat)->first();
        $user_content-> delete();
        $Employee -> delete();
        return redirect()->back();
    }
}
