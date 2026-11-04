<?php
include 'fonction.php';
exiger_admin('Temps de natation');

$discipline = $_GET["discipline"] ?? 'triathle';
$nom_competition = $_GET["competition"] ?? '';
if (!competition_valide($discipline, $nom_competition)) {
    header('Location: ouvrir_competition.php');
    exit;
}
$q = 'discipline=' . urlencode($discipline) . '&competition=' . urlencode($nom_competition);

$fileName = "competitions/{$discipline}/{$nom_competition}/athletes.json";
if (!file_exists($fileName)) {
    header('Location: ajouter_athletes.php?' . $q);
    exit;
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

    header('Location: ?' . $q . '&success=1');
    exit;
}



$cat_names = array_keys($grouped);
sort($cat_names, SORT_NATURAL | SORT_FLAG_CASE);


entete('Temps de natation : ' . $nom_competition);
navbar();
bandeau($nom_competition, 'Temps de natation par catégorie.', true);
echo "<section class='section section--serre'><div class='wrap'>";
echo "<p class='fil'><a href='compet.php'>Compétitions</a> / <a href='ajouter_athletes.php?$q'>Athlètes</a> / Temps de natation</p>";
if (isset($_GET['success'])) message_admin('Temps enregistrés.');
if (!$cat_names) echo "<div class='admin-panel'><p>Aucun athlète inscrit. <a href='ajouter_athletes.php?$q'>Ajouter des athlètes</a>.</p></div>";
echo "<div class='tabs'>";
foreach ($cat_names as $cat) {
    $id = md5($cat);
    echo "<button class='tablink' data-id='$id'>".htmlspecialchars($cat)."</button>";
}
echo "</div>";

echo "<div id='tab-container'>";
foreach ($cat_names as $cat) {
    $id = md5($cat);
    echo "<div class='tabcontent' id='tab_$id' style='display:none;'>";
    echo "<div class='admin-panel'><h2 style='text-transform:capitalize'>".htmlspecialchars($cat)."</h2>";
    
    $title = 'Résultat Natation ' . $nom_competition;
    $titledoc = $title . " $cat";
    echo "<p class='boutons'>
            <a class='btn btn--contour btn--petit' href='download_cat_nat.php?discipline=".urlencode($discipline)."&file=".urlencode($fileName)."&title=".urlencode($title)."&titledoc=".urlencode($titledoc)."&cat=".urlencode($cat)."' target='_blank'>PDF de la catégorie</a>
            <a class='btn btn--contour btn--petit' href='download_cat_nat_csv.php?discipline=".urlencode($discipline)."&file=".urlencode($fileName)."&cat=".urlencode($cat)."' target='_blank'>CSV de la catégorie</a>
          </p>";

    echo "<form method='post' action='?$q'>";
    echo "<div class='tableau-conteneur'><table class='tableau saisie'><thead>
            <tr>
                <th>Nom</th>
                <th>Club</th>
                <th>Temps Natation</th>
                <th>Points Natation</th>
                <th>Différence Leader</th>
                <th>Saisie</th>
            </tr></thead><tbody>";

    $rows = $grouped[$cat];
    usort($rows, fn($a,$b)=>strcmp($b['nom'],$a['nom']));

    foreach ($rows as $ath) {
        echo "<tr>
                <td>".htmlspecialchars($ath['nom'])."</td>
                <td>".htmlspecialchars($ath['club'] ?? '')."</td>
                <td>".e($ath['temps_natation'] ?? '')."</td>
                <td>".e($ath['points_nat'] ?? '')."</td>
                <td>".e($ath['diff_points_leader'] ?? '')."</td>
                <td>
                    <input type='text' 
                           name='temps_natation[".htmlspecialchars($ath['nom'])."]'
                           value='".htmlspecialchars($ath['temps_natation_brut'] ?? '')."'
                           placeholder=\"ex : 1'12''34 ou dns\">
                </td>
            </tr>";
    }

    echo "</tbody></table></div>
          <div class='boutons' style='margin-top:18px'><button type='submit' class='w3-button'>Enregistrer les temps de la catégorie</button></div>
          </form></div></div>";
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
echo "<div class='boutons'>
    <a class='btn' href='ajouter_temps_lr.php?$q'>Saisir les temps de laser run</a>
    <a class='btn btn--contour' href='resultats.php?discipline=".urlencode($discipline)."&title=".urlencode($title)."&file=".urlencode($fileName)."'>Voir les résultats</a>
    <a class='btn btn--contour' href='download_nat.php?discipline=".urlencode($discipline)."&file=".urlencode($fileName)."&title=".urlencode($title)."' target='_blank'>PDF complet</a>
</div></div></section>";

footer();
