<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'heading', 'description','date_published',
    ];
   

    
     public function News_media()
    {
        return $this->hasMany('App\News_media', 'news_id');
    }
}
