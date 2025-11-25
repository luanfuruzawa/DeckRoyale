<?php
// Inclui arquivos do banco e modelos
require __DIR__ . "../../../src/conexao-bd.php";
require __DIR__ . "../../../src/Modelo/Deck.php";
require __DIR__ . "../../../src/Repositorio/DeckRepositorio.php";

date_default_timezone_set('America/Sao_Paulo');
$rodapeDataHora = date('d/m/Y H:i');

$deckRepositorio = new DeckRepositorio($pdo);
$decks = $deckRepositorio->buscarTodos();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <style>
        body, table, th, td, h3 { font-family: Arial, Helvetica, sans-serif; }
        table { width: 90%; margin: auto; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; font-size: 12px; }
        th { font-weight: bold; text-align: left; }
        h3 { text-align: center; margin-top: 0.5rem; margin-bottom: 1rem; }
        .pdf-footer { text-align: center; font-size: 12px; margin-top: 20px; }
    </style>
</head>
<body>
    <h3>Listagem de Decks</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Usuário</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($decks as $deck): ?>
            <tr>
                <td><?= htmlspecialchars($deck->getId()) ?></td>
                <td><?= htmlspecialchars($deck->getNome()) ?></td>
                <td><?= htmlspecialchars($deck->getUsuarioId()) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="pdf-footer">Gerado em: <?= htmlspecialchars($rodapeDataHora) ?></div>
</body>
</html>
