<?php

namespace leanatan\trabalhop2\config;

use PDO;
use PDOException;

class db {

    static $host = 'localhost';
    static $dbname = 'fichaRPG';
    static $user = 'postgres';
    static $password = 'lrrc-1907';

    private static $instance;

    public static function getInstance() {
        if (!isset(self::$instance)) {
          $host = 'localhost';
          $dbname = 'fichaRPG';
          $user = 'postgres';
          $password = 'lrrc-1907';

            try {
                self::$instance = new PDO("pgsql:host=$host;port=5432;dbname=$dbname;charset=utf8", $user, $password,[PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);
                echo "conexão feita";
            } catch (PDOException $e) {
                echo "Erro na conexão: " . $e->getMessage();
            }
        }

        return self::$instance;
    }


}
?>