<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News_media extends Model
{
    protected $fillable = [
        'news_id', 'media','type',
    ];
   

    
     public function News()
    {
        return $this->belongsTo('App\News', 'news_id');
    }
}
