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

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["temps_laser_run"])) {
        $base_pts_lr = 500;
        $temps_saisis = $_POST["temps_laser_run"];

        foreach ($athletes_data as $categorie => &$athletes) {
            foreach ($athletes as &$athlete) {
                $nom = $athlete['nom'];
                if (isset($temps_saisis[$nom]) && trim($temps_saisis[$nom]) !== "") {
                    $temps_lr = strtolower(trim($temps_saisis[$nom]));
                    $athlete['temps_laser_run_brut'] = $temps_lr;
                    
                    if ($temps_lr === 'dns' || $temps_lr === 'dnf') {
                        $athlete['temps_laser_run'] = $temps_lr;
                        $athlete['points_lr'] = 0;
                    } else {
                        // prise en compte du format avec ou sans centièmes
                        if (preg_match("/^(\d+)'(\d{1,2})(?:''(\d{1,2}))?$/", $temps_lr, $matches)) {
                            $minutes = (int)$matches[1];
                            $secondes = (int)$matches[2];
                            $centiemes = isset($matches[3]) ? (int)$matches[3] : 0;
                    
                            $total_seconds = $minutes * 60 + $secondes + ($centiemes / 100);
                    
                            // retard/handicap de départ
                            $retard = $athlete['diff_points_leader'] ?? 0;
                            $retard = min($retard, 90);
                    
                            $total_corrige = $total_seconds - $retard;
                            if ($total_corrige < 0) $total_corrige = 0;
                    
                            $min_corr = floor($total_corrige / 60);
                            $sec_corr = floor($total_corrige % 60);
                            $cent_corr = round(($total_corrige - floor($total_corrige)) * 100);
                    
                            $athlete['temps_laser_run'] = sprintf("%d'%02d''%02d", $min_corr, $sec_corr, $cent_corr);
                    
                            // Référence par catégorie
                            $ref_lr = $categories[$categorie]['lr'];
                            $points_lr = $base_pts_lr - round(($total_corrige - $ref_lr));
                            $athlete['points_lr'] = max($points_lr, 0);
                        } else {
                            $athlete['temps_laser_run'] = 'format invalide';
                            $athlete['points_lr'] = 0;
                        }
                    }}

            }
            unset($athlete);
            usort($athletes, fn($a, $b) => ($b['total'] ?? 0) <=> ($a['total'] ?? 0));
        }
        file_put_contents($fileName, json_encode($athletes_data));
        echo "<script>window.location.href = '?competition=$nom_competition&success=1';</script>";
        exit();
    }

    if (isset($_GET['success'])) {
        echo "<p style='text-align:center;'>✅ Tous les temps ont été enregistrés avec succès.</p>";
    }

    echo "<center><h1>Ajouter les temps de laser run</h1><h2>Liste des athlètes par catégorie :</h2></center>";

    echo "<style>
        .onglets { text-align:center; margin-bottom:20px; }
        .onglets button { margin:5px; padding:10px 20px; background:#2c3e50; color:white; border:none; border-radius:5px; cursor:pointer; }
        .onglets button.active { background:#1abc9c; }
        .categorie-block { display:none; }
        .categorie-block.active { display:block; }
    </style>";

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
            ?>
            <div class="categorie-block" id="cat_<?php echo $id; ?>">
                <h3><?php echo $categorie; ?></h3>
                <center>
                    <?php
                    $title = "Résultat Triathlé $nom_competition";
                    $titledoc = "$title $categorie";
                    echo "<a class='w3-button' href='download_cat_lr.php?file=$fileName&title=$title&titledoc=$titledoc&cat=$categorie' target='_blank'>Télécharger cette catégorie</a>";
                    ?>
                </center>
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
                    </tr>
                    <?php foreach ($athletes as $athlete): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($athlete['nom']); ?></td>
                            <td><?php echo htmlspecialchars($athlete['club']); ?></td>
                            <td><?php echo $athlete['temps_natation'] ?? ''; ?></td>
                            <td><?php echo $athlete['points_nat'] ?? ''; ?></td>
                            <td><?php echo $athlete['temps_laser_run'] ?? ''; ?></td>
                            <td><?php echo $athlete['points_lr'] ?? ''; ?></td>
                            <td><?php echo $athlete['total'] ?? ''; ?></td>
                            <td>
                                <input type="text" 
                                       name="temps_laser_run[<?php echo htmlspecialchars($athlete['nom']); ?>]"
                                       value="<?php echo htmlspecialchars($athlete['temps_laser_run_brut'] ?? ''); ?>"
                                       pattern="[0-9]{1,2}'[0-5][0-9]|dns|dnf"
                                       placeholder="ex : 2'34, dns ou dnf">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table><br>
            </div>
        <?php endif;
    endforeach;

    echo "<center><button type='submit' class='w3-button'>✅ Enregistrer tous les temps</button></center>";
    echo "</form>";

    echo "<script>
        document.addEventListener('DOMContentLoaded', () => {
            const blocs = document.querySelectorAll('.categorie-block');
            const boutons = document.querySelectorAll('.onglet-button');

            boutons.forEach(btn => {
                btn.addEventListener('click', (e) => {
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
