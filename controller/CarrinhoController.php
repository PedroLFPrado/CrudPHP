<?php
require_once "model/Carrinho.php";

class CarrinhoController {
    public function index() {
        $carrinho = Carrinho::get();
        include "view/carrinho/index.php";
    }

    public function remove() {
    $codigo = $_GET['id'] ?? null;
    if ($codigo) {
        Carrinho::remove($codigo);
    }
    header("Location: index.php?c=carrinho&a=index");
}
}
