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
      $images = glob($imageFolder . "*.{jpg,png,gif,JPG,Jpg,jpeg,Jpeg,webp}", GLOB_BRACE);
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
      <div>
        <?php
        // Chemin du fichier contenant la valeur de nb_art
        $nb_art_file = 'nb_art.txt';

        // Vérifier si le fichier existe
        if (file_exists($nb_art_file)) {
          // Lire la valeur actuelle de nb_art à partir du fichier
          $nb_art = file_get_contents($nb_art_file);
        } else {
          // Valeur par défaut si le fichier n'existe pas
          $nb_art = 1;
        }

        // Vérifier si le formulaire a été soumis pour mettre à jour la valeur de nb_art
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          // Récupérer la nouvelle valeur de nb_art depuis le formulaire
          $new_nb_art = $_POST['nb_art'];

          // Écrire la nouvelle valeur de nb_art dans le fichier
          file_put_contents($nb_art_file, $new_nb_art);
        }
        $dossierPdf = './article/article_pdf';
        $dossierImage = './image/article_image';
        $dossierJson = './article/article.json';

        $jsonData = file_get_contents($dossierJson);
        $article = json_decode($jsonData, true);
        usort($article, function ($a, $b) {
          $dateA = DateTime::createFromFormat('d/m/Y', $a['date']);
          $dateB = DateTime::createFromFormat('d/m/Y', $b['date']);
          return $dateB <=> $dateA;
        });


        if ($nb_art == 1) {
          echo "<div class='article-container'>
          <div class='w3-container w3-quarter '>
          </div>
          <div class='w3-container w3-half w3-center'>
          <a class='artcard' href='$dossierPdf/" . pathinfo($article[0]['image'], PATHINFO_FILENAME) . ".pdf' target='_blank' style='text-decoration: none;'>
                <div>
                  <h2>{$article[0]['titre']}</h2>
                  <p>{$article[0]['description']}</p>
                  <div>{$article[0]['date']}</div>
                </div>
                <img src='$dossierImage/{$article[0]['image']}' class='titre-img'>
                </a>
          </div></div>";
        } elseif ($nb_art == 2) {
          echo "<div class='article-container'>";
          echo "<div class='w3-container w3-half w3-center'>";
          echo "<a class='artcard' href='$dossierPdf/" . pathinfo($article[0]['image'], PATHINFO_FILENAME) . ".pdf' target='_blank' style='text-decoration: none;'>
                <div>
                  <h2>{$article[0]['titre']}</h2>
                  <p>{$article[0]['description']}</p>
                  <div>{$article[0]['date']}</div>
                </div>
                <img src='$dossierImage/{$article[0]['image']}' class='titre-img'>
                </a>";
          echo "</div>";
          echo "<div class='w3-container w3-half w3-center'>";
          echo "<a class='artcard' href='$dossierPdf/" . pathinfo($article[1]['image'], PATHINFO_FILENAME) . ".pdf' target='_blank' style='text-decoration: none;'>
                <div>
                  <h2>{$article[1]['titre']}</h2>
                  <p>{$article[1]['description']}</p>
                  <div>{$article[1]['date']}</div>
                </div>
                <img src='$dossierImage/{$article[1]['image']}' class='titre-img'>
                </a>";
          echo "</div>";
          echo "</div>";
        }
        ?>
      </div>
    </div>
    <div class="w3-container w3-third w3-center">
      <h2>Derniers résultats/infos</h2>
        <div>
            <?php
            // Inverser les données pour afficher les plus récentes en premier
            $reversedData = array_reverse($data);
        
            foreach ($reversedData as $result) {
                echo "<h1>{$result['titre']}</h1>
                      <p>{$result['description']}</p>
                      <div>{$result['date']}</div>";
        
                // Vérifier et afficher une URL si elle est présente
                if (!empty($result['url'])) {
                    echo "<div><a href='{$result['url']}' target='_blank'>Voir plus</a></div>";
                }
        
                // Vérifier si un PDF est présent et afficher un lien pour l'ouvrir
                if (!empty($result['pdf'])) {
                    echo "<div><a href='{$result['pdf']}' target='_blank'>Voir le PDF</a></div>";
                }
        
                // Vérifier si une image est présente et l'afficher avec un style similaire à celui des articles
                if (!empty($result['image']) && file_exists($result['image'])) {
                    echo "<div><img src='{$result['image']}' alt='Image' class='titre-img' style='max-width: 100%; height: auto;'></div>";
                }
        
                echo "<hr>";
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