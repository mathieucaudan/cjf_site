<?php
// Chemin vers le fichier JSON
$fichier = './competitions/Championnat de france de Triathlé 2025/athletes.json';


// Vérifie que le fichier existe
if (!file_exists($fichier)) {
    die("Fichier JSON non trouvé : $fichier");
}

// Charge et décode le JSON
$json = file_get_contents($fichier);
$data = json_decode($json, true);

// Tableau pour compter les clubs
$clubCounts = [];
$totalParticipants = 0;

// Parcours des catégories et des participants
foreach ($data as $categorie => $participants) {
    foreach ($participants as $personne) {
        $club = $personne['club'] ?? 'Inconnu';
        $clubCounts[$club] = ($clubCounts[$club] ?? 0) + 1;
        $totalParticipants++;
    }
}

// Tri décroissant
arsort($clubCounts);

// Affichage
echo "<h1>Nombre de participants par club</h1><ul>";
foreach ($clubCounts as $club => $nb) {
    echo "<li><strong>$club</strong> : $nb participant(s)</li>";
}
echo "</ul>";

// Affichage du total
echo "<h2>Total général : $totalParticipants participant(s)</h2>";