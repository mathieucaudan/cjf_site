<link rel='stylesheet' href='style/galerie_photo.css'> <!-- Ajout de la référence au fichier CSS -->
<script src='script/galerie.js'></script> <!-- Ajout de la référence au fichier JS -->

<?php
include 'fonction.php';
entete();
echo "<body style='background-color: rgb(32, 47, 74);'>";
navbar();
?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<?php
$dossierJson = './galerie/galerie_json/data.json';
        
$jsonData = file_get_contents($dossierJson);
$data = json_decode($jsonData, true);
?>

<center><h1>Galerie photo</h1></center>

<main class="galcontent">
  <div id="cardsWrapper">
    <section class="galcards-wrapper"  >
      <?php
      foreach ($data as $galerie) {
        echo "<script>
        console.log('./{$galerie['path_image']}');
        </script>";
        echo "<div class='galcard-grid-space'>
        <a class='galcard' href='{$galerie['lien']}' target='_blank' style='background-image: url(./galerie/galerie_image/{$galerie['path_image']});'>
            <div>
                <h1>{$galerie['titre']}</h1>
                <div>{$galerie['date']}</div>    
            </div>
        </a>
      </div>";
      }
      ?>
    </section>
  </div>
</main>

<div class="galfooter">
  <div style="clear: both">
  <?php
  footer();
  ?>
    </div>
</div>







