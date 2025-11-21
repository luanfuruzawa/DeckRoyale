<?php

require_once __DIR__ . '/../../src/conexao-bd.php';
require_once __DIR__ . '/../../src/Repositorio/DeckRepositorio.php';
require_once __DIR__ . '/../../src/Modelo/carta.php';
require_once __DIR__ . '/../../src/Modelo/deck.php';

$nomeDeck = trim($_POST['nome-deck'] ?? '');
$cartasIds = $_POST['cartas-ids'] ?? [];

if ($nomeDeck === '' || count($cartasIds) !== 8) {
    header('Location: cadastrar-deck.php?erro=dados-invalidos');
    exit;
}

$repo = new DeckRepositorio($pdo);

try {
    $pdo->beginTransaction();
    $deck = new Deck(null, $nomeDeck);
    $repo->salvar($deck);

    $idDeck = $deck->getId();

    foreach ($cartasIds as $idCarta) {
        
        $repo->adicionarCarta($idDeck, $idCarta);
    }

    $pdo->commit();

    header('Location: cadastrar-deck.php?sucesso=ok');
    exit;

} catch (Exception $e) {
    // 9. Rollback em caso de erro
    if ($pdo->inTransaction()) {
        $pdo->rollBack(); // Desfaz a criação do deck e quaisquer cartas que já foram inseridas.
    }

    header('Location: cadastrar-deck.php?erro=db');
    exit;

} catch (PDOException $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    header('Location: cadastrar-deck.php?erro=db-conexao');
    exit;
}