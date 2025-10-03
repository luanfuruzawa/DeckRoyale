<?php

require __DIR__ . "/bd/conexao-bd.php";
require __DIR__ . "/bd/carta.php";
require __DIR__ . "/bd/CartaRepositorio.php";

if (!isset($_POST['id']) || empty(trim($_POST['id']))) {
    header("Location: atualizar-carta.php?erro=sem_id");
    exit;
}

$id = trim($_POST['id']);

$cartaRepositorio = new CartaRepositorio($pdo);
if ($cartaRepositorio->deletar($id)) {
    echo "Carta alterada: {$id}\n";
    header('Location: atualizar-carta.php?apagar=ok');
    exit;
}

header("Location: atualizar-carta.php?erro=bd");
exit;

?>