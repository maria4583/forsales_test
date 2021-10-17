<?php 

namespace Core;

use Core\Routing\{Router, Request, Response};

class Application
{
    public Request $request;
    public Response $response;  
    public Router $router;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }

    public function run()
    {
        $this->router->resolve();
    }
}