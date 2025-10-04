<?php
$erro = $_GET['erro'] ?? '';
$sucesso = $_GET['sucesso'] ?? '';
$apagar = $_GET['apagar'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="atualizar-carta.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Alterar Carta</title>
</head>

<body>
    <form action="../administrar-carta/administrar-carta.php">
        <button type="submit" id="botao-menu"><i class="fas fa-arrow-left"></i></button>
    </form>
    <main>
        <container class="container-formularios">

            <div class="dados-carta">
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

                <form action="alterarCarta.php" method="post">

                    <input type="text" id="id" name="id" placeholder="Nome Carta para alterar: ">
                    <br><br>

                    <input type="number" id="custo" name="custo" placeholder="Custo Elixir">
                    <br><br>

                    <input type="text" id="caminho-carta" name="caminho-carta" placeholder="Caminho Carta">
                    <br><br>

                    <input type="text" id="raridade-carta" name="raridade-carta" placeholder="Raridade Carta">
                    <br><br>
                    <form action="alterarCarta.php" method="post">
                        <button type="submit">Alterar Carta</button>
                    </form>
                </form>
                <div class="deletar-carta">
                    <h1 class="titulo">Apagar Carta</h1>
                    <form action="deletar-carta.php" method="post">
                        <?php if ($apagar === 'ok'): ?>
                            <p class="mensagem-sucesso">Carta apagada com sucesso!</p>
                        <?php endif; ?>
                        <input type="text" name="id" placeholder="Nome da Carta para deletar">
                        <br><br>
                        <button type="submit">Deletar Carta</button>
                    </form>
                </div>
            </div>
        </container>
    </main>
</body>

</html>