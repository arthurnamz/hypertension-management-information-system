<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Urinalysis extends Model
{
    protected $table = 'tbl_urinalysis';
    protected $fillable = [
        'patient_id', 'employee_id','result','comment',
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
