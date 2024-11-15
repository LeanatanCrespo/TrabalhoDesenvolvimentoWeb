<?php

class personagemController
{
    private $personagem;

    public function __construct($db)
    {
        $this->personagem = new personagem($db);
    }

    public function create()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->nome) && isset($data->raca) && isset($data->classe)) {
            try {
                $this->personagem->create($data->nome, $data->raca, $data->classe);

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

    public function getById($id)
    {
        if (isset($id)) {
            try {
                $personagem = $this->personagem->getById($id);
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
                $count = $this->personagem->update($data->id, $data->nome, $data->raca, $data->classe);
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