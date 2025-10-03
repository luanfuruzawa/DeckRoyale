<?php
require_once __DIR__ . '/bd/conexao-bd.php';
require_once __DIR__ . '/bd/CartaRepositorio.php';
require_once __DIR__ . '/bd/carta.php';

$id = trim($_POST['id'] ?? '');
$custoCarta = $_POST['custo'] ?? '';
$caminhoCarta = $_POST['caminho-carta'] ?? '';
$raridadeCarta = $_POST['raridade-carta'] ?? '';

if ($id === '' || $custoCarta === '' ||  $caminhoCarta === '' || $raridadeCarta === '') {
    header('Location: atualizar-carta.php?erro=vazio');
    exit;
}

$repo = new CartaRepositorio($pdo);

$cartaExistente = $repo->buscarPorId($id);
if (!$cartaExistente) {
    header('Location: atualizar-carta.php?erro=inexistente');
    exit;
}

$carta = new Carta($id, $custoCarta, $caminhoCarta, $raridadeCarta);
if ($repo->alterar($carta)) {
    echo "Carta alterada: {$id}\n";
    header('Location: atualizar-carta.php?sucesso=ok');
    exit;
}

    echo "Erro ao alterar a carta {$id}\n";

    header('Location: atualizar-carta.php?erro=bd');
    exit;
?>