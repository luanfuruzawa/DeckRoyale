<?php
require_once __DIR__ . '/../../src/conexao-bd.php';
require_once __DIR__ . '/../../src/Repositorio/CartaRepositorio.php';
require_once __DIR__ . '/../../src/Modelo/carta.php';

$id = trim($_POST['id'] ?? '');
$custoCarta = $_POST['custo'] ?? '';
$raridadeCarta = $_POST['raridade-carta'] ?? '';
$imagemCarta = $_FILES['imagem-carta'] ?? null;

if ($id === '' || $custoCarta === '' || $raridadeCarta === '' || !$imagemCarta || $imagemCarta['tmp_name'] === '') {
    header('Location: cadastrar-carta.php?erro=vazio');
    exit;
}

$repo = new CartaRepositorio($pdo);
if ($repo->buscarPorId($id)) {
    header('Location: cadastrar-carta.php?erro=existente');
    exit;
}

//https://www.php.net/manual/en/features.file-upload.php mais referencias sobre manipulação de arquivos
//https://www.php.net/manual/en/function.pathinfo.php para manipulação de caminho  de arquivos
//https://www.php.net/manual/en/function.mkdir.php para criação de pastas e permissões de edição
$pasta = __DIR__ . '../../../src/uploads/' . strtolower($raridadeCarta) . '/';
if (!is_dir($pasta)) {
    mkdir($pasta, 0777, true);
}

$extensao = pathinfo($imagemCarta['name'], PATHINFO_EXTENSION);
$nomeArquivo = $id . '.' . $extensao;
$caminhoCompleto = $pasta . $nomeArquivo;

if (!move_uploaded_file($imagemCarta['tmp_name'], $caminhoCompleto)) {
    header('Location: cadastrar-carta.php?erro=upload');
    exit;
}

$carta = new Carta($id, $custoCarta, $nomeArquivo, $raridadeCarta);
$repo->salvar($carta);

header('Location: cadastrar-carta.php?sucesso=ok');
exit;
