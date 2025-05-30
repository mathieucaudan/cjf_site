<?php
// Chemin du fichier JSON
$jsonFile = 'resultats.json'; // remplace avec le chemin réel si besoin

// Lire et décoder le contenu JSON
$jsonContent = file_get_contents($jsonFile);
$data = json_decode($jsonContent, true);

$clubs = [];

// Parcours de chaque catégorie
foreach ($data as $categorie => $participants) {
    foreach ($participants as $participant) {
        if (isset($participant['club']) && !in_array($participant['club'], $clubs)) {
            $clubs[] = $participant['club'];
        }
    }
}

// Tri des clubs
sort($clubs);

// Affichage
echo "<h2>Liste des clubs :</h2><ul>";
foreach ($clubs as $club) {
    echo "<li>" . htmlspecialchars($club) . "</li>";
}
echo "</ul>";
?>
