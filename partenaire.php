<link rel='stylesheet' href='style/partenaire.css'> <!-- Ajout de la référence au fichier CSS -->


<?php
include 'fonction.php';
entete();
echo "<body style='background-color: rgb(32, 47, 74);'>";
navbar();
?>
<div class="parcontent-container">
    <h1 style="color: white;"><center>NOS PARTENAIRES</center></h1>


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
                                    <h1>{$article['titre']}</h1> 
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
</div>





 
</div>


<?php
footer();
echo "</body>";
?>