<?php

namespace App\Console\Commands;

use App\Models\Market;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckIsMarketClosed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'market:closed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $carbon=Carbon::now();
        $m = null;
        $dayToday = $carbon->format('l');

        $allMarket = Market::all();
        foreach ($allMarket as $market) {
            if ($dayToday === 'Sunday') {
                $startDateSunday = new Carbon($market->startTimeSunday);
                $endDateSunday = new Carbon($market->endTimeSunday);
                $m = $carbon->lte($endDateSunday) && $carbon->gte($startDateSunday);
            } else {
                $startDate = new Carbon($market->startTime);
                $endDate = new Carbon($market->endTime);
                $m = $carbon->lte($endDate) && $carbon->gte($startDate);
            }
            $market->isClosed = !$m;
            $market->save();
        }
    }
}
