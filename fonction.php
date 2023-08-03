<?php
include 'login.php';
function entete(){
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>CJF Saint-Malo Pentathlon Moderne</title>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Amatic+SC'>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css' rel='stylesheet'>
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js'></script>

        <style>
            body,
            html {
                height: 100%;
            }

            body,
            h1,
            h2,
            h3,
            h4,
            h5,

            h6 {
                font-family: 'Times New Roman', sans-serif;
            }


            /* Existing styles */
            /* ... */
    
            /* New styles for burger menu */
            .burger-menu {
                display: none; /* Hide the burger menu by default */
                cursor: pointer;
                margin-right: 10px;
            }
            
            .bar {
                width: 25px;
                height: 2.5px;
                background-color: white;
                margin-bottom: 6px;
            }
    
            @media screen and (max-width: 1020px) {
                /* Show burger menu icon and hide the regular menu on small screens */
                #myNavbar {
                    display: none;
                }
                
                .burger-menu {
                    width: 100%;
                    height: 20px;
                    margin-top: 15px;
                    display: block!important;
                }
            }

            .burger-menu {
                display: none;
            }

            #burgerMenu {
                display: none;
            }

        </style>
     </head>";
    }
function footer() {
    echo "
    <footer class='w3-center w3-padding-48 w3-xxlarge' style='background-color: rgb(32, 47, 74); color: white;'>
    <p>En espérant vous voir à l'entraînement</p>
        <div>
            <a href='https://www.instagram.com/cjf_pentathlonmoderne/' target='_blank'><img src='image/logo_insta.png' alt='Instagram' style='width: 50px; height: 50px;'></a>
            <a href='https://www.facebook.com/profile.php?id=100085812112831'><img src='image/logo_facebook.png' alt='Facebook' style='width: 50px; height: 50px;'></a>
        </div>
    </footer>";
    }


    function navbar() {
        echo "<div class='w3-top' style='background-color: rgb(32, 47, 74); color: white;'>
            <div class='w3-bar w3-xlarge' id='myNavbar'>
                <a href='accueil.php' class='w3-bar-item w3-button'>ACCUEIL</a>
                <a href='contact.php' class='w3-bar-item w3-button'>CONTACT</a>
                <a href='partenaire.php' class='w3-bar-item w3-button'>PARTENAIRE</a>
                <a href='#'><img src='image/logo_cjf.png' style='float: right; width: 10%; margin-top: 5px; margin-right: 10px;'></a>
                <div class='w3-button-container'>
                    <a href='article.php' class='w3-bar-item w3-button'>ARTICLE</a>
                    <div class='w3-dropdown-hover'>
                        <a class='w3-button'>COLLECTIF</a>
                        <div class='w3-dropdown-content w3-bar-block w3-card-4'>
                            <a href='coach.php' class='w3-bar-item w3-button'>COACH</a>
                            <a href='athletes.php' class='w3-bar-item w3-button'>ATHLETES</a>
                        </div>
                    </div>
                    <div class='w3-dropdown-hover'>
                        <a class='w3-button'>LE CLUB</a>
                        <div class='w3-dropdown-content w3-bar-block w3-card-3'>
                            <a href='record.php' class='w3-bar-item w3-button'>RECORD</a>
                            <a href='creneaux.php' class='w3-bar-item w3-button'>CRENEAUX</a>
                        </div>
                    </div>";
    
        // Check if user is logged in and display appropriate menu items
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 'user') {
                echo "<a href='compte.php' class='w3-bar-item w3-button'>COMPTE</a>";
            } elseif ($_SESSION['role'] == 'admin') {
                echo "<a href='parametre.php' class='w3-bar-item w3-button'>PARAMETRE</a>";
            }
        }
    
        echo "</div></div>";
    
        // Show burger menu icon on small screens
        echo "<div class='w3-bar w3-xlarge burger-menu' onclick='toggleMenu()'>
                <div class='bar'></div>
                <div class='bar'></div>
                <div class='bar'></div>
              </div>";
    
        // Hide the regular menu on small screens
        echo "<div class='w3-bar-block w3-large' id='burgerMenu'>
                <a href='accueil.php' class='w3-bar-item w3-button'>ACCUEIL</a>
                <a href='contact.php' class='w3-bar-item w3-button'>CONTACT</a>
                <a href='partenaire.php' class='w3-bar-item w3-button'>PARTENAIRE</a>
                <a href='article.php' class='w3-bar-item w3-button'>ARTICLE</a>
                <a href='coach.php' class='w3-bar-item w3-button'>COACH</a>
                <a href='athletes.php' class='w3-bar-item w3-button'>ATHLETES</a>
                <a href='record.php' class='w3-bar-item w3-button'>RECORD</a>
                <a href='creneaux.php' class='w3-bar-item w3-button'>CRENEAUX</a>";
    
        // Check if user is logged in and display appropriate menu items in the burger menu
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 'user') {
                echo "<a href='compte.php' class='w3-bar-item w3-button'>COMPTE</a>";
            } elseif ($_SESSION['role'] == 'admin') {
                echo "<a href='parametre.php' class='w3-bar-item w3-button'>PARAMETRE</a>";
            }
        }
    
        echo "</div>";
    
        // JavaScript function to toggle the burger menu
        echo "<script>
                function toggleMenu() {
                    var menu = document.getElementById('burgerMenu');
                    //menu.classList.toggle('w3-show');
                    if (menu.style.display === 'block') {
                        menu.style.display = 'none';
                    } else {
                        menu.style.display = 'block';
                    }
                }

                function checkWindowWidth() {
                    var x = document.getElementById('myNavbar');
                    var burgerMenu = document.getElementById('burgerMenu');
                    if (window.innerWidth <= 1020) {
                        // Hide the regular menu and display the burger menu on small screens
                        x.style.display = 'none';
                        burgerMenu.style.display = 'block';
                    } else {
                        // Show the regular menu and hide the burger menu on larger screens
                        x.style.display = 'block';
                        burgerMenu.style.display = 'none';
                    }
                }
        
                // Call the function on window load and resize
                window.addEventListener('load', checkWindowWidth);
                window.addEventListener('resize', checkWindowWidth);
                
              </script>";
            

        
    }
    


    
    

function accueil() {
    echo "
    <!-- The slideshow/carousel -->
    <div id='demo' class='carousel slide' data-bs-ride='carousel'>
      <div class='carousel-indicators'>
        <button type='button' data-bs-target='#demo' data-bs-slide-to='0' class='active'></button>
        <button type='button' data-bs-target='#demo' data-bs-slide-to='1'></button>
        <button type='button' data-bs-target='#demo' data-bs-slide-to='2'></button>
      </div>
      <div class='carousel-inner' style='height: 800px;'> <!-- Définir la hauteur souhaitée pour les images -->
        <div class='carousel-item active'>
          <img src='image/podium_mixte.jpg' alt='Monde' class='d-block w-100 object-fit-cover' style='object-position: center bottom;'>
        </div>
        <div class='carousel-item'>
          <img src='image/podium_indiv.jpg' alt='France' class='d-block w-100 object-fit-cover' style='object-position: center bottom;'>
        </div>
        <div class='carousel-item'>
          <img src='image/lisbonne_wc.jpeg' alt='Insep' class='d-block w-100 object-fit-cover' style='object-position: center bottom;'>
        </div>
      </div>
      <!-- Left and right controls/icons -->
      <button class='carousel-control-prev' type='button' data-bs-target='#demo' data-bs-slide='prev'>
        <span class='carousel-control-prev-icon'></span>
      </button>
      <button class='carousel-control-next' type='button' data-bs-target='#demo' data-bs-slide='next'>
        <span class='carousel-control-next-icon'></span>
      </button>
    </div>";
    
    // Styles Bootstrap
    echo "
    <!--link href='https://cdn.jsdelivr.net/npm/bootstrap@5.7.2/dist/css/bootstrap.min.css' rel='stylesheet'-->
    
    <style>
    .carousel {
      margin-top: 15px;
      position: relative;
    }
    
    .carousel-control-prev,
    .carousel-control-next {
      top: 50%;
      transform: translateY(-50%);
      bottom: initial;
    }
    
    .object-fit-cover {
      object-fit: cover;
      height: 100%;
    }
    </style>";
    
    // Script JavaScript pour faire défiler les images automatiquement
    echo "
    <script>
    var carousel = document.getElementById('demo');
    var carouselInstance = new bootstrap.Carousel(carousel);
    
    setInterval(function() {
        carouselInstance.next();
    }, 3000); // Défilement toutes les secondes (1000 millisecondes)
    </script>";
    }
function contact(){
      echo "<div class='w3-container w3-padding-64 w3-xlarge'>
        <div class='w3-content'>
            <h1 class='w3-center w3-jumbo' style='margin-bottom:64px'>Contact</h1>
            <div>
        <strong>CJF Saint-Malo Pentathlon moderne</strong>
        <p>Marville</p>
        <p>35400 Saint-Malo</p>
    </div>
    <div>
        <p>Tel : 06-08-10-56-44</p>
        <p>Fax : 01 69 69 69 69</p>
        <p><strong><a href='mailto:cjf.saintmalo.pentathlonmoderne@gmail.com'>cjf.saintmalo.pentathlonmoderne@gmail.com</a></strong></p>
    </div>
    </div>
    </div>";
    }
function coach(){
    echo "<div style='background-color: rgb(32, 47, 74); color: white;'>
            <div class='container mt-5' style='background-color: rgb(32, 47, 74); color: white;'>
                <div class='row justify-content-center'>
                    <center><h1>Coach</h1></center>
                    <div class='col-sm-3'>
                        <img src='image/coach_arnaud.jpg' alt='Avatar' style='height: 300px; width: 306px; border-radius: 50%''>
                        <div class='container'>
                            <h4><b>Arnaud Eveillard</b></h4>
                            <p>description</p>
                        </div>
                    </div>
                    <div class='col-sm-3'>
                        <img src='image/coach_julien.jpg' alt='Avatar' style='height: 300px; width: 306px; border-radius: 50%''>
                        <div class='container'>
                            <h4><b>Julien Tertrain</b></h4>
                            <p>description</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
    }
function connexion(){
    echo "<div style='background-color: rgb(32, 47, 74); color: white; display: flex; justify-content: center; align-items: center; height: 100vh;'>
        <div>
            <center><h1 class='titre' style='font-size: 32px;'>Connexion</h1></center>
            <form action='/login.php' method='post'>
                <div class='form-group'>
                    <label for='identifiant'>Nom d'utilisateur:</label>
                    <input type='text' id='identifiant' name='identifiant' required>
                </div>
                <div class='form-group'>
                    <label for='password'>Mot de passe:</label>
                    <input type='password' id='password' name='password' required>
                </div>
                <div class='form-group'>
                    <input type='submit' value='Se connecter'>
                </div>
            </form>
        </div>
    </div>";
    }
function parametre(){
    echo" a faire: ajouter supprimer athletes et leur cards, changer les photos, supprimer et ajouter des articles,";
    }
function ajout(){
    $dossierPartage = './photo_card/';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter'])) {
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $identifiant = $_POST['identifiant'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $fichier = $_FILES['fichier'];

        // Récupérer l'extension du fichier
        $extension = strtolower(pathinfo($fichier['name'], PATHINFO_EXTENSION));

        // Renommer le fichier avec l'identifiant de l'utilisateur
        $nouveauNom = $identifiant . '.' . $extension;

        // Chemin complet du fichier de destination
        $cheminFichier = $dossierPartage . $nouveauNom;

        // Vérifier si le fichier a été correctement uploadé
        if ($fichier['error'] === UPLOAD_ERR_OK) {
            // Déplacer le fichier vers le dossier de destination avec le nouveau nom
            if (move_uploaded_file($fichier['tmp_name'], $cheminFichier)) {
                // Fichier uploadé avec succès, effectuer les autres opérations (insertion dans la base de données, etc.)
                // ...

                // Créer une carte pour l'utilisateur sur la page athletes.php
                $card = "
                <div class='col-sm-3'>
                    <img src='image/$nouveauNom' alt='Avatar' style='height: 300px; width: 306px; border-radius: 50%''>
                    <div class='container'>
                        <h4><b>$prenom $nom</b></h4>
                        <p>description</p>
                    </div>
                </div>";

                // Ajouter la carte à la page athletes.php
                file_put_contents('athletes.php', $card, FILE_APPEND);

                echo "<p class='w3-text-green'>Le fichier a été téléchargé avec succès.</p>";
            } else {
                echo "<p class='w3-text-red'>Erreur lors du déplacement du fichier.</p>";
            }
        } else {
            echo "<p class='w3-text-red'>Une erreur s'est produite lors du téléchargement du fichier.</p>";
        }
    }

    echo "<div class='w3-center w3-padding-48 w3-xxlarge' style='background-color: rgb(32, 47, 74); color: white;'>
        <h2 class='w3-center w3-padding-48 w3-xxlarge' style='background-color: rgb(32, 47, 74); color: white;'>Ajouter un utilisateur</h2>
        <form method='POST' action='' enctype='multipart/form-data'>
            <label for='prenom'>Prenom:</label>
            <input type='text' name='prenom' required><br><br>

            <label for='nom'>Nom:</label>
            <input type='text' name='nom' required><br><br>

            <label for='identifiant'>Identifiant:</label>
            <input type='text' name='identifiant' required><br><br>
            
            <label for='password'>Mot de passe:</label>
            <input type='password' name='password' required><br><br>
            
            <label for='role'>Rôle:</label>
            <input type='text' name='role' required><br><br>
            
            <label class='w3-text-white'>Sélectionner une photo :</label>
            <input class='w3-input w3-border' style='background-color: rgb(32, 47, 74)' type='file' name='fichier'>
            <br>
            <input class='w3-button' style='background-color: rgb(32, 47, 74)' type='submit' name='ajouter' value='Partager'>
        </form>
    </div>";
    }
function supprimer(){
    echo "<div class='w3-center w3-padding-48 w3-xxlarge' style='background-color: rgb(32, 47, 74); color: white;''>
    <h2 class='w3-center w3-padding-48 w3-xxlarge' style='background-color: rgb(32, 47, 74); color: white;'>Supprimer un utilisateur</h2>
        <form method='POST' action='del_user.php'>
            <label for='id'>Identifiant:</label>
            <input type='text' name='id' required><br><br>
            
            <label for='password'>Mot de passe:</label>
            <input type='password' name='password' required><br><br>
            
            <label for='role'>Rôle:</label>
            <input type='text' name='role' required><br><br>
            
            <input type='submit' value='Supprimer'>
        </form>
    </div>";
    }
function showarticle() {
        $dossierPartage = './article/';
    
        echo "
        <div class='w3-center w3-padding-48 w3-xxlarge' style='background-color: rgb(32, 47, 74); color: white;'>
            <div class='w3-content'>
                <h2 class='w3-center'>Liste des fichiers partagés :</h2>";
    
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
    
                // Afficher le bouton de téléchargement avec l'attribut download pour le téléchargement
                echo "<a class='w3-button' style='background-color: rgb(32, 47, 74)' href='$fichier' download>Télécharger</a>";
    
                // Afficher le bouton d'affichage pour ouvrir le fichier dans un nouvel onglet
                echo "<a class='w3-button' style='background-color: rgb(32, 47, 74)' href='$fichier' target='_blank'>Afficher</a>";
    
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p class='w3-center'>Aucun fichier partagé.</p>";
        }
    
        echo "</div>";
    
        // Supprimer le fichier si l'action "supprimer" est spécifiée
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'supprimer' && isset($_GET['fichier'])) {
            $fichier = $_GET['fichier'];
            $cheminFichier = $dossierPartage . $fichier;
    
            if (file_exists($cheminFichier)) {
                if (unlink($cheminFichier)) {
                    echo "<p class='w3-text-green' style='background-color: rgb(32, 47, 74)'>Fichier supprimé avec succès !</p>";
                } else {
                    echo "<p class='w3-text-red' style='background-color: rgb(32, 47, 74)'>Erreur lors de la suppression du fichier.</p>";
                }
            } else {
                echo "<p class='w3-text-red' style='background-color: rgb(32, 47, 74)'>Le fichier n'existe pas.</p>";
            }
             echo "</div>";
        }
    }
    
function ajoutarticle() {
        $dossierPartage = './article/';
    
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
    
            if (move_uploaded_file($fichierTemporaire, $cheminFichier)) {
                echo "<p class='w3-text-green'>Fichier partagé avec succès !</p>";
            } else {
                echo "<p class='w3-text-red'>Erreur lors du partage du fichier.</p>";
            }
        }
    
        echo "
        <div class='w3-center w3-padding-48 w3-xxlarge' style='background-color: rgb(32, 47, 74); color: white;'>
            <div class='w3-content'>
                <form class='w3-container' action='' method='POST' enctype='multipart/form-data'>
                    <label class='w3-text-white'>Sélectionner un article :</label>
                    <input class='w3-input w3-border' style='background-color: rgb(32, 47, 74)' type='file' name='fichier'>
                    <br>
                    <label class='w3-text-white'>Nom du fichier lors du téléchargement (facultatif) :</label>
                    <input class='w3-input w3-border' style='background-color: rgb(32, 47, 74)' type='text' name='nom_telechargement'>
                    <br>
                    <input class='w3-button' style='background-color: rgb(32, 47, 74)' type='submit' value='Partager'>
                </form>";
    
        echo "</div></div>";
    }
    

function leclub(){
    echo "<div class='w3-container w3-padding-64 w3-xlarge'>
        <div class='w3-content'>
            <h1 class='w3-center w3-jumbo' style='margin-bottom:64px'>Créneaux</h1>
            <div>
        <strong>Laser Run</strong>
        <p>Mercredi 18h00</p>
    </div>

    </div>
    </div>";
    
    }
?>