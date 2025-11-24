<?php

session_start();
require_once __DIR__ . '/../../src/conexao-bd.php';
require_once __DIR__ . '/../../src/Repositorio/DeckRepositorio.php';
require_once __DIR__ . '/../../src/Repositorio/UsuarioRepositorio.php';
require_once __DIR__ . '/../../src/Modelo/carta.php';
require_once __DIR__ . '/../../src/Modelo/deck.php';
require_once __DIR__ . '/../../src/Modelo/usuario.php';

$nomeDeck = trim($_POST['nome-deck'] ?? '');
$cartasIds = $_POST['cartas-ids'] ?? [];

if (!isset($_SESSION['usuario']) || $nomeDeck === '' || count($cartasIds) !== 8) {
    header('Location: montagem.php?erro=dados-invalidos');
    exit;
}

$repo = new DeckRepositorio($pdo);

try {
    $pdo->beginTransaction();

    $emailLogado = $_SESSION['usuario'] ?? null;
    if ($emailLogado === null) {
        throw new Exception('Usuário não autenticado');
    }
    $usuarioRepo = new UsuarioRepositorio($pdo);
    $usuario = $usuarioRepo->buscarPorEmail($emailLogado);
    if ($usuario === null) {
        throw new Exception('Usuário não encontrado');
    }

    $deck = new Deck(null, $nomeDeck, $usuario->getId());
    $repo->salvar($deck);

    $idDeck = $deck->getId();

    foreach ($cartasIds as $idCarta) {
        
        $repo->adicionarCarta($idDeck, $idCarta);
    }

    $pdo->commit();

    header('Location: montagem.php?sucesso=ok');
    exit;

} catch (Exception $e) {
    // 9. Rollback em caso de erro
    if ($pdo->inTransaction()) {
        $pdo->rollBack(); // Desfaz a criação do deck e quaisquer cartas que já foram inseridas.
    }

    header('Location: montagem.php?erro=db');
    exit;

} catch (PDOException $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    header('Location: montagem.php?erro=db-conexao');
    exit;
}