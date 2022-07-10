<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'tbl_employees';
    protected $fillable = [
        'hospital_id','first_name','middle_name','last_name' ,'email' ,'phone_number' ,'role','gender' ,'dob' ,'village','T_A' ,'district','next_of_kin' ,'nok_phone_number' ,'national_id' , 'disability',
    ];
    
  
     public function Hospital()
    {
        return $this->belongsTo('App\Hospital', 'hospital_id');
    }

     public function Allergies()
    {
        return $this->hasMany('App\Allergies', 'employee_id');
    }

     public function Appointment()
    {
        return $this->hasMany('App\Appointment', 'employee_id');
    }

     public function BP_measurements()
    {
        return $this->hasMany('App\BP_measurements', 'employee_id');
    }

    public function Chest_xray()
    {
        return $this->hasMany('App\Chest_xray', 'employee_id');
    }

     public function Glucose_Test()
    {
        return $this->hasMany('App\Glucose_Test', 'employee_id');
    }

     public function Kidnet_Test()
    {
        return $this->hasMany('App\Kidnet_Tests', 'employee_id');
    }

     public function Other_Test()
    {
        return $this->hasMany('App\Other_Test', 'employee_id');
    }

     public function Urinalysis()
    {
        return $this->hasMany('App\Urinalysis', 'employee_id');
    }

     public function Treatment()
    {
        return $this->hasMany('App\Treatment', 'employee_id');
    }
     public function Schedule()
    {
        return $this->hasMany('App\Schedule', 'employee_id');
    }
}
