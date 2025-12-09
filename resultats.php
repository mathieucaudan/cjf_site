<?php
include 'fonction.php';
entete();
echo "<link rel='stylesheet' href='style/parametres.css'>";
navbar();
echo "<body style='background-color: rgb(32, 47, 74); color:white'>";

if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {

    // Style tableau
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
        color: black;
    }
    </style>";

    if (isset($_GET['title']) && isset($_GET['file']) && isset($_GET['discipline'])) {

        $titre = $_GET['title'];
        $fileName = $_GET['file'];
        $discipline = $_GET['discipline']; // ⭐ très important pour savoir si LR ou Triathlé

        echo "<h1>$titre</h1>";

        if (!empty($fileName) && file_exists($fileName)) {

    $data = json_decode(file_get_contents($fileName), true);

    if (!empty($data["athletes"])) {

        // 🔹 On regroupe les athlètes par catégorie
        $grouped = [];

        foreach ($data["athletes"] as $athlete) {
            $cat = $athlete["categorie"] ?? "Inconnu";
            if (!isset($grouped[$cat])) $grouped[$cat] = [];
            $grouped[$cat][] = $athlete;
        }

        // 🔹 Tri des catégories par ordre alphabétique
        ksort($grouped);

        foreach ($grouped as $categorie => $athletes) {

            echo "<center>";
            echo "<h2>" . ucfirst($categorie) . "</h2>";
            echo '<table style="width: 90%;">';

            echo "<tr>";
            echo "<th>Nom</th>";
            echo "<th>Club</th>";

            // 🔹 Colonnes Natation UNIQUEMENT pour Triathlé
            if ($discipline === "triathle") {
                echo "<th>Temps de Natation</th>";
                echo "<th>Points de Natation</th>";
            }

            // 🔹 Colonnes Laser Run
            echo "<th>Temps de Laser Run</th>";
            echo "<th>Points de Laser Run</th>";

            // 🔹 Total UNIQUEMENT pour Triathlé
            if ($discipline === "triathle") {
                echo "<th>Total Points</th>";
            }

            echo "</tr>";

            // 🔹 Athlètes de la catégorie
            foreach ($athletes as $athlete) {
                echo "<tr>";

                echo "<td>" . $athlete['nom'] . "</td>";
                echo "<td>" . $athlete['club'] . "</td>";

                // 🔹 Natation (si Triathlon)
                if ($discipline === "triathle") {
                    echo "<td>" . ($athlete['temps_natation_brut'] ?? '') . "</td>";
                    echo "<td>" . ($athlete['points_nat'] ?? '') . "</td>";
                }

                // 🔹 Laser Run
                echo "<td>" . ($athlete['temps_laser_run'] ?? '') . "</td>";
                echo "<td>" . ($athlete['points_lr'] ?? '') . "</td>";

                // 🔹 Total (Triathlon uniquement)
                if ($discipline === "triathle") {
                    echo "<td>" . ($athlete['total'] ?? '') . "</td>";
                }

                echo "</tr>";
            }

            echo "</table>";
            echo "</center>";
        }

        echo "<center>
                <a class='w3-button w3-blue' href='download_lr.php?file=$fileName&title=$titre&discipline=$discipline' target='_blank'>Télécharger en PDF</a>
                <a class='w3-button w3-gray' href='compet.php'>Retour à l'accueil</a>
              </center>";

    } else {
        echo "<p>Aucune donnée disponible.</p>";
    }

} else {
    echo "<p>Fichier introuvable.</p>";
}


    } else {
        echo "<p>Aucune donnée disponible.</p>";
    }

} else {
    echo "<div class='w3-center w3-padding-48 w3-xxlarge'>
            <h2>Autorisation non accordée</h2>
          </div>";
}

footer();
echo "</body>";
?>
