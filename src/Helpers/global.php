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