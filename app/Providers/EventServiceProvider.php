<?php

namespace App\Providers;

use App\Events\AdsCreated;
use App\Events\AdsDeleted;
use App\Events\AdsUpdated;
use App\Events\CalculatePointsUser;
use App\Listeners\AdsCreatedListener;
use App\Listeners\AdsDeletedListener;
use App\Listeners\AdsUpdatedListener;
use App\Listeners\CalculatePointsUserListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CalculatePointsUser::class => [
            CalculatePointsUserListener::class
        ],
        AdsCreated::class => [
            AdsCreatedListener::class
        ],
        AdsUpdated::class => [
            AdsUpdatedListener::class
        ],
        AdsDeleted::class => [
            AdsDeletedListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
