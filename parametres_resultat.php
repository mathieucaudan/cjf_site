<link rel='stylesheet' href='style/parametres.css'> <!-- Ajout de la référence au fichier CSS -->
<script src='script/parametres.js'></script> <!-- Ajout de la référence au fichier JS -->

<?php
include 'fonction.php';
entete();
navbar();
echo "<body style='background-color: rgb(32, 47, 74);'>";
?>

<div class="tab" style='background-color: rgb(32, 47, 74); font-size: 40px'><center>
<body onload="openTab(event, 'ajoutResultat')">
  <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'ajoutResultat')">Ajouter un Résultat</button>
  <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'suppResultat')">Supprimer un Résultat</button>

</body>  
</center></div>

<div id="ajoutResultat" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white; margin: 0 auto;'>
  <table>
  <?php
    ajoutResultat(); 
    ?>
  </table>
</div>
<div id="suppResultat" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white; margin: 0 auto;'>
  <table>
  <?php
    suppResultat(); 
    ?>
  </table>
</div>

<?php
footer();
echo "</body>";
?>

