<?php
require_once "model/Produto.php";
require_once "model/Carrinho.php";

class ProdutoController {
    public function index() {
        $produtos = Produto::all();
        include "view/produtos/index.php";
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $p = new Produto();
            $p->descricao = $_POST['descricao'];
            $p->preco = floatval($_POST['preco']);
            $p->qtde = intval($_POST['qtde']);
            $p->save();
            header("Location: index.php?c=produto&a=index");
            exit;
        }
        include "view/produtos/create.php";
    }

    public function edit() {
        $codigo = $_GET['id'] ?? null;
        $produto = Produto::find($codigo);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $produto->descricao = $_POST['descricao'];
            $produto->preco = floatval($_POST['preco']);
            $produto->qtde = intval($_POST['qtde']);
            $produto->save();
            header("Location: index.php?c=produto&a=index");
            exit;
        }
        include "view/produtos/edit.php";
    }

    public function destroy() {
    $codigo = $_GET['id'] ?? null;
    if ($codigo) {
        Produto::destroy($codigo);
        Carrinho::remove($codigo); // garante que saia do carrinho
    }
    header("Location: index.php?c=produto&a=index");
    }

    public function addCarrinho() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $codigo = intval($_POST['codigo']);
            $qtde = intval($_POST['qtde']);
            Carrinho::add($codigo, $qtde);
        }
        header("Location: index.php?c=produto&a=index");
    }
}
