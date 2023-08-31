<link rel='stylesheet' href='style/article.css'> <!-- Ajout de la référence au fichier CSS -->
<script src='script/article.js'></script> <!-- Ajout de la référence au fichier JS -->
<?php
include 'fonction.php';
entete();
echo "<body style='background-color: rgb(32, 47, 74);'>";
navbar();

$dossierPdf = './article/article_pdf';
$dossierImage = './article/article_image';
$dossierJson = './article/article_json/article.json';
        
$jsonData = file_get_contents($dossierJson);
$data = json_decode($jsonData, true);
?>

<main class="artcontent">
  <div id="cardsWrapper">
    <section class="artcards-wrapper"  >
      <?php
      foreach ($data as $article) {
        echo "<div class='artcard-grid-space'>
        <a class='artcard' href='$dossierPdf/" . pathinfo($article['image'], PATHINFO_FILENAME) . ".pdf' target='_blank' style='--bg-img: url($dossierImage/{$article['image']}); background-image: linear-gradient(rgba(0, 0, 0, var(--bg-filter-opacity)), rgba(0, 0, 0, var(--bg-filter-opacity))), var(--bg-img);'>
            <div>
                <h1>{$article['titre']}</h1>
                <p>{$article['description']}</p>
                <div>{$article['date']}</div>
                <div class='arttags'>
                    <div class='arttag'>
                        <form action='download.php' method='post' style='display:inline;'>
                            <input type='hidden' name='pdf' value='" . rawurlencode(pathinfo($article['image'], PATHINFO_FILENAME) . ".pdf") . "'>
                            <button type='submit' class='artcard-button' name='download'>Télécharger</button>
                        </form>
                    </div>
                </div>
            </div>
        </a>
      </div>";
      }
      ?>
    </section>
  </div>
</main>

<div class="artfooter">
  <div style="clear: both">
  <?php
  footer();
  ?>
    </div>
</div>






