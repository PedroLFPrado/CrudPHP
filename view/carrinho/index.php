<h2>Carrinho</h2>
<a href="index.php?c=produto&a=index">Voltar</a>
<?php if (empty($carrinho)): ?>
    <p>Carrinho vazio.</p>
<?php else: ?>
<table border="1" cellpadding="5">
<tr><th>Produto</th><th>Quantidade</th><th>Preço Unitário</th><th>Subtotal</th></tr>
<?php $total=0; foreach ($carrinho as $item): 
    $sub = $item['qtde'] * $item['preco'];
    $total += $sub;
?>
<tr>
    <td><?= htmlspecialchars($item['descricao']) ?></td>
    <td><?= $item['qtde'] ?></td>
    <td>R$ <?= number_format($item['preco'],2,',','.') ?></td>
    <td>R$ <?= number_format($sub,2,',','.') ?></td>
</tr>
<?php endforeach; ?>
<tr>
    <td colspan="3"><b>Total</b></td>
    <td><b>R$ <?= number_format($total,2,',','.') ?></b></td>
</tr>
</table>
<?php endif; ?>
