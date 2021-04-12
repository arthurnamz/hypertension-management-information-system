<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{

	protected $table = 'tbl_patients';

	protected $fillable = [
        'hospital_id','first_name','middle_name','last_name' ,'email' ,'phone_number' ,'gender' ,'dob' ,'village','T_A' ,'district','next_of_kin' ,'nok_phone_number' ,'national_id' , 'disability',
    ];
    
  
     public function Hospital()
    {
        return $this->belongsTo('App\Hospital', 'hospital_id');
    }

     public function Allergies()
    {
        return $this->hasMany('App\Allergies', 'patient_id');
    }

     public function Appointment()
    {
        return $this->hasMany('App\Appointment', 'patient_id');
    }

     public function BP_measurements()
    {
        return $this->hasMany('App\BP_measurements', 'patient_id');
    }

    public function Chest_xray()
    {
        return $this->hasMany('App\Chest_xray', 'patient_id');
    }

     public function Glucose_Test()
    {
        return $this->hasMany('App\Glucose_Test', 'patient_id');
    }

     public function Kidney_Test()
    {
        return $this->hasMany('App\Kidney_Test', 'patient_id');
    }

     public function Other_Test()
    {
        return $this->hasMany('App\Other_Test', 'patient_id');
    }

     public function Urinalysis()
    {
        return $this->hasMany('App\Urinalysis', 'patient_id');
    }

     public function Treatment()
    {
        return $this->hasMany('App\Treatment', 'patient_id');
    }
}

 