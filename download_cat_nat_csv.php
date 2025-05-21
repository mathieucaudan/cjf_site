<?php
require 'vendor/autoload.php'; // Autoload PhpSpreadsheet

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

// Trier par points de natation décroissants
usort($athletes, fn($a, $b) => ($b['points_nat'] ?? 0) <=> ($a['points_nat'] ?? 0));

// Création du fichier Excel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle(substr($categorie, 0, 31)); // Excel limite à 31 caractères

// En-têtes
$sheet->fromArray(['Place', 'Nom', 'Prénom', 'Catégorie'], NULL, 'A1');

// Ligne de départ
$row = 2;
$place = 1;

foreach ($athletes as $athlete) {
    $points = $athlete['points_nat'] ?? 0;

    // On ignore les DNS / DNF ou ceux sans points
    if (!is_numeric($points) || $points <= 0) continue;

    $nom_complet = trim($athlete['nom'] ?? '');
    $prenom = trim($athlete['prenom'] ?? '');
    
    if (empty($prenom) && str_contains($nom_complet, ' ')) {
        $parts = preg_split('/\s+/', $nom_complet);
        $nom_parts = [];
        $prenom_parts = [];
    
        foreach ($parts as $part) {
            $first_letter = mb_substr($part, 0, 1);
            if ($first_letter === mb_strtoupper($first_letter)) {
                $nom_parts[] = $part;
            } else {
                $prenom_parts[] = $part;
            }
        }
    
        $nom_complet = implode(' ', $nom_parts);
        $prenom = implode(' ', $prenom_parts);
    }
    
    // Mise en forme finale
    $nom_final = strtoupper($nom_complet);
    $prenom_final = ucwords(strtolower($prenom)); // Jean-Michel par exemple


    // Ajout à la ligne
    $sheet->fromArray([$place++, $nom_final, $prenom_final, $categorie], NULL, "A$row");
    $row++;
}

// Envoi du fichier Excel
$filename = "resultats_natation_" . str_replace(' ', '_', $categorie) . ".xlsx";
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit();
