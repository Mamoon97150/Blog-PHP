<?php

namespace App\Controller;


use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HomeController extends FrontController
{
    /**
     * Affiche la page d'acceuil du site
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function show()
    {
         $this->renderView('home');
    }

    /**
     * Telécharge le CV
     */
    public function download()
    {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="DjaminaCV.pdf"');
        readfile('Djamina CV.pdf');
        redirect('home.show');
    }
}