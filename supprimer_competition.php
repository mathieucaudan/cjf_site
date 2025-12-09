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
?>

<center>
<h1>Choisir une compétition</h1>

<?php
$competitions_directory = './competitions/';

/**
 * Supprime une compétition dans une discipline
 * Exemple : competitions/triathle/competitionABC
 */
function supprimerCompetition($discipline, $competition)
{
    $path = "./competitions/$discipline/$competition";

    if (!is_dir($path)) {
        echo "<p>Le dossier n'existe pas : $path</p>";
        return;
    }

    // supprimer fichiers
    foreach (glob($path.'/*') as $file) {
        if (is_file($file)) unlink($file);
        if (is_dir($file)) rmdir($file);
    }

    // supprimer dossier
    if (rmdir($path)) {
        echo "<p>La compétition <b>$competition</b> a été supprimée avec succès.</p>";
    } else {
        echo "<p>Erreur lors de la suppression de $competition.</p>";
    }
}

/* -------------------------------------------------------
   SUPPRESSION D’UNE COMPETITION
------------------------------------------------------- */
if (isset($_GET['discipline']) && isset($_GET['competition'])) {

    $disc = $_GET['discipline'];
    $comp = $_GET['competition'];

    supprimerCompetition($disc, $comp);
}

/* -------------------------------------------------------
   LISTE DES DISCIPLINES
------------------------------------------------------- */

echo "<h2>Choisir une discipline :</h2>";

$disciplines = ['laserrun', 'triathle'];

echo "<ul>";

foreach ($disciplines as $disc) {
    echo "<li>
            <a class='w3-button' href='?discipline=$disc'>
                ".ucfirst($disc)."
            </a>
          </li>";
}

echo "</ul>";

/* -------------------------------------------------------
   SI UNE DISCIPLINE EST CHOISIE
------------------------------------------------------- */

if (isset($_GET['discipline'])) {

    $discipline = $_GET['discipline'];
    $discipline_path = "./competitions/$discipline/";

    if (!is_dir($discipline_path)) {
        echo "<p>Aucune compétition trouvée pour ".htmlspecialchars($discipline).".</p>";
        echo "</center>";
        footer();
        exit;
    }

    echo "<h2>Compétitions dans : ".ucfirst($discipline)."</h2>";

    echo "<ul>";

    $dirs = scandir($discipline_path);
    foreach ($dirs as $entry) {
        if ($entry === '.' || $entry === '..') continue;

        if (is_dir($discipline_path . $entry)) {

            echo "<li>
                    <b>$entry</b> —
                    <a class='w3-button w3-red' 
                       href='?discipline=$discipline&competition=$entry'
                       onclick='return confirm(\"Supprimer cette compétition ?\")'>
                        Supprimer
                    </a>
                  </li>";
        }
    }

    echo "</ul>";
}

?>

<a class='w3-button' href="compet.php">Retour à l'accueil</a>
</center>

<?php
footer();
echo "</body>";
?>
