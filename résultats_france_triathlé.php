<link rel='stylesheet' href='style/global_tab.css'>
<script src='script/global_tab.js'></script>

<?php
include 'fonction.php';
entete();
echo "<body style='background-color: rgb(32, 47, 74); color:white;'>";
navbar();
?>

<h1 style='color:white'><center>Résultats Officiels</center></h1>

<center>
<div class="tab" style='background-color: rgb(32, 47, 74); font-size: 30px'>
  <button class="tablinks active" onclick="openTab(event, 'indiv')" style='background-color: rgb(32, 47, 74); color: white'>Individuels</button>
  <button class="tablinks" onclick="openTab(event, 'relais')" style='background-color: rgb(32, 47, 74); color: white'>Relais</button>
</div>
</center>

<!-- Onglet INDIVIDUELS -->
<div id="indiv" class="tabcontent" style='display: block; background-color: rgb(32, 47, 74); color: white; padding: 20px; text-align: center;'>
  <h3>Résultats Individuels</h3>
  <div style="display:flex; flex-wrap: wrap; justify-content: center; gap: 20px;">
  <?php
    $files = glob("resultats/indiv/*.pdf");
    foreach ($files as $file) {
        $filename = basename($file);
        echo "<div style='border:1px solid white; border-radius:10px; padding:15px; width:200px; background-color:#1e2e4a;'>
                <p>$filename</p>
                <a href='$file' target='_blank' style='color:lightblue;'>📄 Ouvrir</a>
              </div>";
    }
  ?>
  </div>
</div>

<!-- Onglet RELAIS -->
<div id="relais" class="tabcontent" style='display: none; background-color: rgb(32, 47, 74); color: white; padding: 20px; text-align: center;'>
  <h3>Résultats Relais</h3>
  <div style="display:flex; flex-wrap: wrap; justify-content: center; gap: 20px;">
  <?php
    $files = glob("resultats/relais/*.pdf");
    foreach ($files as $file) {
        $filename = basename($file);
        echo "<div style='border:1px solid white; border-radius:10px; padding:15px; width:200px; background-color:#1e2e4a;'>
                <p>$filename</p>
                <a href='$file' target='_blank' style='color:lightblue;'>📄 Ouvrir</a>
              </div>";
    }
  ?>
  </div>
</div>

<?php
footer();
echo "</body>";
?>
