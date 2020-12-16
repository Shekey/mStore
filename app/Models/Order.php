<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    //Table Name
    protected $table = 'orders';

    //Primary Key
    public $primaryKey = 'id';

    //Timestamps
    public $timestamps =true;

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function orderproduct(){
        return $this->hasMany('App\OrderProduct');
    }
}
