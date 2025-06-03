<?php
include 'fonction.php';
entete();
echo "<link rel='stylesheet' href='style/parametres.css'>";
navbar();
echo "<body style='background-color: rgb(32, 47, 74); color:white'>";
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
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

            // Ajout du titre dans l'en-tête du PDF
            echo '<h1>' . $titre . '</h1>';


            if (!empty($fileName) && file_exists($fileName)) {
                $data = json_decode(file_get_contents($fileName), true);

                // Vérifier si des données existent dans le fichier JSON
                if (!empty($data)) {
                    foreach ($data as $categorie => $athletes) {
                        echo '<center>';
                        echo '<h2>' . $categorie . '</h2>';
                        echo '<table style="width: 90%;">';
                        echo '<tr style="color: rgb(32, 47, 74)";>';
                        echo '<th>Nom</th>';
                        echo '<th>Club</th>';
                        echo '<th>Temps de Natation</th>';
                        echo '<th>Points de Natation</th>';
                        echo '<th>Temps de Laser Run</th>';
                        echo '<th>Points de Laser Run</th>';
                        echo '<th>Points Total</th>';
                        echo '</tr>';
                        foreach ($athletes as $athlete) {
                            echo '<tr>';
                            echo '<td>' . $athlete['nom'] . '</td>';
                            echo '<td>' . $athlete['club'] . '</td>';
                            echo '<td>' . (isset($athlete['temps_natation_brut']) ? $athlete['temps_natation_brut'] : '') . '</td>';
                            echo '<td>' . (isset($athlete['points_nat']) ? $athlete['points_nat'] : '') . '</td>';
                            echo '<td>' . (isset($athlete['temps_laser_run']) ? $athlete['temps_laser_run'] : '') . '</td>';
                            echo '<td>' . (isset($athlete['points_lr']) ? $athlete['points_lr'] : '') . '</td>';
                            echo '<td>' . (isset($athlete['total']) ? $athlete['total'] : '') . '</td>';
                            echo '</tr>';
                        }
                        echo '</table>';
                        echo '</center>';
                    }
                    echo "<center><a class='w3-button' href='download_lr.php?file=$fileName&title=$titre' target='_blank'>Télécharger en PDF</a>";
                    echo "<a class='w3-button' href='compet.php'>Retour à l'accueil</a></center>";
                } else {
                    echo "<p>Aucune donnée disponible.</p>";
                }
            } else {
                echo "<p>Fichier introuvable.</p>";
            }
        } else {
            echo "<p>Aucune donnée disponible.</p>";
        }
    }
} else {
    echo "<div class='w3-center w3-padding-48 w3-xxlarge' style='background-color: rgb(32, 47, 74); color: white;'>
  <h2 class='w3-center'>Autorisation non accordée</h2>
  </div>";
}
footer();
echo "</body>";
