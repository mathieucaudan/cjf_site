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
            <h2>Liste des athlètes par catégorie :</h2>
        </center>

        <style>
            .onglets { text-align:center; margin-bottom:20px; }
            .onglets button { margin:5px; padding:10px 20px; background:#2c3e50; color:white; border:none; border-radius:5px; cursor:pointer; }
            .onglets button.active { background:#1abc9c; }
            .categorie-block { display:none; }
            .categorie-block.active { display:block; }
        </style>

        <?php
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
            'm40 hommes' => array('nat' => 80),
            'm40 femmes' => array('nat' => 80),
            'm50 hommes' => array('nat' => 80),
            'm50 femmes' => array('nat' => 80),
            'm60 hommes' => array('nat' => 45),
            'm60 femmes' => array('nat' => 45),
            'm70 hommes' => array('nat' => 45),
            'm70 femmes' => array('nat' => 45),
            'para hommes' => array('nat' => 45),
            'para femmes' => array('nat' => 45),
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

        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["temps_natation"])) {
            $base_pts_nat = 250;
            $temps_saisis = $_POST["temps_natation"];

            foreach ($athletes_data as $categorie => &$athletes) {
                foreach ($athletes as &$athlete) {
                    $nom = $athlete['nom'];
                    if (isset($temps_saisis[$nom]) && trim($temps_saisis[$nom]) !== "") {
                        $temps_nat = strtolower(trim($temps_saisis[$nom]));
                        $athlete['temps_natation_brut'] = $temps_nat;

                        if ($temps_nat === 'dns' || $temps_nat === 'dnf') {
                            $athlete['temps_natation'] = $temps_nat;
                            $athlete['points_nat'] = 0;
                        } else {
                            list($minutes, $secondes, $centiemes) = sscanf($temps_nat, "%d'%d''%d");
                            $total_seconds = ($minutes * 60) + $secondes + ($centiemes / 100);
                            $ref_nat = $categories[$categorie]['nat'];
                            $diff = $total_seconds - $ref_nat;
                            $penalite = floor($diff * 2); // chaque 0.5s = 1 point
                            $points_nat = $base_pts_nat - $penalite;
                            $athlete['points_nat'] = max($points_nat, 0);

                        }
                        $athlete['total'] = ($athlete['points_nat'] ?? 0) + ($athlete['points_lr'] ?? 0);
                    }
                }
                unset($athlete);
                usort($athletes, fn($a, $b) => ($b['points_nat'] ?? 0) <=> ($a['points_nat'] ?? 0));
 
                $leader_points = $athletes[0]['points_nat'] ?? 0;
                foreach ($athletes as &$athlete) {
                    $athlete['diff_points_leader'] = max(0, $leader_points - ($athlete['points_nat'] ?? 0));
                }
            }
            file_put_contents($fileName, json_encode($athletes_data));
            echo "<script>window.location.href = '?competition=$nom_competition&success=1';</script>";
            exit();
        }

        if (isset($_GET['success'])) {
            echo "<p style='text-align:center;'>✅ Tous les temps de natation ont été enregistrés avec succès.</p>";
        }

        echo "<div class='onglets'>";
        foreach ($athletes_data as $categorie => $athletes) {
            if (!empty($athletes)) {
                $id = md5($categorie);
                echo "<button class='onglet-button' data-id='$id'>$categorie</button>";
            }
        }
        echo "</div>";

        echo "<form method='post' action='?competition=$nom_competition'>";
        foreach ($athletes_data as $categorie => $athletes):
            if (!empty($athletes)):
                $id = md5($categorie);
                echo "<div class='categorie-block' id='cat_$id'><h3>$categorie</h3><center>";
                $title = 'Résultat Natation ' . $nom_competition;
                $titledoc = $title . " $categorie";
                echo "<a class='w3-button' href='download_cat_nat.php?file=$fileName&title=$title&titledoc=$titledoc&cat=$categorie' target='_blank'>Télécharger cette catégorie</a>";
                echo " <a class='w3-button' href='download_cat_nat_csv.php?file=$fileName&cat=$categorie' target='_blank'>📥 CSV</a>";
                echo "<table style='width: 90%;' border='1'>
                        <tr>
                            <th>Nom</th>
                            <th>Club</th>
                            <th>Temps de Natation</th>
                            <th>Points</th>
                            <th>Total</th>
                            <th>Saisie</th>
                        </tr>";
                foreach ($athletes as $athlete):
                    echo "<tr>
                            <td>" . htmlspecialchars($athlete['nom']) . "</td>
                            <td>" . htmlspecialchars($athlete['club']) . "</td>
                            <td>" . ($athlete['temps_natation'] ?? '') . "</td>
                            <td>" . ($athlete['points_nat'] ?? '') . "</td>
                            <td>" . ($athlete['total'] ?? '') . "</td>
                            <td>
                                <input type='text' 
                                       name=\"temps_natation[" . htmlspecialchars($athlete['nom']) . "]\"
                                       value=\"" . htmlspecialchars($athlete['temps_natation_brut'] ?? '') . "\"
                                       pattern=\"[0-9]{1,2}'[0-5][0-9]''[0-9]{2}|dns|dnf\"
                                       placeholder=\"ex : 1'12''34, dns ou dnf\">
                            </td>
                          </tr>";
                endforeach;
                echo "</table><br></div>";
            endif;
        endforeach;
        echo "<center><button type='submit' class='w3-button'>✅ Enregistrer tous les temps</button></center>";
        echo "</form>";

        echo "<script>
        document.addEventListener('DOMContentLoaded', () => {
            const blocs = document.querySelectorAll('.categorie-block');
            const boutons = document.querySelectorAll('.onglet-button');

            boutons.forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.dataset.id;
                    blocs.forEach(b => b.classList.remove('active'));
                    boutons.forEach(b => b.classList.remove('active'));
                    document.getElementById('cat_' + id).classList.add('active');
                    btn.classList.add('active');
                });
            });

            if (blocs.length && boutons.length) {
                blocs[0].classList.add('active');
                boutons[0].classList.add('active');
            }
        });
        </script>";

        $title = 'Résultat Natation ' . $nom_competition;
        echo "<center>
        <a class='w3-button' href='download_nat.php?file=$fileName&title=$title' target='_blank'>Télécharger en PDF</a><br>
        <a class='w3-button' href='resultats.php?title=$title&file=$fileName'>Résultats</a><br>
        <a class='w3-button' href='ajouter_temps_lr.php?competition=$nom_competition'>Ajouter le Temps de Laser Run</a><br>
        <a class='w3-button' href='compet.php'>Retour à l'accueil</a>
        </center>";
    }
} else {
    echo "<div class='w3-center w3-padding-48 w3-xxlarge' style='background-color: rgb(32, 47, 74); color: white;'>
  <h2 class='w3-center'>Autorisation non accordée</h2>
  </div>";
}
footer();
echo "</body>";