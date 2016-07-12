<?php

namespace App\Console;

use Carbon\Carbon;
use DB;
use DateTime;
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
        // Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
		$schedule->call(function () {
			$date = new DateTime();
			$date = $date->format('Y-m-d H:i:s');
            $update2 = DB::table('users')
					->where('isOIC','no')
					->where('OIC_starting_date','<=',$date)
					->update(['isOIC' => 'yes']);
            $update1 = DB::table('users')
					->where('isOIC','yes')
					->where('OIC_end_date','<=',$date)
					->update(['isOIC' => 'no','OIC_starting_date' => null, 'OIC_end_date' => null]);
        })->everyMinute();
    }
}
