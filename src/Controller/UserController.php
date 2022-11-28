<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\UserRepository;
use App\Model\User;

class UserController extends AbstractController
{
    private UserRepository $repository;
    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function list(): void
    {
        $users = $this->repository->findAll();
        $this->render('user/list', [
            'users' => $users,
        ]);
    }

    public function add(): void
    {
        if (true === empty($_POST)) {
            $this->render('user/add');
            return;
        }

        //encriptação
        $senha = password_hash($_POST['senha'], PASSWORD_ARGON2I);

        $user = new User();
        $user->nome = $_POST['nome'];
        $user->email = $_POST['email'];
        $user->senha = $senha;
        $user->perfil = $_POST['perfil'];

        $this->repository->insert($user);

        $this->redirect('usuarios/listar');
    }
}
