<?php


namespace App\Controller;


use App\Entity\Users;
use App\HTTPRequest;
use App\Model\Users as UserModel;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class LoginController extends FrontController
{
    /**
     * affiche la page de connexion
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function login()
    {
        $this->renderView('user/login/login');
    }

    /**
     * affiche la page de creation de compte
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function register()
    {
        $this->renderView('user/register/register');
    }

    /**
     * affiche la page de demande de reinitialisation du mot de passe
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function forgot()
    {
        $this->renderView('user/forgot/forgot');
    }

    /**
     * affiche la page de reinitialisation de mot de passe
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function change()
    {
        $url = explode("/",$_GET['url']);
        $key = $url[2];
        $token = $url[3];
        $now = date('r');

        $userData = (new UserModel())->findUser('username', $key, 'email', $key);
        $user = (new Users())
            ->setId($userData['id'])
            ->setUsername($userData['username'])
            ->setEmail($userData['email'])
            ->setToken($userData['token'])
            ->setExpDate($userData['expDate'])
            ;
        $this->renderView('user/forgot/new', compact(['key','token','user','now']));
    }

    /**
     * Récupère les information de l'utilisateur depuis le formulaire ,
     * le trouve dans la base de données et le connecte
     *
     * @param HTTPRequest $request
     * @return mixed|void
     */
    public function signIn(HTTPRequest $request)
    {
        $request->validator([
            'username' => ['required', "min:3"],
            'password' => ['required']
        ]);

        $user = (new UserController())->getUser($request);
        if (!($user === null))
        {
            return (new UserController())->verifyUser($request, $user);
        }
        return $request->validator([ 'username' => ['incorrect'] ]);
    }

    /**
     * Mets fin a la sesion de l''utillisateur et le deconnecte
     */
    public function signOut()
    {
        session_destroy();
        redirect('home.show');
    }

    /**
     * Récupère les données de l'utulisateurs depuis le formulaire,
     * hydrate l'objet User et l'ajoute à la base de données
     *
     * @param HTTPRequest $request
     */
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

    /**
     * Récupère les information de l'utulisateur,change son mot de passe et le met a jour dans la base de données
     *
     * @param HTTPRequest $request
     */
    public function resetPassword(HTTPRequest $request)
    {
        $form = $request->validator([
            'username' => ['required'],
            'password' => ['required']
        ]);

        (new UserController())->changePassword($request, $form['password']);
    }

}