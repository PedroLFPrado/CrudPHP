<?php
require_once "model/Produto.php";

class Carrinho {
    public static function get() {
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }
        return $_SESSION['carrinho'];
    }

    public static function add($codigo, $qtde) {
        $produto = Produto::find($codigo);
        if (!$produto) return false;

        if ($qtde <= 0 || $qtde > $produto->qtde) return false;

        if (!isset($_SESSION['carrinho'][$codigo])) {
            $_SESSION['carrinho'][$codigo] = [
                'codigo' => $codigo,
                'descricao' => $produto->descricao,
                'preco' => $produto->preco,
                'qtde' => $qtde
            ];
        } else {
            $nova_qtde = $_SESSION['carrinho'][$codigo]['qtde'] + $qtde;
            if ($nova_qtde <= $produto->qtde) {
                $_SESSION['carrinho'][$codigo]['qtde'] = $nova_qtde;
            } else {
                return false;
            }
        }
        return true;
    }

    public static function remove($codigo) {
    if (isset($_SESSION['carrinho'][$codigo])) {
        unset($_SESSION['carrinho'][$codigo]);
    }
    }

}
