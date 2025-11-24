<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../usuarios/login-usuario/login.php");
    exit;
}
require __DIR__ . "/../../src/conexao-bd.php";
require_once __DIR__ . '/../../src/Repositorio/CartaRepositorio.php';
require_once __DIR__ . '/../../src/Modelo/carta.php';
require __DIR__ . "/../../src/paginacao.php";

$ordem = filter_input(INPUT_GET, 'ordem', FILTER_SANITIZE_STRING) ?: null;
$direcao = filter_input(INPUT_GET, 'direcao', FILTER_SANITIZE_STRING) ?: 'ASC';

$itens_por_pagina = filter_input(INPUT_GET, 'itens_por_pagina', FILTER_VALIDATE_INT) ?: 5;

$climite = $itens_por_pagina;
$paginaAtual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;

$cartaRepositorio = new CartaRepositorio($pdo);
$totalCartas = $cartaRepositorio->contarTodos();

$paginacao = new Paginacao($totalCartas, $climite, $paginaAtual);

$cartas = $cartaRepositorio->buscarPaginado($paginacao->getLimite(), $paginacao->getOffset(), $ordem, $direcao);

function gerarUrlOrdenacaoCarta($campo, $paginaAtual, $ordemAtual, $direcaoAtual, $itensPorPagina)
{
    $novaDirecao = ($ordemAtual === $campo && $direcaoAtual === 'ASC') ? 'DESC' : 'ASC';
    return "?pagina={$paginaAtual}&ordem={$campo}&direcao={$novaDirecao}&itens_por_pagina={$itensPorPagina}";
}

function mostrarIconeOrdenacaoCarta($campo, $ordemAtual, $direcaoAtual)
{
    if ($ordemAtual !== $campo) {
        return '&#8597';
    }
    return $direcaoAtual === 'ASC' ? '↑' : '↓';
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="../../css/listar.css" />
    <title>Listar Cartas</title>
</head>

<body>
    <form action="../administrar/administrar-carta.php">
        <button type="submit" id="botao-menu"><i class="fas fa-arrow-left"></i></button>
    </form>
    <div class="container-formulario">
        <div class="formulario">
            <form action="../../administrar/administrar-carta.php">
            </form>
            <h1 class="titulo">Cartas Cadastradas</h1>
            <div class="tabela">
                <form class="form-paginacao" method="GET" action="">
                    <label for="itens_por_pagina">Itens por página:</label>
                    <select name="itens_por_pagina" id="itens_por_pagina" onchange="this.form.submit()">
                        <option value="5" <?= $itens_por_pagina == 5 ? 'selected' : '' ?>>5</option>
                        <option value="10" <?= $itens_por_pagina == 10 ? 'selected' : '' ?>>10</option>  
                    </select>
                    <input type="hidden" name="ordem" value="<?= htmlspecialchars($ordem) ?>">
                    <input type="hidden" name="direcao" value="<?= htmlspecialchars($direcao) ?>">
                </form>
                <table>
                    <thead>
                        <tr>
                            <th>
                                <a href="<?= gerarUrlOrdenacaoCarta('id', $paginacao->getPaginaAtual(), $ordem, $direcao, $itens_por_pagina) ?>"
                                    style="color: inherit; text-decoration: none;">
                                    ID (Nome) <?= mostrarIconeOrdenacaoCarta('id', $ordem, $direcao) ?>
                                </a>
                            </th>
                            <th>
                                <a href="<?= gerarUrlOrdenacaoCarta('custo', $paginacao->getPaginaAtual(), $ordem, $direcao, $itens_por_pagina) ?>"
                                    style="color: inherit; text-decoration: none;">
                                    Custo <?= mostrarIconeOrdenacaoCarta('custo', $ordem, $direcao) ?>
                                </a>
                            </th>
                            <th>Caminho da Imagem</th>
                            <th>Raridade</th>
                            <th> </th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cartas as $carta): ?>
                            <tr>
                                <td><?= htmlspecialchars($carta->getId()) ?></td>
                                <td><?= htmlspecialchars($carta->getCustoCarta()) ?></td>
                                <td><?= htmlspecialchars($carta->getCaminhoCarta()) ?></td>
                                <td><?= htmlspecialchars($carta->getRaridadeCarta()) ?></td>

                                <td>
                                    <form action="../atualizar-carta/atualizar-carta.php" method="POST">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($carta->getId()) ?>">
                                        <button type="submit" class="botao-alterar">Editar</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="../atualizar-carta/deletar-carta.php" method="post">
                                        <input type="hidden" name="id" value="<?= $carta->getId() ?>">
                                        <input type="submit" class="botao-alterar" value="Excluir">
                                    </form>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="paginacao" style="text-align:center; margin-top: 20px;">
                    <?php if ($paginacao->getPaginaAtual() > 1): ?>
                        <a href="?pagina=<?= $paginacao->getPaginaAtual() - 1 ?>&ordem=<?= htmlspecialchars($ordem) ?>&direcao=<?= htmlspecialchars($direcao) ?>&itens_por_pagina=<?= $itens_por_pagina ?>"
                            class="botao-pagina">« Anterior</a>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $paginacao->getTotalPaginas(); $i++): ?>
                        <?php if ($i === $paginacao->getPaginaAtual()): ?>
                            <strong><?= $i ?></strong>
                        <?php else: ?>
                            <a href="?pagina=<?= $i ?>&ordem=<?= htmlspecialchars($ordem) ?>&direcao=<?= htmlspecialchars($direcao) ?>&itens_por_pagina=<?= $itens_por_pagina ?>"
                                class="botao-pagina"><?= $i ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <?php if ($paginacao->getPaginaAtual() < $paginacao->getTotalPaginas()): ?>
                        <a href="?pagina=<?= $paginacao->getPaginaAtual() + 1 ?>&ordem=<?= htmlspecialchars($ordem) ?>&direcao=<?= htmlspecialchars($direcao) ?>&itens_por_pagina=<?= $itens_por_pagina ?>"
                            class="botao-pagina">Próximo »</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>