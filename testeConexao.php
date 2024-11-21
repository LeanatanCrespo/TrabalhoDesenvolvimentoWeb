<?php
require_once 'src/config/db.php'; 

use leanatan\trabalhop2\config\db;

try {
    $conexao = db::getInstance();
    echo "Conexão bem-sucedida!";
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?>