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
            else
            {
                return $request->validator([ 'email' => ['exists'] ]);
            }
        }
        else
        {
            return $request->validator([ 'username' => ['exists'] ]);
        }

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