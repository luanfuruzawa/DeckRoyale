<?php
require_once __DIR__ . '../../conexao-bd/conexao-bd.php';
require_once __DIR__ . '/bd/CartaRepositorio.php';
require_once __DIR__ . '../../carta/carta.php';

$id = trim($_POST['id'] ?? '');
$custoCarta = $_POST['custo'] ?? '';
$raridadeCarta = $_POST['raridade-carta'] ?? '';
$imagemCarta = $_FILES['imagem-carta'] ?? null;

if ($id === '' || $custoCarta === '' || $raridadeCarta === '' || !$imagemCarta || $imagemCarta['tmp_name'] === '') {
    header('Location: cadastro-carta.php?erro=vazio');
    exit;
}

$repo = new CartaRepositorio($pdo);
if ($repo->buscarPorId($id)) {
    header('Location: cadastro-carta.php?erro=existente');
    exit;
}

$pasta = __DIR__ . '/../montagem-deck/img/' . strtolower($raridadeCarta) . '/';
if (!is_dir($pasta)) {
    mkdir($pasta, 0777, true);
}

$extensao = pathinfo($imagemCarta['name'], PATHINFO_EXTENSION);
$nomeArquivo = $id . '.' . $extensao;
$caminhoCompleto = $pasta . $nomeArquivo;

if (!move_uploaded_file($imagemCarta['tmp_name'], $caminhoCompleto)) {
    header('Location: cadastro-carta.php?erro=upload');
    exit;
}

$carta = new Carta($id, $custoCarta, $nomeArquivo, $raridadeCarta);
$repo->salvar($carta);

header('Location: cadastro-carta.php?sucesso=ok');
exit;
