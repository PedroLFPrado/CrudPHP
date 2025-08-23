<h2>Editar Produto</h2>
<form method="POST">
    Descrição: <input type="text" name="descricao" value="<?= htmlspecialchars($produto->descricao) ?>" required><br>
    Preço: <input type="number" step="0.01" name="preco" value="<?= $produto->preco ?>" required><br>
    Quantidade: <input type="number" name="qtde" value="<?= $produto->qtde ?>" min="0" required><br>
    <button type="submit">Salvar</button>
</form>
<a href="index.php?c=produto&a=index">Voltar</a>
