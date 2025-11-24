<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login-usuario/login.php");
    exit;
}

$erro = $_GET['erro'] ?? '';
$sucesso = $_GET['sucesso'] ?? '';
$apagar = $_GET['apagar'] ?? '';

$usuario = null;
require_once __DIR__ . '/../../src/conexao-bd.php';
require_once __DIR__ . '/../../src/Repositorio/UsuarioRepositorio.php';
require_once __DIR__ . '/../../src/Modelo/usuario.php';
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $repo = new UsuarioRepositorio($pdo);
    $usuario = $repo->buscarPorId($id);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/atualizar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Alterar Carta</title>
</head>

<body>
    <form action="../listar-usuario/listar-usuario.php">
        <button type="submit" id="botao-menu"><i class="fas fa-arrow-left"></i></button>
    </form>
    <main>
        <container class="container-formularios">

            <div class="dados">
                <h1 class="titulo">Alterar Usuario</h1>
                <?php if ($erro === 'vazio'): ?>
                    <p class="mensagem-erro">Preencha todos os campos corretamente.</p>
                <?php endif; ?>
                <?php if ($sucesso === 'ok'): ?>
                    <p class="mensagem-sucesso">Carta alterada com sucesso!</p>
                <?php endif; ?>
                <?php if ($erro === 'sem_id'): ?>
                    <p class="mensagem-erro">Erro: informe o ID (nome) da carta para deletar.</p>
                <?php endif; ?>

                <form action="alterarUsuario.php" method="post">
                    <input type="number" id="id" name="id" placeholder="Id do usuario para alterar: " value="<?= htmlspecialchars($usuario?->getId() ?? '') ?>" readonly>
                    <br><br>
                    <input type="text" id="nome" name="nome" placeholder="Nome: " value="<?= htmlspecialchars($usuario?->getNome() ?? '') ?>">
                    <br><br>
                    <input type="text" id="email" name="email" placeholder="Email: " value="<?= htmlspecialchars($usuario?->getEmail() ?? '') ?>">
                    <br><br>
                    <label for="perfil">Perfil:</label>
                    <select id="perfil" name="perfil">
                        <option value="User" <?= ($usuario && $usuario->getPerfil() === 'User') ? 'selected' : '' ?>>User</option>
                        <option value="Admin" <?= ($usuario && $usuario->getPerfil() === 'Admin') ? 'selected' : '' ?>>Admin</option>
                    </select>
                    <br><br>
                    <button type="submit">Alterar Usuario</button>
                </form>
            </div>
        </container>
    </main>
</body>

</html>