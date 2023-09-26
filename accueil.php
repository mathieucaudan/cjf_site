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
      <h2>Qu'est-ce que le</h2>
      <h2>Pentathlon Moderne ?</h2>
      <p>Le pentathlon moderne est une compétition sportive exigeante qui combine cinq disciplines distinctes pour couronner un champion. Ces épreuves sont soigneusement conçues pour refléter les compétences essentielles d'un soldat d'élite. Les athlètes rivalisent pour obtenir le meilleur score global en combinant leurs performances dans ces cinq disciplines.</p>

      <p>La première épreuve consiste en l'escrime, où les compétiteurs s'affrontent en duel à l'épée. L'objectif est de toucher l'adversaire tout en évitant d'être touché, et des points sont attribués en fonction des touches réussies.</p>

      <p>La natation représente la deuxième épreuve, où les athlètes doivent parcourir une distance de 200 mètres en utilisant le style libre. Les temps de nage sont enregistrés et convertis en points en fonction des performances individuelles.</p>

      <p>La troisième discipline est l'équitation, plus précisément le saut d'obstacles. Chaque athlète se voit attribuer un cheval par tirage au sort et dispose d'un court laps de temps pour se familiariser avec le cheval. L'objectif est de parcourir un parcours d'obstacles sans commettre de faute dans un temps limité.</p>

      <p>La quatrième épreuve, le Laser Run, est une combinaison unique de tir au pistolet et de course à pied. Les athlètes utilisent des pistolets laser pour viser des cibles situées à 10 mètres de distance, alternant avec des courses, et les scores sont déterminés par la précision des tirs et le temps de course. Enfin, la cinquième discipline, également intégrée au "Laser Run," consiste en des séries de tirs au pistolet laser entrelacées avec des courses, cette séquence étant répétée plusieurs fois au cours de la compétition.</p>

      <p>Le champion du pentathlon moderne est celui qui parvient à combiner habilement ses performances dans chacune de ces disciplines pour obtenir le score total le plus élevé. Ce sport, devenu une épreuve olympique en 1912, exige une polyvalence exceptionnelle et une grande capacité d'adaptation de la part des athlètes pour exceller dans l'ensemble de ces épreuves variées.</p>
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