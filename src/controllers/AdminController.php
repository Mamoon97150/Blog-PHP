<?php


namespace App\Controller;


class AdminController extends FrontController
{
    public function index($username)
    {
        $this->renderView('admin/home');
    }
}