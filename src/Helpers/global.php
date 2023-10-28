<?php

use fuzionmvc\Core\App;

if(! function_exists('app'))
{
    /**
     * Creates an instance from the app
     *
     * @return App
     */
    function app(): App
    {
        return new App();
    }
}

if(! function_exists('dd'))
{
    function dd(...$vars)
        {
            foreach ($vars as $var) {
                var_dump($var);
            }
            die(1);
        }
}

if(! function_exists('base_path'))
{
    function base_path(): string
    {
        return define('BASE_PATH', dirname(__DIR__));
    }
}
