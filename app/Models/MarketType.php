<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketType extends Model
{
    use HasFactory;

    protected $table = "markettype";
    protected $guarded = [];
    public $timestamps = false;

    public function articles()
    {
        return $this->hasMany('App\Models\Articles');
    }

    public function markets()
    {
        return $this->hasMany('App\Models\Market');
    }
}
