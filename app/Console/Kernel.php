<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\CheckIsMarketClosed'
    ];

    // define your queues here in order of priority
    protected $queues = [
        'notifications',
        'default',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('market:closed')
            ->everyMinute();
        $schedule->command('notifications:clear')
            ->dailyAt('23:00');
        $schedule->command('reset:points')
            ->dailyAt('23:00');

        // run the queue worker "without overlapping"
        // this will only start a new worker if the previous one has died
        $schedule->command($this->getQueueCommand())
            ->everyMinute()
            ->withoutOverlapping();

        // restart the queue worker periodically to prevent memory issues
        $schedule->command('queue:restart')
            ->hourly();
    }

    protected function getQueueCommand()
    {
        // build the queue command
        $params = implode(' ',[
            '--daemon',
            '--tries=3',
            '--sleep=3',
            '--queue='.implode(',',$this->queues),
        ]);

        return sprintf('queue:work %s', $params);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
