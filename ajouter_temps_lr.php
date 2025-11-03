<?php
include 'fonction.php';
entete();
echo "<link rel='stylesheet' href='style/parametres.css'>";
navbar();
echo "<body style='background-color: rgb(32, 47, 74); color:white'>";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<div class='w3-center w3-padding-48 w3-xxlarge'><h2>Autorisation non accordée</h2></div>";
    footer(); exit;
}

$discipline = $_GET["discipline"] ?? null;
$nom_competition = $_GET["competition"] ?? null;

if (!$discipline || !$nom_competition) {
    echo "<p style='color:red;'>Paramètres manquants (discipline ou compétition).</p>";
    echo "<a class='w3-button w3-gray' href='ouvrir_competition.php'>Retour</a>";
    footer(); exit;
}

$fileName = "competitions/{$discipline}/{$nom_competition}/athletes.json";
if (!file_exists($fileName)) {
    echo "<p>Aucune donnée d'athlète trouvée pour cette compétition.</p>";
    footer(); exit;
}

$athletes_data = json_decode(file_get_contents($fileName), true);

// === Détection du format ===
// - Format plat : ['athletes' => [id|index => ['nom','club','categorie',...], ...]]
// - Format historique : ['u15 garcons' => [ ... ], 'u15 filles' => [ ... ], ...]
$isFlat = isset($athletes_data['athletes']) && is_array($athletes_data['athletes']);

// Construction d'une vue "par catégorie" pour l'affichage ET la mise à jour
$grouped = []; // cat => [athlètes...]
if ($isFlat) {
    // On prend des références vers le tableau plat pour que les modifs s’y répercutent
    foreach ($athletes_data['athletes'] as $k => &$a) {
        $cat = $a['categorie'] ?? 'Sans catégorie';
        $grouped[$cat][] = &$athletes_data['athletes'][$k];
    }
    unset($a);
} else {
    // Déjà groupé par catégorie
    $grouped = $athletes_data;
}

// Table des distances LR
$categories_ref = [
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
    'para hommes' => ['lr' => 320],
    'para femmes' => ['lr' => 320],
];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["temps_laser_run"])) {
    $base_pts_lr = 500;
    $temps_saisis = $_POST["temps_laser_run"];

    // Mise à jour via la vue groupée (références si format plat)
    foreach ($grouped as $categorie => &$athletes) {
        foreach ($athletes as &$athlete) {
            $nom = $athlete['nom'];
            if (isset($temps_saisis[$nom]) && trim($temps_saisis[$nom]) !== "") {
                $temps_lr = strtolower(trim($temps_saisis[$nom]));
                $athlete['temps_laser_run_brut'] = $temps_lr;

                if ($temps_lr === 'dns' || $temps_lr === 'dnf') {
                    $athlete['temps_laser_run'] = $temps_lr;
                    $athlete['points_lr'] = 0;
                } else {
                    // formats acceptés: 2'34  |  2'34''50
                    if (preg_match("/^(\d+)'(\d{1,2})(?:''(\d{1,2}))?$/", $temps_lr, $m)) {
                        $minutes   = (int)$m[1];
                        $secondes  = (int)$m[2];
                        $centiemes = isset($m[3]) ? (int)$m[3] : 0;

                        $total_seconds = $minutes * 60 + $secondes + ($centiemes / 100);
                        $retard = min(($athlete['diff_points_leader'] ?? 0), 90);
                        $total_corrige = max($total_seconds - $retard, 0);

                        $min_corr  = floor($total_corrige / 60);
                        $sec_corr  = floor($total_corrige % 60);
                        $cent_corr = round(($total_corrige - floor($total_corrige)) * 100);

                        $athlete['temps_laser_run'] = sprintf("%d'%02d''%02d", $min_corr, $sec_corr, $cent_corr);

                        // catégorie de l’athlète (prend celle de la vue si manquante)
                        $cat_for_ref = $athlete['categorie'] ?? $categorie;
                        $ref_lr = $categories_ref[$cat_for_ref]['lr'] ?? 800;

                        $points_lr = $base_pts_lr - round(($total_corrige - $ref_lr));
                        $athlete['points_lr'] = max($points_lr, 0);
                        $athlete['total'] = ($athlete['points_lr'] ?? 0) + ($athlete['points_nat'] ?? 0);
                    } else {
                        $athlete['temps_laser_run'] = 'format invalide';
                        $athlete['points_lr'] = 0;
                    }
                }
            }
        }
        unset($athlete);

        // Tri par total dans l’affichage si format historique
        if (!$isFlat) {
            usort($athletes, fn($a, $b) => ($b['total'] ?? 0) <=> ($a['total'] ?? 0));
        }
    }
    unset($athletes);

    // Écriture : on respecte le format d’origine
    if ($isFlat) {
        // rien à reconstruire, les refs ont modifié $athletes_data['athletes']
        file_put_contents($fileName, json_encode($athletes_data, JSON_PRETTY_PRINT));
    } else {
        // on réécrit les catégories triées
        file_put_contents($fileName, json_encode($grouped, JSON_PRETTY_PRINT));
    }

    echo "<script>window.location.href='?discipline=$discipline&competition=$nom_competition&success=1';</script>";
    exit;
}

// tri et ordre d’affichage des catégories
$cat_names = array_keys($grouped);
sort($cat_names, SORT_NATURAL | SORT_FLAG_CASE);

// message succès
if (isset($_GET['success'])) {
    echo "<p style='text-align:center;'>✅ Tous les temps ont été enregistrés avec succès.</p>";
}

// Style des onglets/tableau (comme ta capture)
echo "<style>
    .tabs {display:flex; flex-wrap:wrap; justify-content:center; gap:12px; margin:20px;}
    .tabs button {background:#2c3e50; color:white; border:none; border-radius:8px; padding:10px 18px; cursor:pointer;}
    .tabs button.active {background:#1abc9c;}
    hr.sep {border:none; border-top:1px solid #4b5b74; margin:16px 0 24px;}
    table {border-collapse:collapse; margin-top:15px; width:90%; color:white;}
    th, td {border:1px solid #5b6b84; padding:10px; text-align:center;}
    th {font-weight:600;}
    tr:nth-child(even){background-color:#273956;}
</style>";

echo "<center>";
echo "<div class='tabs'>";
foreach ($cat_names as $cat) {
    $id = md5($cat);
    echo "<button class='tablink' data-id='$id'>".htmlspecialchars($cat)."</button>";
}
echo "</div>";
echo "<hr class='sep'>";

echo "<div id='tab-container'>";
foreach ($cat_names as $cat) {
    $id = md5($cat);
    echo "<div class='tabcontent' id='tab_$id' style='display:none;'>";
    echo "<h2 style='text-align:center;'>".htmlspecialchars($cat)."</h2>";

    $title = 'Résultat ' . ucfirst($discipline) . ' - ' . $nom_competition;
    $titledoc = "$title $cat";
    echo "<center><a class='w3-button' href='download_cat_lr.php?discipline=$discipline&file=$fileName&title=$title&titledoc=$titledoc&cat=".urlencode($cat)."' target='_blank'>Télécharger cette catégorie</a></center>";

    echo "<form method='post' action='?discipline=$discipline&competition=$nom_competition'>";
    echo "<table align='center'>
            <tr>
                <th>Nom</th>
                <th>Club</th>";
    if ($discipline === 'triathle') echo "<th>Temps Natation</th><th>Points Natation</th>";
    echo "      <th>Temps Laser Run</th>
                <th>Points Laser Run</th>
                <th>Total</th>
                <th>Saisie</th>
            </tr>";

    // Tri affichage alphabétique par nom (comme avant)
    $rows = $grouped[$cat];
    usort($rows, fn($a,$b)=>strcmp($a['nom'],$b['nom']));

    foreach ($rows as $ath) {
        echo "<tr>
                <td>".htmlspecialchars($ath['nom'])."</td>
                <td>".htmlspecialchars($ath['club'] ?? '')."</td>";
        if ($discipline === 'triathle') {
            echo "<td>".($ath['temps_natation_brut'] ?? '')."</td>
                  <td>".($ath['points_nat'] ?? '')."</td>";
        }
        echo "  <td>".($ath['temps_laser_run'] ?? '')."</td>
                <td>".($ath['points_lr'] ?? '')."</td>
                <td>".($ath['total'] ?? '')."</td>
                <td>
                    <input type='text'
                           name='temps_laser_run[".htmlspecialchars($ath['nom'])."]'
                           value='".htmlspecialchars($ath['temps_laser_run_brut'] ?? '')."'
                           placeholder=\"ex : 2'34 ou dns\">
                </td>
            </tr>";
    }
    echo "</table><br>";

    echo "<center><button type='submit' class='w3-button'>✅ Enregistrer tous les temps</button></center>";
    echo "</form>";
    echo "</div>";
}
echo "</div>"; // tab-container

// JS des onglets (un seul visible, vert pour l'actif)
echo "<script>
document.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelectorAll('.tablink');
    const contents = document.querySelectorAll('.tabcontent');
    function showTab(id){
        contents.forEach(c=>c.style.display='none');
        tabs.forEach(t=>t.classList.remove('active'));
        const el = document.getElementById('tab_'+id);
        if (el) el.style.display='block';
        const btn = document.querySelector('.tablink[data-id=\"'+id+'\"]');
        if (btn) btn.classList.add('active');
    }
    if(tabs.length){
        showTab(tabs[0].dataset.id);
        tabs.forEach(btn=>btn.addEventListener('click',()=>showTab(btn.dataset.id)));
    }
});
</script>";

$title = 'Résultat ' . ucfirst($discipline) . ' - ' . $nom_competition;
echo "<br>
    <a class='w3-button' href='resultats.php?discipline=$discipline&title=$title&file=$fileName'>Voir Résultats</a><br>
    <a class='w3-button' href='download_lr.php?discipline=$discipline&file=$fileName&title=$title' target='_blank'>Télécharger PDF</a><br>
    <a class='w3-button' href='ouvrir_competition.php'>Retour aux compétitions</a>
</center>";

footer();
echo "</body>";
?>
