<?php


namespace App\Controller;


use App\HTTPRequest;
use App\Model\Users as UserModel;
use App\Entity\Users;

class UserController extends FrontController
{
    public function createUser(HTTPRequest $request, array $data)
    {
        $user = new UserModel();

        // check if username exists
        if ($user->userExists('username', $data['username']) == false)
        {
            //check if email exists
            if ($user->userExists('email', $data['email']) == false)
            {
                $user->addUser($data);
            }
            return $request->validator([ 'email' => ['exists'] ]);

        }
        return $request->validator([ 'username' => ['exists'] ]);


    }

    public function verifyUser(HTTPRequest $request, $user)
    {
        $user->toArray();
        if (password_verify($request->name('password'), $user['password']))
        {
            $request->session('auth', $user['role']);
            $request->session('username', $user['username']);
            $request->session('email', $user['email']);
            $request->session('id', $user['id']);
            $request->session('img', $user['img']);

            if ($user['role'] == 'admin')
            {
                return redirect('admin.index', ['user' => strtolower($request->session('username'))]);
            }
            else
            {
                return redirect('home.show');
            }
        }
        else
        {
            return $request->validator([ 'password' => ['incorrect'] ]);
        }
    }

    public function showUserList($usersData)
    {
        $users = [];
        foreach ($usersData as $data)
        {
            $dataUser = (new Users())
                ->setId($data['id'])
                ->setUsername($data['username'])
                ->setEmail($data['email'])
                ->setCreatedAt($data['created_at'])
                ->setRole($data['role'])
            ;

            $users[] = $dataUser;
        }
        return $users;
    }

    public function deleteUser($userId)
    {
        $request = new HTTPRequest();
        $users = new UserModel();

        if ($request->session('auth') == 'admin')
        {
            $users->eraseUser($userId);
        };

        return redirect('admin.adminUsers');
    }

    public function makeAdmin($userId)
    {
        $users = new UserModel();
        $users->changeRole($userId , 'admin');

        return redirect('admin.adminUsers');
    }

    public function makeUser($userId)
    {
        $users = new UserModel();
        $users->changeRole($userId , 'user');

        return redirect('admin.adminUsers');
    }



}