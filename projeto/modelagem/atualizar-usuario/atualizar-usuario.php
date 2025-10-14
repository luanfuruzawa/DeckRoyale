<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login-usuario/login.php");
    exit;
}
$erro = $_GET['erro'] ?? '';
$sucesso = $_GET['sucesso'] ?? '';
$apagar = $_GET['apagar'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../atualizar-css/atualizar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Alterar Carta</title>
</head>

<body>
    <form action="../administrar-usuario/administrar-usuario.php">
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

                <form action="alterarCarta.php" method="post">

                    <input type="number" id="id" name="id" placeholder="Id do usuario para alterar: ">
                    <br><br>

                    <input type="text" id="email" name="email" placeholder="Email: ">
                    <br><br>

                    <input type="text" id="user" name="user" placeholder="User: ">
                    <br><br>

                    <input type="text" id="senha-carta" name="senha" placeholder="Senha: ">
                    <br><br>
                    <form action="alterarUsuario.php" method="post">
                        <button type="submit">Alterar Usuario</button>
                    </form>
                </form>
                <div class="deletar-carta">
                    <h1 class="titulo">Apagar Usuario</h1>
                    <form action="deletar-usuario.php" method="post">
                        <?php if ($apagar === 'ok'): ?>
                            <p class="mensagem-sucesso">Carta apagada com sucesso!</p>
                        <?php endif; ?>
                        <input type="text" name="id" placeholder="ID do usuário para deletar">
                        <br><br>
                        <button type="submit">Deletar Usuario</button>
                    </form>
                </div>
            </div>
        </container>
    </main>
</body>

</html>