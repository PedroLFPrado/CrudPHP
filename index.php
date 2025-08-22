<?php
session_start();
include "db.php";

// Inicializa carrinho se não existir
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Adiciona produto ao carrinho
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['codigo'])) {
    $codigo = intval($_POST['codigo']);
    $qtde = intval($_POST['qtde']);

    // Busca produto no banco
    $stmt = $pdo->prepare("SELECT * FROM produto WHERE codigo = ?");
    $stmt->execute([$codigo]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($produto && $qtde > 0) {
        // Verifica estoque
        if ($qtde <= $produto['qtde']) {
            if (!isset($_SESSION['carrinho'][$codigo])) {
                $_SESSION['carrinho'][$codigo] = [
                    'descricao' => $produto['descricao'],
                    'preco' => $produto['preco'],
                    'qtde' => $qtde
                ];
            } else {
                $nova_qtde = $_SESSION['carrinho'][$codigo]['qtde'] + $qtde;
                if ($nova_qtde <= $produto['qtde']) {
                    $_SESSION['carrinho'][$codigo]['qtde'] = $nova_qtde;
                } else {
                    echo "<p style='color:red'>Quantidade maior que o estoque!</p>";
                }
            }
        } else {
            echo "<p style='color:red'>Quantidade maior que o estoque!</p>";
        }
    }
}

// Lista produtos
$stmt = $pdo->query("SELECT * FROM produto ORDER BY codigo");
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Lista de Produtos</h2>
<a href="add_produto.php">[Novo Produto]</a> | <a href="carrinho.php">[Ver Carrinho]</a>
<table border="1" cellpadding="5">
<tr><th>Código</th><th>Descrição</th><th>Preço</th><th>Estoque</th><th>Ação</th></tr>
<?php foreach ($produtos as $p): ?>
<tr>
    <td><?= $p['codigo'] ?></td>
    <td><?= $p['descricao'] ?></td>
    <td>R$ <?= number_format($p['preco'],2,',','.') ?></td>
    <td><?= $p['qtde'] ?></td>
    <td>
        <form method="POST">
            <input type="hidden" name="codigo" value="<?= $p['codigo'] ?>">
            <input type="number" name="qtde" min="1" max="<?= $p['qtde'] ?>" required>
            <button type="submit">Adicionar ao Carrinho</button>
        </form>
        <a href="edit_produto.php?codigo=<?= $p['codigo'] ?>">Editar</a> | 
        <a href="delete_produto.php?codigo=<?= $p['codigo'] ?>" onclick="return confirm('Excluir produto?')">Excluir</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
