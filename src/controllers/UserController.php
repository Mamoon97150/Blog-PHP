<?php


namespace App\Controller;


use App\HTTPRequest;

class UserController extends FrontController
{
    public function deleteUser($id)
    {
        $request = new HTTPRequest();
        $users = new \Users();

        if ($request->session('auth') == 'admin')
        {
            $users->eraseUser($id);
        };

        return redirect('admin.adminUsers');
    }

    public function makeAdmin($id)
    {
        $users = new \Users();
        $users->changeRole($id , 'admin');

        return redirect('admin.adminUsers');
    }

    public function makeUser($id)
    {
        $users = new \Users();
        $users->changeRole($id , 'user');

        return redirect('admin.adminUsers');
    }
}