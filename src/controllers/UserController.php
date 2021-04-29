<?php


namespace App\Controller;


use App\HTTPRequest;

class UserController extends FrontController
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
        $this->renderView('user/login/forgot');
    }

    public function signIn(HTTPRequest $request)
    {
        $value = $request->validator([
            'username' => ['required', "min:3"],
            'password' => ['required']
        ]);

        $user = \Users::where('username', $request->name('username'))->first()->toArray();

        if (!is_null($user))
        {
            if ($request->name('password') === $user['password'])
            {
                $request->session('auth', $user['role']);
                $request->session('username', $user['username']);
                $request->session('id', $user['id']);
                header('location: /?success=true');
            }
            else
            {
                echo 'Incorrect password';
            }
        }
        else
        {
            $request->lastRedirect();
        }


    }

    public function signOut()
    {
        session_destroy();
        redirect('home.show');
    }

}