<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../usuarios/login-usuario/login.php");
    exit;
}
$erro = $_GET['erro'] ?? '';
$sucesso = $_GET['sucesso'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/cadastro-carta.css">
    <link rel="stylesheet" href="estilo-form.css"> <!-- CSS separado para combo box e input de imagem -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Cadastro de Carta</title>
</head>

<body>
    <form action="../../administrar/administrar-carta.php">
        <button type="submit" id="botao-menu"><i class="fas fa-arrow-left"></i></button>
    </form>

    <main>
        <section class="container-formulario">
            <div class="formulario">
                <h1 class="titulo">Cadastro de Carta</h1>

                <?php if ($erro === 'existente'): ?>
                    <p class="mensagem-erro">Essa carta já está cadastrada.</p>
                <?php elseif ($erro === 'vazio'): ?>
                    <p class="mensagem-erro">Preencha todos os campos corretamente.</p>
                <?php endif; ?>

                <?php if ($sucesso === 'ok'): ?>
                    <p class="mensagem-sucesso">Carta cadastrada com sucesso!</p>
                <?php endif; ?>

                <form action="inserirCarta.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="id" placeholder="Nome da Carta:">
                    <br><br>
                    <input type="number" name="custo" placeholder="Custo Elixir:">
                    <br><br>
                    <label class="categoria" for="imagem-carta">Escolha a imagem da carta:</label>
                    <input type="file" name="imagem-carta" id="imagem-carta" accept="image/*">
                    <br><br>
                    <label class="categoria" for="raridade-carta">Raridade da Carta:</label>
                    <select name="raridade-carta" id="raridade-carta">
                        <option value="">Selecione...</option>
                        <option value="comum">Comum</option>
                        <option value="rara">Rara</option>
                        <option value="epica">Épica</option>
                        <option value="lendaria">Lendária</option>
                        <option value="campeao">Campeão</option>
                    </select>
                    <br><br>
                    <button type="submit">Cadastrar Carta</button>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
