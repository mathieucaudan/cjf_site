<?php
include 'fonction.php';

entete();
echo "<link rel='stylesheet' href='style/parametres.css'>";
navbar();

echo "<body style='background-color: rgb(32, 47, 74); color:white'>";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<div class='w3-center w3-padding-48 w3-xxlarge'>
            <h2>Autorisation non accordée</h2>
          </div>";
    footer();
    exit;
}
?>

<center>
    <h1>Gestion des Compétitions</h1>
    <h2>Choisissez une discipline :</h2>
    <div style="display:flex; justify-content:center; gap:30px; margin-bottom:30px;">
        <a class='w3-button w3-blue' href='?discipline=laserrun'>Laser Run</a>
        <a class='w3-button w3-green' href='?discipline=triathle'>Triathlé</a>
    </div>

<?php
// Dossier racine des compétitions
$competitions_directory = './competitions/';

// Vérifie la discipline sélectionnée
if (isset($_GET['discipline'])) {
    $discipline = htmlspecialchars($_GET['discipline']);
    $discipline_path = $competitions_directory . $discipline . '/';

    if (!is_dir($discipline_path)) {
        echo "<p>Le dossier pour la discipline <b>$discipline</b> n'existe pas encore.</p>";
    } else {
        echo "<h2>Compétitions de $discipline :</h2>";

        // Liste les sous-dossiers
        $competitions = array_filter(scandir($discipline_path), function ($entry) use ($discipline_path) {
            return $entry !== '.' && $entry !== '..' && is_dir($discipline_path . $entry);
        });

        if (empty($competitions)) {
            echo "<p>Aucune compétition trouvée pour cette discipline.</p>";
        } else {
            echo "<ul style='list-style:none;'>";
            foreach ($competitions as $comp) {
                $path = $discipline_path . $comp;
                echo "<li style='margin-bottom:10px;'>
                        <a class='w3-button w3-border' href='?discipline=$discipline&directory=$path'>$comp</a>
                      </li>";
            }
            echo "</ul>";
        }

        // Si une compétition est sélectionnée
        if (isset($_GET['directory'])) {
            $selectedDirectory = htmlspecialchars($_GET['directory']);
            $competition_name = basename($selectedDirectory);

            echo "<hr><h2>Fichiers dans la compétition <b>$competition_name</b> :</h2>";

            if ($handle = opendir($selectedDirectory)) {
                echo "<ul style='list-style:none;'>";
                while (false !== ($file = readdir($handle))) {
                    if (pathinfo($file, PATHINFO_EXTENSION) == 'json') {
                        echo "<li style='margin-bottom:8px;'>
                                <b>$file</b> - 
                                <a class='w3-button w3-small w3-indigo' href='ajouter_athletes.php?competition=$competition_name&discipline=$discipline'>Ajouter Athlètes</a>
                                <a class='w3-button w3-small w3-teal' href='ajouter_temps_nat.php?competition=$competition_name&discipline=$discipline'>Ajouter Temps Nat</a>
                                <a class='w3-button w3-small w3-red' href='ajouter_temps_lr.php?competition=$competition_name&discipline=$discipline'>Ajouter Temps LR</a>
                                <a class='w3-button w3-small w3-orange' href='resultats.php?title=resultats&file=$selectedDirectory/$file&discipline=$discipline'>Résultats</a>
                              </li>";
                    }
                }
                echo "</ul>";
                closedir($handle);
            } else {
                echo "<p>Impossible d'ouvrir le dossier sélectionné.</p>";
            }
        }
    }

    echo "<a class='w3-button w3-gray' href='compet.php'>Retour</a>";
}

footer();
echo "</body>";
?>
