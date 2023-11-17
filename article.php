<link rel='stylesheet' href='style/article.css'> <!-- Ajout de la référence au fichier CSS -->
<script src='script/article.js'></script> <!-- Ajout de la référence au fichier JS -->
<?php
include 'fonction.php';
entete();
echo "<body style='background-color: rgb(32, 47, 74);'>";
navbar();

$dossierPdf = './article/article_pdf';
$dossierImage = './image/article_image';
$dossierJson = './article/article.json';

$jsonData = file_get_contents($dossierJson);
$data = json_decode($jsonData, true);
?>

<h1 style="color: white;">
  <center>Les articles</center>
</h1>


<main class="artcontent">
  <div id="cardsWrapper">
    <section class="artcards-wrapper">
      <?php
      usort($data, function ($a, $b) {
        $dateA = DateTime::createFromFormat('d/m/Y', $a['date']);
        $dateB = DateTime::createFromFormat('d/m/Y', $b['date']);
        return $dateB <=> $dateA;
      });

      foreach ($data as $article) {
        echo "<div class='artcard-grid-space'>
        <a class='artcard' href='$dossierPdf/" . pathinfo($article['image'], PATHINFO_FILENAME) . ".pdf' target='_blank' style='--bg-img: url($dossierImage/{$article['image']}); background-image: linear-gradient(rgba(0, 0, 0, var(--bg-filter-opacity)), rgba(0, 0, 0, var(--bg-filter-opacity))), var(--bg-img);'>
            <div>
                <h2>{$article['titre']}</h2>
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