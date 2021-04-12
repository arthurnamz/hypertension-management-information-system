<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
     protected $fillable = [
        'namartists_id', 'albums_id','song_name','downloads','streams','image','song_file', 'genres', 'for_sale', 'price', 'duration','released_time','date_produced',
    ];
   

    public function Namartist()
    {
        return $this->belongsTo('App\Namartist', 'namartists_id');
    }
     public function Album()
    {
        return $this->belongsTo('App\Album', 'albums_id');
    }
}
