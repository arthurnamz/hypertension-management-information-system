<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chest_xray extends Model
{
    protected $table = 'tbl_chest_x_rays';
     protected $fillable = [
        'patient_id', 'employee_id','file_name','results','comment',
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
