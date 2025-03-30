<?php

if(php_sapi_name() == 'cli')
    die("No support for CLI.\n");

header('Content-Type: text/plain; charset=utf-8');

/**
 * Returns list of request headers as key value array
 * @param array $exceptions
 * @return array
 */
function getRequestHeaders($exceptions = []) {
    $headers = array();
    if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
        $headers['authorization'] = 'Basic ' . base64_encode($_SERVER['PHP_AUTH_USER'] . ':' . $_SERVER['PHP_AUTH_PW']);
    }
    foreach($_SERVER as $key => $value) {
        if (($key !== 'PHP_AUTH_USER' && substr($key, 0, 5) <> 'HTTP_') || in_array($key, $exceptions)) {
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
 * @return mixed|bool The present key value, or false
 */
function insensitiveKeyValue($needle, $haystack) {
    foreach ($haystack as $key => $value) {
        if (strtolower($needle) == strtolower($key)) {
            return $value;
        }
    }
    return false;
}

/**
 * Convert array keys to snake case
 * @param array $array
 * @return array with snake_case keys
 */
function snakeCaseArrayKeys($array) {
    $result = [];
    foreach ($array as $k => $v) {
        $separators = [' ', '_', '-', '·'];
        foreach ($separators as $sep) {
            if(strpos($k, $sep) !== false) {
                $k = implode('_', array_map('ucfirst', explode($sep, $k)));
            }
        }
        $result[strtolower($k)] = $v;
    }
    return $result;
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


// Select response formatter
$format = null;
if (!empty($_GET['format'])) {
    $format = strtolower($_GET['format']);
    if (!in_array($_GET['format'], ['plain', 'json'])) {
        http_response_code(400);
        echo "ERROR: `format` attribute `$format` not found.";
        exit(1);
    }
}

// Select single attribute response
$what = null;
if (!empty($_GET['what'])) {
    $what = strtolower($_GET['what']);
    if (!insensitiveKeyValue($what, $attr)) {
        http_response_code(400);
        echo "ERROR: `what` attribute `{$what}` not found.";
        exit(1);
    }
}

$response = $what ? insensitiveKeyValue($what, $attr) : $attr;

if ($format === 'json') {
    header('Content-type: application/json; charset=utf-8');

    $response = is_array($response) ? snakeCaseArrayKeys($response) : $response;
    echo json_encode($response);
}
else {
    header('Content-Type: text/plain; charset=utf-8');

    if (is_array($response)) {
        foreach ($response as $key => $value) {
            echo $key . ': '. ($value ?: 'N/A') . PHP_EOL;
        }
    }
    else {
        echo $response;
    }
}
