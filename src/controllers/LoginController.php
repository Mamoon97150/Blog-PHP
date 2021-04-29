<?php


namespace App\Controller;


use App\HTTPRequest;
use App\Model\Users as UserModel;

class LoginController extends FrontController
{
    //TO-DO : Add security to admin dashboard
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
        $request->validator([
            'username' => ['required', "min:3"],
            'password' => ['required']
        ]);

        $user = (new UserModel())->findUser('username', $request->name('username'), 'email', $request->name('username'));

        if ($user === null)
        {
            (new UserController())->verifyUser($request, $user);
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