<?php

namespace App\Controllers;

use Core\Routing\{Controller, Request, Response};

class HomeController extends Controller
{
    /**
     * Return home page
     *
     * @param Request $request
     * @param Response $response
     * @throws \Exception
     */
    public function index(Request $request, Response $response)
    {
        return $response->view('index');
    }
}
