<link rel='stylesheet' href='style/parametres.css'> <!-- Ajout de la référence au fichier CSS -->


<?php
include 'fonction.php';
entete();
navbar();
echo "<body style='background-color: rgb(32, 47, 74);'>";
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
changeRecord();
}
}else{
  echo"<div class='w3-center w3-padding-48 w3-xxlarge' style='background-color: rgb(32, 47, 74); color: white;'>
  <h2 class='w3-center'>Autorisation non accordée</h2>
  </div>";
}
echo"aa";
footer();
echo "</body>";
?>
