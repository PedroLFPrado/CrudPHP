<link rel="stylesheet" href="public/style.css">

<h2>Novo Produto</h2>
<form method="POST">
    Descrição: <input type="text" name="descricao" required><br>
    Preço: <input type="number" step="0.01" name="preco" required><br>
    Quantidade: <input type="number" name="qtde" min="0" required><br>
    <button type="submit">Salvar</button>
</form>
<a href="index.php?c=produto&a=index">Voltar</a>
