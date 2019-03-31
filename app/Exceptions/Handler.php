<?php

namespace App\Exceptions;

use ApplicationInsights\Telemetry_Client;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Symfony\Component\Console\Exception\CommandNotFoundException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    private $telemetryClient;

    public function __construct(Container $container)
    {
        parent::__construct($container);

        $app_insight_token = env('AZURE_APP_INSIGHT_KEY');

        if (is_null($app_insight_token)) {

            $server_ip = array_key_exists('SERVER_ADDR', $_SERVER) ? $_SERVER['SERVER_ADDR'] : '127.0.0.1';

            $this->telemetryClient = new Telemetry_Client();
            $this->telemetryClient->getContext()->setInstrumentationKey($app_insight_token);
            $this->telemetryClient->getContext()->getLocationContext()->setIp($server_ip);
            $this->telemetryClient->getChannel()->SetClient(new Client());

        }
    }

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $exception
     *
     * @return void
     */
    public function report(Exception $exception)
    {

        parent::report($exception);

        if (is_null($exception) || is_null(env('AZURE_APP_INSIGHT_KEY')))
            return;

       $this->telemetryClient->trackException($exception);
       $this->telemetryClient->flush();
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception               $exception
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {

        return parent::render($request, $exception);
    }
}
