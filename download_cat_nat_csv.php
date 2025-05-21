<?php
require 'vendor/autoload.php'; // Assure-toi que PhpSpreadsheet est installé

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

// Tri par points_nat décroissant
usort($athletes, fn($a, $b) => ($b['points_nat'] ?? 0) <=> ($a['points_nat'] ?? 0));

// Création Excel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Résultats');

// En-têtes
$sheet->fromArray(['Place', 'Nom', 'Prénom', 'Catégorie'], NULL, 'A1');

// Remplissage
$row = 2;
$place = 1;
foreach ($athletes as $athlete) {
    $points = $athlete['points_nat'] ?? 0;
    if (!is_numeric($points) || $points <= 0) continue;

    $nom = $athlete['nom'] ?? '';
    $prenom = $athlete['prenom'] ?? '';
    $sheet->fromArray([$place++, $nom, $prenom, $categorie], NULL, "A$row");
    $row++;
}

// Envoi du fichier
$filename = "resultats_natation_" . str_replace(' ', '_', $categorie) . ".xlsx";
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit();
