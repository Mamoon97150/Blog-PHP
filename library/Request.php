<?php

namespace App;

class Request
{
    protected $path;
    protected $action;
    protected $parameters = [];
    protected $request;
    protected $routeName = [];

    public function __construct(string $path, $action)
    {
        $this->request = new HTTPRequest();
        $this->path = trim($path, '/');
        $this->action = $action;
    }

    public function name(string $name = null)
    {
        $this->routeName[$name][] = $this->path;
        return $this->routeName;
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
        if ($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            $this->getRequest();
        }
        else
        {
            $this->postRequest();
        }
    }

    public function getRequest()
    {
        if (is_string($this->action))
        {
            $action = explode('@', $this->action);
            $controller = $action[0];
            $controller = new $controller;
            $method = $action[1];
            return isset($this->parameters) ? $controller->$method(implode($this->parameters)) : $controller->$method();
        }
        else
        {
            call_user_func_array($this->action, $this->parameters);
        }
    }

    public function postRequest()
    {
        if (is_string($this->action))
        {
            $action = explode('@', $this->action);
            $controller = $action[0];
            $controller = new $controller;
            $method = $action[1];
            return isset($this->parameters) ? $controller->$method($this->request, implode($this->parameters)) : $controller->$method($this->request);
        }
        else
        {
            call_user_func_array($this->action, $this->parameters);
        }
    }
}