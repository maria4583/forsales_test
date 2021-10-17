<?php

namespace Core\Routing;

use Core\Validation;

class Request
{
    use Validation;

    public function __construct()
    {
        $this->parseParams();
    }

    public function getPath(): string
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if ($position === false) {
            return $path;
        }
        return substr($path, 0, $position);
    }

    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * Parse URL params and adds them as object variables
     */
    private function parseParams(): void
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        // if params exist
        if ($position !== false) {
            $paramsString = substr($path, $position + 1, strlen($path));
            $paramsToArray = explode('&', $paramsString);
            foreach ($paramsToArray as $param) {
                [$key, $value] = explode('=', $param);
                $this->$key = $value;
            }
        }
    }
}
