<?php

namespace App\Console;

use Exception;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Seat\Services\Models\Schedule as DbSchedule;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {


        // Check that the schedules table exists. This
        // could cause a fatal error if the app is
        // still being setup or the db has not yet
        // been configured. This is a relatively ugly
        // hack as this schedule() method is core to
        // the framework.
        try {

            DB::connection();
            if (! Schema::hasTable('schedules'))
                throw new Exception('Schema schedules does not exist');

        } catch (Exception $e) {

            return;
        }
        // Load the schedule from the database
        foreach (DbSchedule::all() as $job) {

            $command = $schedule->command($job['command'])
                ->cron($job['expression']);

            // Check if overlapping is allowed
            if (! $job['allow_overlap'])
                $command = $command->withoutOverlapping();

            // Check if maintenance mode is allowed
            if ($job['allow_maintenance'])
                $command = $command->evenInMaintenanceMode();

            if ($job['ping_before'])
                $command = $command->pingBefore($job['ping_before']);

            if ($job['ping_after'])
                $command->thenPing($job['ping_after']);

        }
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
