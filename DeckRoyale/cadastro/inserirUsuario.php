<?php
require_once __DIR__ . '../conexao-bd/conexao-bd.php';
require_once __DIR__ . '/bd/UsuarioRepositorio.php';
require_once __DIR__ . '/bd/Usuario.php';

$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

$repo = new UsuarioRepositorio($pdo);
if ($repo->buscarPorEmail($email)) {
    echo "Usuario já existe! {$email}\n";
    exit;
}
$usuario = new Usuario(0, $email, $senha, $nome, $perfil);
$repo->salvar($usuario);


echo "Usuário inserido: {$email}\n";



?>