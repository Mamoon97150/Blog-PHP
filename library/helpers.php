<?php

function routeName($name ,$parameters = [])
{
    $path = \App\Router::url($name, $parameters);
    echo $path;
}

function redirect($name, $parameters = [])
{
    $path = \App\Router::url($name, $parameters);
    header(('location:'.$path));
}
