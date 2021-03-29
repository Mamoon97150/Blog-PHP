<?php

namespace App;

class Request
{
    protected $path;
    protected $action;
    protected $parameters = [];
    protected $request;

    public function __construct(string $path, string $action)
    {
        $this->request = new HTTPRequest();
        $this->path = trim($path, '/');
        $this->action = $action;
    }

    public function match($url)
    {
        $path = preg_replace('#({[\w]+})#', '([^/]+)', $this->path);
        $pathToMatch = "#^$path$#";

        if (preg_match($pathToMatch, $url, $results))
        {
            array_shift($results);
            $this->parameters = $results;
            return true;
        }
        else
        {
            return false;
        }
    }

    public function execute()
    {
        $action = explode('@', $this->action);
        $controller = $action[0];
        $controller = new $controller;
        $method = $action[1];

        if ($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            return isset($this->parameters) ? $controller->$method(implode($this->parameters)) : $controller->$method();
        }
        else
        {
            return isset($this->parameters) ? $controller->$method($this->request, implode($this->parameters)) : $controller->$method($this->request);
        }
    }
}