<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;

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

// Tri par points de natation décroissants
usort($athletes, fn($a, $b) => ($b['points_nat'] ?? 0) <=> ($a['points_nat'] ?? 0));

// Excel init
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle(substr($categorie, 0, 31));

// En-têtes
$headers = ['Dossard', 'Nom', 'Prénom', 'Club', 'Sexe', 'Nationalité', 'Catégorie', 'Course'];
$sheet->fromArray($headers, NULL, 'A1');

// Format des en-têtes
$headerStyle = $sheet->getStyle('A1:H1');
$headerStyle->getFont()->setBold(true);
$headerStyle->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$headerStyle->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
$sheet->setAutoFilter('A1:H1');

// Lignes de données
$row = 2;
$dossard = 1;

// Déduction sexe
$categorie_parts = explode(' ', $categorie);
$dernier_mot = mb_strtolower(end($categorie_parts));
$sexe = match ($dernier_mot) {
    'filles', 'femmes' => 'F',
    'garçons', 'garcons', 'hommes' => 'M',
    default => '',
};

foreach ($athletes as $athlete) {
    $points = $athlete['points_nat'] ?? 0;
    if (!is_numeric($points) || $points <= 0) continue;

    $nom_complet = trim($athlete['nom'] ?? '');
    $prenom = trim($athlete['prenom'] ?? '');

    // Traitement nom/prénom fusionné
    if (empty($prenom) && str_contains($nom_complet, ' ')) {
        $parts = preg_split('/\s+/', $nom_complet);
        $nom_parts = [];
        $prenom_parts = [];

        foreach ($parts as $part) {
            if ($part === mb_strtoupper($part)) {
                $nom_parts[] = $part;
            } else {
                $prenom_parts[] = $part;
            }
        }

        $nom = implode(' ', $nom_parts);
        $prenom = implode(' ', $prenom_parts);
    } else {
        $nom = $nom_complet;
    }

    $nom_final = strtoupper($nom);
    $prenom_final = ucwords(mb_strtolower($prenom));

    $club = $athlete['club'] ?? '';
    $nationalite = 'FRA';
    $categorie_simple = $categorie_parts[0];
    $course = $categorie;

    // Ligne dans Excel
    $sheet->fromArray([
        $dossard++, $nom_final, $prenom_final, $club, $sexe, $nationalite, $categorie_simple, $course
    ], NULL, "A$row");

    // Bordures pour chaque ligne
    $sheet->getStyle("A$row:H$row")
        ->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    
    $row++;
}

// Auto-size des colonnes
foreach (range('A', 'H') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Téléchargement
$filename = "resultats_natation_" . str_replace(' ', '_', $categorie) . ".xlsx";
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit();
