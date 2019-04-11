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

namespace App\Wrappers;

use ApplicationInsights\Telemetry_Client;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Queue\Events\JobProcessed;
use Seat\Eveapi\Jobs\EsiBase;
use Seat\Services\Exceptions\SettingException;

/**
 * Class AzureApplicationInsight.
 * @package App\Wrappers
 */
class AzureApplicationInsight
{
    /**
     * Determine the number of metrics which will put on the side before being sent to Azure Application Insight
     */
    const MAXIMUM_QUEUE_SIZE = 10;

    /**
     * @var \ApplicationInsights\Telemetry_Client
     */
    private $telemetryClient;

    /**
     * AzureApplicationInsight constructor.
     */
    public function __construct()
    {
        $this->initContainer();
    }

    /**
     * AzureApplicationInsight destructor.
     */
    public function __destruct()
    {
        // send all remaining queue elements to the telemetry platform
        try {
            $this->telemetryClient->flush();
        } catch (RequestException $e) {
            logger()->error($e->getMessage(), $e->getTrace());
        }
    }

    /**
     * Determine if yes or no the monitoring service is online.
     *
     * @return bool
     */
    public function isEnabled() : bool
    {
        // in case client is unset, monitoring is offline
        if (! isset($this->telemetryClient))
            return false;

        // attempt to determine user choice related to monitoring
        try {
            $value = setting('allow_tracking', true);

            return $value === 'yes';
        } catch (SettingException $e) {
            logger()->error($e->getMessage(), $e->getTrace());
        }

        // by default, assume monitoring is disabled
        return false;
    }

    /**
     * @param Exception $exception
     */
    public function trackException(Exception $exception)
    {
        // ensure telemetry service is active or attempt to init it
        if (! $this->beforeTrackTelemetry())
            return;

        $this->telemetryClient->trackException($exception);

        $this->afterTrackTelemetry();
    }

    /**
     * @param $request
     * @param $response
     */
    public function trackRequest($request, $response)
    {
        // ensure telemetry service is active or attempt to init it
        if (! $this->beforeTrackTelemetry())
            return;

        // build a name composed of HTTP verb and request path
        $name = sprintf('%s %s', strtoupper($request->method()), $request->path());

        // build an extra properties array
        $properties = [
            'ajax' => $request->ajax(),
            'ip' => $request->ip(),
            'pjax' => $request->pjax(),
            'secure' => $request->secure(),
        ];

        if ($request->route() && $request->route()->getName())
            $properties['route'] = $request->route()->getName();

        // log the telemetry
        $this->telemetryClient->trackRequest(
            $name,
            substr($request->fullUrl(), 0, 2048),
            LARAVEL_START,
            (microtime(true) - LARAVEL_START),
            $response->getStatusCode(),
            $response->isSuccessful(),
            $properties
        );

        $this->afterTrackTelemetry();
    }

    /**
     * @param JobProcessed $event
     */
    public function trackJobDependency(JobProcessed $event)
    {
        if (! property_exists($event->job, 'startTime'))
            return;

        // ensure telemetry service is active or attempt to init it
        if (! $this->beforeTrackTelemetry())
            return;

        $end_time = microtime(true);

        $payload = $event->job->payload();

        // build metadata
        $job_name = $payload['displayName'];
        $job_class = $payload['data']['commandName'];
        $job_duration = $end_time - $event->job->startTime;
        $job_type = is_subclass_of($job_class, EsiBase::class, true) ? 'Esi' : 'Third Party';

        // log the telemetry
        $this->telemetryClient->trackDependency(
            $job_name, $job_type, 'job', $event->job->startTime, $job_duration);

        $this->afterTrackTelemetry();
    }

    /**
     * Init the container with a new Telemetry Client.
     */
    private function initContainer()
    {
        $app_insight_token = env('AZURE_APP_INSIGHT_KEY');

        if (is_null($app_insight_token))
            return;

        $server_ip = array_key_exists('SERVER_ADDR', $_SERVER) ? $_SERVER['SERVER_ADDR'] : '127.0.0.1';

        $this->telemetryClient = new Telemetry_Client();
        $this->telemetryClient->getContext()->setInstrumentationKey($app_insight_token);
        $this->telemetryClient->getContext()->getLocationContext()->setIp($server_ip);
        $this->telemetryClient->getChannel()->SetClient(new Client());
    }

    /**
     * Ensure telemetry service is active or attempt to init it.
     *
     * @return bool
     */
    private function beforeTrackTelemetry() : bool
    {
        if (! $this->isEnabled()) {
            $this->initContainer();

            return $this->isEnabled();
        }

        return true;
    }

    /**
     * Send telemetry data to Azure Application Insight if we've reached the maximum queue size.
     */
    private function afterTrackTelemetry()
    {
        if (count($this->telemetryClient->getChannel()->getQueue()) >= self::MAXIMUM_QUEUE_SIZE) {

            try {
                $this->telemetryClient->flush();
            } catch (RequestException $e) {
                logger()->error($e->getMessage(), $e->getTrace());
            }
        }
    }
}
