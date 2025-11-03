<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../usuarios/login-usuario/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/administrar.css">
    <!-- https://fontawesome.com/icons/house?s=solid link do icone casa-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>Administrar</title>
</head>

<body>
       <form action="../menu-principal/menu-principal.php">
        <button type="submit" id="botao-menu"><i class="fas fa-arrow-left"></i></button>
    </form>

    <section class = "container-formulario">
        <div class = "formulario">
            <form action="../cartas/cadastrar-carta/cadastrar-carta.php" method="post">
                <button class="botao-opcao" type="submit">Cadastrar Cartas</button>
            </form>
            <br><br>
            <form action="../cartas/listar-carta/listar-carta.php" method="post">
                <button class="botao-opcao" type="submit">Listar Cartas</button>
            </form>
            <br><br>
            <form action="../cartas/atualizar-carta/atualizar-carta.php" method="post">
                <button class="botao-opcao" type="submit">Atualizar Cartas</button>
            </form>

        </div>
    </section>
    
    
</body>

</html>