<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

if (!isset($_GET['file'], $_GET['cat']) || !file_exists($_GET['file'])) {
    header('Content-Type: text/plain');
    echo "Fichier ou catégorie manquants.";
    exit();
}

$file = $_GET['file'];
// Récupération + normalisation de la catégorie
$categorie = mb_strtolower(trim($_GET['cat']));
$categorie = strtr($categorie, [
    'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e',
    'à' => 'a', 'â' => 'a',
    'î' => 'i', 'ï' => 'i',
    'ô' => 'o',
    'ù' => 'u', 'û' => 'u',
    'ç' => 'c'
]);



// Liste ordonnée des catégories
$categories = [
    "u11 filles"     => 1,
    "u11 garcons"    => 1.06,
    "u13 filles"     => 2,
    "u13 garcons"    => 3,
    "m70 femmes"     => 4,
    "m70 hommes"     => 5,
    "m60 femmes"     => 6,
    "m60 hommes"     => 7,
    "para femmes"    => 8,
    "para hommes"    => 8.04,
    "m40 femmes"     => 9,
    "m40 hommes"     => 10,
    "m50 femmes"     => 11,
    "m50 hommes"     => 12,
    "u15 filles"     => 13,
    "u15 garcons"    => 14,
    "u17 filles"     => 15,
    "u17 garcons"    => 16,
    "u19 femmes"     => 17,
    "u22 femmes"     => 19,
    "senior femmes"  => 20,
    "u19 hommes"     => 21,
    "u22 hommes"     => 22,
    "senior hommes"  => 23
];




// Vérification dans le dictionnaire
if (!array_key_exists($categorie, $categories)) {
    header('Content-Type: text/plain');
    echo "Catégorie non reconnue.";
    exit();
}


$athletes = $athletes_data[$categorie];
usort($athletes, fn($a, $b) => ($b['points_nat'] ?? 0) <=> ($a['points_nat'] ?? 0));

// Excel init
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle(substr($categorie, 0, 31));

// En-têtes
$headers = ['Dossard', 'Nom', 'Prénom', 'Club', 'Sexe', 'Nationalité', 'Catégorie', 'Course'];
$sheet->fromArray($headers, NULL, 'A1');

// Format des en-têtes
$sheet->getStyle('A1:H1')->applyFromArray([
    'font' => ['bold' => true],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
]);
$sheet->setAutoFilter('A1:H1');

// Sexe
$categorie_parts = explode(' ', $categorie);
$dernier_mot = mb_strtolower(end($categorie_parts));
$sexe = match ($dernier_mot) {
    'filles', 'femmes' => 'F',
    'garçons', 'garcons', 'hommes' => 'M',
    default => '',
};

$row = 2;
$prefix_dossard = $categories[$categorie] * 100;
 
$compteur = 1;

foreach ($athletes as $athlete) {
    $points = $athlete['points_nat'] ?? 0;
    if (!is_numeric($points) || $points <= 0) continue;

    $nom_complet = trim($athlete['nom'] ?? '');
    $prenom = trim($athlete['prenom'] ?? '');

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
    $dossard = $prefix_dossard + $compteur++;

    $sheet->fromArray([
        $dossard, $nom_final, $prenom_final, $club, $sexe, $nationalite, $categorie_simple, $course
    ], NULL, "A$row");

    $sheet->getStyle("A$row:H$row")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    $row++;
}

// Auto-size
foreach (range('A', 'H') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Export
$filename = "resultats_natation_" . str_replace(' ', '_', $categorie) . ".xlsx";
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit();
