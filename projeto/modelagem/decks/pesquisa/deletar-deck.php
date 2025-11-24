<?php

session_start();
require_once __DIR__ . '/../../src/conexao-bd.php';
require_once __DIR__ . '/../../src/Repositorio/DeckRepositorio.php';
require_once __DIR__ . '/../../src/Repositorio/UsuarioRepositorio.php';
require_once __DIR__ . '/../../src/Modelo/carta.php';
require_once __DIR__ . '/../../src/Modelo/deck.php';
require_once __DIR__ . '/../../src/Modelo/usuario.php';

$id = trim($_POST['id-deck'] ?? '');
$id = (int) $id;

$repo = new DeckRepositorio($pdo);

try {
    if ($id <= 0) {
        throw new Exception('ID de deck inválido');
    }

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
 
    $deck = $repo->buscarPorId($id);
    if ($deck === null) {
        throw new Exception('Deck não encontrado');
    }
    if ($deck->getUsuarioId() !== $usuario->getId()) {
        throw new Exception('Ação não autorizada');
    }
 
    $deleted = $repo->deletar($id);
    if ($deleted === false) {
        throw new Exception('Falha ao deletar o deck');
    }

    $pdo->commit();

    header('Location: pesquisa-deck.php?sucesso=ok');
    exit;

} catch (PDOException $e) { 
    error_log('[PDOException] deletar-deck.php: ' . $e->getMessage());
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    header('Location: pesquisa-deck.php?erro=db-conexao');
    exit;
} catch (Exception $e) { 
    error_log('[Exception] deletar-deck.php: ' . $e->getMessage());
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    header('Location: pesquisa-deck.php?erro=deletar');
    exit;
}