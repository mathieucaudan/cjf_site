<link rel='stylesheet' href='style/parametres.css'> <!-- Ajout de la référence au fichier CSS -->
<script src='script/parametres.js'></script> <!-- Ajout de la référence au fichier JS -->
<?php
include 'fonction.php';
entete();
navbar();
echo "<body style='background-color: rgb(32, 47, 74);'>";
?>

<div class="tab" style='background-color: rgb(32, 47, 74); font-size: 40px'><center>
<body onload="openTab(event, 'ajoutImageCarousel')">
  <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'ajoutImageCarousel')">Ajouter une image</button>
  <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'suppImageCarousel')">Supprimer une image</button>
</body>
</center></div>

<div id="ajoutImageCarousel" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white; margin: 0 auto;'>
  <table>
  <?php
    ajoutImageCarousel();
    ?>
  </table>
</div>

<div id="suppImageCarousel" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white; margin: 0 auto;'>
  <table>
  <?php
    suppImageCarousel();
    ?>
  </table>
</div>

<?php
footer();
echo "</body>";
?>