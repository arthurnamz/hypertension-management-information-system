<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery_album extends Model
{
     protected $fillable = [
        'name', 'description', 'gallery_cover',
    ];

    public function Gallery()
    {
        return $this->hasMany('App\Gallery', 'gallery_album_id');
    }
}
