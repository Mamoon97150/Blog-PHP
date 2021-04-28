<?php


namespace App\Controller;


use App\HTTPRequest;
use App\Model\Users as UserModel;
use App\Entity\Users;

class UserController extends FrontController
{
    public function deleteUser($id)
    {
        $request = new HTTPRequest();
        $users = new UserModel();

        if ($request->session('auth') == 'admin')
        {
            $users->eraseUser($id);
        };

        return redirect('admin.adminUsers');
    }

    public function makeAdmin($id)
    {
        $users = new UserModel();
        $users->changeRole($id , 'admin');

        return redirect('admin.adminUsers');
    }

    public function makeUser($id)
    {
        $users = new UserModel();
        $users->changeRole($id , 'user');

        return redirect('admin.adminUsers');
    }
}