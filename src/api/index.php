<?php

use leanatan\trabalhop2\api\Router;
use leanatan\trabalhop2\controllers\personagemController;
use leanatan\trabalhop2\Controllers\usuarioController;


require_once '../config/db.php'; 
require_once '../Router.php';
require_once '../Controllers/personagemController.php';
require_once '../Controllers/usuarioController.php';

// Configuração CORS
header("Access-Control-Allow-Origin: *"); // Permite todas as origens
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Permite os métodos HTTP necessários
header("Access-Control-Allow-Headers: Content-Type"); // Permite o cabeçalho Content-Type

// Para lidar com a requisição de "preflight" (opções)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}


$router = Router::getInstance();

// Rotas de Usuários
$router->add('GET', '/usuario', function () { 
    if(isset($_GET["id"])){
        usuarioController::getInstance()->getById($_GET["id"]);
    } else {}
});
$router->add('POST', '/usuario', function () { usuarioController::getInstance()->create();});
$router->add('DELETE', '/usuario', function () { usuarioController::getInstance()->delete();});
$router->add('PUT', '/usuario', function () { usuarioController::getInstance()->update();});


// Rotas de Personagens
$router->add('GET', '/personagem', function () { 
    if(isset($_GET["id"])){
        personagemController::getInstance()->getByUsuario($_GET["id"]);
    } else {
        personagemController::getInstance()->list();
    }
});

$router->add('GET', '/personagem/usuario', function () { 
    if(isset($_GET["id"])){
        personagemController::getInstance()->getByUsuario($_GET["id"]);
    }else {
        echo json_encode([
            "msg" => "Parametro Id do usuario não presente"
        ]);
    }
});


$router->add('POST', '/personagem', function () { personagemController::getInstance()->create();});
$router->add('DELETE', '/personagem', function () { personagemController::getInstance()->delete();});
$router->add('PUT', '/personagem', function () { personagemController::getInstance()->update();});

Router::getInstance()->process();