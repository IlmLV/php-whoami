<?php

if(php_sapi_name() == 'cli')
	die("Currently no support for CLI.\n");

header('Content-Type: text/plain; charset=utf-8');

function get_HTTP_request_headers($exceptions = []) {
    $HTTP_headers = array();
    foreach($_SERVER as $key => $value) {
        if (substr($key, 0, 5) <> 'HTTP_' || in_array($key, $exceptions)) {
            continue;
        }
        $single_header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
        $HTTP_headers[$single_header] = $value;
    }
    return $HTTP_headers;
}

$attr = [
    //'Hostname' =>  gethostname(),
    $_SERVER['REQUEST_METHOD'] => $_SERVER['REQUEST_URI'].' '.$_SERVER['SERVER_PROTOCOL'],
    'Client-IP' => $_SERVER['REMOTE_ADDR'],
    'Server-IP' => $_SERVER['SERVER_ADDR'],
    'Method' => $_SERVER['REQUEST_METHOD'],
    'Scheme' => $_SERVER['REQUEST_SCHEME'],
    'Status' => http_response_code(),
    'Protocol' => $_SERVER['SERVER_PROTOCOL'],
    'Time' => $_SERVER['REQUEST_TIME_FLOAT'],
    'TZ' => $_SERVER['TZ'],
    'Host' => $_SERVER['HTTP_HOST'],
    'User-Agent' => $_SERVER['HTTP_USER_AGENT'],
];

$headers = get_HTTP_request_headers(['HTTP_HOST', 'HTTP_USER_AGENT']);
foreach ($attr + $headers as $key => $value) {
    echo "$key: $value\n";
}
