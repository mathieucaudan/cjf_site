<?php
include 'login.php';
function entete()
{
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>CJF Saint-Malo Pentathlon Moderne</title>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <meta property='og:title' content='CJF Saint-Malo Pentathlon Moderne'>
        <meta name='description' content='Section Pentathlon Moderne du Cercle Jules Ferry Saint-Malo, LaserRun / Natation / Escrime / Obstacle'>
        <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Amatic+SC'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        <link rel='stylesheet' href='style/global.css'> <!-- Ajout de la référence au fichier CSS -->
        <link rel='stylesheet' href='style/footer.css'> <!-- Ajout de la référence au fichier CSS -->
        <link rel='stylesheet' href='style/navbar.css'> <!-- Ajout de la référence au fichier CSS -->
        <link rel='shortcut icon' href='image/favicon.webp'>
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js'></script>

     </head>";
}
function footer()
{
    echo "
    <footer class='footer-distributed' style='clear: both;'>

        <div class='footer-left'>

            <h3>En espérant vous voir <span>à l'entraînement</span></h3>

            <p class='footer-links'>
                <a href='accueil.php' class='link-1'>Accueil</a> |
                <a href='partenaire.php'>Partenaires</a> |
                <a href='article.php'>Articles</a> |
                <a href='record.php'>Records</a> |
                <a href='creneaux.php'>Créneaux</a> |
                <a href='nous.php'>Qui sommes nous ?</a> |
                <a href='section.php'>Section</a> |
                <a href='galerie_photo.php'>Galerie photo</a> |
                <a href='calendrier.php'>Calendrier</a> |
                <a href='inscription.php'>S'inscrire</a> |
                <a href='laser_shot.php' style='color: rgb(30, 60, 80)'>Laser Shot</a>
            </p>
        </div>

        <div class='footer-center'>
            <div>
                <i class='fa fa-map-marker'></i>
                <a href='https://maps.google.com/?q=22+avenue+de+Marvile' target='_blank' style='text-decoration: none;color: white'>22 avenue de Marvile</a>
            </div>

            <div>
                <i class='fa fa-phone'></i>
                <p><span><a href='tel:0608105644'>06 08 10 56 44</a></p>
            </div>

            <div>
                <i class='fa fa-envelope'></i>
                <p><a href='mailto:cjf.saintmalo.pentathlonmoderne@gmail.com' style='color: white;'>cjf.saintmalo.pentathlonmoderne@gmail.com</a></p>
            </div>
        </div>

        <div class='footer-right'>
            <p class='footer-company-about'>
                <span>Nous suivre sur les réseaux</span>
            </p>

            <div>
                <a href='https://www.instagram.com/cjf_pentathlonmoderne/' target='_blank'><img src='image/logo_insta.webp' alt='Instagram' style='width: 50px; height: 50px;'></a>
                <a href='https://www.facebook.com/profile.php?id=100085812112831' target='_blank'><img src='image/logo_facebook.webp' alt='Facebook' style='width: 50px; height: 50px;'></a>
            </div>

        </div>
        <div style='color:white'><center>
            <a>© Copyright  " . date("Y") . " |</a>
            <a> CJF Saint-Malo Pentathlon Moderne</a></br>
            <a>Tous droits réservés |</a>
            <a> Réalisé par les cracks du cjf</a>
        </center></div>
    </footer>";
}
function navbar()
{
    echo "
    <div class='navbarcontainer' style='background-color: rgb(32,47,74); color: white; text-align: center; padding: 10px;'>
    <img id='logoclub' class= 'logoclub' src='image/logo_cjf.webp'>    
        <h1>CJF PENTATHLON MODERNE</h1>
        <a href='https://www.instagram.com/cjf_pentathlonmoderne/' target='_blank'><img id='insta' class= 'insta' src='image/logo_insta.webp' alt='Instagram'></a>
        <a href='https://www.facebook.com/profile.php?id=100085812112831' target='_blank'><img id='facebook' class= 'facebook' src='image/logo_facebook.webp' alt='Facebook'></a>
    </div>
    <div class='topnav' id='myTopnav'>
    <a href='accueil.php' class='w3-bar-item w3-button'>ACCUEIL</a>
        <a href='partenaire.php' class='w3-bar-item w3-button'>PARTENAIRES</a>
        <a href='article.php' class='w3-bar-item w3-button'>ARTICLES</a>
    <div class='dropdown'>
      <button class='dropbtn'>LE CLUB 
        <i class='fa fa-caret-down'></i>
      </button>
      <div class='dropdown-content'>
        <a href='record.php'>RECORDS</a>
        <a href='creneaux.php'>CRENEAUX</a>
        <a href='nous.php'>QUI SOMMES NOUS?</a>
      </div>
    </div>
    <a href='section.php' class='w3-bar-item w3-button'>SECTION</a>
    <a href='galerie_photo.php' class='w3-bar-item w3-button'>GALERIE PHOTO</a>
    <a href='calendrier.php' class='w3-bar-item w3-button'>CALENDRIER</a>
    <a href='inscription.php' class='w3-bar-item w3-button'>S'INSCRIRE</a>";
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            echo "<div class='dropdown'>
                <button class='dropbtn'>PARAMETRES 
                    <i class='fa fa-caret-down'></i>
                </button>
                <div class='dropdown-content'>
                    <a href='parametres_record.php'>RECORDS</a>
                    <a href='parametres_article.php'>ARTICLES</a>
                    <a href='parametres_carousel.php'>CAROUSEL</a>
                    <a href='parametres_galerie.php'>GALERIE</a>
                    <a href='parametres_section.php'>SECTION</a>
                    <a href='parametres_calendrier.php'>CALENDRIER</a>
                    <a href='parametres_resultat.php'>INFO/RESULTAT</a>
                    <a href='parametres_nb_article.php'>ARTICLE ACCUEIL</a>
                    <a href='connexion_LR.php'>CONNEXION LR</a>
                    <a href='compet.php'>COMPET</a>
                </div>
                </div>";
        }
    }
    if (isset($_SESSION['role'])) {
        echo "<div class='loginButton'><a href='deconnexion.php' class='buttonContainer w3-right noHover'><button class='logButton'> Déconnexion
        <div class='logicon'>
          <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 22 22' width='22' height='22'><path fill='none' d='M0 0h24v24H0z'></path><path fill='currentColor' d='M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z'></path></svg>
        </div>
      </button></a></div>";
    } else {
        echo "<div class='loginButton'><a href='connexion.php' class='buttonContainer w3-right noHover'><button class='logButton'> Connexion
        <div class='logicon'>
          <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 22 22' width='22' height='22'><path fill='none' d='M0 0h24v24H0z'></path><path fill='currentColor' d='M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z'></path></svg>
        </div>
      </button></a></div>";
    }
    echo "
    <script>
        window.onload = function() {
            adjustLogoWidth();
            window.addEventListener('resize', adjustLogoWidth);
        };
    
        function adjustLogoWidth() {
            if (window.innerWidth <= 600) {
                logo.style.width = '20vw';
            } else {
                logo.style.width = '10vw';
            }
        }
    </script>";


    echo " 
    <a href='javascript:void(0);' style='font-size:15px;' class='icon' onclick='myFunction()'>&#9776;</a>
  </div>
  <script>
    function myFunction() {
        var x = document.getElementById('myTopnav');

        if (x.className === 'topnav') {
            x.className += ' responsive';
        } else {
            x.className = 'topnav';
        }
    }
    </script>";
}
function ajoutGalerie()
{
    // Vérifie si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupère les données du formulaire
        $titre = $_POST["titre"];
        $lien = $_POST["lien"];
        $date_formattee = $_POST["date"];
        $date = date("d/m/Y", strtotime($date_formattee));

        // Remplace les espaces par des tirets
        $fileName = str_replace(' ', '-', $_POST["nom_image"]);
        // Convertit en minuscules
        $fileName = strtolower($fileName);
        // Supprime les caractères non autorisés
        $fileName = preg_replace('/[^a-z0-9\-\.]/', '', $fileName);

        echo '<script>
            console.log("Nouveau file : ' . $fileName . '");
            </script>';

        // Récupère le nom de l'image et le nettoie
        $nomImage = $fileName;

        echo '<script>
        console.log("Error : ' . $_FILES["image"]["error"] . '");
        </script>';

        $imageTemp = $_FILES["image"]["tmp_name"];

        // Récupère l'extension de l'image
        $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

        // Chemin où les images seront stockées avec nom et extension
        $imagePath =  $nomImage . '.' . $extension;

        // Vérifier si l'image est au format WebP, si non, la convertir
        if ($extension !== "webp") {
            // Crée une image à partir du fichier
            $image = imagecreatefromstring(file_get_contents($imageTemp));

            // Enregistre l'image au format WebP
            $webpFilePath = 'image/galerie_image/' . $nomImage . '.webp';
            imagewebp($image, $webpFilePath);
            $imagePath = $nomImage . '.webp';

            // Libère la mémoire
            imagedestroy($image);
        } else {
            // Si l'image est déjà en format WebP, simplement la déplacer
            move_uploaded_file($imageTemp, 'image/galerie_image/' . $imagePath);
        }

        // Chemin du fichier JSON
        $jsonFile = "galerie/data.json";

        // Charge les données existantes du JSON
        $donneesExistantes = [];
        if (file_exists($jsonFile)) {
            $donneesExistantes = json_decode(file_get_contents($jsonFile), true);
        }

        // Vérifie si le titre ou le nom de l'image existe déjà
        $titreExiste = false;
        $nomImageExiste = false;
        foreach ($donneesExistantes as $item) {
            if ($item['titre'] == $titre) {
                $titreExiste = true;
            }
            if ($item['path_image'] == $imagePath) {
                $nomImageExiste = true;
            }
        }

        if (!$titreExiste && !$nomImageExiste) {
            // Crée un tableau avec les données du nouvel article
            $nouvelArticle = array(
                "titre" => $titre,
                "lien" => $lien,
                "date" => $date,
                "path_image" => $imagePath
            );

            // Ajoute le nouvel article aux données existantes
            $donneesExistantes[] = $nouvelArticle;

            // Convertit les données en format JSON sans échapper les barres obliques
            file_put_contents($jsonFile, json_encode($donneesExistantes, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        } else {
            if ($titreExiste) {
                echo '<script>console.log("Erreur: Un article avec le même titre existe déjà.");</script>';
            }
            if ($nomImageExiste) {
                echo '<script>console.log("Erreur: Une image avec le même nom existe déjà.");</script>';
            }
        }
    }
    // Affiche le formulaire si tu est admin
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            echo "<div class='w3-center w3-padding-48 w3-xxlarge' style='background-color: rgb(32, 47, 74); color: white;'>
            <div class='w3-content'>
                <form class='w3-container' action='' method='POST' enctype='multipart/form-data'>
                    <label class='w3-text-white' for='titre'>Titre du dossier :</label>
                    <input class='w3-input w3-border' style='background-color: rgb(32, 47, 74); color: white;' type='text' name='titre' required><br>
                        
                    <label class='w3-text-white' for='lien'>Lien Google Drive :</label>
                    <input class='w3-input w3-border' style='background-color: rgb(32, 47, 74); color: white;' type='text' name='lien' required><br>
                        
                    <label class='w3-text-white' for='date'>Date de l'album :</label>
                    <input class='w3-input w3-border' style='background-color: rgb(32, 47, 74); color: white;' type='date' name='date' required><br>
                        
                    <label class='w3-text-white' for='nom_image'>Nom de l'image :</label>
                    <input class='w3-input w3-border' style='background-color: rgb(32, 47, 74); color: white;' type='text' name='nom_image' required><br>
                        
                    <label class='w3-text-white' for='image'>Sélectionnez une image :</label>
                    <input class='w3-input w3-border' style='background-color: rgb(32, 47, 74); color: white;' type='file' name='image' accept='image/webp, image/webp, image/webp' required><br>
                        
                    <button type='submit'>Envoyer</button>
                </form>";
        }
    }
}

function suppGalerie()
{
    $dossierPartage = './galerie/';

    echo "
    <div class='w3-center w3-padding-48 w3-xxlarge' style='background-color: rgb(32, 47, 74); color: white;'>
        <div class='w3-content'>
            <h2 class='w3-center'>Liste des galeries partagés :</h2>";

    $fichiers = glob('image/galerie_image/*');

    if (count($fichiers) > 0) {
        echo "<ul class='w3-ul'>";
        foreach ($fichiers as $fichier) {
            $nomFichier = basename($fichier);
            echo "<li class='w3-padding'><span class='w3-large'>$nomFichier</span>";

            // Afficher le bouton de suppression pour les administrateurs
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                echo "<a class='w3-button' style='background-color: rgb(32, 47, 74)' href='?action=supprimer&fichier=$nomFichier'>Supprimer</a>";
            }

            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p class='w3-center'>Aucun article partagé.</p>";
    }

    echo "</div>";


    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'supprimer' && isset($_GET['fichier'])) {
        $fichierAvecExtension = $_GET['fichier'];
        $cheminImages = 'image/galerie_image/' . $fichierAvecExtension;

        if (file_exists($cheminImages)) {
            if (unlink($cheminImages)) {
                $cheminArticleJSON = $dossierPartage . 'data.json';
                if (file_exists($cheminArticleJSON)) {
                    $articlesJson = file_get_contents($cheminArticleJSON);
                    $articles = json_decode($articlesJson, true);

                    foreach ($articles as $key => $article) {
                        if ($article['path_image'] == $fichierAvecExtension) {
                            unset($articles[$key]);
                            break;
                        }
                    }

                    file_put_contents($cheminArticleJSON, json_encode(array_values($articles)));
                }
            }
        }
    }
    echo "</div>";
}
function suppArticle()
{
    $dossierPartage = './article/';

    echo "
    <div class='w3-center w3-padding-48 w3-xxlarge' style='background-color: rgb(32, 47, 74); color: white;'>
        <div class='w3-content'>
            <h2 class='w3-center'>Liste des articles partagés :</h2>";

    $fichiers = glob('image/article_image/*');

    if (count($fichiers) > 0) {
        echo "<ul class='w3-ul'>";
        foreach ($fichiers as $fichier) {
            $nomFichier = basename($fichier);
            echo "<li class='w3-padding'><span class='w3-large'>$nomFichier</span>";

            // Afficher le bouton de suppression pour les administrateurs
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                echo "<a class='w3-button' style='background-color: rgb(32, 47, 74)' href='?action=supprimer&fichier=$nomFichier'>Supprimer</a>";
            }

            echo "</li>";
        }
        echo "</ul>";
    }
    echo "</div>";
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'supprimer' && isset($_GET['fichier'])) {
        $fichierAvecExtension = $_GET['fichier'];
        $nomFichierPDF = pathinfo($fichierAvecExtension, PATHINFO_FILENAME);
        $cheminImages = 'image/article_image/' . $fichierAvecExtension;
        $cheminFichierPDF = glob('article/article_pdf/' . $nomFichierPDF . '.*');

        if (file_exists($cheminImages) && !empty($cheminFichierPDF)) {
            if (unlink($cheminImages)) {
                foreach ($cheminFichierPDF as $cheminFichierPDF) {
                    if (file_exists($cheminFichierPDF) && unlink($cheminFichierPDF)) {
                        $cheminArticleJSON = $dossierPartage . 'article.json';
                        if (file_exists($cheminArticleJSON)) {
                            $articlesJson = file_get_contents($cheminArticleJSON);
                            $articles = json_decode($articlesJson, true);

                            foreach ($articles as $key => $article) {
                                if ($article['image'] == $fichierAvecExtension) {
                                    unset($articles[$key]);
                                    break;
                                }
                            }

                            file_put_contents($cheminArticleJSON, json_encode(array_values($articles)));
                        }
                    }
                }
            }
        }
    }

    echo "</div>";
}
function suppImageCarousel()
{
    $dossierPartage = './image/carousel/';

    echo "
    <div class='w3-center w3-padding-48 w3-xxlarge' style='background-color: rgb(32, 47, 74); color: white;'>
        <div class='w3-content'>
            <h2 class='w3-center'>Liste des images du carousel :</h2>";

    $fichiers = glob($dossierPartage . '*');

    if (count($fichiers) > 0) {
        echo "<ul class='w3-ul'>";
        foreach ($fichiers as $fichier) {
            $nomFichier = basename($fichier);
            echo "<li class='w3-padding'><span class='w3-large'>$nomFichier</span>";

            // Afficher le bouton de suppression pour les administrateurs
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                echo "<a class='w3-button' style='background-color: rgb(32, 47, 74)' href='?action=supprimer&fichier=$nomFichier'>Supprimer</a>";
            }

            // Afficher le bouton d'affichage pour ouvrir le fichier dans un nouvel onglet
            echo "<a class='w3-button' style='background-color: rgb(32, 47, 74)' href='$fichier' target='_blank'>Afficher</a>";

            echo "</li>";
        }
        echo "</ul>";
    }
    echo "</div>";
    // Supprimer le fichier si l'action 'supprimer' est spécifiée
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'supprimer' && isset($_GET['fichier'])) {
        $fichier = $_GET['fichier'];
        $cheminFichier = $dossierPartage . $fichier;

        if (file_exists($cheminFichier)) {
            if (unlink($cheminFichier)) {
            }
        }
    }
    echo "</div>";
}
function changeRecord()
{
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            $disciplineChosen = false;
            $formSubmitted = false; // Variable pour vérifier si le formulaire a été soumis

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $discipline = $_POST['discipline'];

                // JavaScript pour masquer le formulaire de choix
                echo "<script>
                    document.getElementById('discipline-form').style.display = 'none';
                </script>";

                // Vérifiez si une discipline a été choisie
                if (!empty($discipline)) {
                    $disciplineChosen = true;
                }

                // Vérifiez si le formulaire a été soumis avec succès (vous devrez ajouter votre propre logique de validation ici)
                if (isset($_POST['categorie'])) {
                    $formSubmitted = true;
                }
            }
            // Affichez le bouton de retour uniquement lorsque la discipline a été choisie
            if ($disciplineChosen && !$formSubmitted) {
                echo "<div class='w3-large'>
                        <a href='javascript:history.back()' class='w3-button' style='background-color: rgb(32, 47, 74); color:white; text-decoration: none;'>Retour</a>
                    </div>";
            }


            // Affichez le formulaire de choix de discipline (seulement si une discipline n'a pas encore été choisie et si le formulaire n'a pas été soumis)
            if (!$disciplineChosen && !$formSubmitted) {
                echo "
                <div class='w3-center w3-padding-48 w3-xxlarge' style='background-color: rgb(32, 47, 74); color: white;'>
                    <form method='POST' name='formulaire' id='discipline-form'>
                        Discipline<br>
                        <input type='radio' name='discipline' value='Laser Run'> Laser Run<br>
                        <input type='radio' name='discipline' value='Triathlé'> Triathlé<br>
                        <input type='radio' name='discipline' value='Tetrathlon'> Tetrathlon<br>
                        <input type='radio' name='discipline' value='Pentathlon'> Pentathlon<br>
                        <input type='submit' value='Choisir'>
                    </form>
                </div>";
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if ($formSubmitted) {
                    echo "<h1 style='color:green'><center>Changement enregistré avec succès </center></h1>";
                } else {
                    echo "
                    <div class='w3-center w3-padding-48 w3-xxlarge' style='background-color: rgb(32, 47, 74); color: white;'>
                        <div class='w3-content'>
                            <form class='w3-container' action='' method='POST' enctype='multipart/form-data'>
                                Nom: <input class='w3-input w3-border' style='background-color: rgb(32, 47, 74); color: white;' type='text' name='nom' pattern='[A-Za-z\s,\\-]+' required><br>
                                Prénom: <input class='w3-input w3-border' style='background-color: rgb(32, 47, 74); color: white;' type='text' name='prenom' pattern='[A-Za-z\s,\\-]+' required><br>
                                Date: <input class='w3-input w3-border' style='background-color: rgb(32, 47, 74); color: white;' type='text' name='date' pattern='\d{2}/\d{2}/\d{4}' placeholder='jj/mm/aaaa' required><br>
                                Lieu: <input class='w3-input w3-border' style='background-color: rgb(32, 47, 74); color: white;' type='text' name='lieu' pattern='[A-Za-z\s,\\-]+' required><br>";

                    if ($discipline == 'Laser Run') {
                        echo "Temps : <input class='w3-input w3-border' style='background-color: rgb(32, 47, 74); color: white;' type='text' name='temps' pattern='(?:[0-9]{2}&#039;[0-9]{2}|[0-9]&#039;[0-9]{2})'' placeholder='mm&#039;ss' required><br>";
                    } else {
                        echo "Points: <input class='w3-input w3-border' style='background-color: rgb(32, 47, 74); color: white;' type='text' name='points' pattern='[0-9]+' required><br>";
                    }

                    if ($discipline == 'Laser Run') {
                        echo "Catégorie:
                    <select class='w3-input w3-border' style='background-color: rgb(32, 47, 74); color: white;' name='categorie'>
                    <option value=0>U9 F</option>
                    <option value=1>U9 H</option>
                    <option value=2>U11 F</option>
                    <option value=3>U11 H</option>
                    <option value=4>U13 F</option>
                    <option value=5>U13 H</option>
                    <option value=6>U15 F</option>
                    <option value=7>U15 H</option>
                    <option value=8>U17 F</option>
                    <option value=9>U17 H</option>
                    <option value=10>U19 F</option>
                    <option value=11>U19 H</option>
                    <option value=12>U22 F</option>
                    <option value=13>U22 H</option>
                    <option value=14>Senior F</option>
                    <option value=15>Senior H</option>
                    <option value=16>M40 F</option>
                    <option value=17>M40 H</option>
                    <option value=18>M50 F</option>
                    <option value=19>M50 H</option>
                    <option value=20>M60 F</option>
                    <option value=21>M60 H</option>
                    <option value=22>M70 F</option>
                    <option value=23>M70 H</option>
                    <option value=24>Longue Distance F</option>
                    <option value=25>Longue Distance H</option>
                    </select><br>";
                    } elseif ($discipline == 'Triathlé') {
                        echo "Catégorie:
                    <select class='w3-input w3-border' style='background-color: rgb(32, 47, 74); color: white;' name='categorie'>
                        <option value=0>U9 F</option>
                        <option value=1>U9 H</option>
                        <option value=2>U11 F</option>
                        <option value=3>U11 H</option>
                        <option value=4>U13 F</option>
                        <option value=5>U13 H</option>
                        <option value=6>U15 F</option>
                        <option value=7>U15 H</option>
                        <option value=8>U17 F</option>
                        <option value=9>U17 H</option>
                        <option value=10>U19 F</option>
                        <option value=11>U19 H</option>
                        <option value=12>U22 F</option>
                        <option value=13>U22 H</option>
                        <option value=14>Senior F</option>
                        <option value=15>Senior H</option>
                        <option value=16>M40 F</option>
                        <option value=17>M40 H</option>
                        <option value=18>M50 F</option>
                        <option value=19>M50 H</option>
                        <option value=20>M60 F</option>
                        <option value=21>M60 H</option>
                        <option value=22>M70 F</option>
                        <option value=23>M70 H</option>
                    </select><br>";
                    } elseif ($discipline == 'Tetrathlon') {
                        echo "Catégorie:
                    <select class='w3-input w3-border' style='background-color: rgb(32, 47, 74); color: white;' name='categorie'>
                        <option value=0>U17 F</option>
                        <option value=1>U17 H</option>
                        <option value=2>U19 F</option>
                        <option value=3>U19 H</option>
                        <option value=4>U22 F</option>
                        <option value=5>U22 H</option>
                        <option value=6>Senior F</option>
                        <option value=7>Senior H</option>
                        <option value=8>M30 F</option>
                        <option value=9>M30 H</option>
                        <option value=10>M40 F</option>
                        <option value=11>M40 H</option>
                        <option value=12>M50 F</option>
                        <option value=13>M50 H</option>
                        <option value=14>M60 F</option>
                        <option value=15>M60 H</option>
                        <option value=16>M70 F</option>
                        <option value=17>M70 H</option>
                    </select><br>";
                    } elseif ($discipline == 'Pentathlon') {
                        echo "Catégorie:
                    <select class='w3-input w3-border' style='background-color: rgb(32, 47, 74); color: white;' name='categorie'>
                        <option value=0>U17 F</option>
                        <option value=1>U17 H</option>
                        <option value=2>U19 F</option>
                        <option value=3>U19 H</option>
                        <option value=4>U22 F</option>
                        <option value=5>U22 H</option>
                        <option value=6>Senior F</option>
                        <option value=7>Senior H</option>
                        <option value=8>M30 F</option>
                        <option value=9>M30 H</option>
                        <option value=10>M40 F</option>
                        <option value=11>M40 H</option>
                        <option value=12>M50 F</option>
                        <option value=13>M50 H</option>
                        <option value=14>M60 F</option>
                        <option value=15>M60 H</option>
                        <option value=16>M70 F</option>
                        <option value=17>M70 H</option>
                    </select><br>";
                    }

                    echo "<input type='hidden' name='discipline' value='$discipline'>
                        <input class='w3-button' style='background-color: rgb(32, 47, 74); color:white' type='submit' value='Enregistrer'>
                    </form></div></div>";
                }
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['categorie'])) {
                    $data = json_decode(file_get_contents('record.json'), true);
                    $discipline = $_POST['discipline'];
                    $cat = $_POST['categorie'];
                    $newnom = $_POST['nom'];
                    $newprenom = $_POST['prenom'];
                    $newdate = $_POST['date'];
                    $newlieu = $_POST['lieu'];

                    if ($discipline == 'Laser Run') {
                        $newtemps = $_POST['temps'];
                        $data[$discipline][$cat]['temps'] = $newtemps;
                        list($minutes, $seconds) = explode("'", $newtemps);
                        $totalSeconds = $minutes * 60 + $seconds;
                        if ($data[$discipline][2]['temps'] != "-") {
                            list($minutes2, $seconds2) = explode("'", $data[$discipline][2]['temps']);
                            $totalSeconds2 = $minutes2 * 60 + $seconds2;
                        } else {
                            $totalSeconds2 = 3600;
                        }
                        if ($data[$discipline][3]['temps'] != "-") {
                            list($minutes3, $seconds3) = explode("'", $data[$discipline][3]['temps']);
                            $totalSeconds3 = $minutes3 * 60 + $seconds3;
                        } else {
                            $totalSeconds3 = 3600;
                        }
                        if ($data[$discipline][12]['temps'] != "-") {
                            list($minutes12, $seconds12) = explode("'", $data[$discipline][12]['temps']);
                            $totalSeconds12 = $minutes12 * 60 + $seconds12;
                        } else {
                            $totalSeconds12 = 3600;
                        }
                        if ($data[$discipline][13]['temps'] != "-") {
                            list($minutes13, $seconds13) = explode("'", $data[$discipline][13]['temps']);
                            $totalSeconds13 = $minutes13 * 60 + $seconds13;
                        } else {
                            $totalSeconds13 = 3600;
                        }
                        if ($data[$discipline][14]['temps'] != "-") {
                            list($minutes14, $seconds14) = explode("'", $data[$discipline][14]['temps']);
                            $totalSeconds14 = $minutes14 * 60 + $seconds14;
                        } else {
                            $totalSeconds14 = 3600;
                        }
                        if ($data[$discipline][15]['temps'] != "-") {
                            list($minutes15, $seconds15) = explode("'", $data[$discipline][15]['temps']);
                            $totalSeconds15 = $minutes15 * 60 + $seconds15;
                        } else {
                            $totalSeconds15 = 3600;
                        }
                        if ($cat == 10 and ($totalSeconds < $totalSeconds12)) {
                            if ($cat == 10 and ($totalSeconds < $totalSeconds14)) {
                                $data[$discipline][14]['nom'] = $newnom;
                                $data[$discipline][14]['prenom'] = $newprenom;
                                $data[$discipline][14]['date'] = $newdate;
                                $data[$discipline][14]['lieux'] = $newlieu;
                                $data[$discipline][14]['temps'] = $newtemps;

                                $data[$discipline][12]['nom'] = $newnom;
                                $data[$discipline][12]['prenom'] = $newprenom;
                                $data[$discipline][12]['date'] = $newdate;
                                $data[$discipline][12]['lieux'] = $newlieu;
                                $data[$discipline][12]['temps'] = $newtemps;
                            } else {
                                $data[$discipline][12]['nom'] = $newnom;
                                $data[$discipline][12]['prenom'] = $newprenom;
                                $data[$discipline][12]['date'] = $newdate;
                                $data[$discipline][12]['lieux'] = $newlieu;
                                $data[$discipline][12]['temps'] = $newtemps;
                            }
                        } elseif ($cat == 12 and ($totalSeconds < $totalSeconds14)) {
                            $data[$discipline][14]['nom'] = $newnom;
                            $data[$discipline][14]['prenom'] = $newprenom;
                            $data[$discipline][14]['date'] = $newdate;
                            $data[$discipline][14]['lieux'] = $newlieu;
                            $data[$discipline][14]['temps'] = $newtemps;
                        } else if ($cat == 11 and ($totalSeconds < $totalSeconds13)) {
                            if ($cat == 11 and ($totalSeconds < $totalSeconds15)) {
                                $data[$discipline][15]['nom'] = $newnom;
                                $data[$discipline][15]['prenom'] = $newprenom;
                                $data[$discipline][15]['date'] = $newdate;
                                $data[$discipline][15]['lieux'] = $newlieu;
                                $data[$discipline][15]['temps'] = $newtemps;

                                $data[$discipline][13]['nom'] = $newnom;
                                $data[$discipline][13]['prenom'] = $newprenom;
                                $data[$discipline][13]['date'] = $newdate;
                                $data[$discipline][13]['lieux'] = $newlieu;
                                $data[$discipline][13]['temps'] = $newtemps;
                            } else {
                                $data[$discipline][13]['nom'] = $newnom;
                                $data[$discipline][13]['prenom'] = $newprenom;
                                $data[$discipline][13]['date'] = $newdate;
                                $data[$discipline][13]['lieux'] = $newlieu;
                                $data[$discipline][13]['temps'] = $newtemps;
                            }
                        } else if ($cat == 13 and ($totalSeconds < $totalSeconds15)) {
                            $data[$discipline][15]['nom'] = $newnom;
                            $data[$discipline][15]['prenom'] = $newprenom;
                            $data[$discipline][15]['date'] = $newdate;
                            $data[$discipline][15]['lieux'] = $newlieu;
                            $data[$discipline][15]['temps'] = $newtemps;
                        } else if ($cat == 0 and ($totalSeconds < $totalSeconds2)) {
                            $data[$discipline][2]['nom'] = $newnom;
                            $data[$discipline][2]['prenom'] = $newprenom;
                            $data[$discipline][2]['date'] = $newdate;
                            $data[$discipline][2]['lieux'] = $newlieu;
                            $data[$discipline][2]['temps'] = $newtemps;
                        } else if ($cat == 1 and ($totalSeconds < $totalSeconds3)) {
                            $data[$discipline][3]['nom'] = $newnom;
                            $data[$discipline][3]['prenom'] = $newprenom;
                            $data[$discipline][3]['date'] = $newdate;
                            $data[$discipline][3]['lieux'] = $newlieu;
                            $data[$discipline][3]['temps'] = $newtemps;
                        }
                    } else {
                        $newpoints = $_POST['points'];
                        $data[$discipline][$cat]['points'] = $newpoints;
                        if ($discipline == 'Pentathlon') {
                            if ($cat == 3 and ($newpoints > $data[$discipline][5]['points'] or $data[$discipline][5]['points'] == "-")) {
                                if ($newpoints > $data[$discipline][7]['points'] or $data[$discipline][7]['points'] == "-") {
                                    $data[$discipline][7]['nom'] = $newnom;
                                    $data[$discipline][7]['prenom'] = $newprenom;
                                    $data[$discipline][7]['date'] = $newdate;
                                    $data[$discipline][7]['lieux'] = $newlieu;
                                    $data[$discipline][7]['points'] = $newpoints;

                                    $data[$discipline][5]['nom'] = $newnom;
                                    $data[$discipline][5]['prenom'] = $newprenom;
                                    $data[$discipline][5]['date'] = $newdate;
                                    $data[$discipline][5]['lieux'] = $newlieu;
                                    $data[$discipline][5]['points'] = $newpoints;
                                } else {
                                    $data[$discipline][5]['nom'] = $newnom;
                                    $data[$discipline][5]['prenom'] = $newprenom;
                                    $data[$discipline][5]['date'] = $newdate;
                                    $data[$discipline][5]['lieux'] = $newlieu;
                                    $data[$discipline][5]['points'] = $newpoints;
                                }
                            } else if ($cat == 5 and ($newpoints > $data[$discipline][7]['points']  or $data[$discipline][7]['points'] == "-")) {
                                $data[$discipline][7]['nom'] = $newnom;
                                $data[$discipline][7]['prenom'] = $newprenom;
                                $data[$discipline][7]['date'] = $newdate;
                                $data[$discipline][7]['lieux'] = $newlieu;
                                $data[$discipline][7]['points'] = $newpoints;
                            } else if ($cat == 2 and ($newpoints > $data[$discipline][4]['points'] or $data[$discipline][4]['points'] == "-")) {
                                if ($newpoints > $data[$discipline][6]['points'] or $data[$discipline][6]['points'] == "-") {
                                    $data[$discipline][6]['nom'] = $newnom;
                                    $data[$discipline][6]['prenom'] = $newprenom;
                                    $data[$discipline][6]['date'] = $newdate;
                                    $data[$discipline][6]['lieux'] = $newlieu;
                                    $data[$discipline][6]['points'] = $newpoints;

                                    $data[$discipline][4]['nom'] = $newnom;
                                    $data[$discipline][4]['prenom'] = $newprenom;
                                    $data[$discipline][4]['date'] = $newdate;
                                    $data[$discipline][4]['lieux'] = $newlieu;
                                    $data[$discipline][4]['points'] = $newpoints;
                                } else {
                                    $data[$discipline][4]['nom'] = $newnom;
                                    $data[$discipline][4]['prenom'] = $newprenom;
                                    $data[$discipline][4]['date'] = $newdate;
                                    $data[$discipline][4]['lieux'] = $newlieu;
                                    $data[$discipline][4]['points'] = $newpoints;
                                }
                            }
                        } else if ($discipline == 'Tetrathlon') {
                            if ($cat == 3 and ($newpoints > $data[$discipline][5]['points']  or $data[$discipline][5]['points'] == "-")) {
                                if ($newpoints > $data[$discipline][7]['points'] or $data[$discipline][7]['points'] == "-") {
                                    $data[$discipline][7]['nom'] = $newnom;
                                    $data[$discipline][7]['prenom'] = $newprenom;
                                    $data[$discipline][7]['date'] = $newdate;
                                    $data[$discipline][7]['lieux'] = $newlieu;
                                    $data[$discipline][7]['points'] = $newpoints;

                                    $data[$discipline][5]['nom'] = $newnom;
                                    $data[$discipline][5]['prenom'] = $newprenom;
                                    $data[$discipline][5]['date'] = $newdate;
                                    $data[$discipline][5]['lieux'] = $newlieu;
                                    $data[$discipline][5]['points'] = $newpoints;
                                } else {
                                    $data[$discipline][5]['nom'] = $newnom;
                                    $data[$discipline][5]['prenom'] = $newprenom;
                                    $data[$discipline][5]['date'] = $newdate;
                                    $data[$discipline][5]['lieux'] = $newlieu;
                                    $data[$discipline][5]['points'] = $newpoints;
                                }
                            } else if ($cat == 5 and ($newpoints > $data[$discipline][7]['points']  or $data[$discipline][7]['points'] == "-")) {
                                $data[$discipline][7]['nom'] = $newnom;
                                $data[$discipline][7]['prenom'] = $newprenom;
                                $data[$discipline][7]['date'] = $newdate;
                                $data[$discipline][7]['lieux'] = $newlieu;
                                $data[$discipline][7]['points'] = $newpoints;
                            } else if ($cat == 2 and ($newpoints > $data[$discipline][4]['points']  or $data[$discipline][4]['points'] == "-")) {
                                if ($newpoints > $data[$discipline][6]['points'] or $data[$discipline][6]['points'] == "-") {
                                    $data[$discipline][6]['nom'] = $newnom;
                                    $data[$discipline][6]['prenom'] = $newprenom;
                                    $data[$discipline][6]['date'] = $newdate;
                                    $data[$discipline][6]['lieux'] = $newlieu;
                                    $data[$discipline][6]['points'] = $newpoints;

                                    $data[$discipline][4]['nom'] = $newnom;
                                    $data[$discipline][4]['prenom'] = $newprenom;
                                    $data[$discipline][4]['date'] = $newdate;
                                    $data[$discipline][4]['lieux'] = $newlieu;
                                    $data[$discipline][4]['points'] = $newpoints;
                                } else {
                                    $data[$discipline][4]['nom'] = $newnom;
                                    $data[$discipline][4]['prenom'] = $newprenom;
                                    $data[$discipline][4]['date'] = $newdate;
                                    $data[$discipline][4]['lieux'] = $newlieu;
                                    $data[$discipline][4]['points'] = $newpoints;
                                }
                            }
                        } else if ($discipline == 'Triathlé') {
                            if ($cat == 11 and ($newpoints > $data[$discipline][13]['points']  or $data[$discipline][13]['points'] == "-")) {
                                if ($newpoints > $data[$discipline][15]['points'] or $data[$discipline][15]['points'] == "-") {
                                    $data[$discipline][15]['nom'] = $newnom;
                                    $data[$discipline][15]['prenom'] = $newprenom;
                                    $data[$discipline][15]['date'] = $newdate;
                                    $data[$discipline][15]['lieux'] = $newlieu;
                                    $data[$discipline][15]['points'] = $newpoints;

                                    $data[$discipline][13]['nom'] = $newnom;
                                    $data[$discipline][13]['prenom'] = $newprenom;
                                    $data[$discipline][13]['date'] = $newdate;
                                    $data[$discipline][13]['lieux'] = $newlieu;
                                    $data[$discipline][13]['points'] = $newpoints;
                                } else {
                                    $data[$discipline][13]['nom'] = $newnom;
                                    $data[$discipline][13]['prenom'] = $newprenom;
                                    $data[$discipline][13]['date'] = $newdate;
                                    $data[$discipline][13]['lieux'] = $newlieu;
                                    $data[$discipline][13]['points'] = $newpoints;
                                }
                            } else if ($cat == 13 and ($newpoints > $data[$discipline][15]['points']  or $data[$discipline][15]['points'] == "-")) {
                                $data[$discipline][15]['nom'] = $newnom;
                                $data[$discipline][15]['prenom'] = $newprenom;
                                $data[$discipline][15]['date'] = $newdate;
                                $data[$discipline][15]['lieux'] = $newlieu;
                                $data[$discipline][15]['points'] = $newpoints;
                            } else if ($cat == 10 and ($newpoints > $data[$discipline][12]['points']  or $data[$discipline][12]['points'] == "-")) {
                                if ($newpoints > $data[$discipline][14]['points'] or $data[$discipline][14]['points'] == "-") {
                                    $data[$discipline][14]['nom'] = $newnom;
                                    $data[$discipline][14]['prenom'] = $newprenom;
                                    $data[$discipline][14]['date'] = $newdate;
                                    $data[$discipline][14]['lieux'] = $newlieu;
                                    $data[$discipline][14]['points'] = $newpoints;

                                    $data[$discipline][12]['nom'] = $newnom;
                                    $data[$discipline][12]['prenom'] = $newprenom;
                                    $data[$discipline][12]['date'] = $newdate;
                                    $data[$discipline][12]['lieux'] = $newlieu;
                                    $data[$discipline][12]['points'] = $newpoints;
                                } else {
                                    $data[$discipline][12]['nom'] = $newnom;
                                    $data[$discipline][12]['prenom'] = $newprenom;
                                    $data[$discipline][12]['date'] = $newdate;
                                    $data[$discipline][12]['lieux'] = $newlieu;
                                    $data[$discipline][12]['points'] = $newpoints;
                                }
                            } else if ($cat == 0 and ($newpoints > $data[$discipline][2]['points']  or $data[$discipline][2]['points'] == "-")) {
                                $data[$discipline][2]['nom'] = $newnom;
                                $data[$discipline][2]['prenom'] = $newprenom;
                                $data[$discipline][2]['date'] = $newdate;
                                $data[$discipline][2]['lieux'] = $newlieu;
                                $data[$discipline][2]['points'] = $newpoints;
                            } else if ($cat == 1 and ($newpoints > $data[$discipline][3]['points']  or $data[$discipline][3]['points'] == "-")) {
                                $data[$discipline][3]['nom'] = $newnom;
                                $data[$discipline][3]['prenom'] = $newprenom;
                                $data[$discipline][3]['date'] = $newdate;
                                $data[$discipline][3]['lieux'] = $newlieu;
                                $data[$discipline][3]['points'] = $newpoints;
                            }
                        }
                    }

                    $data[$discipline][$cat]['nom'] = $newnom;
                    $data[$discipline][$cat]['prenom'] = $newprenom;
                    $data[$discipline][$cat]['date'] = $newdate;
                    $data[$discipline][$cat]['lieux'] = $newlieu;

                    // Sauvegardez le tableau mis à jour dans le fichier JSON
                    file_put_contents('record.json', json_encode($data, JSON_PRETTY_PRINT));
                }
            }
            // Affichez le bouton pour un nouveau record uniquement après que le formulaire a été soumis avec succès
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && $formSubmitted) {
                echo "<div class='w3-center w3-padding-48 w3-xxlarge'>
                        <button class='w3-button' style='background-color: rgb(32, 47, 74); color:white' onclick='redirectToPage()'>Ajouter un nouveau record</button>
                    </div>";
                // JavaScript pour rediriger l'utilisateur vers parametres_record.php
                echo "<script>
                    function redirectToPage() {
                        window.location.href = 'parametres_record.php';
                    }
                </script>";
            }
        }
    }
}
function ajoutArticle()
{
    $dossierPdf = './article/article_pdf/';
    $dossierImage = './image/article_image/';
    $dossierJson = './article/article.json';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['img'])) {
        // Déplacer le fichier vers son dossier de destination avec le nouveau nom
        $fichierTemporaire = $_FILES['fichier']['tmp_name'];
        $nomFichierOriginal = $_FILES['fichier']['name'];
        $nomFichierTelechargement = isset($_POST['nom_telechargement']) ? $_POST['nom_telechargement'] : '';

        $imageTemporaire = $_FILES['img']['tmp_name'];
        $nomImageOriginal = $_FILES['img']['name'];
        $nomImageTelechargement = isset($_POST['nom_telechargement']) ? $_POST['nom_telechargement'] : '';

        // Récupérer l'extension du fichier
        $extension = pathinfo($nomFichierOriginal, PATHINFO_EXTENSION);

        // Récupérer l'extension de l'image
        $extensionImage = pathinfo($nomImageOriginal, PATHINFO_EXTENSION);

        // Générer un nouveau nom de fichier en combinant l'ancien nom et le nom de téléchargement personnalisé (si fourni)
        $nouveauNomFichier = $nomFichierTelechargement ? $nomFichierTelechargement . '.' . $extension : $nomFichierOriginal;

        // Générer un nouveau nom d'image en combinant l'ancien nom et le nom de téléchargement personnalisé (si fourni)
        $nouveauNomImage = $nomImageTelechargement ? $nomImageTelechargement . '.' . $extensionImage : $nomImageOriginal;

        // Chemins des fichiers de destination
        $cheminFichier = $dossierPdf . $nouveauNomFichier;
        $cheminImage = $dossierImage . $nouveauNomImage;

        // Vérifier si l'extension de l'image est déjà en WebP
        if ($extensionImage !== "webp") {
            // Si ce n'est pas le cas, convertir l'image en format WebP
            $image = imagecreatefromstring(file_get_contents($imageTemporaire));
            imagepalettetotruecolor($image);
            $cheminImageWebP = $dossierImage . pathinfo($nouveauNomImage, PATHINFO_FILENAME) . '.webp';
            imagewebp($image, $cheminImageWebP);
            imagedestroy($image);
            $nouveauNomImage = pathinfo($nouveauNomImage, PATHINFO_FILENAME) . '.webp';
        }

        // Vérifier si le titre ou le nom de l'image existent déjà
        $data = json_decode(file_get_contents($dossierJson), true);
        $titreExiste = false;
        $imageExiste = false;
        foreach ($data as $item) {
            if ($item['titre'] == $_POST['titre']) {
                $titreExiste = true;
            }
            if ($item['image'] == $nouveauNomImage) {
                $imageExiste = true;
            }
        }

        // Afficher les messages d'erreur si le titre ou le nom de l'image existent déjà
        if ($titreExiste || $imageExiste) {
            if ($titreExiste) {
                echo '<script>alert("Un article avec ce titre existe déjà.");</script>';
            }
            if ($imageExiste) {
                echo '<script>alert("Une image avec ce nom existe déjà.");</script>';
            }
        } else {
            // Déplacer les fichiers vers leur dossier de destination avec les nouveaux noms
            if (move_uploaded_file($imageTemporaire, $cheminImage) && move_uploaded_file($fichierTemporaire, $cheminFichier)) {
                // Ajouter les données du nouvel article au fichier JSON
                $titre = $_POST['titre'];
                $image = $nouveauNomImage; // Utiliser le nouveau nom de l'image
                $description = $_POST['description_telechargement'];
                $date = $_POST['date_telechargement'];
                $nouvelArticle = array(
                    "titre" => $titre,
                    "image" => $image,
                    "description" => $description,
                    "date" => $date
                );
                $data[] = $nouvelArticle;
                file_put_contents($dossierJson, json_encode($data, JSON_PRETTY_PRINT));
            }
        }
    }

    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
        echo "
        <div class='w3-center w3-padding-48 w3-xxlarge' style='background-color: rgb(32, 47, 74); color: white;'>
            <div class='w3-content'>
                <form class='w3-container' action='' method='POST' enctype='multipart/form-data'>
                    <label class='w3-text-white'>Sélectionner un article :</label>
                    <input class='w3-input w3-border' style='background-color: rgb(32, 47, 74); color: white;' type='file' name='fichier' required>
                    <br>
                    <label class='w3-text-white'>Titre :</label>
                    <input class='w3-input w3-border' style='background-color: rgb(32, 47, 74); color: white;' type='text' name='titre' required>
                    <br>
                    <label class='w3-text-white'>Nom du fichier lors du téléchargement:</label>
                    <input class='w3-input w3-border' style='background-color: rgb(32, 47, 74); color: white;' type='text' name='nom_telechargement' pattern='[A-Za-z0-9_-]+' required>
                    <br>
                    <label class='w3-text-white'>Description :</label>
                    <input class='w3-input w3-border' style='background-color: rgb(32, 47, 74); color: white;' type='text' name='description_telechargement' required>
                    <br>
                    <label class='w3-text-white'>Date :</label>
                    <input class='w3-input w3-border' style='background-color: rgb(32, 47, 74); color: white;' type='text' name='date_telechargement' pattern='\d{2}/\d{2}/\d{2}' placeholder='jj/mm/aa' required>
                    <br>
                    <label class='w3-text-white'>Sélectionner une image :</label>
                    <input class='w3-input w3-border' style='background-color: rgb(32, 47, 74); color: white;' type='file' name='img' accept='image/webp, image/webp, image/webp' required>
                    <br>
                    <input class='w3-button' style='background-color: rgb(32, 47, 74)' type='submit' value='Partager' name='partage'>
                </form>";

        echo "</div></div>";
    }
}


function ajoutImageCarousel()
{
    $dossierPartage = './image/carousel/';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fichier'])) {
        $fichierTemporaire = $_FILES['fichier']['tmp_name'];
        $nomFichierOriginal = $_FILES['fichier']['name'];
        $nomFichierTelechargement = isset($_POST['nom_telechargement']) ? $_POST['nom_telechargement'] : '';

        // Récupérer l'extension du fichier
        $extension = pathinfo($nomFichierOriginal, PATHINFO_EXTENSION);

        // Générer un nouveau nom de fichier en combinant l'ancien nom et le nom de téléchargement personnalisé (si fourni)
        $nouveauNomFichier = $nomFichierTelechargement ? $nomFichierTelechargement . '.' . $extension : $nomFichierOriginal;

        // Déplacer le fichier vers le dossier de destination avec le nouveau nom
        $cheminFichier = $dossierPartage . $nouveauNomFichier;
        move_uploaded_file($fichierTemporaire, $cheminFichier);
    }
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            echo "
            <div class='w3-center w3-padding-48 w3-xxlarge' style='background-color: rgb(32, 47, 74); color: white;'>
                <div class='w3-content'>
                    <form class='w3-container' action='' method='POST' enctype='multipart/form-data'>
                        <label class='w3-text-white'>Sélectionner une image :</label>
                        <input class='w3-input w3-border' style='background-color: rgb(32, 47, 74)' type='file' name='fichier' accept='image/webp' required>
                        <br>
                        <label class='w3-text-white'>Nom du fichier lors du téléchargement (facultatif) :</label>
                        <input class='w3-input w3-border' style='background-color: rgb(32, 47, 74); color: white;' type='text' name='nom_telechargement' pattern='[A-Za-z0-9]+'>
                        <br>
                        <input class='w3-button' style='background-color: rgb(32, 47, 74)' type='submit' value='Partager'>
                    </form>";

            echo "</div></div>";
        }
    }
}
function ajoutArticleSection()
{
    $dossierJson = './section/articles.json';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données du formulaire
        $nouveauTitreArticle = $_POST['titre'];

        // Vérifier si un fichier PDF a été téléchargé
        if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] === 0) {
            $nomFichierPDF = $_FILES['pdf']['name'];
            $cheminFichierPDF = './section/articles/' . $nomFichierPDF;

            // Déplacer le fichier PDF vers le répertoire approprié
            if (move_uploaded_file($_FILES['pdf']['tmp_name'], $cheminFichierPDF)) {
                $data = json_decode(file_get_contents('./section/articles.json'), true);
                $titre = $_POST['titre'];

                // Sauvegardez le tableau mis à jour dans le fichier JSON
                $nouvelArticle = array(
                    "titre" => $titre,
                    "pdf" => $nomFichierPDF
                );

                $data[] = $nouvelArticle;
                file_put_contents($dossierJson, json_encode($data, JSON_PRETTY_PRINT));
            }
        }
    }
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            echo "
            <div class='w3-center w3-padding-48 w3-xxlarge' style='background-color: rgb(32, 47, 74); color: white;'>
                <div class='w3-content'>
                <form method='POST' enctype='multipart/form-data'>
                    <label for='titre'>Titre de l'article :</label>
                    <input class='w3-input w3-border' style='background-color: rgb(32, 47, 74); color: white;' type='text' name='titre' required>
                    
                    <label for='pdf'>Sélectionnez un PDF:</label>
                    <input class='w3-input w3-border' style='background-color: rgb(32, 47, 74); color: white;' type='file' name='pdf' accept='.pdf' required /><br>
                    
                    <input class='w3-button' style='background-color: rgb(32, 47, 74)' type='submit' value='Partager' name='Ajouter'>
                </form></div></div>";
        }
    }
}
function suppArticleSection()
{
    $dossierSection = './section/';

    echo "
    <div class='w3-center w3-padding-48 w3-xxlarge' style='background-color: rgb(32, 47, 74); color: white;'>
        <div class='w3-content'>
            <h2 class='w3-center'>Liste des articles de la section :</h2>";

    $fichiers = glob($dossierSection . 'articles/*');

    if (count($fichiers) > 0) {
        echo "<ul class='w3-ul'>";
        foreach ($fichiers as $fichier) {
            $nomFichier = basename($fichier);
            echo "<li class='w3-padding'><span class='w3-large'>$nomFichier</span>";

            // Afficher le bouton de suppression pour les administrateurs
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                echo "<a class='w3-button' style='background-color: rgb(32, 47, 74)' href='?action=supprimer&fichier=$nomFichier'>Supprimer</a>";
            }

            echo "</li>";
        }
        echo "</ul>";
    }
    echo "</div>";

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'supprimer' && isset($_GET['fichier'])) {
        $fichierAvecExtension = $_GET['fichier'];
        $cheminArticles = $dossierSection . 'articles/' . $fichierAvecExtension;

        // Vérifier si les fichiers existent
        if (file_exists($cheminArticles)) {
            // Suppression du fichier article associé
            if (unlink($cheminArticles)) {
                // Charger et mettre à jour le fichier articles.json
                $cheminArticlesJSON = $dossierSection . 'articles.json';
                if (file_exists($cheminArticlesJSON)) {
                    $articlesJson = file_get_contents($cheminArticlesJSON);
                    $articles = json_decode($articlesJson, true);

                    foreach ($articles as $key => $article) {
                        if ($article['pdf'] == $fichierAvecExtension) {
                            unset($articles[$key]);
                            break;
                        }
                    }

                    // Réindexer le tableau pour éviter les trous
                    $articles = array_values($articles);

                    file_put_contents($cheminArticlesJSON, json_encode($articles, JSON_PRETTY_PRINT));
                }
            }
        }
    }
}
function ajoutEvenement()
{
    $dossierJson = './calendrier.json';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données du formulaire
        $nouvelEvenement = $_POST['evenement'];
        $date = $_POST['date']; // La date est au format AAAA-MM-JJ

        // Extraire l'année, le mois et le jour
        list($annee, $mois, $jour) = explode('-', $date);

        // Charger le contenu actuel du fichier JSON
        $data = [];
        if (file_exists($dossierJson)) {
            $jsonContent = file_get_contents($dossierJson);
            $data = json_decode($jsonContent, true);
        }

        // Créer la clé de date au format AAAA-MM
        $dateCle = "$annee-$mois";

        // Vérifier si le mois existe, sinon le créer
        if (!isset($data[$dateCle])) {
            $data[$dateCle] = [];
        }
        // Formater le jour avec un seul chiffre si nécessaire
        $jour = ltrim($jour, '0');

        $data[$dateCle][$jour] = $nouvelEvenement;
        file_put_contents($dossierJson, json_encode($data, JSON_PRETTY_PRINT));
    }

    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            echo "
            <div class='w3-center w3-padding-48 w3-xxlarge' style='background-color: rgb(32, 47, 74); color: white;'>
                <div class='w3-content'>
                    <form method='POST' enctype='multipart/form-data'>
                    <label for='date'>Date de l'événement:</label>
                    <input class='w3-input w3-padding-16 w3-border' type='date' name='date' value='" . date('Y-m-d') . "' required><br>

                    <label for='evenement'>Événement:</label>
                    <input class='w3-input w3-padding-16 w3-border' type='text' name='evenement' required /><br>

                    <input class='w3-button' style='background-color: rgb(32, 47, 74)' type='submit' value='Partager' name='Ajouter'>
                    </form>
                </div>
            </div>";
        }
    }
}
function suppResultat()
{
    $dossierJson = './resultat.json';
    $dossierPdf = './info_pdf/';
    $dossierImage = './info_images/';

    // Charger le contenu actuel du fichier JSON
    $data = [];
    if (file_exists($dossierJson)) {
        $jsonContent = file_get_contents($dossierJson);
        $data = json_decode($jsonContent, true);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'supprimer') {
        if (isset($_GET['fichier'])) {
            $resultat = $_GET['fichier'];

            // Chercher l'article correspondant au titre
            foreach ($data as $key => $article) {
                if ($article['titre'] == $resultat) {
                    // Supprimer le fichier PDF du dossier si présent
                    if (!empty($article['pdf']) && file_exists($article['pdf'])) {
                        unlink($article['pdf']); // Supprimer le fichier PDF
                    }

                    // Supprimer l'image du dossier si présente
                    if (!empty($article['image']) && file_exists($article['image'])) {
                        unlink($article['image']); // Supprimer l'image
                    }

                    // Supprimer l'article du tableau
                    unset($data[$key]);
                    break;
                }
            }

            // Sauvegarder les modifications dans le fichier JSON
            file_put_contents($dossierJson, json_encode(array_values($data), JSON_PRETTY_PRINT));
        }
    }

    // Affichage des résultats
    echo "<div class='w3-center w3-padding-48 w3-xxlarge' style='background-color: rgb(32, 47, 74); color: white;'>
            <div class='w3-content'>";

    if (empty($data)) {
        echo "<h2 class='w3-center'>AUCUN RESULTAT ENREGISTRÉ</h2>";
    } else {
        echo "<h2 class='w3-center'>Liste des articles partagés :</h2>";
        echo "<ul class='w3-ul'>";
        foreach ($data as $article) {
            echo "<li class='w3-padding'><span class='w3-large'>" . htmlspecialchars($article['titre']) . "</span>";
            $resultat = htmlspecialchars($article['titre']);
            echo "<a class='w3-button' style='background-color: rgb(32, 47, 74)' href='?action=supprimer&fichier=$resultat'>Supprimer</a>";
            echo "</li>";
        }
        echo "</ul>";
    }

    echo "</div></div>";
}


function ajoutResultat()
{
    $dossierJson = './resultat.json';
    $dossierPdf = './info_pdf/';
    $dossierImage = './info_images/';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['description'])) {
        // Récupérer les données du formulaire
        $titre = $_POST['titre'];
        $date = $_POST['date']; // La date est au format AAAA-MM-JJ
        $description = $_POST['description'];
        $url = isset($_POST['url']) ? $_POST['url'] : null;
        $pdfPath = null;
        $imagePath = null;

        // Vérifier si un fichier PDF a été téléchargé
        if (!empty($_FILES['pdf']['name'])) {
            $pdfFileName = basename($_FILES['pdf']['name']);
            $targetPdfPath = $dossierPdf . $pdfFileName;

            // Déplacer le fichier PDF vers le dossier cible
            if (move_uploaded_file($_FILES['pdf']['tmp_name'], $targetPdfPath)) {
                $pdfPath = $targetPdfPath;
            } else {
                echo "<p>Erreur lors du téléchargement du fichier PDF.</p>";
                return;
            }
        }

        // Vérifier si une image a été téléchargée
        if (!empty($_FILES['image']['name'])) {
            $imageFileName = basename($_FILES['image']['name']);
            $targetImagePath = $dossierImage . $imageFileName;

            // Déplacer le fichier image vers le dossier cible
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetImagePath)) {
                $imagePath = $targetImagePath;
            } else {
                echo "<p>Erreur lors du téléchargement de l'image.</p>";
                return;
            }
        }

        // Charger le contenu actuel du fichier JSON
        $data = [];
        if (file_exists($dossierJson)) {
            $jsonContent = file_get_contents($dossierJson);
            $data = json_decode($jsonContent, true);
        }

        // Ajouter le nouvel article
        $nouvelArticle = array(
            "titre" => $titre,
            "description" => $description,
            "date" => $date,
            "url" => $url,
            "pdf" => $pdfPath,
            "image" => $imagePath
        );
        $data[] = $nouvelArticle;

        // Sauvegarder le tableau mis à jour dans le fichier JSON
        file_put_contents($dossierJson, json_encode($data, JSON_PRETTY_PRINT));
    }

    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
        echo "
        <div class='w3-center w3-padding-48 w3-xxlarge' style='background-color: rgb(32, 47, 74); color: white;'>
            <div class='w3-content'>
                <form method='POST' enctype='multipart/form-data'>
                    <label for='titre'>Titre:</label>
                    <input class='w3-input w3-padding-16 w3-border' type='text' name='titre' required><br>

                    <label for='date'>Date de l'événement:</label>
                    <input class='w3-input w3-padding-16 w3-border' type='date' name='date' value='" . date('Y-m-d') . "' required><br>

                    <label for='description'>Description:</label>
                    <input class='w3-input w3-padding-16 w3-border' type='text' name='description' required /><br>

                    <label for='url'>URL (optionnel, si aucun PDF):</label>
                    <input class='w3-input w3-padding-16 w3-border' type='url' name='url' /><br>

                    <label for='pdf'>Télécharger un PDF (optionnel, si aucune URL):</label>
                    <input class='w3-input w3-padding-16 w3-border' type='file' name='pdf' accept='application/pdf' /><br>

                    <label for='image'>Télécharger une image (optionnel):</label>
                    <input class='w3-input w3-padding-16 w3-border' type='file' name='image' accept='image/*' /><br>

                    <input class='w3-button' style='background-color: rgb(32, 47, 74)' type='submit' value='Partager' name='Ajouter'>
                </form>
            </div>
        </div>";
    }
}


function suppEvenement()
{
    $dossierJson = './resultat.json';

    // Charger le contenu actuel du fichier JSON
    $data = [];
    if (file_exists($dossierJson)) {
        $jsonContent = file_get_contents($dossierJson);
        $data = json_decode($jsonContent, true);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'supprimer') {
        if (isset($_GET['fichier'])) {
            if (file_exists($dossierJson)) {
                $articlesJson = file_get_contents($dossierJson);
                $articles = json_decode($articlesJson, true);
                $resultat = $_GET['fichier'];
                foreach ($articles as $key => $article) {
                    if ($article['titre'] == $resultat) { // Utilisez le nom de l'image avec extensions pour la comparaison
                        unset($articles[$key]);
                        break;
                    }
                }
                file_put_contents($dossierJson, json_encode(array_values($articles)));
            }
        }
    }


    if (empty($data)) {
        echo "Aucun élément à afficher.";
    } else {
        foreach ($data as $key => $article) {
            echo "<div>";
            echo $article['titre'];
            $resultat = $article['titre'];
            echo "<form method='POST'>";
            echo "<input type='hidden' name='index' value='$key'>"; // Champ caché pour l'index
            echo "<a class='w3-button' style='background-color: rgb(32, 47, 74)' href='?action=supprimer&fichier=$resultat'>Supprimer</a>";
            echo "</form>";
            echo "</div>";
        }
    }
}
function nombre_article()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $choix = $_POST['choix'];

        // Écrire la valeur dans le fichier nb_art.txt
        file_put_contents('nb_art.txt', $choix);
    }

    echo "
    <div class='w3-center w3-padding-48 w3-xxlarge' style='background-color: rgb(32, 47, 74); color: white;'>
        <div class='w3-content'>
            <form method='POST' enctype='multipart/form-data'>

                <label for='choix'>Nombre d'article sur la page d'accueil:</label><br>
                    <select name='choix'>
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                    </select><br>

                <input class='w3-button' style='background-color: rgb(32, 47, 74)' type='submit' value='Partager' name='Ajouter'>
            </form>
        </div>
    </div>";
}
