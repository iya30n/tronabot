<?php

use App\Core\Request;

function dd(...$something)
{
    echo '<pre>';
    var_dump($something);
    echo '</pre>';
    die();
}

function view($view, $data = [])
{
    extract($data);
    require "app/views/{$view}.view.php";
}

function redirect($path)
{
    header("location: {$path}");
}

function validateData($data)
{
    $data = htmlspecialchars(trim($data));
    if ($data == null) {
        redirect('/');
    }
    return $data;
}

function request($key)
{
    return Request::get($key);
}

/**
 * Flatten a multi-dimensional associative array with dots.
 *
 * @param  iterable  $array
 * @param  string  $prepend
 * @return array
 */
function array_dot($array, $prepend = '')
{
    $results = [];

    foreach ($array as $key => $value) {
        if (is_array($value) && !empty($value)) {
            $results = array_merge($results, array_dot($value, $prepend . $key . '.'));
        } else {
            $results[$prepend . $key] = $value;
        }
    }

    return $results;
}

// TODO: remember you've defined array_dot and config functions (add them to the framework)

function config($key)
{
    $confFile = include(__DIR__ . '/../config.php');
    return array_dot($confFile)[$key];
}
