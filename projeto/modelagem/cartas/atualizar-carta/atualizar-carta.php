<?php
require_once __DIR__ . '/../../src/conexao-bd.php';
require_once __DIR__ . '/../../src/Repositorio/CartaRepositorio.php';
require_once __DIR__ . '/../../src/Modelo/carta.php';

session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../usuarios/login-usuario/login.php");
    exit;
}
$erro = $_POST['erro'] ?? '';
$sucesso = $_POST['sucesso'] ?? '';
$apagar = $_POST['apagar'] ?? '';

$carta = null;

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $repo = new CartaRepositorio($pdo);
    $carta = $repo->buscarPorId($id);
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
    <form action="../../administrar/administrar-carta.php">
        <button type="submit" id="botao-menu"><i class="fas fa-arrow-left"></i></button>
    </form>
    <main>
        <container class="container-formularios">

            <div class="dados">
                <h1 class="titulo">Alterar Carta</h1>
                <?php if ($erro === 'vazio'): ?>
                    <p class="mensagem-erro">Preencha todos os campos corretamente.</p>
                <?php endif; ?>
                <?php if ($sucesso === 'ok'): ?>
                    <p class="mensagem-sucesso">Carta alterada com sucesso!</p>
                <?php endif; ?>
                <?php if ($erro === 'sem_id'): ?>
                    <p class="mensagem-erro">Erro: informe o ID (nome) da carta para deletar.</p>
                <?php endif; ?>

                <form action="alterarCarta.php" method="post" enctype="multipart/form-data">

                    <input type="text" id="id" name="id" placeholder="Nome Carta para alterar:"
                        value="<?= htmlspecialchars($carta?->getId() ?? '') ?>" readonly>
                    <br><br>

                    <input type="number" id="custo" name="custo" placeholder="Custo Elixir"
                        value="<?= htmlspecialchars($carta?->getCustoCarta() ?? '') ?>">
                    <br><br>

                    <input type="file" id="imagem-carta" name="imagem-carta" accept="image/*">
                    <?php if ($carta && $carta->getCaminhoCarta()): ?>
                        <br>
                        <img src="<?= htmlspecialchars($carta->getCaminhoCarta()) ?>" alt="Imagem da carta" width="100">
                    <?php endif; ?>
                    <br><br>

                    <select name="raridade-carta" id="raridade-carta">
                        <option value="">Selecione a raridade</option>
                        <option value="campeao" <?= ($carta && $carta->getRaridadeCarta() === 'campeao') ? 'selected' : '' ?>>Campeão</option>
                        <option value="lendaria" <?= ($carta && $carta->getRaridadeCarta() === 'lendaria') ? 'selected' : '' ?>>Lendária</option>
                        <option value="epica" <?= ($carta && $carta->getRaridadeCarta() === 'epica') ? 'selected' : '' ?>>
                            Épica</option>
                        <option value="rara" <?= ($carta && $carta->getRaridadeCarta() === 'rara') ? 'selected' : '' ?>>
                            Rara</option>
                        <option value="comum" <?= ($carta && $carta->getRaridadeCarta() === 'comum') ? 'selected' : '' ?>>
                            Comum</option>
                    </select>
                    <br><br>

                    <button type="submit">Alterar Carta</button>
                </form>

                </form>

        </container>
    </main>
</body>

</html>