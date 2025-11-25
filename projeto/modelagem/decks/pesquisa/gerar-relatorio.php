<?php
require __DIR__ . "../../../../vendor/autoload.php"; // Caminho correto

use Dompdf\Dompdf;

// Captura o HTML do relatório
ob_start();
require __DIR__ . "/relatorio-deck.php"; // Inclui conteúdo HTML do relatório
$html = ob_get_clean(); // Aqui pega tudo que foi gerado pelo require

// Cria PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4');
$dompdf->render();

// Envia PDF para download
$filename = 'Relatorio-decks-' . date('dmY') . '.pdf';
$dompdf->stream($filename, ['Attachment' => 1]);
exit;
