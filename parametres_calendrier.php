<link rel='stylesheet' href='style/parametres.css'> <!-- Ajout de la référence au fichier CSS -->
<script src='script/parametres.js'></script> <!-- Ajout de la référence au fichier JS -->

<?php
include 'fonction.php';
entete();
navbar();
echo "<body style='background-color: rgb(32, 47, 74);'>";
?>

<div class="tab" style='background-color: rgb(32, 47, 74); font-size: 40px'><center>
<body onload="openTab(event, 'ajoutEvenement')">
  <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'ajoutEvenement')">Ajouter un événement dans le calendrier</button>
</body>
</center></div>
<div id="message">
    <?php 
    if (isset($_SESSION['message'])) {
        echo"<h1 style= 'color: green'><center>". $_SESSION['message']."</center></h1>";
        unset($_SESSION['message']); // Effacez le message pour qu'il n'apparaisse qu'une fois
    }
    ?>
</div>
<div id="ajoutEvenement" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white; margin: 0 auto;'>
  <table>
  <?php
    ajoutEvenement(); 
    ?>
  </table>
</div>


<?php
footer();
echo "</body>";
?>
