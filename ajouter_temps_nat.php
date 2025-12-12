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

$discipline = $_GET["discipline"] ?? 'triathle';
$nom_competition = $_GET["competition"] ?? null;

if (!$nom_competition) {
    echo "<p style='color:red;'>Paramètre 'competition' manquant.</p>";
    footer(); exit;
}

$fileName = "competitions/{$discipline}/{$nom_competition}/athletes.json";
if (!file_exists($fileName)) {
    echo "<p>Aucune donnée d'athlète trouvée pour cette compétition.</p>";
    footer(); exit;
}

$athletes_data = json_decode(file_get_contents($fileName), true);

// === Détection du format ===
$isFlat = isset($athletes_data['athletes']) && is_array($athletes_data['athletes']);

// Vue par catégorie
$grouped = [];
if ($isFlat) {
    foreach ($athletes_data['athletes'] as $k => &$a) {
        $cat = $a['categorie'] ?? 'Sans catégorie';
        $grouped[$cat][] = &$athletes_data['athletes'][$k];
    }
    unset($a);
} else {
    $grouped = $athletes_data;
}

// Distances de référence natation
$categories = [
    'senior hommes' => ['nat' => 150],
    'senior femmes' => ['nat' => 150],
    'u22 hommes' => ['nat' => 150],
    'u22 femmes' => ['nat' => 150],
    'u19 hommes' => ['nat' => 150],
    'u19 femmes' => ['nat' => 150],
    'u17 hommes' => ['nat' => 150],
    'u17 femmes' => ['nat' => 150],
    'u15 garcons' => ['nat' => 80],
    'u15 filles' => ['nat' => 80],
    'u13 garcons' => ['nat' => 80],
    'u13 filles' => ['nat' => 80],
    'u11 garcons' => ['nat' => 45],
    'u11 filles' => ['nat' => 45],
    'u9 garcons' => ['nat' => 45],
    'u9 filles' => ['nat' => 45],
    'm40 hommes' => ['nat' => 80],
    'm40 femmes' => ['nat' => 80],
    'm50 hommes' => ['nat' => 80],
    'm50 femmes' => ['nat' => 80],
    'm60 hommes' => ['nat' => 45],
    'm60 femmes' => ['nat' => 45],
    'm70 hommes' => ['nat' => 45],
    'm70 femmes' => ['nat' => 45],
    'para hommes' => ['nat' => 45],
    'para femmes' => ['nat' => 45],
    'open hommes' => ['nat' => 80],
    'open femmes' => ['nat' => 80],
];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["temps_natation"])) {
    $base_pts_nat = 250;
    $temps_saisis = $_POST["temps_natation"];

    foreach ($grouped as $categorie => &$athletes) {
        foreach ($athletes as &$athlete) {
            $nom = $athlete['nom'];
            if (isset($temps_saisis[$nom]) && trim($temps_saisis[$nom]) !== "") {
                $temps_nat = strtolower(trim($temps_saisis[$nom]));
                $athlete['temps_natation_brut'] = $temps_nat;

                if ($temps_nat === 'dns' || $temps_nat === 'dnf') {
                    $athlete['temps_natation'] = $temps_nat;
                    $athlete['points_nat'] = 0;
                } else {
                    // formats acceptés: 1'12''34
                    if (preg_match("/^(\d+)'(\d{1,2})''(\d{1,2})$/", $temps_nat, $m)) {
                        $minutes = (int)$m[1];
                        $secondes = (int)$m[2];
                        $centiemes = (int)$m[3];
                        $total_seconds = $minutes * 60 + $secondes + ($centiemes / 100);

                        $ref_nat = $categories[$categorie]['nat'] ?? 150;
                        $diff = $total_seconds - $ref_nat;
                        $penalite = floor($diff * 2);
                        $points_nat = $base_pts_nat - $penalite;
                        $athlete['points_nat'] = max($points_nat, 0);
                        $athlete['temps_natation'] = $temps_nat;
                    } else {
                        $athlete['points_nat'] = 0;
                        $athlete['temps_natation'] = 'format invalide';
                    }
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
    unset($athletes);

    if ($isFlat) {
        file_put_contents($fileName, json_encode($athletes_data, JSON_PRETTY_PRINT));
    } else {
        file_put_contents($fileName, json_encode($grouped, JSON_PRETTY_PRINT));
    }

    echo "<script>window.location.href='?discipline=$discipline&competition=$nom_competition&success=1';</script>";
    exit;
}

if (isset($_GET['success'])) {
    echo "<p style='text-align:center;'>✅ Tous les temps de natation ont été enregistrés avec succès.</p>";
}

$cat_names = array_keys($grouped);
sort($cat_names, SORT_NATURAL | SORT_FLAG_CASE);

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
    echo "<p style='text-align:center; font-size:1.1em;'>Télécharger cette catégorie</p>";

    $title = 'Résultat Natation ' . $nom_competition;
    $titledoc = $title . " $cat";
    echo "<center>
            <a class='w3-button' href='download_cat_nat.php?discipline=$discipline&file=$fileName&title=$title&titledoc=$titledoc&cat=".urlencode($cat)."' target='_blank'>Télécharger cette catégorie</a>
            <a class='w3-button' href='download_cat_nat_csv.php?discipline=$discipline&file=$fileName&cat=".urlencode($cat)."' target='_blank'>📥 CSV</a>
          </center>";

    echo "<form method='post' action='?discipline=$discipline&competition=$nom_competition'>";
    echo "<table align='center'>
            <tr>
                <th>Nom</th>
                <th>Club</th>
                <th>Temps Natation</th>
                <th>Points Natation</th>
                <th>Différence Leader</th>
                <th>Saisie</th>
            </tr>";

    $rows = $grouped[$cat];
    usort($rows, fn($a,$b)=>strcmp($b['nom'],$a['nom']));

    foreach ($rows as $ath) {
        echo "<tr>
                <td>".htmlspecialchars($ath['nom'])."</td>
                <td>".htmlspecialchars($ath['club'] ?? '')."</td>
                <td>".($ath['temps_natation'] ?? '')."</td>
                <td>".($ath['points_nat'] ?? '')."</td>
                <td>".($ath['diff_points_leader'] ?? '')."</td>
                <td>
                    <input type='text' 
                           name='temps_natation[".htmlspecialchars($ath['nom'])."]'
                           value='".htmlspecialchars($ath['temps_natation_brut'] ?? '')."'
                           placeholder=\"ex : 1'12''34 ou dns\">
                </td>
            </tr>";
    }

    echo "</table><br>
          <center><button type='submit' class='w3-button'>✅ Enregistrer tous les temps</button></center>
          </form></div>";
}
echo "</div>";

echo "<script>
document.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelectorAll('.tablink');
    const contents = document.querySelectorAll('.tabcontent');
    function showTab(id){
        contents.forEach(c=>c.style.display='none');
        tabs.forEach(t=>t.classList.remove('active'));
        document.getElementById('tab_'+id).style.display='block';
        document.querySelector('.tablink[data-id=\"'+id+'\"]').classList.add('active');
    }
    if(tabs.length){
        showTab(tabs[0].dataset.id);
        tabs.forEach(btn=>btn.addEventListener('click',()=>showTab(btn.dataset.id)));
    }
});
</script>";

$title = 'Résultat Natation ' . $nom_competition;
echo "<br>
    <a class='w3-button' href='download_nat.php?discipline=$discipline&file=$fileName&title=$title' target='_blank'>Télécharger PDF</a><br>
    <a class='w3-button' href='resultats.php?discipline=$discipline&title=$title&file=$fileName'>Voir Résultats</a><br>
    <a class='w3-button' href='ajouter_temps_lr.php?discipline=$discipline&competition=$nom_competition'>Ajouter le Temps Laser Run</a><br>
    <a class='w3-button' href='ouvrir_competition.php'>Retour aux compétitions</a>
</center>";

footer();
echo "</body>";
?>
