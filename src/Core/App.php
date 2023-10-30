<?php

namespace fuzionmvc\Core;

use fuzionmvc\Core\Request;
use fuzionmvc\Http\Router;
use ReflectionMethod;

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

    /**
     * @throws \ReflectionException
     */
    public function setRouting()
    {
        require root_path() . DIRECTORY_SEPARATOR . 'routes.php';

        $routes = Router::getRoutes();
        $uri = $this->getURL();
        $request = $this->getRequest(); // Get the Request object

        foreach ($routes as $route) {
            // Compare the request URL with the route string
            if(strtoupper($route['method']) !== $_SERVER['REQUEST_METHOD']) {
                abort(405, "Method not allowed");
            }

            if ($route['route'] === $uri) {
                $controllerClass = $route['controller'][0];
                $controllerMethod = $route['controller'][1];

                $obj = new $controllerClass();

                $method = new ReflectionMethod($obj, $controllerMethod);
                foreach ($method->getParameters() as $arg) {
                    if ($arg->getType() && $arg->getType()->getName() === 'fuzionmvc\\Core\\Request') {
                        print_r('test route');
                        return $obj->{$controllerMethod}($request); // Pass the Request object
                    }
                }

                return $obj->{$controllerMethod}();
            }
        }

        // Handle case when route not found
        echo "Route not found";
    }

    public function prepare($path): App
    {
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
