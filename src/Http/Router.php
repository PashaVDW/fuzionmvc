<?php

namespace fuzionmvc\Http;

class Router
{
    protected array $routes;

    public function __construct($routes = [])
    {
        $this->routes = $routes;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public static function get($route, $controller): Router
    {
        $newRoute = [
            'method' => 'GET',
            'route' => $route,
            'controller' => $controller,
        ];
        return new self([$newRoute]);
    }

}