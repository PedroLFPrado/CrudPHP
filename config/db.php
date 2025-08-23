<?php
class db {
    public static function getConnection() {
        $host = "localhost";
        $dbname = "TOCC8php";
        $user = "postgres";
        $password = "1234"; // altere conforme seu ambiente

        try {
            $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Erro de conexão: " . $e->getMessage());
        }
    }
}
