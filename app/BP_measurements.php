<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BP_measurements extends Model
{
     protected $table = 'tbl_BP_measurements';
     protected $fillable = [
        'patient_id', 'employee_id','systolic','diastolic', 'pulse_rate','comment',
    ];

     public function Patient()
    {
        return $this->belongsTo('App\Patient', 'patient_id');
    }

    //  public function Employee()
    // {
    //     return $this->belongsTo('App\Employee', 'employee_id');
    // }
    public function Employee()
    {
        return $this->belongsTo('App\Employee', 'employee_id');
    }
}
