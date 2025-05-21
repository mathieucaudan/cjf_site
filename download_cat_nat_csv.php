<?php
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

// Trier par points natation (décroissant)
usort($athletes, fn($a, $b) => ($b['points_nat'] ?? 0) <=> ($a['points_nat'] ?? 0));

// Préparer envoi CSV
header('Content-Type: text/csv');
$filename = "resultats_natation_" . str_replace(' ', '_', $categorie) . ".csv";
header("Content-Disposition: attachment; filename=\"$filename\"");

$output = fopen('php://output', 'w');
fputcsv($output, ['Place', 'Nom', 'Prénom', 'Catégorie']);

$place = 1;
foreach ($athletes as $athlete) {
    $nom = $athlete['nom'];
    $prenom = $athlete['prenom'] ?? '';
    $points = $athlete['points_nat'] ?? 0;

    // Ignorer DNS/DNF
    if (!is_numeric($points) || $points <= 0) continue;

    fputcsv($output, [$place++, $nom, $prenom, $categorie]);
}

fclose($output);
exit();
