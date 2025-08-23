<?php
require_once "config/db.php";

class Produto {
    public $codigo;
    public $descricao;
    public $preco;
    public $qtde;

    public static function all() {
        $pdo = DB::getConnection();
        $stmt = $pdo->query("SELECT * FROM produto ORDER BY codigo");
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Produto');
    }

    public static function find($codigo) {
        $pdo = DB::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM produto WHERE codigo=?");
        $stmt->execute([$codigo]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Produto');
        return $stmt->fetch();
    }

    public function save() {
        $pdo = DB::getConnection();
        if ($this->codigo) {
            $stmt = $pdo->prepare("UPDATE produto SET descricao=?, preco=?, qtde=? WHERE codigo=?");
            $stmt->execute([$this->descricao, $this->preco, $this->qtde, $this->codigo]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO produto(descricao, preco, qtde) VALUES (?,?,?)");
            $stmt->execute([$this->descricao, $this->preco, $this->qtde]);
        }
    }

    public static function destroy($codigo) {
        $pdo = DB::getConnection();
        $stmt = $pdo->prepare("DELETE FROM produto WHERE codigo=?");
        $stmt->execute([$codigo]);
    }
}
