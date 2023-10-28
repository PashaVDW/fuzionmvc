<?php

namespace fuzionmvc\Core;

class App
{
    private Request $request;

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

    public function build() {
        $this->request = new Request($_REQUEST);
    }
    public function setRouting() {

    }

    public function prepare($path): App {
        return $this;
    }
}