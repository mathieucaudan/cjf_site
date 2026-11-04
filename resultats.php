<?php
include 'fonction.php';
exiger_admin('Résultats');

$titre = $_GET['title'] ?? 'Résultats';
$fichier = fichier_competition($_GET['file'] ?? '');
$discipline = ($_GET['discipline'] ?? '') === 'triathle' ? 'triathle' : 'laserrun';
$relatif = $fichier ? 'competitions/' . substr($fichier, strlen(realpath(__DIR__ . '/competitions')) + 1) : '';

entete($titre);
navbar();
bandeau($titre, $discipline === 'triathle' ? 'Triathlé : natation et laser run, classés par catégorie.' : 'Laser run, classé par catégorie.', true);
echo "<section class='section section--serre'><div class='wrap'>";
echo "<p class='fil'><a href='compet.php'>Compétitions</a> / <a href='ouvrir_competition.php?discipline=$discipline'>Ouvrir</a> / Résultats</p>";

$data = $fichier ? (json_decode(file_get_contents($fichier), true) ?: []) : [];
if (!$fichier) {
    message_admin('Fichier de résultats introuvable.', 'erreur');
} elseif (empty($data['athletes'])) {
    echo "<div class='admin-panel'><p>Aucun athlète dans cette compétition pour le moment.</p></div>";
} else {
    // Regroupement par catégorie, catégories par ordre alphabétique
    $grouped = [];
    foreach ($data['athletes'] as $athlete) {
        $grouped[$athlete['categorie'] ?? 'Inconnu'][] = $athlete;
    }
    ksort($grouped);

    echo "<div class='boutons' style='margin-bottom:24px'>
            <a class='btn' href='download_lr.php?file=" . urlencode($relatif) . "&title=" . urlencode($titre) . "&discipline=$discipline' target='_blank'>Télécharger en PDF</a>
          </div>";

    foreach ($grouped as $categorie => $athletes) {
        echo "<div class='admin-panel'><h2 style='text-transform:capitalize'>" . e($categorie) . "</h2>";
        echo "<div class='tableau-conteneur'><table class='tableau tableau--empile'><thead><tr><th>Nom</th><th>Club</th>";
        if ($discipline === 'triathle') echo "<th>Temps natation</th><th>Points natation</th>";
        echo "<th>Temps laser run</th><th>Points laser run</th>";
        if ($discipline === 'triathle') echo "<th>Total</th>";
        echo "</tr></thead><tbody>";
        foreach ($athletes as $a) {
            echo "<tr><td data-title='Nom'>" . e($a['nom'] ?? '') . "</td><td data-title='Club'>" . e($a['club'] ?? '') . "</td>";
            if ($discipline === 'triathle') {
                echo "<td data-title='Temps natation'>" . e($a['temps_natation_brut'] ?? '') . "</td><td data-title='Points natation'>" . e($a['points_nat'] ?? '') . "</td>";
            }
            echo "<td data-title='Temps laser run'>" . e($a['temps_laser_run'] ?? '') . "</td><td data-title='Points laser run'>" . e($a['points_lr'] ?? '') . "</td>";
            if ($discipline === 'triathle') {
                echo "<td data-title='Total' class='perf'>" . e($a['total'] ?? '') . "</td>";
            }
            echo "</tr>";
        }
        echo "</tbody></table></div></div>";
    }
}

echo "</div></section>";
footer();
