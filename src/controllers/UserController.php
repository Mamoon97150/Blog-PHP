<?php


namespace App\Controller;


use App\HTTPRequest;
use App\Model\Users as UserModel;
use App\Entity\Users;
use function Symfony\Component\String\u;

class UserController extends FrontController
{
    public function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function verifyPassword($password, Users $user)
    {
        return password_verify($password, $user->getPassword());
    }

    public function createUser(HTTPRequest $request, array $data)
    {
        $query = new UserModel();
        $password = $this->hashPassword($data['password']);
        $user = (new Users())
            ->setUsername($data['username'])
            ->setEmail($data['email'])
            ->setPassword($password)
            ->setImg($data['img'])
        ;

        // check if username exists
        if ($query->userExists('username', $user->getUsername()) == false)
        {
            //check if email exists
            if ($query->userExists('email', $user->getEmail()) == false)
            {
                $query->addUser($user);
            }
            return $request->validator([ 'email' => ['exists'] ]);

        }
        return $request->validator([ 'username' => ['exists'] ]);


    }

    public function getUser(HTTPRequest $request): Users
    {
        $userData = (new UserModel())->findUser('username', $request->name('username'), 'email', $request->name('username'));

        return (new Users())
            ->setId($userData['id'])
            ->setUsername($userData['username'])
            ->setPassword($userData['password'])
            ->setEmail($userData['email'])
            ->setCreatedAt($userData['created_at'])
            ->setImg($userData['img'])
            ->setRole($userData['role'])
            ->setExpDate($userData['expDate'])
        ;
    }

    public function verifyUser(HTTPRequest $request, Users $user)
    {
        $password = $request->name('password');

        if ($this->verifyPassword($password , $user))
        {
            $request->session('auth', $user->getRole());
            $request->session('username', $user->getUsername());
            $request->session('email', $user->getEmail());
            $request->session('id', $user->getId());
            $request->session('img', $user->getImg());

            if ($user->getRole() == 'admin')
            {
                return redirect('admin.index', ['user' => strtolower($request->session('username'))]);
            }
            return redirect('home.show');

        }
        return $request->validator([ 'password' => ['incorrect'] ]);

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

    public function changePassword(HTTPRequest $request, $password)
    {
        $user = $this->getUser($request);
        $passwordHashed = $this->hashPassword($password);
        (new UserModel())->changePassword($user, $passwordHashed, null);

        redirect('user.login');
    }

}