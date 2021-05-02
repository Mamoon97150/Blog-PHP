<?php


namespace App\Controller;


use App\Entity\Users;
use App\HTTPRequest;
use App\Model\Users as UserModel;

class LoginController extends FrontController
{
    public function login()
    {
        $this->renderView('user/login/login');
    }

    public function register()
    {
        $this->renderView('user/register/register');
    }

    public function forgot()
    {
        $this->renderView('user/forgot/forgot');
    }

    public function signIn(HTTPRequest $request)
    {
        $request->validator([
            'username' => ['required', "min:3"],
            'password' => ['required']
        ]);

        $userData = (new UserModel())->findUser('username', $request->name('username'), 'email', $request->name('username'));
        $user = (new Users())
            ->setId($userData['id'])
            ->setUsername($userData['username'])
            ->setPassword($userData['password'])
            ->setEmail($userData['email'])
            ->setCreatedAt($userData['created_at'])
            ->setImg($userData['img'])
            ->setRole($userData['role'])
        ;

        if (!($user === null))
        {
            return (new UserController())->verifyUser($request, $user);
        }
        return $request->validator([ 'username' => ['incorrect'] ]);
    }

    public function signOut()
    {
        session_destroy();
        redirect('home.show');
    }

    public function signUp(HTTPRequest $request)
    {
        $value = $request->validator([
            'username' => ['required', "min:3"],
            'email' => ['required'],
            'password' => ['required', "min:5"]
        ]);

        $img = $request->loadFiles('image', 'img/profile/', ['.jpg', '.JPG', '.png', '.PNG', '.jpeg', '.JPEG']);

        $data = array_merge_recursive($value, ['img' => '/public/'.$img]);
        (new UserController())->createUser($request, $data);

        return redirect('user.login');

    }

}