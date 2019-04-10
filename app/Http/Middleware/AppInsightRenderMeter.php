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

namespace App\Http\Middleware;

use ApplicationInsights\Telemetry_Client;
use Closure;
use GuzzleHttp\Client;

/**
 * Class AppInsightRenderMeter.
 * @package App\Http\Middleware
 */
class AppInsightRenderMeter
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    /**
     * @param $request
     * @param $response
     * @throws \Seat\Services\Exceptions\SettingException
     */
    public function terminate($request, $response)
    {
        $app_insight_token = env('AZURE_APP_INSIGHT_KEY');

        if (! is_null($app_insight_token) && setting('allow_tracking', true)) {

            $server_ip = array_key_exists('SERVER_ADDR', $_SERVER) ? $_SERVER['SERVER_ADDR'] : '127.0.0.1';

            $telemetry_client = new Telemetry_Client();
            $telemetry_client->getContext()->setInstrumentationKey($app_insight_token);
            $telemetry_client->getContext()->getLocationContext()->setIp($server_ip);
            $telemetry_client->getChannel()->SetClient(new Client());

            $uid = sha1(implode('|', [$request->method(), $request->path()]));

            $telemetry_client->trackRequest($uid, substr($request->fullUrl(), 0, 2048), LARAVEL_START, (microtime(true) - LARAVEL_START), $response->getStatusCode(), $response->isSuccessful());
            $telemetry_client->flush();

        }
    }
}
