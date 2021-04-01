<?php

namespace App\Controller;

use Twig\Environment;
use Twig\Extra\Intl\IntlExtension;
use Twig\Extra\String\StringExtension;
use Twig\TwigFunction;
use Twig\Loader\FilesystemLoader;


class FrontController
{
    public function renderView(string $path, $data = [])
    {
        $loader = new FilesystemLoader(__DIR__.'/../views');
        $twig = new Environment($loader, [
            'cache' => false,
        ]);
        $twig->addExtension(new StringExtension());
        $twig->addExtension(new IntlExtension());
        $twig->addFunction(new TwigFunction('route', function ($name, $parameters = []) {
            routeName($name, $parameters);
        }));

        echo $twig->render($path.'.twig' , $data);

    }

}