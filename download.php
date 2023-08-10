<?php
if (isset($_POST['download']) && isset($_POST['pdf'])) {
    $pdfFile = rawurldecode($_POST['pdf']);
    $filePath = './article/article_pdf/' . $pdfFile;

    if (file_exists($filePath)) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $pdfFile . '"');
        readfile($filePath);
        exit;
    } else {
        echo "Fichier non trouvé.";
    }
} 
?>
