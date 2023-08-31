<link rel='stylesheet' href='style/parametres.css'> <!-- Ajout de la référence au fichier CSS -->


<?php
include 'fonction.php';
entete();
navbar();
echo "<body style='background-color: rgb(32, 47, 74);'>";
?>

<div class="pargaltab" style='background-color: rgb(32, 47, 74); font-size: 40px'><center>
  <body onload="openTab(event, 'ajoutGalerie')">
    <button class="pargaltablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'ajoutGalerie')">Ajouter une galerie</button>
    <button class="pargaltablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'suppGalerie')">Supprimer une galerie</button>
  </body>  
  </center>
</div>
<div id="message">
    <?php 
    if (isset($_SESSION['message'])) {
        echo"<h1 style= 'color: green'><center>". $_SESSION['message']."</center></h1>";
        unset($_SESSION['message']); // Effacez le message pour qu'il n'apparaisse qu'une fois
    }
    ?>
</div>
<div id="ajoutGalerie" class="pargaltabcontent" style='background-color: rgb(32, 47, 74); color: white; margin: 0 auto;'>
  <table>
  <?php
    ajoutGalerie(); 
    ?>
  </table>
</div>

<div id="suppGalerie" class="pargaltabcontent" style='background-color: rgb(32, 47, 74); color: white; margin: 0 auto;'>
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
<script>
function openTab(evt, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("pargaltabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("pargaltablinks");
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

