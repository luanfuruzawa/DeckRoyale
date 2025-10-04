<?php
session_start();

require_once __DIR__ . '../../conexao-bd/conexao-bd.php';
require_once __DIR__ . '/bd/usuarioRepositorio.php';
require_once __DIR__ . '/bd/usuario.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';

if ($email === '' || $senha === '') {
    header('Location: login.php?erro=campos');
    exit;
}

$repo = new UsuarioRepositorio($pdo);
$usuario = $repo->buscarPorEmail($email);

if ($usuario && password_verify($senha, $usuario->getSenha())) {
    session_regenerate_id(true);
    $_SESSION['usuario'] = $email;
    $_SESSION['perfil'] = $usuario->getPerfil(); 
    header('Location: ../menu-principal/menu-principal.php');
    exit;
}

header('Location: login.php?erro=credenciais');
exit;