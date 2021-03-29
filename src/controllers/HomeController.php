<?php

namespace App\Controller;


class HomeController extends FrontController
{


    public function index()
    {
        return $this->renderView('home.twig');
    }


}