<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
	protected $table = 'tbl_schedules';
    protected $fillable = [
        'employee_id', 'available_days', 'start_time', 'end_time', 'status',
    ];

    public function Employee()
    {
        return $this->belongsTo('App\Employee', 'employee_id');
    }
}
