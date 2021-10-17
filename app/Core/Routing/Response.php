<?php 

namespace Core\Routing;

use Core\View;

class Response 
{
    use View;

    public function withStatus(int $status): Response
    {
        http_response_code($status);
        return $this;
    }

    public function withHeader(string $key, $value): Response
    {
        header("$key:$value");
        return $this;
    }

    public function toJson($body)
    {
        $this->withHeader('Content-Type', 'application/json');
        echo json_encode($body, JSON_UNESCAPED_UNICODE);
    }
}