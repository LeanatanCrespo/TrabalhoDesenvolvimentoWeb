<?php

namespace leanatan\trabalhop2\controllers;

use leanatan\trabalhop2\models\personagem;
use leanatan\trabalhop2\config\db;
use PDO;

require_once __DIR__ . '/../models/fpersonagem.php';

class personagemController
{
    private $personagem;

    private static $INSTANCE;

    public static function getInstance(){
        if(!isset(self::$INSTANCE)){
            self::$INSTANCE = new personagemController();
        }
        return self::$INSTANCE;
    }

    public function __construct()
    {
        $this->personagem = new Personagem(db::getInstance());
    }

    public function create()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->nome) && isset($data->raca) && isset($data->classe) && isset($data->usuarioId)) {
            try {
                $this->personagem->create($data->nome, $data->raca, $data->classe, $data->usuarioId);

                http_response_code(201);
                echo json_encode(["message" => "Personagem criado com sucesso."]);
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao criar o Personagem."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function getByUsuario($usuarioId)
    {
        if (isset($usuarioId)) {
            try {
                $personagem = $this->personagem->getByUsuario($usuarioId);
                if ($personagem) {
                    echo json_encode($personagem);
                } else {
                    http_response_code(404);
                    echo json_encode(["message" => "Personagem não encontrado."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao buscar o Personagem."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function list()
    {
        $personagens = $this->personagem->list();
        echo json_encode($personagens);
    }

    public function update()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->id) && isset($data->nome) && isset($data->raca) && isset($data->classe)) {
            try {
                $count = $this->personagem->update($data->id, $data->nome, $data->raca, $data->classe, $data->usuarioId);
                if ($count > 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Personagem atualizado com sucesso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao atualizar o Personagem."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao atualizar o Personagem."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function delete()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->id)) {
            try {
                $count = $this->personagem->delete($data->id);

                if ($count > 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Personagem deletado com sucesso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao deletar o Personagem."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao deletar o Personagem."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }
}