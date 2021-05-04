<?php

namespace App;


use App\Controller\FrontController;

class Router
{
    private static $request;

    //stockage d'une route GET dans $request
    public static function get( string  $path, $action)
    {
        $routes = new Request($path, $action);
        self::$request['GET'][] = $routes;
        return $routes;
    }

    //stockage d'une route POST dans $request
    public static function post( string  $path, $action)
    {
        $routes = new Request($path, $action);
        self::$request['POST'][] = $routes;
        return $routes;
    }


    //Démarre l'application, match et execute la route
    public static function run()
    {
        foreach (self::$request[$_SERVER['REQUEST_METHOD']] as $route)
        {
            if ($route->match(trim($_GET['url']), '/'))
            {
                $haystack = $_GET['url'];
                if (str_contains($haystack, 'admin'))
                {
                    return self::accessDenied($route);
                }
                return $route->execute();
            }
        }
        return redirect404();
    }

    //parcourir les routes stockées et trouver la route associé
    public static function url( $name, $parameters = [])
    {
        foreach (self::$request as $key => $value)
        {
            foreach (self::$request[$key] as $routes)
            {
                if (array_key_exists( $name, $routes->name()))
                {
                    $route = $routes->name();
                    $path = implode(",", $route[$name]);


                    if (!empty( $parameters))
                    {
                        foreach ($parameters as $key => $value)
                        {
                            $path = str_replace("{{$key}}", $value, $path);

                        }
                    }
                    return '/'.$path;
                }
            }
        }
    }


    public static function accessDenied($route)
    {
        if (isset($_SESSION['auth']))
        {
            if ($_SESSION['auth'] == 'admin')
            {
                $route->execute();
                exit();
            }
            return redirect403();
        }
        return redirect403();
    }



}