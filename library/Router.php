<?php

namespace App;


class Router
{
    protected static $request;

    public static function get( string  $path, $action)
    {
        $routes = new Request($path, $action);
        self::$request['GET'][] = $routes;
        return $routes;
    }

    public static function post( string  $path, $action)
    {
        $routes = new Request($path, $action);
        self::$request['POST'][] = $routes;
        return $routes;
    }

    public static function run()
    {
        session_start();
        foreach (self::$request[$_SERVER['REQUEST_METHOD']] as $route)
        {
            if ($route->match(trim($_GET['url']), '/'))
            {
                $route->execute();
                die();
            }
            header('HTTP/1.0 404 Not Found');
        }
    }

    public static function url( $name, $parameters = [])
    {
        foreach (self::$request as $key => $value)
        {
            foreach (self::$request[$key] as $routes)
            {
                if (array_key_exists($name, $routes->name()))
                {
                    $route = $routes->name();
                    $path = implode($route[$name]);

                    if (!empty( $parameters))
                    {
                        foreach ($parameters as $key => $value)
                        {
                            $path = str_replace("{{$key}}", $value, $path);

                        }
                        return '/'.$path;
                    }
                }
            }
        }
    }



}