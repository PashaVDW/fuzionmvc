<?php

namespace fuzionmvc\Core;

use fuzionmvc\Http\Router;

class App
{
    private Request $request;
    private static $basePath;

    public function __construct()
    {
        static::init();
    }

    public static function init(): void
    {
        static::$basePath = dirname(__DIR__, 5);
    }


    public function getURL()
    {
        if ($_SERVER['REQUEST_URI']) {
            $url = rtrim(strtolower($_SERVER['REQUEST_URI']), '/');
            return filter_var($url, FILTER_SANITIZE_URL);
        }
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function build(): void
    {
        $this->request = new Request($_REQUEST);
    }
    public function setRouting() {
        require_once root_path() . DIRECTORY_SEPARATOR .  "routes.php";

        $routes = (new \fuzionmvc\Http\Router)->getRoutes();
        $routesArray = $routes->toArray();
        dd($routesArray);
    }

    public function prepare($path): App {
        return $this;
    }

    public static function getViewPath(): string
    {
        return static::$basePath . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR;
    }

    public static function getRootPath(): string
    {
        return static::$basePath;
    }

}