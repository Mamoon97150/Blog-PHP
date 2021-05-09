<?php

use App\Controller\FrontController;

function request($instance = null)
{
   if ($instance == null)
   {
       $instance = new \App\HTTPRequest();
   }
   return $instance;
}


function routeName($name ,$parameters = [])
{
    unset($_SESSION['errors']);
    unset($_SESSION['input']);

    $path = \App\Router::url($name, $parameters);

    echo $path;

}

function redirect($name, $parameters = [])
{
    unset($_SESSION['errors']);
    unset($_SESSION['input']);
    $path = \App\Router::url($name, $parameters);
    header(('location:'.$path));
}

function redirect404()
{
    header('HTTP/1.0 404 Not Found');
    return (new FrontController())->renderView("404");
}

function redirect403()
{
    header('HTTP/1.0 403 Access Denied');
    return (new FrontController())->renderView("403");
}

function setPost()
{
    return isset($_SESSION['input']) ? $_SESSION['input'] : '';
}

function session($value)
{
    return isset($_SESSION[$value]) ? $_SESSION[$value] : '';
}

function Errors()
{
    $errors = session('errors');
    $errorsData = [];

    if (!empty($errors))
    {
        foreach ($errors as $key => $value)
        {
            $errorsData = array_merge_recursive($errorsData, array($key => implode($value)));
        }
    }
    return isset($errorsData) ? $errorsData : "";
}

function authenticator()
{
    $request = request();
    return array(
        'status' => $request->session('auth'),
        'username' => $request->session('username'),
        'email' => $request->session('email'),
        'id' => $request->session('id'),
        'img' => $request->session('img')
    );
}
