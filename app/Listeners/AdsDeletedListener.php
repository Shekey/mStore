<?php

namespace App\Listeners;

use App\Events\AdsDeleted;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AdsDeletedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AdsDeleted  $event
     * @return void
     */
    public function handle(AdsDeleted $event)
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->points -= $event->ads->points;
            if($user->points < 0) $user->points = 0;
            $user->save();
        }
    }
}
