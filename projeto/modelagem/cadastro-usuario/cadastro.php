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
    <link rel="stylesheet" href="cadastro.css">
    <title>Deck Royale - Cadastro</title>
</head>

<body>
    <main>
        <?php
        if ($usuarioLogado): ?>                
                    <p id="texto-logout">Você já está logado como <strong>
                            <?php echo htmlspecialchars($usuarioLogado); ?>
                        </strong></p>

                    <form action="../logout-usuario/logout.php" method="post">
                        <button type="submit" id="botao-sair">Sair</button>
                    </form>
        <?php else: ?>

            <div class="titulo">
                <h1>Deck Royale</h1>
            </div>
                    <?php if ($erro === 'credenciais'): ?>
                        <p class="mensagem-erro">Nome, email ou senha incorretos.</p>
                    <?php elseif ($erro === 'campos'): ?>
                        <p class="mensagem-erro">Preencha e-mail, senha e nome.</p>
                    <?php endif; ?>
                    <div class="caixa-registro">
                        <div class="textoh2-cadastrar">
                            <h2 id="titulo-cadastro">Cadastro</h2>
                        </div>
                        <div class="campos-cadastro">
                            <form action="autenticar.php" method="post">
                                <input type="text" id="nome" name="nome" placeholder="Nome: ">
                                <br><br>
                                <input type="text" id="email" name="email" placeholder="Email: ">
                                <br><br>
                                <input type="password" id="senha" name="senha" placeholder="Senha: ">
                                <br><br>
                                <button type="submit" value="Entrar" id="botao-cadastro">Fazer Cadastro</button>
                            </form>
                        </div>
                        <div class="ir-para-login">
                            Já tem conta? <a id="link-login" href="../login-usuario/login.php">Clique aqui</a>
                        </div>
                    </div>
        <?php endif; ?>
    </main>

    <script>
        window.addEventListener('DOMContentLoaded', function () {
            var msg = document.querySelector('.mensagem-erro');
            if (msg) {
                setTimeout(function () {
                    msg.classList.add('oculto');
                }, 5000);
            }
        });
    </script>

</body>

</html>