<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $table = 'tbl_treatments';
    protected $fillable = [
        'patient_id', 'employee_id','drug','comment',
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
