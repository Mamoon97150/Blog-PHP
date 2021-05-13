<?php


namespace App\Controller;


use App\HTTPRequest;
use App\Model\Users as UserModel;
use App\Entity\Users;
use function Symfony\Component\String\u;

class UserController extends FrontController
{
    /**
     * SECURISE LE MOTS DE PASSE UTILISATEURS
     *
     * @param $password
     * @return string
     */
    public function hashPassword($password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Verifie que le mot de passe sécurisé correspond au mot de passe taper par l'utulisateur
     *
     * @param $password
     * @param Users $user
     * @return bool
     */
    public function verifyPassword($password, Users $user): bool
    {
        return password_verify($password, $user->getPassword());
    }

    /**
     * Récupère les données de l'utilisateur depuis le formulaire,
     * hydrate l'objet Users, verifie que l'utilisateur n'existe pas déjà et l'ajoute à la base de données
     *
     * @param HTTPRequest $request
     * @param array $data
     * @return mixed
     */
    public function createUser(HTTPRequest $request, array $data): mixed
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

    /**
     * Récupère les données de l'utilisateur depuis le formulaire et hydrate l'objet Users
     *
     * @param HTTPRequest $request
     * @return Users
     */
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

    /**
     * Verrifie que le mots de passe de l'utilisateur soit le bon,
     * ajoute les données de l'utilisateur a la session et le redirige
     *
     * @param HTTPRequest $request
     * @param Users $user
     * @return mixed|void
     */
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

    /**
     *  Récupère la liste des utilisateurs depuis la base de donnée,
     * hydrate l'objet User, l'ajoute a un array stocké dans un array et affiche l'array
     *
     * @param $usersData
     * @return array
     */
    public function showUserList($usersData): array
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

    /**
     *  Récupère les information de l'utilisateur et le supprime de la base de données
     *
     * @param $userId
     */
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

    /**
     * Récupère les information de l'utilisateur, hydrate l'objet Users et change son role dans la base de données
     *
     * @param $name
     * @param $userId
     */
    public function changeStatus($name, $userId)
    {
        $userData = (new UserModel())->findUser('id', $userId, 'role', $name );
        $user = (new Users())
            ->setId($userData['id'])
            ->setUsername($userData['username'])
            ->setRole($userData['role'])
        ;

        if ($user->getRole() == 'admin')
        {
            (new UserModel())->changeRole($user->getId(), 'user');
            return redirect('admin.adminUsers');
        }

        (new UserModel())->changeRole($user->getId(), 'admin');
        return redirect('admin.adminUsers');
    }

    /**
     * Récupère les information du post depuis le formulaire,
     * modifie le mot de passe et le met a jour dans la base de données
     *
     * @param HTTPRequest $request
     * @param $password
     */
    public function changePassword(HTTPRequest $request, $password)
    {
        $user = $this->getUser($request);
        $passwordHashed = $this->hashPassword($password);
        (new UserModel())->changePassword($user, $passwordHashed, null);

        redirect('user.login');
    }

}