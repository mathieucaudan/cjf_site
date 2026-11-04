<?php
include 'fonction.php';
exiger_admin('Temps de laser run');

$discipline = $_GET["discipline"] ?? null;
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
    'm40 hommes' => ['lr' => 460],
    'm40 femmes' => ['lr' => 460],
    'm50 hommes' => ['lr' => 460],
    'm50 femmes' => ['lr' => 460],
    'm60 hommes' => ['lr' => 320],
    'm60 femmes' => ['lr' => 320],
    'm70 hommes' => ['lr' => 240],
    'm70 femmes' => ['lr' => 240],
    'para hommes' => ['lr' => 320],
    'para femmes' => ['lr' => 320],
    'open hommes' => ['nat' => 320],
    'open femmes' => ['nat' => 320],
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

    header('Location: ?' . $q . '&success=1');
    exit;
}

// tri et ordre d’affichage des catégories
$cat_names = array_keys($grouped);
sort($cat_names, SORT_NATURAL | SORT_FLAG_CASE);




entete('Temps de laser run : ' . $nom_competition);
navbar();
bandeau($nom_competition, 'Temps de laser run par catégorie.', true);
echo "<section class='section section--serre'><div class='wrap'>";
echo "<p class='fil'><a href='compet.php'>Compétitions</a> / <a href='ajouter_athletes.php?$q'>Athlètes</a> / Temps de laser run</p>";
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

    $title = 'Résultat ' . ucfirst($discipline) . ' - ' . $nom_competition;
    $titledoc = "$title $cat";
    echo "<p><a class='btn btn--contour btn--petit' href='download_cat_lr.php?discipline=".urlencode($discipline)."&file=".urlencode($fileName)."&title=".urlencode($title)."&titledoc=".urlencode($titledoc)."&cat=".urlencode($cat)."' target='_blank'>PDF de la catégorie</a></p>";

    echo "<form method='post' action='?$q'>";
    echo "<div class='tableau-conteneur'><table class='tableau saisie'><thead>
            <tr>
                <th>Nom</th>
                <th>Club</th>";
    if ($discipline === 'triathle') echo "<th>Temps Natation</th><th>Points Natation</th>";
    echo "      <th>Temps Laser Run</th>
                <th>Points Laser Run</th>
                <th>Total</th>
                <th>Saisie</th>
            </tr></thead><tbody>";

    // Tri affichage alphabétique par nom (comme avant)
    $rows = $grouped[$cat];
    usort($rows, fn($a,$b)=>strcmp($a['nom'],$b['nom']));

    foreach ($rows as $ath) {
        echo "<tr>
                <td>".htmlspecialchars($ath['nom'])."</td>
                <td>".htmlspecialchars($ath['club'] ?? '')."</td>";
        if ($discipline === 'triathle') {
            echo "<td>".e($ath['temps_natation_brut'] ?? '')."</td>
                  <td>".e($ath['points_nat'] ?? '')."</td>";
        }
        echo "  <td>".e($ath['temps_laser_run'] ?? '')."</td>
                <td>".e($ath['points_lr'] ?? '')."</td>
                <td>".e($ath['total'] ?? '')."</td>
                <td>
                    <input type='text'
                           name='temps_laser_run[".htmlspecialchars($ath['nom'])."]'
                           value='".htmlspecialchars($ath['temps_laser_run_brut'] ?? '')."'
                           placeholder=\"ex : 2'34 ou dns\">
                </td>
            </tr>";
    }
    echo "</tbody></table></div>";

    echo "<div class='boutons' style='margin-top:18px'><button type='submit' class='w3-button'>Enregistrer les temps de la catégorie</button></div>";
    echo "</form>";
    echo "</div></div>";
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
echo "<div class='boutons'>
    <a class='btn' href='resultats.php?discipline=".urlencode($discipline)."&title=".urlencode($title)."&file=".urlencode($fileName)."'>Voir les résultats</a>
    <a class='btn btn--contour' href='download_lr.php?discipline=".urlencode($discipline)."&file=".urlencode($fileName)."&title=".urlencode($title)."' target='_blank'>PDF complet</a>
    <a class='btn btn--contour' href='ouvrir_competition.php?discipline=".urlencode($discipline)."'>Retour aux compétitions</a>
</div></div></section>";

footer();
