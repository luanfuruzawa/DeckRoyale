    <?php
    require_once __DIR__ . '../../conexao-bd/conexao-bd.php';
    require_once __DIR__ . '/bd/CartaRepositorio.php';
    require_once __DIR__ . '../../carta/carta.php';

    $id = trim($_POST['id'] ?? '');
    $custoCarta = $_POST['custo'] ?? '';
    $raridadeCarta = $_POST['raridade-carta'] ?? '';
    $imagemCarta = $_FILES['imagem-carta'] ?? null;

    if ($id === '' || $custoCarta === '' || $raridadeCarta === '') {
        header('Location: atualizar-carta.php?erro=vazio');
        exit;
    }

    $repo = new CartaRepositorio($pdo);
    $cartaExistente = $repo->buscarPorId($id);

    if (!$cartaExistente) {
        header('Location: atualizar-carta.php?erro=inexistente');
        exit;
    }
    //https://www.php.net/manual/en/features.file-upload.php mais referencias sobre manipulação de arquivos
    //https://www.php.net/manual/en/function.pathinfo.php para manipulação de caminho  de arquivos
    //https://www.php.net/manual/en/function.mkdir.php para criação de pastas e permissões de edição
    if ($imagemCarta && $imagemCarta['tmp_name']) {
        $pasta = __DIR__ . '/../img/' . strtolower($raridadeCarta) . '/';
        if (!is_dir($pasta)) {
            mkdir($pasta, 0777, true);
        }

        $extensao = pathinfo($imagemCarta['name'], PATHINFO_EXTENSION);
        $nomeArquivo = $id . '.' . $extensao;
        $caminhoCompleto = $pasta . $nomeArquivo;

        if (!move_uploaded_file($imagemCarta['tmp_name'], $caminhoCompleto)) {
            header('Location: atualizar-carta.php?erro=upload');
            exit;
        }
    } 

    $carta = new Carta($id, $custoCarta, $nomeArquivo, $raridadeCarta);
    $repo->alterar($carta);

    header('Location: atualizar-carta.php?sucesso=ok');
    exit;
    ?>
