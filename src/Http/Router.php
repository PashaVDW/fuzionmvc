<?php

namespace fuzionmvc\Http;

class Router
{
    protected static array $routes = [];

    public function __construct($routes = [])
    {
        self::$routes = $routes;
    }

    public static function getRoutes()
    {
        return self::$routes;
    }

    public static function get($route, $controller): void
    {
        $newRoute = [
            'method' => 'GET',
            'route' => $route,
            'controller' => $controller,
        ];
        self::$routes[] = $newRoute;
    }
}
