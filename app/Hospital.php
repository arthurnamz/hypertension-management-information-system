<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
	protected $table = 'tbl_hospitals';
    protected $fillable = [
        'name', 'location',
    ];

    public function Employee()
    {
        return $this->hasMany('App\Employee', 'hospital_id');
    }

    public function Patient()
    {
        return $this->hasMany('App\Patient', 'hospital_id');
    }
}
