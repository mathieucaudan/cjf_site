<link rel='stylesheet' href='style/parametres.css'> <!-- Ajout de la référence au fichier CSS -->
<script src='script/parametres.js'></script> <!-- Ajout de la référence au fichier JS -->

<?php
include 'fonction.php';
entete();
navbar();
echo "<body style='background-color: rgb(32, 47, 74);'>";
?>

<div class="tab" style='background-color: rgb(32, 47, 74); font-size: 40px'><center>
  <body onload="openTab(event, 'ajoutGalerie')">
    <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'ajoutGalerie')">Ajouter une galerie</button>
    <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'suppGalerie')">Supprimer une galerie</button>
  </body>  
  </center>
</div>

<div id="ajoutGalerie" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white; margin: 0 auto;'>
  <table>
  <?php
    ajoutGalerie(); 
    ?>
  </table>
</div>

<div id="suppGalerie" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white; margin: 0 auto;'>
  <table>
  <?php
    suppGalerie();
    ?>
  </table>
</div>

<?php
footer();
echo "</body>";
?>

