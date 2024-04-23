<link rel='stylesheet' href='style/global_tab.css'> <!-- Ajout de la référence au fichier CSS -->
<link rel='stylesheet' href='style/nous.css'> <!-- Ajout de la référence au fichier CSS -->
<script src='script/global_tab.js'></script> <!-- Ajout de la référence au fichier JS -->

<?php
include 'fonction.php';
entete();
echo "<body style='background-color: rgb(32, 47, 74); color:white;'>";
navbar();
?>

<h1 style='color:white'>
    <center>Gestion des Compétitions</center>
</h1>
<center>
    <div class="tab" style='background-color: rgb(32, 47, 74); font-size: 40px'>
        <button class="tablinks creer active" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'creer')">Créer une nouvelle compétition</button>
        <button class="tablinks ouvrir" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'ouvrir')">Ouvrir une compétition existante</button>
        <button class="tablinks supprimer" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'supprimer')">Supprimer une compétition existante</button>
    </div>
</center>

<div id="creer" class="tabcontent" style='display: block;'>

</div>


<div id="ouvrir" class="tabcontent">
    <?php
    // Répertoire où se trouvent les dossiers de compétition
    $competitions_directory = './competitions/';

    // Vérifier si le dossier "competitions" existe
    if (is_dir($competitions_directory)) {
        // Afficher la liste des dossiers de compétition
        echo "<h2>Choisir un dossier :</h2>";
        echo "<ul>";

        // Parcourir le répertoire des compétitions
        if ($handle = opendir($competitions_directory)) {
            while (false !== ($entry = readdir($handle))) {
                // Vérifier si l'entrée est un dossier et n'est pas . ou ..
                if ($entry != "." && $entry != ".." && is_dir($competitions_directory . $entry)) {
                    // Afficher le nom du dossier avec un lien vers cette page
                    echo "<li><a href='{$_SERVER['PHP_SELF']}?directory={$competitions_directory}{$entry}'>$entry</a></li>";
                }
            }
            closedir($handle);
        }

        echo "</ul>";

        // Vérifier si un dossier est sélectionné
        if (isset($_GET["directory"])) {
            // Si oui, afficher la liste des fichiers JSON dans ce dossier
            $selectedDirectory = $_GET["directory"];
            $selectedDirectoryParts = explode('/', $selectedDirectory);
            $competition_name = end($selectedDirectoryParts);
            echo "<h2>Fichiers dans la compétition $competition_name :</h2>";

            // Ouvrir le répertoire sélectionné
            if ($handle = opendir($selectedDirectory)) {
                echo "<ul>";
                // Parcourir le répertoire
                while (false !== ($file = readdir($handle))) {
                    // Vérifier si le fichier est un fichier JSON
                    if (pathinfo($file, PATHINFO_EXTENSION) == 'json') {
                        // Afficher le nom du fichier avec un lien vers test.php
                        echo "<li>{$file} - ";
                        $competition_name = basename($selectedDirectory);
                        echo "<a href='ajouter_athletes.php?competition={$competition_name}'>Ajouter Athletes</a> | ";
                        echo "<a href='ajouter_temps_nat.php?competition={$competition_name}'>Ajouter Temps Nat</a> | ";
                        echo "<a href='ajouter_temps_lr.php?competition={$competition_name}'>Ajouter Temps LR</a> | ";
                        echo "<a href='resultats.php?title=résultat&file={$selectedDirectory}/{$file}'>Résultats</a>";
                        echo "</li>";
                    }
                }
                echo "</ul>";
                // Fermer le gestionnaire de répertoire
                closedir($handle);
            } else {
                echo "<p>Aucun fichier JSON trouvé dans ce répertoire.</p>";
            }
        }
    } else {
        echo "<p>Aucun dossier 'competitions' trouvé.</p>";
    }
    ?>
    <a href="compet.php">Retour à l'accueil</a>
</div>


<div id="supprimer" class="tabcontent">

</div>

<?php
footer();
?>