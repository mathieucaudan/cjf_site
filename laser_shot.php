<?php
include 'fonction.php';
entete();
echo "<link rel='stylesheet' href='style/parametres.css'>";
navbar();
echo "<body style='background-color: rgb(32, 47, 74); color:white'>";

$filePath = 'compteur.json';

if (file_exists($filePath)) {
  $data = file_get_contents($filePath);
  $connexions = json_decode($data, true);
} else {
  $connexions = [];
}

$weekNumber = date('W');

if (array_key_exists($weekNumber, $connexions)) {
  $connexions[$weekNumber] = $connexions[$weekNumber] + 1;
} else {
  $connexions[$weekNumber] = 1;
}

file_put_contents($filePath, json_encode($connexions));
?>

<div class="container">
  <center>
    <h1>Laser Shot</h1>
  </center>
  <div id="playButtonContainer">
    <button id="button-85" class="button-85" role="button">Afficher les règles</button>
  </div>

  <div id="rules">
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
</div>
<script>
  var audio = document.getElementById('backgroundMusic');
  var rulesDiv = document.getElementById('rules');

  // Fonction pour afficher les règles, lancer la musique lorsque le bouton est cliqué
  document.getElementById('button-85').addEventListener('click', function() {
    audio.play();
    document.getElementById('playButtonContainer').style.display = 'none';
    rulesDiv.style.display = 'block';
  });
</script>

</body>

</html>