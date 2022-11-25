<?php

use App\Connection\DataBaseConnection;

include_once '../vendor/autoload.php'; // solicitando o composer que gerencie o carregamento automatioc dos arquivos

include '../config/database.php';

// var_dump(
//     DataBaseConnection::abrirConexao()
// );

$rotas = require '../config/routes.php';

$url = $_SERVER['REQUEST_URI']; // pegando a url acessada pelo usuario
$rota = explode('?', $url)[0]; // separando a url, atraves do "?"

if (false === isset($rotas[$rota])) {
    echo "Erro 404";
    exit;
}

$controller = $rotas[$rota]['controller'];
$method = $rotas[$rota]['method'];

(new $controller)->$method();
