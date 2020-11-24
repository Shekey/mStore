<?php

namespace App\Listeners;

use App\Events\AdsUpdated;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AdsUpdatedListener
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
     * @param  AdsUpdated  $event
     * @return void
     */
    public function handle(AdsUpdated $event)
    {
        $changes = $event->ads->getChanges();
        $original = $event->ads->getOriginal();
        if(isset($changes["points"])) {
            $pointsDiff = $changes["points"] - $original["points"];
            $users = User::all();
            foreach ($users as $user) {
                $user->points += $pointsDiff;
                if($user->points < 0) {
                    $user->points = 0;
                }
                $user->save();
            }
        }
    }
}
