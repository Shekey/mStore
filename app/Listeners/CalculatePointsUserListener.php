<?php

namespace App\Listeners;

use App\Events\CalculatePointsUser;
use App\Models\OrderProduct;
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
        if(count($event->orderProduct) > 0) {
            $user = User::find($event->orderProduct[0]['customer_id']);
            $orderProduct = $event->orderProduct;
            $orderTotal = 0;

            foreach ($orderProduct as $op) {
                if ($op['profitMake']) {
                    $orderTotal += $op['currentPrice'] * $op['qty'];
                }
            }
            $user->moneySpent += $orderTotal;
            $pointsExtra = floor($user->moneySpent / 50);

            if ($event->addPoints) {
                $user->points += $pointsExtra;
                $user->moneySpent = fmod($user->moneySpent, 50);
            } else {
                $user->points -= $pointsExtra;
                $user->points = $user->points < 0 ? 0 : $user->points;
                $user->moneySpent = $user->moneySpent = -fmod($user->moneySpent, 50);
                $user->moneySpent = $user->moneySpent < 0 ? 0 : $user->moneySpent;
            }

            $user->save();
        }
    }
}
