<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all notifications from database, monthly';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $notifications = DB::table('notifications')->where('created_at', '<=', Carbon::now()->subDays(30)->toDateTimeString())->get();
        foreach ($notifications as $notification) {
            $notification->delete();
        }
    }
}
