<?php
$erro = $_GET['erro'] ?? '';
$sucesso = $_GET['sucesso'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastro-carta.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Cadastro-Carta</title>
</head>

<body>
    <form action="../menu-principal/menu-principal.php" >
        <button type="submit" id="botao-menu"><i class="fa-solid fa-house"></i></button>
    </form>
    <main>

            <div class="dados-carta">
                <h1>Cadastro de Carta</h1>
                <?php if ($erro === 'existente'): ?>
                    <p class="mensagem-erro">Essa carta já está cadastrada.</p>
                <?php elseif ($erro === 'vazio'): ?>
                    <p class="mensagem-erro">Preencha todos os campos corretamente.</p>
                <?php endif; ?>

                <?php if ($sucesso === '1'): ?>
                    <p class="mensagem-sucesso">Carta cadastrada com sucesso!</p>
                <?php endif; ?>

                <form action="inserirCarta.php" method="post">
                    <input type="text" id="id" name="id" placeholder="Nome: ">
                    <br><br>
                    <input type="number" id="custo" name="custo" placeholder="Custo Elixir: ">
                    <br><br>
                    <input type="text" id="caminho-carta" name="caminho-carta" placeholder="Caminho Carta: ">
                    <br><br>
                    <input type="text" id="raridade-carta" name="raridade-carta" placeholder="Raridade Carta: ">
                    <br><br>

                    <button type="submit">Cadastrar Carta</button>
                </form>
            </div>
        </div>
    </main>
</body>

</html>