<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../usuarios/login-usuario/login.php");
    exit;
}
require __DIR__ . "/../../src/conexao-bd.php";
require __DIR__ . "/../../src/Modelo/carta.php";
require __DIR__ . "/../../src/paginacao.php";


$sql = "SELECT id, srcImagem, custo, raridade
        FROM carta
        ORDER BY FIELD(raridade, 'Campeao', 'Lendaria', 'Epica', 'Rara', 'Comum');";
$stmt = $pdo->query($sql);
$cartas = $stmt->fetchAll(PDO::FETCH_ASSOC);

$categorias = [];
foreach ($cartas as $carta) {
    $categorias[$carta['raridade']][] = $carta;
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Montagem Deck</title>
    <link rel="stylesheet" href="../../css/montagem.css">
    <!-- https://fontawesome.com/icons/house?s=solid link do icone casa-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <form action="../../menu-principal/menu-principal.php">
        <button type="submit" id="botao-menu"><i class="fa-solid fa-house"></i></button>
    </form>

    <h1 id="titulo">Deck</h1>
    <!--Imagens tiradas de https://www.deckshop.pro/br/card/list-->
    <section class="container-deck">
        <div class="deck"></div>
        <p>Custo médio de elixir:</p>
        <p id="custo-elixir">0.0</p>

        <div class="selecao-cartas">
            <div class="todas-cartas">
                <div class="raridade">
                    <?php foreach ($categorias as $raridade => $lista): ?>
                        <h2><?= htmlspecialchars($raridade) ?></h2>
                        <?php foreach ($lista as $carta): ?>
                            <img class="carta"
                                data-custo="<?= htmlspecialchars($carta['custo']) ?>"
                                data-id="<?= htmlspecialchars($carta['id']) ?>"
                                id="<?= htmlspecialchars(pathinfo($carta['srcImagem'], PATHINFO_FILENAME)) ?>"
                                src="../../src/uploads/<?= strtolower($carta['raridade']) ?>/<?= htmlspecialchars($carta['srcImagem']) ?>"
                                draggable="true" alt="<?= htmlspecialchars($carta['id']) ?>">
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <button id="botao-salvar">Salvar</button>
    <script src="montagem.js"></script>

    <div class="menu-salvar">
        <div class="campos-menu-salvar">
            <form id="form-salvar-deck">
                <label for="nome-deck">Nome do Deck:</label>
                </br></br>
                <input type="text" name="nome-deck" id="nome-deck" placeholder="Nome do Deck:">
                </br></br>
                <button type="submit" id="botao-enviar">Salvar</button>

            </form>


        </div>

    </div>
</body>

</html>