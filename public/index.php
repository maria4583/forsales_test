<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Core\Application;

$app = new Application();

$routes = require_once __DIR__ . '/../routes/routes.php';
$routes($app);

$app->run();