<?php
require 'vendor/autoload.php'; // Assure-toi que PhpSpreadsheet est bien installé

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (!isset($_GET['file'], $_GET['cat']) || !file_exists($_GET['file'])) {
    header('Content-Type: text/plain');
    echo "Fichier ou catégorie manquants.";
    exit();
}

$file = $_GET['file'];
$categorie = $_GET['cat'];

$athletes_data = json_decode(file_get_contents($file), true);
if (!isset($athletes_data[$categorie])) {
    header('Content-Type: text/plain');
    echo "Catégorie non trouvée.";
    exit();
}

$athletes = $athletes_data[$categorie];

// Création du fichier Excel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle(substr($categorie, 0, 31)); // Titre max 31 caractères

// En-têtes
$sheet->fromArray(['Nom', 'Prénom'], NULL, 'A1');

// Remplissage
$row = 2;
foreach ($athletes as $athlete) {
    $nom = strtoupper($athlete['nom'] ?? '');
    $prenom = ucfirst(strtolower($athlete['prenom'] ?? ''));

    $sheet->setCellValue("A$row", $nom);
    $sheet->setCellValue("B$row", $prenom);
    $row++;
}

// Envoi au navigateur
$filename = "athletes_natation_" . str_replace(' ', '_', $categorie) . ".xlsx";
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit();
