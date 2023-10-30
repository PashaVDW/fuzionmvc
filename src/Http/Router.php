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

}
