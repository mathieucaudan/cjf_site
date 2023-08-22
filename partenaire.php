<?php
include 'fonction.php';
entete();
echo "<body style='background-color: rgb(32, 47, 74);'>";
navbar();
?>
<h1 style="color: white;"><center>NOS PARTENAIRES</center></h1>
<div id="btn-grad">
    <a href="./partenaires/Dossier partenaires CJF Pentathlon Moderne.pdf" target="_blank">
        <button class="btn-grad">
            <span>Etre partenaire?</span>
        </button>
    </a>
</div>

<?php
$dossierImage = './partenaires/partenaires_images/';
$dossierJson = './partenaires/partenaires_json/partenaires.json';
        
$jsonData = file_get_contents($dossierJson);
$data = json_decode($jsonData, true);

echo"<div class='containerResponsive'>";
foreach ($data as $article) {
    echo "<div class='item'>
            <div class='flip-card'>
                <div class='flip-card-inner'>
                        <div class='flip-card-front'>
                        <img src='" .$dossierImage. $article['image'] . "'>
                        </div>
                        <div class='flip-card-back'>
                            <h1>{$article['titre']}</h1> 
                            <p>{$article['description']}</p> 
                        </div>
                </div>
            </div>
        </div>";
  
  }
echo"</div>";
?>

 
</div>

<style>
        .containerResponsive {
            display: grid;
            gap: 10px;
            justify-items: center;
        }
        
        .item {
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid #ccc;
        }
        
        .item img {
            max-width: 100%;
            height: auto;
        }

        /* Utilisation des Media Queries pour ajuster le nombre d'images par ligne */
        @media screen and (max-width: 1100px) {
            .containerResponsive {
                grid-template-columns: repeat(1,1fr);
            }

            .flip-card {
                width: 50vw;
                height: 50vw;
                perspective: 1000px;
            }
        }


        @media screen and (min-width: 1100px) {
            .containerResponsive {
                grid-template-columns: repeat(auto-fit, minmax(30vw, 1fr));
            }

            .flip-card {
            /*background-color: transparent;*/
            width: 30vw;
            height: 30vw;
            perspective: 1000px;
            }
        }
        .flip-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        text-align: center;
        transition: transform 0.6s;
        transform-style: preserve-3d;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        }

        .flip-card-front img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ajuste l'image pour remplir l'espace */
        }

        .flip-card:hover .flip-card-inner {
        transform: rotateY(180deg);
        }

        .flip-card-front, .flip-card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        }

        .flip-card-front {
        background-color: #bbb;
        color: black;
        }

        .flip-card-back {
        background-color: #2980b9;
        color: white;
        transform: rotateY(180deg);
        }
                 
                 
        .btn-grad {
            background-image: linear-gradient(to right, #4b6cb7 0%, #182848  51%, #4b6cb7  100%);
            margin: 10px;
            padding: 15px 45px;
            text-align: center;
            text-transform: uppercase;
            transition: 0.5s;
            background-size: 200% auto;
            color: white;            
            border-radius: 10px;
            display: block;
          }

          .btn-grad:hover {
            background-position: right center; /* change the direction of the change here */
          }
         
         

</style>

<?php
footer();
echo "</body>";
?>