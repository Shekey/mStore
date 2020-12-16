<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function market()
    {
        return $this->belongsTo('App\Models\Market');
    }

    public function images()
    {
        return $this->hasMany('App\Models\ArtikalImage', 'articleId', 'id');
    }

    public function orderproduct(){
        return $this->belongsTo('App\OrderProduct');
    }

}
