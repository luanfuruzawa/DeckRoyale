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

// Substitui a query que referenciava carta.nome (não existe)
// Seleciona apenas colunas reais: id, srcImagem, custo, raridade, e info do deck
$sql = "
SELECT
    carta.id           AS carta_id,
    carta.srcImagem    AS carta_imagem,
    carta.custo        AS carta_custo,
    carta.raridade     AS carta_raridade,
    deck.id            AS deck_id,
    deck.nome          AS deck_nome
FROM carta
INNER JOIN deckCarta ON carta.id = deckCarta.id_carta
INNER JOIN deck ON deckCarta.id_deck = deck.id
ORDER BY deck.id, FIELD(carta.raridade, 'Campeao', 'Lendaria', 'Epica', 'Rara', 'Comum');
";
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// agrupa resultados por deck (usa deck_id e deck_nome retornados)
$grupos = [];
foreach ($rows as $r) {
    $deckId = (int) $r['deck_id'];
    if (!isset($grupos[$deckId])) {
        $grupos[$deckId] = [
            'nome' => $r['deck_nome'] ?? ("Deck $deckId"),
            'cartas' => []
        ];
    }

    // determina um "nome" legível para a carta: filename do srcImagem ou fallback por id
    $cartaNome = '';
    if (!empty($r['carta_imagem'])) {
        $cartaNome = pathinfo($r['carta_imagem'], PATHINFO_FILENAME);
    } else {
        $cartaNome = 'Carta #' . $r['carta_id'];
    }

    $grupos[$deckId]['cartas'][] = [
        'id' => (int)$r['carta_id'],
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
            <form action="#" method="post">
                <label for="pesquisa-deck"></label>
                <input class="barra-pesquisa" type="text" id="pesquisa-deck" name="pesquisa-deck"
                    placeholder="Pesquisar Deck...">
            </form>
        </section>
    </div>
    <main>
        <div class="deck-container">
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
                                     <img src="<?= $src ?>"
                                          alt="<?= htmlspecialchars($carta['nome'] ?? 'Carta') ?>"
                                          title="<?= htmlspecialchars($carta['nome'] ?? 'Carta') ?>">
                                 <?php else: ?>
                                     <div class="empty-slot" aria-hidden="true"></div>
                                 <?php endif; ?>
                             </div>
                         <?php endfor; ?>
                     </div> 
                    <div class="deck-header">
                        <div class="deck-name-display"
                             data-deck-id="<?= htmlspecialchars($deckId) ?>"
                             aria-label="Nome do deck"><?= htmlspecialchars($deck['nome']) ?></div>
                    </div>
                 </div>
             <?php endforeach; ?>
         </div>
     </main>

</body>

</html>