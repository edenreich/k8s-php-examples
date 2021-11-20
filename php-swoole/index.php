<?php

require_once __DIR__ . '/vendor/autoload.php';

use Swoole\Http\{Server, Request, Response};

$port = 8080;
$host = '0.0.0.0';

$server = new Server($host, $port);

$server->set([
    // Process
    'daemonize' => 0,
    'user' => 'www-data',
    'group' => 'www-data',
    'pid_file' =>'/run/swoole.pid',

    // Logging
    'log_level' => 1,
    'log_file' => '/proc/self/fd/1',
]);

$server->on('request', function (Request $request, Response $response) {
    $requestMethod = $request->server['request_method'];
    $requestUri = $request->server['request_uri'];
    $requestQueryString = $request->server['query_string'];
    $time = date('Y-m-d H:i:s');
    echo "[$time][info] $requestMethod $requestUri?$requestQueryString\n\r";
    $response->header('Content-Type', 'text/html');
    $response->status(200);
    $response->end("Hello World!\n\r");
});

$server->on('start', function (Server $server) {
    echo "Starting server on $server->host:$server->port\n";
});

$server->start();
