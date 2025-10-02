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
            <section class="container-topo">
                <div class="topo-direita">
                    <p>Você já está logado como <strong>
                            <?php echo htmlspecialchars($usuarioLogado); ?>
                        </strong></p>
                    <form action="logout.php" method="post">
                        <button type="submit" class="botao-sair">Sair</button>
                    </form>
                </div>
            </section>
        <?php else: ?>

            <div class="titulo">
                <h1>Deck Royale</h1>
            </div>
            <section class="container-form">
                <div class="form-wrapper">
                    <?php if ($erro === 'credenciais'): ?>
                        <p class="mensagem-erro">Usuário ou senha incorretos.</p>
                    <?php elseif ($erro === 'campos'): ?>
                        <p class="mensagem-erro">Preencha e-mail e senha.</p>
                    <?php endif; ?>
                    <div class="caixa-registro">
                        <div class="textoh2-cadastrar">
                            <h2 id="titulo-cadastro">Cadastro</h2>
                        </div>
                        <div class="campos-cadastro">
                            <form action="autenticar.php" method="post">
                                <input type="text" id="usuario" name="usuario" placeholder="Usuario: ">
                                <br><br>
                                <input type="text" id="email" name="email" placeholder="Email: ">
                                <br><br>
                                <input type="password" id="senha" name="senha" placeholder="Senha: ">
                                <br><br>
                                <button type="submit" value="Entrar" id="botao-cadastro">Fazer Cadastro</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
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