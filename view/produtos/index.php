<h2>Lista de Produtos</h2>
<a href="index.php?c=produto&a=create">[Novo Produto]</a> | 
<a href="index.php?c=carrinho&a=index">[Ver Carrinho]</a>

<table border="1" cellpadding="5">
<tr><th>Código</th><th>Descrição</th><th>Preço</th><th>Estoque</th><th>Ações</th></tr>
<?php foreach ($produtos as $p): ?>
<tr>
    <td><?= $p->codigo ?></td>
    <td><?= htmlspecialchars($p->descricao) ?></td>
    <td>R$ <?= number_format($p->preco,2,',','.') ?></td>
    <td><?= $p->qtde ?></td>
    <td>
        <form method="POST" action="index.php?c=produto&a=addCarrinho" style="display:inline">
            <input type="hidden" name="codigo" value="<?= $p->codigo ?>">
            <input type="number" name="qtde" min="1" max="<?= $p->qtde ?>" required>
            <button type="submit">Adicionar</button>
        </form>
        <a href="index.php?c=produto&a=edit&id=<?= $p->codigo ?>">Editar</a> |
        <a href="index.php?c=produto&a=destroy&id=<?= $p->codigo ?>" onclick="return confirm('Excluir?')">Excluir</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
