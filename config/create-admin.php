<?php

include dirname(__DIR__) . '../vendor/autoload.php';
include 'database.php';

use App\Repository\UserRepository;
use App\Model\User;

$admin =  new User();
$admin->nome = 'Administrador Padrão';
$admin->email = 'admin@admin.com';
$admin->perfil = 'admin';
$admin->senha = password_hash('123456', PASSWORD_ARGON2I);

(new UserRepository())->insert($admin);

echo "=========================" . PHP_EOL;
echo "== Novo usuário criado ==" . PHP_EOL;
echo "=========================" . PHP_EOL;
echo "= Email: admin@admin.com =" . PHP_EOL;
echo "= Senha: 123456          =" . PHP_EOL;
echo "=========================" . PHP_EOL;
