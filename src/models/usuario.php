<?php

class usuario{
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function create($login, $senha, $email){
        $sql = "INSERT INTO usuarios (login,senha,email) VALUES (:login, :senha, :email)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $login, $senha, $email)
    {
        $sql = "UPDATE usuarios SET login = :login, senha = :senha, email = :email WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->rowCount();
    }
}