<?php
include "db.php";

$codigo = $_GET['codigo'] ?? null;

if (!$codigo) {
    die("Produto não informado!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descricao = $_POST['descricao'];
    $preco = floatval($_POST['preco']);
    $qtde = intval($_POST['qtde']);

    $stmt = $pdo->prepare("UPDATE produto SET descricao=?, preco=?, qtde=? WHERE codigo=?");
    $stmt->execute([$descricao, $preco, $qtde, $codigo]);

    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM produto WHERE codigo=?");
$stmt->execute([$codigo]);
$p = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<h2>Editar Produto</h2>
<form method="POST">
    Descrição: <input type="text" name="descricao" value="<?= $p['descricao'] ?>" required><br>
    Preço: <input type="number" step="0.01" name="preco" value="<?= $p['preco'] ?>" required><br>
    Quantidade: <input type="number" name="qtde" value="<?= $p['qtde'] ?>" required><br>
    <button type="submit">Salvar</button>
</form>
<a href="index.php">Voltar</a>
