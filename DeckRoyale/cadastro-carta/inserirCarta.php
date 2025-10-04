<?php
require_once __DIR__ . '../../conexao-bd/conexao-bd.php';
require_once __DIR__ . '/bd/CartaRepositorio.php';
require_once __DIR__ . '../../carta/carta.php';

$id = trim($_POST['id'] ?? '');
$custoCarta = $_POST['custo'] ?? '';
$caminhoCarta = $_POST['caminho-carta'] ?? '';
$raridadeCarta = $_POST['raridade-carta'] ?? '';

if ($id === '' || $custoCarta === 0 || $caminhoCarta === '' || $raridadeCarta === '') {
    header('Location: cadastro-carta.php?erro=vazio');
    exit;
}

$repo = new CartaRepositorio($pdo);
if ($repo->buscarPorId($id)) {
    header('Location: cadastro-carta.php?erro=existente');
    exit;
}

$repo = new CartaRepositorio($pdo);
if ($repo->buscarPorId($id)) {
    echo "Carta já existe! {$id}\n";
    exit;
}
$carta = new Carta($id, $custoCarta, $caminhoCarta, $raridadeCarta);
$repo->salvar($carta);

header('Location: cadastro-carta.php?sucesso=ok');
exit;


?>