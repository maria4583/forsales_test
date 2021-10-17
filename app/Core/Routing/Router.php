<?php

namespace Core\Routing;

use Core\Routing\Request;
use Core\Routing\Response;

class Router
{
    private Request $request;
    private Response $response;
    private array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get(string $path, $callback): void
    {
        $this->routes['get'][$path] = $callback;
    }

    /**
     * Returns a controller callback or page 404
     *
     * @throws \Exception
     */
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$path] ?? false;
        if (!$callback) {
            return $this->response->withStatus(404)->view('error404');
        }
        if (!is_array($callback)) {
            throw new \Exception('Route is incorrect');
        }

        $controller = new $callback[0];
        $controllerMethod = $callback[1];

        $controller->$controllerMethod($this->request, $this->response);
    }
}
