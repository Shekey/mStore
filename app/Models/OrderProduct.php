<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;


    //Table Name
    protected $table = 'order_product';

    //Primary Key
    public $primaryKey = 'id';


    //Timestamps
    public $timestamps =true;

    public function order(){
        return $this->belongsTo('App\Order');

    }
    public function product(){
        return $this->hasMany('App\Product');
    }
}
