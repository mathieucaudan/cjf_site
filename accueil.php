<?php
include 'fonction.php';
entete();
echo "<link rel='stylesheet' href='style/accueil.css'> <!-- Ajout de la référence au fichier CSS -->
<script src='script/accueil.js'></script> <!-- Ajout de la référence au fichier JS -->";
navbar();
$dossierJson = './resultat.json';
$jsonData = file_get_contents($dossierJson);
$data = json_decode($jsonData, true);
?>

<body style='background-color: rgb(32, 47, 74); color:white'>
  <div class="accslider-container">
    <div class="accslider">
      <?php
      $imageFolder = "image/carousel/";
      $images = glob($imageFolder . "*.{jpg,png,gif,JPG,Jpg}", GLOB_BRACE);
      foreach ($images as $image) {
        echo "<img src='$image' alt='Image' class='acccustom-img'>";
      }
      ?>
    </div>
  </div>
  <div>
    <center>
      <h1>Accueil</h1>
    </center>
    <div class="w3-container w3-twothird w3-center">
      <h1>Article a la une</h1>
      <div class='art'>
        <?php
        $dossierPdf = './article/article_pdf';
        $dossierImage = './article/article_image';
        $dossierJson = './article/article_json/article.json';

        $jsonData = file_get_contents($dossierJson);
        $article = array_reverse(json_decode($jsonData, true));

        echo "<a class='artcard' href='$dossierPdf/" . pathinfo($article[0]['image'], PATHINFO_FILENAME) . ".pdf' target='_blank'>
        <div>
          <h2>{$article[0]['titre']}</h2>
          <p>{$article[0]['description']}</p>
          <div>{$article[0]['date']}</div>
        </div>
        <img src='$dossierImage/{$article[0]['image']}' class='titre-img'>";
        ?>
      </div>
    </div>
    <div class="w3-container w3-third w3-center">
      <h2>Derniers résultats/infos</h2>
      <div>
        <?php
        $reversedData = array_reverse($data);

        foreach ($reversedData as $article) {
          echo "<h1>{$article['titre']}</h1>
        <p>{$article['description']}</p>
        <div>{$article['date']}</div>
        <hr>";
        }
        ?>
      </div>
    </div>
    <script>
      // Appeler la fonction pour démarrer le slider automatique
      startSlider();
    </script>
</body>

<?php
footer();
?>