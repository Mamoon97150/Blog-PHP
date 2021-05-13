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


    /**
     * retourne la liste du nom de toutes les routes
     *
     * @param string|null $name
     * @return array
     */
    public function name(string $name = null): array
    {
        $this->routeName[$name][] = $this->path;
        return $this->routeName;
    }

    /**
     * verifie que le chemin est au bon format et récupère les paramètre
     *
     * @param $url
     * @return bool
     */
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

    /**
     * execute la methode demander en fonction du type de requête
     *
     * @return false|mixed
     */
    public function execute()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            return $this->getRequest();
        }

        return $this->postRequest();

    }

    /**
     * Récupère l'action afin de séparer le controller , la methode et les parametre si nécéssaire d'une requête GET
     *
     * @return mixed
     */
    public function getRequest(): mixed
    {
        if (is_string($this->action))
        {
            $action = explode('@', $this->action);
            $controller = $action[0];
            $controller = new $controller;
            $method = $action[1];
            return call_user_func_array([$controller, $method], $this->parameters);
        }

        return call_user_func_array($this->action, $this->parameters);

    }

    /**
     * Récupère l'action afin de séparer le controller , la methode et les parametre si nécéssaire d'une requête POST
     *
     * @return mixed
     */
    public function postRequest(): mixed
    {
        if (is_string($this->action))
        {
            $action = explode('@', $this->action);
            $controller = $action[0];
            $controller = new $controller;
            $method = $action[1];
            array_unshift($this->parameters, $this->request);
            return call_user_func_array([$controller, $method], $this->parameters);
        }
        return call_user_func_array($this->action, $this->parameters);
    }
}