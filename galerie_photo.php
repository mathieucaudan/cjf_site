<link rel='stylesheet' href='style/galerie_photo.css'> <!-- Ajout de la référence au fichier CSS -->


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


<script>
  function adjustContentHeight() {
    const cardsWrapper = document.getElementById('galcardsWrapper');
    const content = document.querySelector('.galcontent');
    const cards = cardsWrapper.querySelectorAll('.galcard');

    let totalHeight = 0;
    cards.forEach(card => {
      totalHeight += card.clientHeight;
    });

    // Déterminez le nombre d'articles par ligne en fonction de la largeur de l'écran
    let articlesPerRow = 3; // Par défaut, 3 articles par ligne
    if (window.innerWidth <= 1285 && window.innerWidth > 900) {
      articlesPerRow = 2; // 2 articles par ligne entre 900px et 1285px
    } else if (window.innerWidth <= 900) {
      articlesPerRow = 1; // 1 article par ligne en dessous de 900px
    }

    // Calculez la hauteur minimale de la section de contenu en fonction du nombre d'articles par ligne
    const minHeight = Math.ceil(cards.length / articlesPerRow) * totalHeight / articlesPerRow;
    content.style.minHeight = minHeight + 'px';

    console.log('Nouvelle hauteur de .content:', minHeight + 'px');
  }

  document.addEventListener('DOMContentLoaded', adjustContentHeight);
  window.addEventListener('resize', adjustContentHeight);
</script>






