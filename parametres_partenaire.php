<link rel='stylesheet' href='style/parametres.css'> <!-- Ajout de la référence au fichier CSS -->


<?php
include 'fonction.php';
entete();
navbar();
echo "<body style='background-color: rgb(32, 47, 74);'>";
?>

<div class="parpartab" style='background-color: rgb(32, 47, 74); font-size: 40px'><center>
<body onload="openTab(event, 'ajoutPartenaire')">
  <button class="parpartablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'ajoutPartenaire')">Ajouter un partenaire</button>
  <button class="parpartablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'suppPartenaire')">Supprimer un partenaire</button>
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
<div id="ajoutPartenaire" class="parpartabcontent" style='background-color: rgb(32, 47, 74); color: white; margin: 0 auto;'>
  <table>
  <?php
    ajoutPartenaire(); 
    ?>
  </table>
</div>

<div id="suppPartenaire" class="parpartabcontent" style='background-color: rgb(32, 47, 74); color: white; margin: 0 auto;'>
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
<script>
function openTab(evt, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("parpartabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("parpartablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";

  // Vérifiez si un message de session est défini
  var messageDiv = document.getElementById("message");
  var message = "<?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''; ?>";
  if (message !== "") {
    messageDiv.innerHTML = "<h1 style='color: green'><center>" + message + "</center></h1>";
    // Effacez le message pour qu'il n'apparaisse qu'une fois
    <?php unset($_SESSION['message']); ?>
  }
}
</script>
