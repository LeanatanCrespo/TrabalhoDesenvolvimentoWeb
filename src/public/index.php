<?php

header("Content-type: application/json; charset=UTF-8");

$router = new Router();
$controller = new usuarioController($pdo);
$controller = new personagemController($pdo);

$router->add('POST', '/usuarios', [$controller, 'create']);
$router->add('GET', '/usuarios/{id}', [$controller, 'getById']);
$router->add('PUT', '/usuarios/{id}', [$controller, 'update']);
$router->add('DELETE', '/usuarios/{id}', [$controller, 'delete']);

$router->add('POST', '/personagens', [$controller, 'create']);
$router->add('GET', '/personagens/{id}', [$controller, 'getById']);
$router->add('PUT', '/personagens/{id}', [$controller, 'update']);
$router->add('DELETE', '/personagens/{id}', [$controller, 'delete']);

$requestedPath = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$pathItems = explode("/", $requestedPath);
$requestedPath = "/" . $pathItems[3] . ($pathItems[4] ? "/" . $pathItems[4] : "");

$router->dispatch($requestedPath);

/*V1{
$controller = new usuarioController($pdo);
$method = $_SERVER['REQUEST_METHOD'];


switch ($method) {
    case 'POST':
        $controller->create();
        break;
    case 'PUT':
        $controller->update();
        break;
    case 'DELETE':
        $controller->delete();
        break;
    default:
        http_response_code(405);
        echo json_encode(["message" => "Método não permitido"]);
        break;
}
}
*/