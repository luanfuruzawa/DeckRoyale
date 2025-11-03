<?php
require_once __DIR__ . '/../../src/conexao-bd.php';
require_once __DIR__ . '/../../src/Repositorio/UsuarioRepositorio.php';
require_once __DIR__ . '/../../src/Modelo/usuario.php';

$id = trim($_POST['id'] ?? '');
$perfil = $_POST['perfil'] ?? '';
$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';

if ($perfil === '' || $nome === '' || $email === '') {
    header('Location: atualizar-usuario.php?erro=vazio');
    exit;
}

$repo = new UsuarioRepositorio($pdo);

$usuarioExistente = $repo->buscarPorId($id);
if (!$usuarioExistente) {
    header('Location: atualizar-usuario.php?erro=inexistente');
    exit;
}

$senhaAtual = $usuarioExistente->getSenha();

$usuario = new Usuario($id, $email, $senhaAtual, $nome, $perfil);

$repo->alterar($usuario);

header('Location: atualizar-usuario.php?sucesso=ok');
exit;
