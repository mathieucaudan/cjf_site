<link rel='stylesheet' href='style/partenaire.css'> <!-- Ajout de la référence au fichier CSS -->
<link rel='stylesheet' href='style/global_tab.css'> <!-- Ajout de la référence au fichier CSS -->
<script src='script/global_tab.js'></script> <!-- Ajout de la référence au fichier JS -->

<?php
include 'fonction.php';
entete();
echo"<body style='background-color: rgb(32, 47, 74); color:white;'>";
navbar();
?>
<h1 style='color:white'><center>Partenaires</center></h1>
<center><div class="tab" style='background-color: rgb(32, 47, 74); font-size: 40px'>
  <button class="tablinks partenaire active" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'partenaire')">Nos Partenaires</button>
  <button class="tablinks evenement" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'evenement')">Evenements</button>
</div></center>
<div id="partenaire" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white; display: block; text-align:center;'>
  <h3>Nos partenaires</h3>
  <table class='table'>
    <?php
        $dossierImage = './partenaires/partenaires_images/';
        $dossierJson = './partenaires/partenaires_json/partenaires.json';
                
        $jsonData = file_get_contents($dossierJson);
        $data = json_decode($jsonData, true);

        echo"<div class='parcontainerResponsive'>";
        foreach ($data as $article) {
            echo "<div class='paritem'>
                    <div class='parflip-card'>
                        <div class='parflip-card-inner'>
                                <div class='parflip-card-front'>
                                <img src='" .$dossierImage. $article['image'] . "'>
                                </div>
                                <div class='parflip-card-back'>
                                    <h1>{$article['nom']}</h1>
                                    <h1>{$article['nom_bis']}</h1>  
                                    <p>{$article['description']}</p> 
                                </div>
                        </div>
                    </div>
                </div>";
        
        }
        echo"</div>";
    ?>

    <a href="./partenaires/Dossier partenaires CJF Pentathlon Moderne.pdf" target="_blank" class="parcenter-button">
        <button class='parglowing-btn'>
            <span class='parglowing-txt'>NOUS <span class='parfaulty-letter'>REJOIN</span>DRE</span>
        </button>
    </a>
    </table> 
</div>


<?php
footer();
echo "</body>";
?>