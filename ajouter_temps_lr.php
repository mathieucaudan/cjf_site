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
            <h1>Ajouter les temps de laser run</h1>
        </center>
        <?php
        // Définir le tableau des catégories avec les temps de laser run et les points de base
        $categories = array(
            'senior hommes' => array('lr' => 800),
            'senior femmes' => array('lr' => 800),
            'u22 hommes' => array('lr' => 800),
            'u22 femmes' => array('lr' => 800),
            'u19 hommes' => array('lr' => 800),
            'u19 femmes' => array('lr' => 800),
            'u17 hommes' => array('lr' => 800),
            'u17 femmes' => array('lr' => 800),
            'u15 garcons' => array('lr' => 460),
            'u15 filles' => array('lr' => 460),
            'u13 garcons' => array('lr' => 320),
            'u13 filles' => array('lr' => 320),
            'u11 garcons' => array('lr' => 240),
            'u11 filles' => array('lr' => 240),
            'u9 garcons' => array('lr' => 240),
            'u9 filles' => array('lr' => 240),
            'm40 hommes' => array('lr' => 690),
            'm40 femmes' => array('lr' => 690),
            'm50 hommes' => array('lr' => 690),
            'm50 femmes' => array('lr' => 690),
            'm60 hommes' => array('lr' => 420),
            'm60 femmes' => array('lr' => 420),
            'm70 hommes' => array('lr' => 420),
            'm70 femmes' => array('lr' => 420),
            'para hommes' => array('lr' => 320),
            'para femmes' => array('lr' => 320),
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
            // Récupérer le nom de l'athlète et le temps de laser run
            $nom_athlete = $_POST["nom_athlete"];
            $temps_lr = $_POST["temps_laser_run"];

            // Ajouter le temps de laser run à l'athlète correspondant
            foreach ($athletes_data as $categorie => &$athletes) {
                foreach ($athletes as &$athlete) {
                    $base_pts_lr = 500;
                    if ($athlete['nom'] === $nom_athlete) {
                        $athlete['temps_laser_run'] = $temps_lr;

                        // Calculer les points pour le temps de laser run
                        $tmp_lr = $categories[$categorie]['lr'];
                        list($minutes, $secondes) = explode("'", $temps_lr);
                        $seconde_lr = ($minutes * 60) + $secondes;
                        // Exemple de calcul des points (à adapter selon votre besoin)
                        $points_lr = $base_pts_lr - ($seconde_lr - intval($tmp_lr));

                        $athlete['points_lr'] = $points_lr;
                        $athlete['total'] = $points_lr + $athlete['points_nat'];
                    }
                }
            }


            // Trier les athlètes par ordre de points total
            usort($athletes, function ($a, $b) {
                // Si total n'est pas défini pour l'un des athlètes, considérez-le comme ayant des points nuls
                $totalA = isset($a['total']) ? $a['total'] : 0;
                $totalB = isset($b['total']) ? $b['total'] : 0;
                return $totalB <=> $totalA;
            });


            // Enregistrer les données mises à jour dans le fichier JSON
            file_put_contents($fileName, json_encode($athletes_data));

            // Afficher un message de succès
            echo "<p>Temps de laser run ajouté avec succès pour l'athlète {$nom_athlete}.</p>";
        }
        $athletes_data = json_decode(file_get_contents($fileName), true);
        ?>
        <center>
            <h2>Liste des athlètes par catégorie :</h2>
            <?php foreach ($athletes_data as $categorie => $athletes) : ?>
        </center>
        <h3><?php echo $categorie; ?></h3>
        <center>
            <?php $title = 'Résultat Triathlé ' . $nom_competition;
                echo "<a class='w3-button' href='download_cat_lr.php?file=$fileName&title=$title&cat=$categorie' target='_blank'>Télécharger cette catégorie</a>"; ?>
            <table style='width: 90%;' border="1">
                <tr>
                    <th>Nom</th>
                    <th>Temps de Natation</th>
                    <th>Points de Natation</th>
                    <th>Temps de Laser Run</th>
                    <th>Points de Laser Run</th>
                    <th>Points Total</th>
                    <th></th>
                </tr>
                <?php foreach ($athletes as $athlete) : ?>
                    <tr>
                        <td><?php echo $athlete['nom']; ?></td>
                        <td><?php echo isset($athlete['temps_natation']) ? $athlete['temps_natation'] : ''; ?></td>
                        <td><?php echo isset($athlete['points_nat']) ? $athlete['points_nat'] : ''; ?></td>
                        <td><?php echo isset($athlete['temps_laser_run']) ? $athlete['temps_laser_run'] : ''; ?></td>
                        <td><?php echo isset($athlete['points_lr']) ? $athlete['points_lr'] : ''; ?></td>
                        <td><?php echo isset($athlete['total']) ? $athlete['total'] : ''; ?></td>
                        <td>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?competition={$nom_competition}"; ?>">
                                <input type="text" name="temps_laser_run" value="<?php echo isset($athlete['temps_laser_run']) ? $athlete['temps_laser_run'] : ''; ?>" pattern="[0-9]{1,2}'[0-5][0-9]" required>
                                <input type="hidden" name="nom_athlete" value="<?php echo $athlete['nom']; ?>">
                                <button type="submit" value="">Ajouter/Modifier temps</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table></br>
        <?php endforeach; ?>


        <?php
        $title = 'Résultat triathlé ' . $nom_competition;

        echo "<a class='w3-button' href='resultats.php?title=résultat&file=$fileName'>Résultats</a></br>";
        echo "<a class='w3-button' href='download_lr.php?file=$fileName&title=$title' target='_blank'>Télécharger en PDF</a></br>";
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
