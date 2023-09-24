<link rel='stylesheet' href='style/laser_shot.css'> <!-- Ajout de la référence au fichier CSS -->

<?php
include 'fonction.php';
entete();
echo "<body style='margin: 20px; background-color: rgb(32, 47, 74); color: white;'>";
echo "<audio src='musique.mp3' autoplay></audio>";
navbar();
?>

<center>
  <h1>Laser Shot</h1>
</center>
<div>
  <h2>Règlement du jeu</h2>
  <h2>Préparation du jeu</h2>
  <ul>
    <il>
      Cible a 10m</br>
      Alcool principal : Marquisette et alcool fort, bière si aucun alcool cité précédemment n'est présent !</br>
      Un pistolet minimum.</br>
    </il>
  </ul>
  <h2>Déroulement du jeu</h2>
  <ul>
    <il>
      Un tir pour allumer la cible.</br>
      Prendre son shot(alcool ou cul sec de biere).</br>
      Finir la cible.</br>
      Si la cible n'est pas fini, un shot supplémentaire sinon joueur suivant.</br>
      Si 5/5, un shot au joueur de ton choix.</br>
      Interdiction de toucher le joueur lorsqu'il tir, interdiction de toucher la cible et se mettre entre la cible et le tireur.</br>
    </il>
  </ul>
  <h2>Variante possible à deux cibles.</h2>
  <ul>
    <il>
      Tableau 1/4, 1/2 et final</br>
      Match, pour définir le perdant, c'est celui qui met le plus de temps à finir la cible ou celui qui a mis moins de lumière verte, 1v1 le perdant prend un shot supplémentaire</br>
    </il>
  </ul>
</div>

<?php
footer();
echo "</body>";
?>
<script>
  document.addEventListener('click', function() {
    var audio = new Audio('musique.mp3');
    audio.play();
  });
</script>