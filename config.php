<?php

function config($key, $fallback = null)
{
    $data = [
        'DB_DSN' => 'mysql:host=localhost;dbname=forsales_test',
        'DB_USER' => 'root',
        'DB_PASSWORD' => 'root',

        'ROOT_PATH' => __DIR__,
        'DS' => DIRECTORY_SEPARATOR,
    ];

    return array_key_exists($key, $data) ? $data[$key] : $fallback;
}
