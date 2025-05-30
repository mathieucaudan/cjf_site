<?php
session_start();

use Dompdf\Dompdf;

// Inclure la bibliothèque Dompdf
require_once 'dompdf/autoload.inc.php';

ob_start();
echo "<style>
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table, th, td {
    border: 1px solid black;
}

th, td {
    padding: 10px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
    font-weight: bold;
}
</style>";
if (isset($_GET['title']) && isset($_GET['file'])) {
    $titre = isset($_GET['title']) ? $_GET['title'] : "Résultats Natation";
    $titredoc = isset($_GET['titledoc']) ? $_GET['titledoc'] : "Résultats Natation";// Titre par défaut si non spécifié dans l'URL
    $fileName = isset($_GET['file']) ? $_GET['file'] : ""; // Nom du fichier JSON
    $categorie = isset($_GET['cat']) ? $_GET['cat'] : ""; // Catégorie à Télécharger

    // Ajout du titre dans l'en-tête du PDF
    echo '<h1>' . $titre . '</h1>';


    echo '<p style="text-align: right;">Date: ' . date("d-m-Y") . '</p>';

    // Ajouter le copyright en bas de page
    echo '<p style="position: fixed; bottom: 20px; width: 100%; text-align: center;">© ' . date("Y") . ' CJF Saint-Malo PM</p>';

    if (!empty($fileName) && file_exists($fileName)) {
        $data = json_decode(file_get_contents($fileName), true);

        // Vérifier si des données existent dans le fichier JSON
        if (!empty($data)) {

            if (isset($data[$categorie])) {
    $athletes = $data[$categorie];

    // Déterminer le score max (leader)
    usort($athletes, function($a, $b) {
        return $b['points_nat'] <=> $a['points_nat'];
    });

    $leader_points = $athletes[0]['points_nat'];

    // Ajouter la différence au tableau
    foreach ($athletes as &$athlete) {
        $athlete['diff_points_leader'] = $leader_points - $athlete['points_nat'];
    }

    // Réaffecter au tableau initial
    $data[$categorie] = $athletes;

    // Affichage
    echo '<h2>' . $categorie . '</h2>';
    echo '<table>';
    echo '<tr>';
    echo '<th>Nom</th>';
    echo '<th>Club</th>';
    echo '<th>Temps de Natation</th>';
    echo '<th>Points</th>';
    echo '<th>Différence avec le leader</th>';
    echo '</tr>';

    foreach ($data[$categorie] as $athlete) {
        echo '<tr>';
        echo '<td>' . $athlete['nom'] . '</td>';
        echo '<td>' . $athlete['club'] . '</td>';
        echo '<td>' . $athlete['temps_natation'] . '</td>';
        echo '<td>' . $athlete['points_nat'] . '</td>';

        echo '<td>';
        $diff = $athlete['diff_points_leader'];

        if ($diff > 90) {
            $additional = $diff - 90;
            echo "1'30 (+$additional)";
        } else {
            $min = floor($diff / 60);
            $sec = $diff % 60;
            echo sprintf("%d'%02d", $min, $sec);
        }

        echo '</td>';
        echo '</tr>';
    }
    echo '</table>';
}

             else {
                echo "<p>Aucune donnée disponible pour la catégorie spécifiée.</p>";
            }
        } else {
            echo "<p>Aucune donnée disponible.</p>";
        }
    } else {
        echo "<p>Fichier introuvable.</p>";
    }




    // Créer le PDF
    $dompdf = new Dompdf();
    $dompdf->loadHtml(ob_get_clean());
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Nom du fichier PDF à télécharger
    $filename = $titredoc . '.pdf';

    // Télécharger le fichier PDF
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    echo $dompdf->output();
} else {
    echo "<p>Aucune donnée disponible.</p>";
}
