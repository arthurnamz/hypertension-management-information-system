<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allergies extends Model
{
     protected $table = 'tbl_allergies';
     protected $fillable = [
        'patient_id', 'employee_id','name',
    ];

     public function Patient()
    {
        return $this->belongsTo('App\Patient', 'patient_id');
    }

     public function Employee()
    {
        return $this->belongsTo('App\Employee', 'employee_id');
    }
}
