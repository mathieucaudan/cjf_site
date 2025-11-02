<?php
session_start();

use Dompdf\Dompdf;

// Inclure la bibliothèque Dompdf
require_once 'dompdf/autoload.inc.php';

ob_start();
echo "<style>
body {
    font-family: Arial, sans-serif;
    font-size: 12px;
}
h1 {
    text-align: center;
    margin-bottom: 30px;
}
h2 {
    background-color: #f2f2f2;
    padding: 6px;
    border-radius: 5px;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 25px;
}

table, th, td {
    border: 1px solid black;
}

th, td {
    padding: 8px;
    text-align: left;
}

th {
    background-color: #e8e8e8;
    font-weight: bold;
}
</style>";

if (isset($_GET['title']) && isset($_GET['file'])) {
    $titre = $_GET['title'] ?? "Résultats Laser Run";
    $titredoc = $_GET['titledoc'] ?? "Résultats Laser Run";
    $fileName = $_GET['file'] ?? "";

    echo '<h1>' . htmlspecialchars($titre) . '</h1>';
    echo '<p style="text-align: right;">Date : ' . date("d-m-Y") . '</p>';

    if (!empty($fileName) && file_exists($fileName)) {
        $data = json_decode(file_get_contents($fileName), true);

        if (!empty($data)) {
            foreach ($data as $categorie => $athletes) {
                echo '<h2>' . htmlspecialchars(strtoupper($categorie)) . '</h2>';
                echo '<table>';
                echo '<tr>';
                echo '<th>Nom</th>';
                echo '<th>Club</th>';
                echo '<th>Temps Laser Run</th>';
                echo '<th>Points Laser Run</th>';
                echo '<th>Total</th>';
                echo '</tr>';

                foreach ($athletes as $athlete) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($athlete['nom'] ?? '') . '</td>';
                    echo '<td>' . htmlspecialchars($athlete['club'] ?? '') . '</td>';
                    echo '<td>' . htmlspecialchars($athlete['temps_laser_run'] ?? '') . '</td>';
                    echo '<td>' . htmlspecialchars($athlete['points_lr'] ?? '') . '</td>';
                    echo '<td>' . htmlspecialchars($athlete['total'] ?? '') . '</td>';
                    echo '</tr>';
                }

                echo '</table>';
            }
        } else {
            echo "<p>Aucune donnée disponible dans le fichier.</p>";
        }
    } else {
        echo "<p>Fichier introuvable.</p>";
    }

    echo '<p style="position: fixed; bottom: 20px; width: 100%; text-align: center;">© ' . date("Y") . ' CJF Saint-Malo PM</p>';

    // Création du PDF
    $dompdf = new Dompdf();
    $dompdf->loadHtml(ob_get_clean());
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $filename = $titredoc . '.pdf';
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    echo $dompdf->output();
} else {
    echo "<p>Aucune donnée disponible.</p>";
}
?>
