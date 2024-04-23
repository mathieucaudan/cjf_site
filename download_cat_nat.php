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
    $titre = isset($_GET['title']) ? $_GET['title'] : "Résultats Natation"; // Titre par défaut si non spécifié dans l'URL
    $fileName = isset($_GET['file']) ? $_GET['file'] : ""; // Nom du fichier JSON
    $categorie = isset($_GET['cat']) ? $_GET['cat'] : ""; // Catégorie à Télécharger

    // Ajout du titre dans l'en-tête du PDF
    echo '<h1>' . $titre . '</h1>';
    echo '<img src="data:image/png;base64,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" alt="logo cjf" style="position: absolute; top: 10px; right: 10px; width: 200px; height: auto;">';


    echo '<p style="text-align: right;">Date: ' . date("d-m-Y") . '</p>';

    // Ajouter le copyright en bas de page
    echo '<p style="position: fixed; bottom: 20px; width: 100%; text-align: center;">© ' . date("Y") . ' CJF Saint-Malo PM</p>';

    if (!empty($fileName) && file_exists($fileName)) {
        $data = json_decode(file_get_contents($fileName), true);

        // Vérifier si des données existent dans le fichier JSON
        if (!empty($data)) {

            // Vérifier si la catégorie spécifiée existe dans les données
            if (isset($data[$categorie])) {
                echo '<h2>' . $categorie . '</h2>';
                echo '<table>';
                echo '<tr>';
                echo '<th>Nom</th>';
                echo '<th>Temps de Natation</th>';
                echo '<th>Points</th>';
                echo '<th>Différence avec le leader</th>';
                echo '</tr>';
                foreach ($data[$categorie] as $athlete) {
                    echo '<tr>';
                    echo '<td>' . $athlete['nom'] . '</td>';
                    echo '<td>' . (isset($athlete['temps_natation']) ? $athlete['temps_natation'] : '') . '</td>';
                    echo '<td>' . (isset($athlete['points_nat']) ? $athlete['points_nat'] : '') . '</td>';
                    echo '<td>' . (isset($athlete['diff_points_leader']) ? $athlete['diff_points_leader'] : '') . '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            } else {
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
    $filename = $titre . '.pdf';

    // Télécharger le fichier PDF
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    echo $dompdf->output();
} else {
    echo "<p>Aucune donnée disponible.</p>";
}
