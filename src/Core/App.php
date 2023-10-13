<?php

namespace fuzionmvc\Core;

class App {

    public function getURL()
    {
        if ($_SERVER['REQUEST_URI']) {
            $url = rtrim(strtolower($_SERVER['REQUEST_URI']), '/');
            return filter_var($url, FILTER_SANITIZE_URL);
        }
    }

    public function prepare($path): App {
        return $this;
    }
}