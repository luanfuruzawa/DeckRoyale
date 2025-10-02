<?php
session_start();


require_once __DIR__ . '/bd/conexao-bd.php';
require_once __DIR__ . '/bd/usuarioRepositorio.php';
require_once __DIR__ . '/bd/usuario.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: cadastro.php.php');
    exit;
}

$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';

if ($email === '' || $senha === '') {
    header('Location: cadastro.php?erro=campos');
    exit;
}

$repo = new usuarioRepositorio($pdo);

if ($repo->autenticar($email, $senha)) {
    session_regenerate_id(true);
    $_SESSION['usuario'] = $email;
    header('Location:menu-principal.php');
    exit;
}
header('Location: cadastro.php?erro=credenciais');
exit;
?>