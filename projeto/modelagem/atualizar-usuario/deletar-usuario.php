<?php

require_once __DIR__ . '../../conexao-bd/conexao-bd.php';
require_once __DIR__ . '../../usuario/usuario.php';
require __DIR__ . "/bd/UsuarioRepositorio.php";

if (!isset($_POST['id']) || empty(trim($_POST['id']))) {
    header("Location: atualizar-usuario.php?erro=sem_id");
    exit;
}

$id = trim($_POST['id']);

$usuarioRepositorio = new UsuarioRepositorio($pdo);
if ($usuarioRepositorio->deletar($id)) {
    echo "Usuario alterado: {$id}\n";
    header('Location: atualizar-usuario.php?apagar=ok');
    exit;
}

header("Location: atualizar-usuario.php?erro=bd");
exit;

?>