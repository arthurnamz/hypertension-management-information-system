<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
   protected $fillable = [
        'album_title', 'cover_picture', 'for_sale', 'price', 'download', 'released_time', 
    ];

    public function Music()
    {
        return $this->hasMany('App\Music', 'albums_id');
    }
}
