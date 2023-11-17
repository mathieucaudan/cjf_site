<link rel='stylesheet' href='style/laser_shot.css'>
<?php
include 'fonction.php';
entete();
echo "<audio id='backgroundMusic' src='musique.mp3' type='audio/mpeg'></audio>";
navbar();
?>
<style>
  /* Style pour centrer le bouton */
  #playButtonContainer {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 50vh;
  }

  #button-85 {
    padding: 20px 40px;
    font-size: 50px;
    cursor: pointer;
  }
</style>

<body style='margin: 20px; background-color: rgb(32, 47, 74); color: white;'>
  <?php
  $file = 'compteur.txt';
  if (!file_exists($file)) {
    $handle = fopen($file, 'w');
    fwrite($handle, '0');
    fclose($handle);
  }
  $count = file_get_contents($file);
  $count++;
  file_put_contents($file, $count);
  ?>


  <center>
    <h1>Laser Shot</h1>
  </center>

  <div id="playButtonContainer">
    <button id="button-85" class="button-85" role="button">Afficher les règles</button>
  </div>

  <!-- Déplacer la balise <div id="rules"> ici -->
  <div id="rules" style="display: none; text-align: center;">
    <h2>Règlement du jeu</h2>
    <h2>Préparation du jeu</h2>
    <ul>

      Cible à 10m<br>
      Alcool principal : Marquisette et alcool fort, bière si aucun alcool cité précédemment n'est présent !<br>
      Un pistolet minimum.<br>

    </ul>
    <h2>Déroulement du jeu</h2>
    <ul>

      Un tir pour allumer la cible.<br>
      Prendre son shot (alcool ou cul sec de bière).<br>
      Finir la cible.<br>
      Si la cible n'est pas finie, un shot supplémentaire sinon joueur suivant.<br>
      Si 5/5, un shot au joueur de ton choix.<br>
      Interdiction de toucher le joueur lorsqu'il tire, interdiction de toucher la cible et de se mettre entre la cible et le tireur.<br>

    </ul>
    <h2>Variante possible à deux cibles.</h2>
    <ul>

      Tableau 1/4, 1/2 et final<br>
      Match, pour définir le perdant, c'est celui qui met le plus de temps à finir la cible ou celui qui a mis moins de lumière verte, 1v1 le perdant prend un shot supplémentaire.<br>

    </ul>
  </div>


  <script>
    var audio = document.getElementById('backgroundMusic');
    var rulesDiv = document.getElementById('rules');

    // Fonction pour afficher les règles, lancer la musique lorsque le bouton est cliqué
    document.getElementById('playButton').addEventListener('click', function() {
      audio.play();
      document.getElementById('playButtonContainer').style.display = 'none';
      rulesDiv.style.display = 'block';
    });
  </script>

</body>

</html>