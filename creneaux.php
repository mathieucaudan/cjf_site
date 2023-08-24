<?php
include 'fonction.php';
entete();
echo "<body style='background-color: rgb(32, 47, 74); color:white;'>";
navbar();
?>
<div class="tab" style='background-color: rgb(32, 47, 74); font-size: 40px'><center>
<body onload="openTab(event, 'laser run')">
<h1 style='color: white;'>CRENAUX</h1>
  <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'laser run')">Laser Run</button>
  <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'natation')">Natation</button>
  <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'escrime')">Escrime</button>
  <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'obstacle')">Obstacle</button>
</body>
</center></div>

<div id="laser run" class="tabcontent" style="text-align:center;">
    <h3>Mercredi 18h00-19h00</h3>
</div>
<div id="natation" class="tabcontent" style="text-align:center;">
    <h3>Lundi 6h30-7h30</h3>
    <h3>Mercredi 6h30-7h30</h3>
    <h3>Jeudi 20h0-21h30</h3>
    <h3>Vendredi 6h30-7h30</h3>
    <h3>Samedi 8h00-9h30</h3>
</div>
<div id="escrime" class="tabcontent" style="text-align:center;">
    <h3>Lundi 18h30-20h00</h3>
    <h3>Mercredi 19h00-20h00</h3>
</div>
<div id="obstacle" class="tabcontent" style="text-align:center;">
    <h3>A voir</h3>
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
    document.getElementById(tabName).style.display = "block";
}

</script>