<?php

if(php_sapi_name() == 'cli')
    die("Currently no support for CLI.\n");

header('Content-Type: text/plain; charset=utf-8');

/**
 * Returns list of request headers as key value array
 * @param array $exceptions
 * @return array
 */
function getRequestHeaders($exceptions = []) {
    $headers = array();
    foreach($_SERVER as $key => $value) {
        if (substr($key, 0, 5) <> 'HTTP_' || in_array($key, $exceptions)) {
            continue;
        }
        $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
        $headers[$header] = $value;
    }
    return $headers;
}

/**
 * Case-insensitive search for present array key value
 * @param string $needle
 * @param array $haystack
 * @return string|bool The present key value, or false
 */
function getArrayKeyValue($needle, $haystack) {
    foreach ($haystack as $key => $value) {
        if (strtolower($needle) == strtolower($key)) {
            return (string) $value;
        }
    }
    return false;
}

$attr = [
    $_SERVER['REQUEST_METHOD'] => $_SERVER['REQUEST_URI'].' '.$_SERVER['SERVER_PROTOCOL'],
    'IP' => $_SERVER['REMOTE_ADDR'],
    'Server-IP' => $_SERVER['SERVER_ADDR'],
    'Method' => $_SERVER['REQUEST_METHOD'],
    'Scheme' => $_SERVER['REQUEST_SCHEME'],
    'Host' => $_SERVER['HTTP_HOST'],
    'Uri' => $_SERVER['REQUEST_URI'],
    'Status' => http_response_code(),
    'Protocol' => $_SERVER['SERVER_PROTOCOL'],
    'Time' => $_SERVER['REQUEST_TIME_FLOAT'],
] + getRequestHeaders();

// Select single attribute response
if (!empty($_GET['what'])) {
    $what = $_GET['what'];
    if (($whatIs = getArrayKeyValue($what, $attr)) !== false) {
        echo $whatIs;
    }
    else {
        http_response_code(400);
        echo "ERROR: `what` attribute `$what` not found.";
    }
}
// Return all attributes
else {
    foreach ($attr as $key => $value) {
        echo "$key: $value\n";
    }
}
