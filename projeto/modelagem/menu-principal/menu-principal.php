<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../usuarios/login-usuario/login.php');
    exit;
}
function pode(string $perm): bool
{
    return in_array($perm, $_SESSION['permissoes'] ?? [], true);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/menu-inicial.css">
    <!-- https://fontawesome.com/icons/house?s=solid link do icone casa-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Menu Principal</title>
</head>

<body>
    <section class="menu-principal">
        <div class="container-menu-lateral">
            <div class="icones-menu">

                <h1 class="titulo">Deck Royale</h1>
            </div>
            <div class="opcoes-menu">
                <a class="botao-opcao" href="../decks/montagem-deck/montagem.php">Montar Deck</a>
                <a class="botao-opcao" href="../decks/pesquisa/pesquisa-deck.html">Meus Decks</a>
                <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'Admin'): ?>
                    <form action="../administrar/administrar-carta.php" method="post">
                        <button class="botao-opcao" type="submit">Administrar Cartas</button>
                    </form>
                    <form action="../administrar/administrar-usuario.php" method="post">
                        <button class="botao-opcao" type="submit">Administrar Usuario</button>
                    </form>
                <?php endif; ?>
                <form action="../usuarios/login-usuario/login.php" method="post">
                    <button class="botao-sair" type="submit">Sair</button>
                </form>
            </div>
        </div>
        <div class="informacao">
            <h1>
                Bem-vindo ao Deck Royale!
                Se você é apaixonado por Clash Royale e quer melhorar suas estratégias, está no lugar certo. Nosso site
                foi criado para ajudar jogadores de todos os níveis a montar decks equilibrados e eficientes, acompanhar
                os decks mais populares do meta e descobrir novas combinações de cartas para surpreender seus
                adversários.
            </h1>
            <img class="imagem-royale" src="../img/clash-royale-logo.png" alt="royale">

        </div>
    </section>
</body>

</html>