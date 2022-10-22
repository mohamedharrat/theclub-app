<?php

namespace App\Console;

use Carbon\Carbon;
use App\Models\Evenements;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // $evenements = Evenements::where('date', '<', Carbon::now()->subDays(1))->get();

        // foreach ($evenements as $evenement) {
        //     $evenement->delete();
        // }

        $schedule->call(function () {
            $evenements = Evenements::select('date')->where('date', '<', date('Y/m/d'));

            foreach ($evenements as $evenement) {
                $evenement->players()->detach();
                $evenement->delete();
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
