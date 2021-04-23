<?php

namespace App\Controller;

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Extra\Intl\IntlExtension;
use Twig\Extra\Markdown\MarkdownExtension;
use Twig\Extra\String\StringExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Twig\Loader\FilesystemLoader;


class FrontController
{
    public function renderView(string $path, $data = [])
    {
        $path = str_replace(".", "/", $path);
        $loader = new FilesystemLoader(__DIR__.'/../views');
        $twig = new Environment($loader, [
            'cache' => false,
            'debug' => true,
        ]);

        $twig->addExtension(new DebugExtension());
        $twig->addExtension(new StringExtension());
        $twig->addExtension(new IntlExtension());
        $twig->addExtension(new MarkdownExtension());

        $twig->addFunction(new TwigFunction('route', function ($name, $parameters = []) {
            routeName($name, $parameters);
        }));

        $twig->addGlobal('error', Errors());
        $twig->addGlobal('post', setPost());
        $twig->addGlobal('auth', authenticator());

        echo $twig->render($path.'.twig' , $data);

    }

}