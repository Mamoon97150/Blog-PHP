<?php

namespace App;


use App\Controller\FrontController;

class Router
{
    private static $request;

    /**
     * @param string $path
     * @param $action
     * @return Request
     *
     * stockage d'une route GET dans $request
     */
    public static function get(string  $path, $action): Request
    {
        $routes = new Request($path, $action);
        self::$request['GET'][] = $routes;
        return $routes;
    }

    /**
     * stockage d'une route POST dans $request
     *
     * @param string $path
     * @param $action
     * @return Request
     */
    public static function post(string  $path, $action): Request
    {
        $routes = new Request($path, $action);
        self::$request['POST'][] = $routes;
        return $routes;
    }

    /**
     * Démarre l'application, recupère la route, vérifie si elle est administrateur puis exécute ou redirige en fonction des
     * droits de l'utilisateur
     *
     * @return mixed|void
     */
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

    /**
     * parcoure les routes stockées et trouve la route associé et retourne le chemin
     *
     * @param $name
     * @param array $parameters
     * @return string
     */
    public static function url($name, $parameters = []): string
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


    /**
     * verifie que l'utilisateur à les droits d'accès admin
     *
     * @param $route
     * @return mixed|void
     */
    public static function accessDenied($route)
    {
        if (isset($_SESSION['auth']))
        {
            if ($_SESSION['auth'] == 'admin')
            {
                return $route->execute();
            }
            return redirect403();
        }
        return redirect403();
    }



}