<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login-usuario/login.php");
    exit;
}
require __DIR__ . "../../conexao-bd/conexao-bd.php";
require __DIR__ . "../../usuario/usuario.php";
require __DIR__ . "/bd/UsuarioRepositorio.php";
require __DIR__ . "../../paginacao/paginacao.php";

$climite = 15;
$paginaAtual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;

$usuarioRepositorio = new UsuarioRepositorio($pdo);
$totalUsuarios = $usuarioRepositorio->contarTodos();

$paginacao = new Paginacao($totalUsuarios, $climite, $paginaAtual);

$usuarios1 = $usuarioRepositorio->buscarPaginado($paginacao->getLimite(), $paginacao->getOffset());
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="../listar-css/listar.css" />
    <title>Listar Usuario</title>
</head>

<body>
    <form action="../administrar-usuario/administrar-usuario.php">
        <button type="submit" id="botao-menu"><i class="fas fa-arrow-left"></i></button>
    </form>
    <div class="container-formulario">
        <div class="formulario">
            <form action="../administrar-usuario/administrar-usuario.php">
            </form>
            <h1 class="titulo">Cartas Cadastradas</h1>
            <div class="tabela-cartas">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Senha</th>
                            <th>Perfil</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><?= htmlspecialchars($usuario->getId()) ?></td>
                                <td><?= htmlspecialchars($usuario->getNome()) ?></td>
                                <td><?= htmlspecialchars($usuario->getEmail()) ?></td>
                                <td><?= htmlspecialchars($usuario->getSenha()) ?></td>
                                <td><?= htmlspecialchars($usuario->getPerfil()) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="paginacao" style="text-align:center; margin-top: 20px;">
                    <?php if ($paginacao->getPaginaAtual() > 1): ?>
                        <a href="?pagina=<?= $paginacao->getPaginaAtual() - 1 ?>" class="botao-pagina">« Anterior</a>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $paginacao->getTotalPaginas(); $i++): ?>
                        <?php if ($i === $paginacao->getPaginaAtual()): ?>
                            <strong><?= $i ?></strong>
                        <?php else: ?>
                            <a href="?pagina=<?= $i ?>" class="botao-pagina"><?= $i ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <?php if ($paginacao->getPaginaAtual() < $paginacao->getTotalPaginas()): ?>
                        <a href="?pagina=<?= $paginacao->getPaginaAtual() + 1 ?>" class="botao-pagina">Próximo »</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>