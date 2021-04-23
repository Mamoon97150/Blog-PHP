<?php

namespace App;

class Request
{
    private $path;
    private $action;
    private $parameters = [];
    private $request;
    private $routeName = [];

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

    public function match($url): bool
    {
        $path = preg_replace('#({[\w]+})#', '([^/]+)', $this->path);
        $pathToMatch = "#^$path$#";

        if (preg_match($pathToMatch, $url, $results))
        {
            array_shift($results);
            $this->parameters = $results;
            return true;
        }

        return false;
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
            call_user_func_array([$controller, $method], $this->parameters);
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
            array_unshift($this->parameters, $this->request);
            call_user_func_array([$controller, $method], $this->parameters);}
        else
        {
            call_user_func_array($this->action, $this->parameters);
        }
    }
}