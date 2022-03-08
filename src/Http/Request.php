<?php

declare(strict_types=1);

namespace App\Http;

class Request
{
    private array $params = [];
    public function __construct()
    {
        switch($this->getMethod()) {
            case 'GET':
                $this->params['GET'] = $_GET;
                break;
            case 'POST':
                $this->params['POST'] = $_POST;
                break;
            //TODO etc...
        }
        $this->params['REQUEST'] = $_REQUEST;
    }

    private function getMethod()
    {
        return filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_ENCODED);

    }

    public function isPost(): bool
    {
        return 'POST' === $this->getMethod();
    }

    public function isGet(): bool
    {
        return 'GET' === $this->getMethod();
    }

    public function hasGet(string $param): bool
    {
        return isset($this->params['GET'][$param]);
    }

    public function hasPost(string $param): bool
    {
        return isset($this->params['POST'][$param]);
    }

    public function hasVar(string $param): bool
    {
        return isset($this->params['REQUEST'][$param]);
    }

    public function get(string $param)
    {
        return $this->params['GET'][$param] ?? null;
    }

    public function post(string $param)
    {
        return $this->params['POST'][$param] ?? null;
    }

    public function getVar(string $param)
    {
        return $this->params['REQUEST'][$param] ?? null;
    }


}
