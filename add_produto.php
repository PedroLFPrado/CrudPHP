<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descricao = trim($_POST['descricao']);
    $preco = floatval($_POST['preco']);   // garante número
    $qtde = intval($_POST['qtde']);       // garante inteiro

    // Validação extra
    if ($preco <= 0 || $qtde < 0) {
        die("Erro: preço e quantidade precisam ser válidos.");
    }

    $stmt = $pdo->prepare("INSERT INTO produto(descricao, preco, qtde) VALUES (?, ?, ?)");
    $stmt->bindValue(1, $descricao, PDO::PARAM_STR);
    $stmt->bindValue(2, $preco, PDO::PARAM_STR); // para float no Postgres use string
    $stmt->bindValue(3, $qtde, PDO::PARAM_INT);
    $stmt->execute();

    header("Location: index.php");
    exit;
}

?>

<h2>Novo Produto</h2>
<form method="POST">
    Descrição: <input type="text" name="descricao" required><br>
    Preço: <input type="number" step="0.01" name="preco" required><br>
    Quantidade: <input type="number" name="qtde" required><br>
    <button type="submit">Salvar</button>
</form>
<a href="index.php">Voltar</a>
