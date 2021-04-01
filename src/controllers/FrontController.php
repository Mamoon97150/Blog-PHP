<?php

namespace App\Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;


class FrontController
{
    public function renderView(string $path, $data = [])
    {
        $loader = new FilesystemLoader(__DIR__.'/../views');
        $twig = new Environment($loader, [
            'cache' => false,
        ]);

        echo $twig->render($path, $data);

    }

}