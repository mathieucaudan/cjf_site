<?php
session_start();

use Dompdf\Dompdf;
require_once 'dompdf/autoload.inc.php';

ob_start();
echo "<style>
body {
    font-family: DejaVu Sans, sans-serif;
    font-size: 12px;
}
h1, h2 {
    text-align: center;
}
p {
    font-size: 11px;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 25px;
}
th, td {
    border: 1px solid #333;
    padding: 8px;
    text-align: center;
}
th {
    background-color: #f2f2f2;
    font-weight: bold;
}
tr:nth-child(even) {
    background-color: #f9f9f9;
}
.footer {
    position: fixed;
    bottom: 10px;
    width: 100%;
    text-align: center;
    font-size: 10px;
    color: #777;
}
</style>";

if (isset($_GET['title']) && isset($_GET['file'])) {
    $titre = $_GET['title'] ?? "Résultats Natation";
    $titredoc = $_GET['titledoc'] ?? "Résultats Natation";
    $fileName = $_GET['file'] ?? "";
    $categorie = $_GET['cat'] ?? "";

    echo "<h1>$titre</h1>";
    echo "<p style='text-align:right;'>Date : " . date("d/m/Y") . "</p>";

    if (!empty($fileName) && file_exists($fileName)) {
        $data = json_decode(file_get_contents($fileName), true);

        if (!empty($data)) {
            // --- Détection du format ---
            $isFlat = isset($data['athletes']) && is_array($data['athletes']);
            $grouped = [];

            if ($isFlat) {
                foreach ($data['athletes'] as $a) {
                    $cat = $a['categorie'] ?? 'Sans catégorie';
                    $grouped[$cat][] = $a;
                }
            } else {
                $grouped = $data;
            }

            // Vérifie que la catégorie existe
            if (isset($grouped[$categorie])) {
                echo "<h2>" . htmlspecialchars($categorie) . "</h2>";

                // Tri des athlètes par total décroissant
                usort($grouped[$categorie], fn($a, $b) => ($b['total'] ?? 0) <=> ($a['total'] ?? 0));

                echo "<table>
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Club</th>
                                <th>Temps Natation</th>
                                <th>Points Natation</th>
                                <th>Temps Laser Run</th>
                                <th>Points Laser Run</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>";

                foreach ($grouped[$categorie] as $athlete) {
                    echo "<tr>
                            <td>" . htmlspecialchars($athlete['nom'] ?? '') . "</td>
                            <td>" . htmlspecialchars($athlete['club'] ?? '') . "</td>
                            <td>" . htmlspecialchars($athlete['temps_natation'] ?? '') . "</td>
                            <td>" . htmlspecialchars($athlete['points_nat'] ?? '') . "</td>
                            <td>" . htmlspecialchars($athlete['temps_laser_run'] ?? '') . "</td>
                            <td>" . htmlspecialchars($athlete['points_lr'] ?? '') . "</td>
                            <td>" . htmlspecialchars($athlete['total'] ?? '') . "</td>
                          </tr>";
                }

                echo "</tbody></table>";
            } else {
                echo "<p>Aucune donnée trouvée pour la catégorie <b>" . htmlspecialchars($categorie) . "</b>.</p>";
            }
        } else {
            echo "<p>Aucune donnée disponible dans le fichier.</p>";
        }
    } else {
        echo "<p>Fichier introuvable.</p>";
    }

    echo "<div class='footer'>© " . date("Y") . " CJF Saint-Malo Pentathlon Moderne</div>";

    // --- Génération du PDF ---
    $dompdf = new Dompdf();
    $dompdf->loadHtml(ob_get_clean());
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $filename = $titredoc . ".pdf";
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    echo $dompdf->output();
    exit;
} else {
    echo "<p>Aucune donnée disponible.</p>";
}
?>
