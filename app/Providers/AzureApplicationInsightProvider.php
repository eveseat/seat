<?php

/*
 * This file is part of SeAT
 *
 * Copyright (C) 2015, 2016, 2017, 2018, 2019  Leon Jacobs
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

namespace App\Providers;

use App\Wrappers\AzureApplicationInsight;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;

/**
 * Class AzureApplicationInsightProvider.
 * @package App\Providers
 */
class AzureApplicationInsightProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = false;

    public function boot()
    {
        Queue::before(function (JobProcessing $event) {
            $event->job->startTime = microtime(true);
        });

        Queue::after(function (JobProcessed $event) {
            app('app-insight')->trackJobDependency($event);
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            \App\Wrappers\AzureApplicationInsight::class,
        ];
    }

    public function register()
    {
        $this->app->singleton('app-insight', function ($app) {
            return new AzureApplicationInsight();
        });
    }
}
