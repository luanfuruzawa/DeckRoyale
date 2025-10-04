<?php
session_start();

require_once __DIR__ . '../../conexao-bd/conexao-bd.php';
require_once __DIR__ . '/bd/usuarioRepositorio.php';
require_once __DIR__ . '/bd/usuario.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: cadastro.php');
    exit;
}

$nome = $_POST['nome'] ?? '';
$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';

if ($email === '' || $senha === '' || $nome === '') {
    header('Location: cadastro.php?erro=campos');
    exit;
}

$repo = new usuarioRepositorio($pdo);

if ($repo->buscarPorEmail($email)) {
    header('Location: cadastro.php?erro=credenciais');
    exit;
}

$usuario = new Usuario(0, $email, $senha, $nome, 'User');
$repo->salvar($usuario);

$_SESSION['usuario'] = $email;
header('Location: ../menu-principal/menu-principal.php');
exit;
?>