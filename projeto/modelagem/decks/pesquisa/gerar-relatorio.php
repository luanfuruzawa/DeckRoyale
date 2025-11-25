<?php
require __DIR__ . "../../../../vendor/autoload.php"; 

use Dompdf\Dompdf;
 
ob_start();
require __DIR__ . "/relatorio-deck.php"; 
$html = ob_get_clean();  
 
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4');
$dompdf->render();
 
$filename = 'Relatorio-decks-' . date('dmY') . '.pdf';
$dompdf->stream($filename, ['Attachment' => 1]);
exit;
