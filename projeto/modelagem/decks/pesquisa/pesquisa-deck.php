<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../usuarios/login-usuario/login.php");
    exit;
}
require __DIR__ . "/../../src/conexao-bd.php";
require __DIR__ . "/../../src/Modelo/deck.php";
require __DIR__ . "/../../src/Repositorio/DeckRepositorio.php";

$repo = new DeckRepositorio($pdo);
$decks = $repo->buscarTodos();

$pesquisa = trim($_POST['pesquisa-deck'] ?? '');
if ($pesquisa !== '') {
    $decks = $repo->buscarPorNome($pesquisa);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../css/pesquisa-deck.css">
    <title>Pesquisa-Deck</title>
</head>
<body>
    <div class="parte-cima">
        <div class="icones-menu">
            <a href="../../menu-principal/menu-principal.php" id="botao-menu"><i class="fa-solid fa-house"></i></a>
            <h1 class="titulo">Deck Royale</h1>
        </div>
        <section class="container-barra-pesquisa">
            <i class="fa-solid fa-magnifying-glass"></i>
            <form action="" method="post">
                <label for="pesquisa-deck"></label>
                <input class="barra-pesquisa" type="text" id="pesquisa-deck" name="pesquisa-deck" placeholder="Pesquisar Deck..." value="<?= htmlspecialchars($pesquisa) ?>">
            </form>
        </section>
    </div>
</body>
</html>
