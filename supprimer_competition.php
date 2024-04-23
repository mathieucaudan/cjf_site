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
            <h1>Choisir un dossier de compétition</h1>

            <?php
            // Répertoire où se trouvent les dossiers de compétition
            $competitions_directory = './competitions/';

            // Fonction pour supprimer le dossier de compétition
            // Fonction pour supprimer le dossier de compétition avec ses fichiers
            function supprimerCompetition($directory)
            {
                if (is_dir($directory)) {
                    // Parcourir le dossier et supprimer tous les fichiers
                    $files = glob($directory . '/*');
                    foreach ($files as $file) {
                        if (is_file($file)) {
                            unlink($file);
                        }
                    }

                    // Supprimer le dossier
                    if (rmdir($directory)) {
                        echo "<p>La compétition a été supprimée avec succès.</p>";
                    } else {
                        echo "<p>Erreur lors de la suppression de la compétition.</p>";
                    }
                } else {
                    echo "<p>Le dossier de compétition n'existe pas.</p>";
                }
            }


            // Vérifier si un dossier de compétition doit être supprimé
            if (isset($_GET['competition'])) {
                $competition_name = $_GET['competition'];
                $competition_directory = $competitions_directory . $competition_name;
                supprimerCompetition($competition_directory);
            }

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
                            echo "<li><a class='w3-button' href='{$_SERVER['PHP_SELF']}?directory={$competitions_directory}{$entry}'>$entry</a></li>";
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
                    echo "<h2>Fichiers JSON dans le dossier $competition_name :</h2>";

                    // Ouvrir le répertoire sélectionné
                    if ($handle = opendir($selectedDirectory)) {
                        echo "<ul>";
                        // Parcourir le répertoire
                        while (false !== ($file = readdir($handle))) {
                            // Vérifier si le fichier est un fichier JSON
                            if (pathinfo($file, PATHINFO_EXTENSION) == 'json') {
                                // Afficher le nom du fichier avec un lien vers test.php
                                echo "<li>{$file} - ";
                                echo "<a class='w3-button' href='supprimer_competition.php?competition={$competition_name}'>Supprimer compétition</a>";
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
