<?php

namespace fuzionmvc\Core;

class Request {
    private array $request;

    public function __construct($request) {
        $this->request = $request;
    }

    public function getRequest(): array {
        return $this->request;
    }

    public function getUri() {

    }
}