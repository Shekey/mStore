<?php

namespace App\Listeners;

use App\Events\AdsCreated;
use App\Models\User;
use App\Notifications\notifyUserAds;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;

class AdsCreatedListener
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
     * @param  AdsCreated  $event
     * @return void
     */
    public function handle(AdsCreated $event)
    {
//        $users = User::whereHas('roles', function ($query) {
//            $query->where('id', 2);
//        })->get();
        $users = User::all();
        foreach ($users as $user) {
            $user->points += $event->ads->points;
            $user->save();
        }

        Notification::send($users, new notifyUserAds($event->ads));
    }
}
