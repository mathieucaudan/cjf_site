<?php
include 'fonction.php';
entete();
navbar();
echo "<body style='background-color: rgb(32, 47, 74);'>";
?>

<div class="tab" style='background-color: rgb(32, 47, 74); font-size: 40px'><center>
<h1 style='color: white;'>Record</h1>
  <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'ajoutpartenaires')">Ajouter un partenaire</button>
  <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'supppartenaires')">Supprimer un partenaire</button>
</center></div>

<div id="ajoutpartenaires" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white; margin: 0 auto;'>
  <table>
  <?php
    ajoutpartenaire(); 
    ?>
  </table>
</div>

<div id="supppartenaires" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white; margin: 0 auto;'>
  <table>
  <?php
    supppartenaire();
    ?>
  </table>
</div>

<?php
footer();
echo "</body>";
?>
<style>
    .tab {
  overflow: hidden;
}

.tab button {
  background-color: #ccc;
  border: none;
  color: black;
  padding: 10px 20px;
  cursor: pointer;
}

.tab button:hover {
  background-color: #ddd;
}

.tab button.active {
  background-color: #fff;
}

.tabcontent {
  display: none;
  padding: 20px;
  border: 1px solid #ccc;
}
</style>
<script>
    function openTab(evt, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>