<?php


namespace App\Controller;


use App\HTTPRequest;

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
        $this->renderView('user/login/forgot');
    }

    public function signIn(HTTPRequest $request)
    {
        $value = $request->validator([
            'username' => ['required', "min:3"],
            'password' => ['required']
        ]);

        $Users = new \Users();
        $user = $Users->findUser('username', $request->name('username'), 'email', $request->name('username'));


        if (!is_null($user))
        {
            $user->toArray();
            // check if password is right (hash)
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
        else
        {
            return $request->validator([ 'username' => ['incorrect'] ]);
        }
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

        $user = new \Users();

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


        return redirect('user.login');

    }

}