<?php

namespace App\Listeners;

use App\Events\CalculatePointsUser;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CalculatePointsUserListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CalculatePointsUser $event)
    {
        $user = User::find($event->order->customer_id);
        $orderTotal = $event->order->total;
        $user->moneySpent += $orderTotal;
        $pointsExtra = round($user->moneySpent / 50);
        $user->moneySpent = $user->moneySpent % 50;
        $user->points += $pointsExtra;
        $user->save();
    }
}
