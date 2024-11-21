<?php

namespace leanatan\trabalhop2\models;
require_once __DIR__ . '/../config/db.php';
use PDO;

class personagem{
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function create($nome, $raca, $classe, $usuarioId){
        $sql = "INSERT INTO personagens (nome,raca,classe,ususarioId) VALUES (:nome, :raca, :classe, :usuarioId)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':raca', $raca);
        $stmt->bindParam(':classe', $classe);
        $stmt->bindParam(':usuarioId', $usuarioId);
        return $stmt->execute();
    }

    public function list()
    {
        $sql = "SELECT nome FROM personagens";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByUsuario($usuarioId)
    {
        $sql = "SELECT nome FROM personagens WHERE usuarioId = :usuarioId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':usuarioId', $usuarioId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $nome, $raca, $classe, $usuarioId)
    {
        $sql = "UPDATE personagens SET nome = :nome, raca = :raca, classe = :classe WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':raca', $raca);
        $stmt->bindParam(':classe', $classe);
        $stmt->bindParam(':usuarioId', $usuarioId);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM personagens WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->rowCount();
    }
}