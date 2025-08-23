<?php
require_once "model/Carrinho.php";

class CarrinhoController {
    public function index() {
        $carrinho = Carrinho::get();
        include "view/carrinho/index.php";
    }
}
