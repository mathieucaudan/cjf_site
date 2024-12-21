<?php
include 'fonction.php';
entete();
echo "<link rel='stylesheet' href='style/parametres.css'>";
navbar();
echo "<body style='background-color: rgb(32, 47, 74); color:white'>";
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
?>
        <center>
            <h1>Ajouter les temps de natation</h1>
        </center>

        <?php
        // Définir le tableau des catégories avec les temps de natation et les points de base
        $categories = array(
            'senior hommes' => array('nat' => 150),
            'senior femmes' => array('nat' => 150),
            'u22 hommes' => array('nat' => 150),
            'u22 femmes' => array('nat' => 150),
            'u19 hommes' => array('nat' => 150),
            'u19 femmes' => array('nat' => 150),
            'u17 hommes' => array('nat' => 150),
            'u17 femmes' => array('nat' => 150),
            'u15 garcons' => array('nat' => 80),
            'u15 filles' => array('nat' => 80),
            'u13 garcons' => array('nat' => 80),
            'u13 filles' => array('nat' => 80),
            'u11 garcons' => array('nat' => 45),
            'u11 filles' => array('nat' => 45),
            'u9 garcons' => array('nat' => 45),
            'u9 filles' => array('nat' => 45),
            'm40 hommes' => array('nat' =>  80),
            'm40 femmes' => array('nat' =>  80),
            'm50 hommes' => array('nat' =>  80),
            'm50 femmes' => array('nat' =>  80),
            'm60 hommes' => array('nat' =>  45),
            'm60 femmes' => array('nat' =>  45),
            'm70 hommes' => array('nat' => 45),
            'm70 femmes' => array('nat' => 45),
            'para hommes' => array('nat' => 80),
            'para femmes' => array('nat' => 80),
        );


        // Vérifier si la compétition est spécifiée dans l'URL
        if (isset($_GET["competition"])) {
            $nom_competition = $_GET["competition"];
        } else {
            // Rediriger si la compétition n'est pas spécifiée
            header("Location: creer_competition.php");
            exit();
        }

        // Charger les données JSON des athlètes par catégorie
        $fileName = "competitions/{$nom_competition}/athletes.json";
        if (file_exists($fileName)) {
            $athletes_data = json_decode(file_get_contents($fileName), true);
        } else {
            echo "<p>Aucune donnée d'athlète trouvée pour cette compétition.</p>";
            exit();
        }

        // Traitement des données lors de la soumission du formulaire
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer le nom de l'athlète et le temps de natation
            $nom_athlete = $_POST["nom_athlete"];
            $temps_natation = $_POST["temps_natation"];

            // Ajouter le temps de natation à l'athlète correspondant
            foreach ($athletes_data as $categorie => &$athletes) {
                foreach ($athletes as &$athlete) {
                    $base_pts_nat = 250;
                    if ($athlete['nom'] === $nom_athlete) {
                        if ($temps_natation == 'dnf') {
                            $athlete['temps_natation'] = 'dnf';
                            $points_nat = 0;
                        } else if ($temps_natation == 'dns') {
                            $athlete['temps_natation'] = 'dns';
                            $points_nat = 0;
                        } else {
                            $athlete['temps_natation'] = $temps_natation;

                            // Calculer les points pour le temps de natation
                            $tmp_nat = $categories[$categorie]['nat'];
                            list($minutes, $secondes, $supp, $centiemes) = explode("'", $temps_natation);
                            $seconde_natation =  $minutes * 60 + $secondes;
                            if ($centiemes == 0) {
                                $centi = 0;
                            } else if ($centiemes > 0 && $centiemes < 49) {
                                $centi = 1;
                            } else if ($centiemes > 49 && $centiemes < 99) {
                                $centi = 2;
                            }
                            $points_nat = $base_pts_nat - ($seconde_natation - $tmp_nat) * 2 - $centi;
                        }
                        $athlete['points_nat'] = $points_nat;
                    }
                }
            }


            foreach ($athletes_data as $categorie => &$athletes) {
                // Vérifier si des athlètes existent dans la catégorie
                if (isset($athletes) && is_array($athletes) && count($athletes) > 0) {
                    usort($athletes, function ($a, $b) {
                        // Si total n'est pas défini pour l'un des athlètes, considérez-le comme ayant des points nuls
                        $totalA = isset($a['points_nat']) ? $a['points_nat'] : 0;
                        $totalB = isset($b['points_nat']) ? $b['points_nat'] : 0;
                        return $totalB <=> $totalA;
                    });

                    // Récupérer les points du leader de la catégorie
                    if (isset($athletes[0]['points_nat'])) {
                        $leader_points = $athletes[0]['points_nat']; // Le leader est le premier athlète dans le tableau trié
                    }
                    // Calculer la différence de points avec le leader pour chaque athlète
                    foreach ($athletes as &$athlete) {
                        if (isset($athlete['points_nat'])) {
                            $athlete['diff_points_leader'] = $leader_points - $athlete['points_nat'];
                        }
                    }
                    unset($athlete); // Libérer la référence
                }
            }


            // Enregistrer les données mises à jour dans le fichier JSON
            file_put_contents($fileName, json_encode($athletes_data));

            // Afficher un message de succès
            echo "<p>Temps de natation ajouté avec succès pour l'athlète {$nom_athlete}.</p>";
        }

        function convertirTempsEnSecondes($temps)
        {
            // Vérifier si le temps est au format attendu
            if (preg_match('/^([0-9]+\'[0-5]?[0-9]\'\'[0-9]{2})$/', $temps)) {
                // Séparer le temps en minutes, secondes et centièmes
                $temps_parts = explode("'", $temps);
                $minutes = (int) $temps_parts[0];
                $secondes = (int) $temps_parts[1];
                $centiemes = (int) $temps_parts[3];
                // Calculer le temps total en secondes
                $temps_total = ($minutes * 60) + $secondes + ($centiemes / 100);

                return $temps_total;
            } else {
                // Si le format du temps n'est pas correct, retourner une valeur par défaut ou générer une erreur
                return null; // Ou générer une erreur avec die() ou trigger_error() par exemple
            }
        }
        $athletes_data = json_decode(file_get_contents($fileName), true);
        ?>
        <center>
            <h2>Liste des athlètes par catégorie :</h2>

            <?php foreach ($athletes_data as $categorie => $athletes) : ?>
        </center>
        <h3><?php echo $categorie; ?></h3>
        <center>
            <?php $title = 'Résultat Natation ' . $nom_competition;
                echo "<a class='w3-button' href='download_cat_nat.php?file=$fileName&title=$title&cat=$categorie' target='_blank'>Télécharger cette catégorie</a>"; ?>
            <table style='width: 90%;' border='1'>
                <tr>
                    <th>Nom</th>
                    <th>Club</th>
                    <th>Temps de Natation</th>
                    <th>Points</th>
                    <th>Différence avec le leader</th>
                    <th></th>
                </tr>
                <?php foreach ($athletes as $athlete) : ?>
                    <tr>
                        <td><?php echo $athlete['nom']; ?></td>
                        <td><?php echo $athlete['club']; ?></td>
                        <td><?php echo isset($athlete['temps_natation']) ? $athlete['temps_natation'] : ''; ?></td>
                        <td><?php echo isset($athlete['points_nat']) ? $athlete['points_nat'] : ''; ?></td>
                        <td>
                            <?php
                            if (isset($athlete['diff_points_leader'])) {
                                $diff_points_leader = $athlete['diff_points_leader'];
                        
                                if ($diff_points_leader > 90) {
                                    $additional_seconds = $diff_points_leader - 90; // Temps restant au-delà de 90 secondes
                                    echo "1'30 (+$additional_seconds)";
                                } else {
                                    $minutes = floor($diff_points_leader / 60);
                                    $seconds = $diff_points_leader % 60;
                                    echo sprintf("%d'%02d", $minutes, $seconds); // Format MM'SS
                                }
                            } else {
                                echo ''; // Pas de valeur à afficher
                            }
                            ?>
                        </td>

                        <td>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?competition={$nom_competition}"; ?>">
                                <input type="text" name="temps_natation" value="<?php echo isset($athlete['temps_natation']) ? $athlete['temps_natation'] : ''; ?>" pattern="[0-9]{1,2}'[0-5][0-9]''[0-9][0-9]" required>
                                <input type="hidden" name="nom_athlete" value="<?php echo $athlete['nom']; ?>">
                                <button class='w3-button' type="submit" value="">Ajouter/Modifier temps</button>
                            </form>
                            </form>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?competition={$nom_competition}"; ?>">
                                <input type="hidden" name="nom_athlete" value="<?php echo $athlete['nom']; ?>">
                                <button type="submit" name="temps_natation" value="dns">DNS</button>
                            </form>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?competition={$nom_competition}"; ?>">
                                <input type="hidden" name="nom_athlete" value="<?php echo $athlete['nom']; ?>">
                                <button type="submit" name="temps_natation" value="dnf">DNF</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table></br>
        <?php endforeach; ?>

        <?php
        // Fonction pour convertir les secondes en temps au format m'ss'xx
        function convertirSecondesEnTemps($temps_secondes)
        {
            $minutes = floor(intval($temps_secondes) / 60);
            $secondes = intval($temps_secondes) % 60;
            $centiemes = (intval($temps_secondes) - floor(intval($temps_secondes))) * 100;
            return sprintf("%02d'%02d''%02d", $minutes, $secondes, $centiemes);
        }
        $title = 'Résultat Natation ' . $nom_competition;
        echo "<a class='w3-button' href='download_nat.php?file=$fileName&title=$title' target='_blank'>Télécharger en PDF</a>";
        echo "<a class='w3-button' href='resultats.php?title=$title&file=$fileName'>Résultats</a></br>";
        echo "<a class='w3-button' href='ajouter_temps_lr.php?competition=" . $_GET["competition"] . "'>Ajouter le Temps de Laser Run</a></br>";

        ?>

        <a class='w3-button' href="compet.php">Retour à l'accueil</a>
        </center>
<?php
    }
} else {
    echo "<div class='w3-center w3-padding-48 w3-xxlarge' style='background-color: rgb(32, 47, 74); color: white;'>
  <h2 class='w3-center'>Autorisation non accordée</h2>
  </div>";
}
footer();
echo "</body>";
