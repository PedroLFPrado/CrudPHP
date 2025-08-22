<?php
include "db.php";

$codigo = $_GET['codigo'] ?? null;
if ($codigo) {
    $stmt = $pdo->prepare("DELETE FROM produto WHERE codigo=?");
    $stmt->execute([$codigo]);
}

header("Location: index.php");
exit;
