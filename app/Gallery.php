<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
     protected $fillable = [
        'gallery_album_id','name', 'image', 'description',
    ];

     public function Gallery_album()
    {
        return $this->belongsTo('App\Gallery_album', 'gallery_album_id');
    }
}

