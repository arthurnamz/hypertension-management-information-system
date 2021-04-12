<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kidney_Test extends Model
{
    protected $table = 'tbl_kidney_function_tests';
    protected $fillable = [
        'patient_id', 'employee_id','results','comment',
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
