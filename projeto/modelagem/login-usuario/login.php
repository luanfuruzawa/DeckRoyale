<?php
session_start();
$usuarioLogado = $_SESSION['usuario'] ?? null;
$erro = $_GET['erro'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Deck Royale - Login</title>
</head>

<body>
    <main>
        <?php if ($usuarioLogado): ?>
            <p id="texto-logout">Você já está logado como <?php echo htmlspecialchars($usuarioLogado); ?></br>quer fazer logout?</p>
                <form action="../logout-usuario/logout.php" method="post">
                    <button type="submit" id="botao-sair">Sair</button>
                    </form>
            <?php else: ?>
                </form>

            <div class="titulo">
                <h1>Deck Royale</h1>
            </div>

            <?php if ($erro === 'credenciais'): ?>
                <p class="mensagem-erro">Usuário ou senha incorretos.</p>
            <?php elseif ($erro === 'campos'): ?>
                <p class="mensagem-erro">Preencha e-mail e senha.</p>
            <?php endif; ?>

            <div class="caixa-login">
                <div class="textoh2-login">
                    <h2>Login</h2>
                </div>
                <div class="campos-login">
                    <form action="autenticar.php" method="post">
                        <input type="text" id="nome" name="nome" placeholder="Nome:">
                        <br><br>
                        <input type="text" id="email" name="email" placeholder="Email:">
                        <br><br>
                        <input type="password" id="senha" name="senha" placeholder="Senha:">
                        <br><br>
                        <button type="submit" id="botao-login">Fazer Login</button>
                    </form>
                </div>
            </div>

        <?php endif; ?>
    </main>

    <script>
        window.addEventListener('DOMContentLoaded', function () {
            var msg = document.querySelector('.mensagem-erro');
            if (msg) {
                setTimeout(() => {
                    msg.style.display = 'none';
                }, 5000);
            }
        });
    </script>
</body>

</html>
