<?php
// Téléchargement d'un article PDF (bouton « Télécharger le PDF » de la page Articles).
if (isset($_POST['download'], $_POST['pdf'])) {
    // basename() empêche de sortir du dossier des articles (../athletes.json, etc.)
    $pdfFile = basename(rawurldecode((string) $_POST['pdf']));
    $filePath = __DIR__ . '/article/article_pdf/' . $pdfFile;

    if (strtolower(pathinfo($pdfFile, PATHINFO_EXTENSION)) === 'pdf' && is_file($filePath)) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . str_replace('"', '', $pdfFile) . '"');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    }
}
http_response_code(404);
echo "Fichier non trouvé.";
