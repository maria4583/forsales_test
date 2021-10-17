<?php

use Core\Application;
use App\Controllers\{
    HomeController,
    ReportController
};

return function (Application $app) {
    $app->router->get('/', [HomeController::class, 'index']);
    $app->router->get('/api/report', [ReportController::class, 'index']);
};
