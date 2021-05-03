<?php

namespace App\Controller;


class HomeController extends FrontController
{
    public function show()
    {
         $this->renderView('home');
    }

    public function download()
    {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="DjaminaCV.pdf"');
        readfile('Djamina CV.pdf');
        redirect('home.show');
    }
}