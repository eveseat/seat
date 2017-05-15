<?php

/*
 * This file is part of SeAT
 *
 * Copyright (C) 2015, 2016, 2017  Leon Jacobs
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 */

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
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {

        require base_path('routes/console.php');
    }
}
