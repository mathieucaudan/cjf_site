<?php
if (!isset($_GET['file']) || !file_exists($_GET['file'])) {
    header('Content-Type: text/plain');
    echo "Fichier non trouvé.";
    exit();
}

$athletes_data = json_decode(file_get_contents($_GET['file']), true);

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="resultats_natation.csv"');

$output = fopen('php://output', 'w');
fputcsv($output, ['Place', 'Nom', 'Prénom', 'Catégorie']);

foreach ($athletes_data as $categorie => $athletes) {
    // Tri décroissant des points
    usort($athletes, fn($a, $b) => ($b['points_nat'] ?? 0) <=> ($a['points_nat'] ?? 0));

    $place = 1;
    foreach ($athletes as $athlete) {
        $nom = $athlete['nom'];
        $prenom = $athlete['prenom'] ?? '';
        $points = $athlete['points_nat'] ?? 0;

        // Ignorer les DNS ou DNF
        if (!is_numeric($points) || $points <= 0) continue;

        fputcsv($output, [$place++, $nom, $prenom, $categorie]);
    }
}

fclose($output);
exit();
