<link rel='stylesheet' href='style/parametres.css'> <!-- Ajout de la référence au fichier CSS -->
<script src='script/parametres.js'></script> <!-- Ajout de la référence au fichier JS -->

<?php
include 'fonction.php';
entete();
navbar();
echo "<body style='background-color: rgb(32, 47, 74);'>";
?>

<div class="tab" style='background-color: rgb(32, 47, 74); font-size: 40px'><center>
<body onload="openTab(event, 'ajoutArticleSection')">
  <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'ajoutArticleSection')">Ajouter un articles de section</button>
  <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'suppArticleSection')">Supprimer les articles de section</button>
</body>
</center></div>
<div id="ajoutArticleSection" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white; margin: 0 auto;'>
  <table>
  <?php
    ajoutArticleSection(); 
    ?>
  </table>
</div>
<div id="suppArticleSection" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white; margin: 0 auto;'>
  <table>
  <?php
    suppArticleSection(); 
    ?>
  </table>
</div>

<?php
footer();
echo "</body>";
?>
