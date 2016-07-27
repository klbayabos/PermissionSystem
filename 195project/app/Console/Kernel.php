<?php

namespace App\Console;

use Carbon\Carbon;
use DB;
use Mail;
use DateTime;
use DateTimeZone;
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
    protected function schedule(Schedule $schedule){
		$schedule->call(function () {
			$date = new DateTime();
			$date->setTimezone(new DateTimeZone('Asia/Manila'));
			$date = $date->format('Y-m-d H:i:s');
			
			// Officer in Charge Expiration
            $update2 = DB::table('users')
					->where('isOIC','no')
					->where('OIC_starting_date','<=',$date)
					->update(['isOIC' => 'yes']);
            $update1 = DB::table('users')
					->where('isOIC','yes')
					->where('OIC_end_date','<=',$date)
					->update(['isOIC' => 'no','OIC_starting_date' => null, 'OIC_end_date' => null]);
					
			// Request Expiration
			$date2 = new DateTime();
			$date2->setTimezone(new DateTimeZone('Asia/Manila'));
			$req_date = $date2->format('Y-m-d');
			$req_time = $date2->format('H:i:s');
			$req_expiration1 = DB::table('request')
							->where('starting_date', '<=', $req_date)
							->where('starting_time', '<=', $req_time)
							->where(function ($query) {
								$query->where('status', 'Submitted')
									->orWhere('status', 'Endorsed for approval');
								})
							->update(['status' => 'Expired']);
							
			$req_expiration2 = DB::table('request_endorsement')
							->join('request', 'request_endorsement.request_id', '=', 'request.request_id')
							->where('request.starting_date', '<=', $req_date)
							->where('request.starting_time', '<=', $req_time)
							->where('request.status', 'Expired')
							->delete();
	
        })->everyMinute();
    }
}
