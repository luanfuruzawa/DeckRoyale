<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../../usuarios/login-usuario/login.php');
    exit;
}
function pode(string $perm): bool
{
    return in_array($perm, $_SESSION['permissoes'] ?? [], true);
}

require __DIR__ . "/../../src/conexao-bd.php";
require_once __DIR__ . '/../../src/Repositorio/UsuarioRepositorio.php';
require_once __DIR__ . '/../../src/Modelo/usuario.php';

$usuarioRepo = new UsuarioRepositorio($pdo);
$usuarioLogado = $usuarioRepo->buscarPorEmail($_SESSION['usuario'] ?? '');
$usuarioIdLogado = $usuarioLogado ? $usuarioLogado->getId() : null;

$pesquisa = trim((string) ($_GET['pesquisa-deck'] ?? ''));
$pesquisar_por = filter_input(INPUT_GET, 'pesquisar_por', FILTER_SANITIZE_STRING) ?: 'nome';
$pesquisar_por = in_array($pesquisar_por, ['nome', 'autor'], true) ? $pesquisar_por : 'nome';

$sql = "
SELECT
    carta.id           AS carta_id,
    carta.srcImagem    AS carta_imagem,
    carta.custo        AS carta_custo,
    carta.raridade     AS carta_raridade,
    deck.id            AS deck_id,
    deck.nome          AS deck_nome,
    deck.id_usuario    AS deck_usuario_id,
    usuario.nome       AS usuario_nome
FROM carta
INNER JOIN deckCarta ON carta.id = deckCarta.id_carta
INNER JOIN deck ON deckCarta.id_deck = deck.id
LEFT JOIN usuario ON deck.id_usuario = usuario.id
";

$params = [];
if ($pesquisa !== '') {
    if ($pesquisar_por === 'autor') {
        $sql .= " WHERE usuario.nome LIKE ? ";
    } else {
        $sql .= " WHERE deck.nome LIKE ? ";
    }
    $params[] = '%' . $pesquisa . '%';
}

$sql .= " ORDER BY (deck.id_usuario = ?) DESC, deck.id, FIELD(carta.raridade, 'Campeao', 'Lendaria', 'Epica', 'Rara', 'Comum');";

$params[] = (int) $usuarioIdLogado;

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$grupos = [];
foreach ($rows as $r) {
    $deckId = (int) $r['deck_id'];
    if (!isset($grupos[$deckId])) {
        $grupos[$deckId] = [
            'nome' => $r['deck_nome'] ?? ("Deck $deckId"),
            'cartas' => [],
            'usuario_id' => isset($r['deck_usuario_id']) ? (int) $r['deck_usuario_id'] : null,
            'usuario_nome' => isset($r['usuario_nome']) ? $r['usuario_nome'] : null
        ];
    }

    $cartaNome = '';
    if (!empty($r['carta_imagem'])) {
        $cartaNome = pathinfo($r['carta_imagem'], PATHINFO_FILENAME);
    } else {
        $cartaNome = 'Carta #' . $r['carta_id'];
    }

    $grupos[$deckId]['cartas'][] = [
        'id' => (int) $r['carta_id'],
        'nome' => $cartaNome,
        'imagem' => $r['carta_imagem'] ?? '',
        'raridade' => $r['carta_raridade'] ?? ''
    ];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Icone de lupa-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../css/pesquisa-deck.css">
    <title>Pesquisa-Deck</title>
</head>

<body>
    <div class="parte-cima">
        <div class="icones-menu">
            <a href="../../menu-principal/menu-principal.php" id="botao-menu"><i class="fa-solid fa-house"></i></a>
            <h1 class="titulo">Deck Royale</h1>
        </div>
        <section class="container-barra-pesquisa">
            <i class="fa-solid fa-magnifying-glass"></i>
            <form action="" method="get">
                <label for="pesquisa-deck"></label>
                <input class="barra-pesquisa" type="text" id="pesquisa-deck" name="pesquisa-deck"
                    placeholder="Pesquisar Deck..." value="<?= htmlspecialchars($pesquisa) ?>">

                <select name="pesquisar_por" id="pesquisar_por">
                    <option value="nome" <?= $pesquisar_por === 'nome' ? 'selected' : '' ?>>Nome do deck</option>
                    <option value="autor" <?= $pesquisar_por === 'autor' ? 'selected' : '' ?>>Autor do deck</option>
                </select>

            </form>
        </section>
    </div>
    <main>
        <div class="deck-container">
            <?php if (empty($grupos)): ?>
                <p>Nenhum deck encontrado.</p>
            <?php endif; ?>

            <?php foreach ($grupos as $deckId => $deck): ?>
                <div class="deck-wrapper" data-deck-id="<?= htmlspecialchars($deckId) ?>">
                    <div class="cards-grid">
                        <?php
                        $slots = array_slice($deck['cartas'], 0, 8);
                        for ($i = 0; $i < 8; $i++):
                            $carta = $slots[$i] ?? null;
                            $src = '../../img/placeholder.png';
                            if ($carta && !empty($carta['imagem']) && !empty($carta['raridade'])) {
                                $src = '../../src/uploads/' . strtolower($carta['raridade']) . '/' . htmlspecialchars($carta['imagem']);
                            }
                            ?>
                            <div class="card">
                                <?php if ($carta): ?>
                                    <img src="<?= $src ?>" alt="<?= htmlspecialchars($carta['nome'] ?? 'Carta') ?>"
                                        title="<?= htmlspecialchars($carta['nome'] ?? 'Carta') ?>">
                                <?php else: ?>
                                    <div class="empty-slot" aria-hidden="true"></div>
                                <?php endif; ?>
                            </div>
                        <?php endfor; ?>
                    </div>
                    <div class="deck-header">
                        <div class="deck-name-display" data-deck-id="<?= htmlspecialchars($deckId) ?>"
                            aria-label="Nome do deck">Nome: <?= htmlspecialchars($deck['nome']) ?></div>

                        <div class="deck-autor-display" data-deck-id="<?= htmlspecialchars($deckId) ?>"
                            aria-label="Autor do deck">Autor:
                            <?= htmlspecialchars(($deck['usuario_id'] === $usuarioIdLogado) ? 'Você' : ($deck['usuario_nome'] ?? 'Desconhecido')) ?>
                        </div>
                    </div>
                    <div class="deletar-deck">
                        <?php if ($usuarioIdLogado !== null && $deck['usuario_id'] === $usuarioIdLogado): ?>
                            <form method="post" action="deletar-deck.php"
                                onsubmit="return confirm('Confirma exclusão deste deck?');">
                                <input type="hidden" name="id-deck" value="<?= htmlspecialchars($deckId) ?>">
                                <button type="submit" class="btn-delete" title="Excluir deck" aria-label="Excluir deck">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="botao-relatorio">
            <form action="gerar-relatorio.php" method="get">
                <button type="submit" id="botao-relatorio">Gerar Relatório de Decks</button>
            </form>

        </div>

    </main>

</body>

</html>