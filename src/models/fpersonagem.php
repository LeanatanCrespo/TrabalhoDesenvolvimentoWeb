<?php

class personagem{
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    /*public function create($nome, $raca, $classe, $forca, $dextreza, $vitalidade, $inteligencia, $sabedoria, $carisma){
        $sql = "INSERT INTO usuarios (login,senha,email) VALUES (:login, :senha, :email)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }*/

    public function create($nome, $raca, $classe){
        $sql = "INSERT INTO personagens (nome,raca,classe) VALUES (:nome, :raca, :classe)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':raca', $raca);
        $stmt->bindParam(':classe', $classe);
        return $stmt->execute();
    }

    public function list()
    {
        $sql = "SELECT id, nome FROM personagens";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM personagens WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $nome, $raca, $classe)
    {
        $sql = "UPDATE personagens SET nome = :nome, raca = :raca, classe = :classe WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':raca', $raca);
        $stmt->bindParam(':classe', $classe);
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