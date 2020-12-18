<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ResetUsersPoints extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:points';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'If the user did not have any transaction in the last month then clear his points';

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
        $users = User::whereHas('roles', function ($query) {
            $query->where('id', 2);
        })->with('order')->get();

        foreach ($users as $user) {
            $lastOrderDate = count($user->order) ? $user->order->first()->created_at : $user->created_at;
            if (30 - ((new \Carbon\Carbon($lastOrderDate, 'UTC'))->diffInDays()) < 0) {
                $user->points = 0;
                $user->created_at = now();
                $user->save();
            }
        }
    }
}
