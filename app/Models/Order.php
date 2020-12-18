<?php

namespace App\Models;

use App\Events\CalculatePointsUser;
use App\Notifications\OrderCreatedNotification;
use App\Notifications\OrderCreatedNotificationUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;

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

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::created(function (Order $order) {
            $admins = User::whereHas('roles', function ($query) {
                $query->where('id', 1);
            })->get();

            Notification::send($admins, new OrderCreatedNotification($order));
            Notification::send(auth()->user(), new OrderCreatedNotificationUser($order));
            CalculatePointsUser::dispatch($order);
        });
    }

    public function orderproduct(){
        return $this->hasMany('App\OrderProduct');
    }

}
