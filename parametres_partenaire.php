<link rel='stylesheet' href='style/parametres.css'> <!-- Ajout de la référence au fichier CSS -->
<script src='script/parametres.js'></script> <!-- Ajout de la référence au fichier JS -->

<?php
include 'fonction.php';
entete();
navbar();
echo "<body style='background-color: rgb(32, 47, 74);'>";
?>

<div class="tab" style='background-color: rgb(32, 47, 74); font-size: 40px'><center>
<body onload="openTab(event, 'ajoutPartenaire')">
  <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'ajoutPartenaire')">Ajouter un partenaire</button>
  <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'suppPartenaire')">Supprimer un partenaire</button>
</body>
</center></div>

<div id="ajoutPartenaire" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white; margin: 0 auto;'>
  <table>
  <?php
    ajoutPartenaire(); 
    ?>
  </table>
</div>

<div id="suppPartenaire" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white; margin: 0 auto;'>
  <table>
  <?php
    suppPartenaire();
    ?>
  </table>
</div>

<?php
footer();
echo "</body>";
?>

