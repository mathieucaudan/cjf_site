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
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js'></script>

         <style>
            body {margin:0;font-family:Arial}

        .topnav {
        overflow: hidden;
        background-color: #333;
        }

        .topnav a {
        float: left;
        display: block;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
        }

        .active {
        background-color: #04AA6D;
        color: white;
        }

        .topnav .icon {
        display: none;
        }

        .dropdown {
        float: left;
        overflow: hidden;
        }

        .dropdown .dropbtn {
        font-size: 17px;    
        border: none;
        outline: none;
        color: white;
        padding: 14px 16px;
        background-color: inherit;
        font-family: inherit;
        margin: 0;
        }

        .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        }

        .dropdown-content a {
        float: none;
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
        }

        .topnav a:hover, .dropdown:hover .dropbtn {
        background-color: #555;
        color: white;
        }

        .dropdown-content a:hover {
        background-color: #ddd;
        color: black;
        }

        .dropdown:hover .dropdown-content {
        display: block;
        }

        @media screen and (max-width: 600px) {
        .topnav a:not(:first-child), .dropdown .dropbtn {
            display: none;
        }
        .topnav a.icon {
            float: right;
            display: block;
        }
        }

        @media screen and (max-width: 600px) {
        .topnav.responsive {position: relative;}
        .topnav.responsive .icon {
            position: absolute;
            right: 0;
            top: 0;
        }
        .topnav.responsive a {
            float: none;
            display: block;
            text-align: left;
        }
        .topnav.responsive .dropdown {float: none;}
        .topnav.responsive .dropdown-content {position: relative;}
        .topnav.responsive .dropdown .dropbtn {
            display: block;
            width: 100%;
            text-align: left;
        }
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
    echo "<div class='topnav' id='myTopnav'>
    <a href='accueil.php' class='w3-bar-item w3-button'>ACCUEIL</a>
        <a href='contact.php' class='w3-bar-item w3-button'>CONTACT</a>
        <a href='partenaire.php' class='w3-bar-item w3-button'>PARTENAIRE</a>
        <a href='article.php' class='w3-bar-item w3-button'>ARTICLE</a>
    <div class='dropdown'>
      <button class='dropbtn'>COLLECTIF 
        <i class='fa fa-caret-down'></i>
      </button>
      <div class='dropdown-content'>
        <a href='coach.Php'>COACH</a>
        <a href='athletes.php'>ATHLETES</a>
      </div>
    </div>
    <div class='dropdown'>
      <button class='dropbtn'>LE CLUB 
        <i class='fa fa-caret-down'></i>
      </button>
      <div class='dropdown-content'>
        <a href='coach.Php'>RECORD</a>
        <a href='athletes.php'>CRENAUX</a>
      </div>
    </div>";
    if (isset($_SESSION['role'])) {
        echo "<a href='deconnexion.php' class='w3-right'><button  style='float: right' type='button'>Déconnexion</button></a>";
    } else {
        echo "<a href='connexion.php' class='w3-right'><button style='float: right' type='button'>Connexion</button></a>";
    }
    echo "<a><img src='image/logo_cjf.png' style='float: right; width: 50%; margin-top: 5px; margin-right: 10px'></a>";



    echo" 
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
function connexion(){
    echo "<div style='background-color: rgb(32, 47, 74); color: white; display: flex; justify-content: center; align-items: center; height: 100vh;>
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
    
        // Supprimer le fichier si l'action 'supprimer' est spécifiée
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
?>