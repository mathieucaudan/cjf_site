<?php
include 'fonction.php';
entete();
echo "<link rel='stylesheet' href='style/parametres.css'>";
navbar();
echo "<body style='background-color: rgb(32, 47, 74); color:white'>";

if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {

    $categories = array(
        'senior hommes' => ['lr' => 800],
        'senior femmes' => ['lr' => 800],
        'u22 hommes' => ['lr' => 800],
        'u22 femmes' => ['lr' => 800],
        'u19 hommes' => ['lr' => 800],
        'u19 femmes' => ['lr' => 800],
        'u17 hommes' => ['lr' => 630],
        'u17 femmes' => ['lr' => 630],
        'u15 garcons' => ['lr' => 460],
        'u15 filles' => ['lr' => 460],
        'u13 garcons' => ['lr' => 320],
        'u13 filles' => ['lr' => 320],
        'u11 garcons' => ['lr' => 240],
        'u11 filles' => ['lr' => 240],
        'u9 garcons' => ['lr' => 240],
        'u9 filles' => ['lr' => 240],
        'm40 hommes' => ['lr' => 690],
        'm40 femmes' => ['lr' => 690],
        'm50 hommes' => ['lr' => 690],
        'm50 femmes' => ['lr' => 690],
        'm60 hommes' => ['lr' => 320],
        'm60 femmes' => ['lr' => 320],
        'm70 hommes' => ['lr' => 240],
        'm70 femmes' => ['lr' => 240],
        'para hommes' => ['lr' => 800],
        'para femmes' => ['lr' => 800],
    );

    if (!isset($_GET["competition"])) {
        header("Location: creer_competition.php");
        exit();
    }

    $nom_competition = $_GET["competition"];
    $fileName = "competitions/{$nom_competition}/athletes.json";

    if (!file_exists($fileName)) {
        echo "<p>Aucune donnée d'athlète trouvée pour cette compétition.</p>";
        exit();
    }

    $athletes_data = json_decode(file_get_contents($fileName), true);

    // Traitement global à l'envoi du formulaire
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["temps_laser_run"])) {
        $base_pts_lr = 500;
        $temps_saisis = $_POST["temps_laser_run"];

        foreach ($athletes_data as $categorie => &$athletes) {
            foreach ($athletes as &$athlete) {
                $nom = $athlete['nom'];
                if (isset($temps_saisis[$nom]) && trim($temps_saisis[$nom]) !== "") {
                    $temps_lr = strtolower(trim($temps_saisis[$nom]));

                    if ($temps_lr === 'dns' || $temps_lr === 'dnf') {
                        $athlete['temps_laser_run'] = $temps_lr;
                        $athlete['points_lr'] = 0;
                    } else {
                        list($minutes, $secondes) = explode("'", $temps_lr);
                        $seconde_lr = ($minutes * 60) + $secondes;

                        $retard = $athlete['diff_points_leader'] ?? 0;
                        $retard = min($retard, 90);
                        $seconde_lr -= $retard;

                        $athlete['temps_laser_run'] = sprintf("%d'%02d", floor($seconde_lr / 60), $seconde_lr % 60);
                        $ref_lr = $categories[$categorie]['lr'];
                        $points_lr = $base_pts_lr - ($seconde_lr - intval($ref_lr));
                        $athlete['points_lr'] = max($points_lr, 0);
                    }

                    $athlete['total'] = $athlete['points_lr'] + ($athlete['points_nat'] ?? 0);
                }
            }

            // Tri dans chaque catégorie
            usort($athletes, fn($a, $b) => ($b['total'] ?? 0) <=> ($a['total'] ?? 0));
        }

        file_put_contents($fileName, json_encode($athletes_data));
        echo "<p style='text-align:center;'>✅ Tous les temps ont été enregistrés avec succès.</p>";
    }

    echo "<center><h1>Ajouter les temps de laser run</h1><h2>Liste des athlètes par catégorie :</h2></center>";

    echo "<form method='post' action='?competition=$nom_competition'>";

    foreach ($athletes_data as $categorie => $athletes) {
        echo "<h3>$categorie</h3>
              <center><a class='w3-button' href='download_cat_lr.php?file=$fileName&title=Résultat Triathlé $nom_competition&titledoc=Résultat Triathlé $nom_competition $categorie&cat=$categorie' target='_blank'>Télécharger cette catégorie</a></center>
              <table style='width: 90%;' border='1' align='center'>
                <tr>
                    <th>Nom</th>
                    <th>Club</th>
                    <th>Temps Natation</th>
                    <th>Points Natation</th>
                    <th>Temps Laser Run</th>
                    <th>Points Laser Run</th>
                    <th>Total</th>
                    <th>Saisie</th>
                </tr>";

        foreach ($athletes as $athlete) {
            $nom = $athlete['nom'];
            echo "<tr>
                    <td>$nom</td>
                    <td>{$athlete['club']}</td>
                    <td>" . ($athlete['temps_natation'] ?? '') . "</td>
                    <td>" . ($athlete['points_nat'] ?? '') . "</td>
                    <td>" . ($athlete['temps_laser_run'] ?? '') . "</td>
                    <td>" . ($athlete['points_lr'] ?? '') . "</td>
                    <td>" . ($athlete['total'] ?? '') . "</td>
                    <td>
                        <input type='text' 
                               name='temps_laser_run[$nom]'
                               value='" . ($athlete['temps_laser_run'] ?? '') . "'
                               pattern=\"[0-9]{1,2}'[0-5][0-9]|dns|dnf\"
                               placeholder=\"ex : 2'34, dns ou dnf\">
                    </td>
                </tr>";
        }

        echo "</table><br>";
    }

    echo "<center><button type='submit' class='w3-button'>✅ Enregistrer tous les temps</button></center>";
    echo "</form>";

    // Liens généraux
    $title = 'Résultat triathlé ' . $nom_competition;
    echo "<br><center>
        <a class='w3-button' href='resultats.php?title=$title&file=$fileName'>Voir Résultats</a><br>
        <a class='w3-button' href='download_lr.php?file=$fileName&title=$title' target='_blank'>Télécharger PDF</a><br>
        <a class='w3-button' href='compet.php'>Retour à l'accueil</a>
    </center>";
} else {
    echo "<div class='w3-center w3-padding-48 w3-xxlarge' style='background-color: rgb(32, 47, 74); color: white;'>
          <h2 class='w3-center'>Autorisation non accordée</h2>
          </div>";
}

footer();
echo "</body>";
