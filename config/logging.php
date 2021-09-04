<?php

use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that gets used when writing
    | messages to the logs. The name specified in this option should match
    | one of the channels defined in the "channels" configuration array.
    |
    */

    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log channels for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "monolog",
    |                    "custom", "stack"
    |
    */

    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['single'],
            'ignore_exceptions' => false,
        ],

        'single' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => 14,
        ],

        'slack' => [
            'driver' => 'slack',
            'url' => env('LOGGING_SLACK_WEBHOOK_URL'),
            'username' => 'Laravel Log',
            'emoji' => ':boom:',
            'level' => env('LOG_LEVEL', 'critical'),
        ],

        'papertrail' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => SyslogUdpHandler::class,
            'handler_with' => [
                'host' => env('PAPERTRAIL_URL'),
                'port' => env('PAPERTRAIL_PORT'),
            ],
        ],

        'stderr' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'with' => [
                'stream' => 'php://stderr',
            ],
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'null' => [
            'driver' => 'monolog',
            'handler' => NullHandler::class,
        ],

        'emergency' => [
            'path' => storage_path('logs/laravel.log'),
        ],

        /**
         * Custom Logging
         */
        'ServiceErrorExceptionLog' => [
            'driver' => 'daily',
            'path' => storage_path('logs/'.date('Y/m/').'ServiceErrorExceptionLog.log'),
            'level' => 'debug',
            'days' => 31,
        ],

        'NotFoundHttpException' => [
            'driver' => 'daily',
            'path' => storage_path('logs/'.date('Y/m/').'NotFoundHttpException.log'),
            'level' => 'debug',
            'days' => 31,
        ],

        'MethodNotAllowedHttpException' => [
            'driver' => 'daily',
            'path' => storage_path('logs/'.date('Y/m/').'MethodNotAllowedHttpException.log'),
            'level' => 'debug',
            'days' => 31,
        ],

        'ClientErrorException' => [
            'driver' => 'daily',
            'path' => storage_path('logs/'.date('Y/m/').'ClientErrorException.log'),
            'level' => 'debug',
            'days' => 31,
        ],

        'ServerErrorException' => [
            'driver' => 'daily',
            'path' => storage_path('logs/'.date('Y/m/').'ServerErrorException.log'),
            'level' => 'debug',
            'days' => 31,
        ],

        'ForbiddenErrorException' => [
            'driver' => 'daily',
            'path' => storage_path('logs/'.date('Y/m/').'ForbiddenErrorException.log'),
            'level' => 'debug',
            'days' => 31,
        ],

        'AuthenticationException' => [
            'driver' => 'daily',
            'path' => storage_path('logs/'.date('Y/m/').'AuthenticationException.log'),
            'level' => 'debug',
            'days' => 31,
        ],

        'ThrottleRequestsException' => [
            'driver' => 'daily',
            'path' => storage_path('logs/'.date('Y/m/').'ThrottleRequestsException.log'),
            'level' => 'debug',
            'days' => 31,
        ],

        'PDOException' => [
            'driver' => 'daily',
            'path' => storage_path('logs/'.date('Y/m/').'PDOException.log'),
            'level' => 'debug',
            'days' => 31,
        ],

        'Throwable' => [
            'driver' => 'daily',
            'path' => storage_path('logs/'.date('Y/m/').'Throwable.log'),
            'level' => 'debug',
            'days' => 31,
        ],

    ],

];
