<?php
include 'fonction.php';
entete();
echo "<body>";
navbar();
?>

<div class="tab" style='background-color: rgb(32, 47, 74);'><center>
<h1 style='color: white;'>Record</h1>
  <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'table1')">Laser Run</button>
  <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'table2')">Triathlé</button>
  <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'table3')">Tetrathlon</button>
  <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'table4')">Pentathlon</button>
</center></div>

<div id="table1" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white'>
  <h3>Laser Run</h3>
  <table>
    <!-- Contenu du tableau 1 -->
  </table>
</div>

<div id="table2" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white'>
  <h3>Triathlé</h3>
  <table>
  
  </table>
</div>

<div id="table3" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white'>
  <h3>Tetrathlon</h3>
  <table>
    <!-- Contenu du tableau 3 -->
  </table>
</div>
<div id="table4" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white'>
  <h3>Pentathlon</h3>
  <table>
    <!-- Contenu du tableau 3 -->
  </table>
</div>
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
<?php
footer();
echo "</body>";
?>