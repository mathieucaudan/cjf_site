<link rel='stylesheet' href='style/creneaux.css'> <!-- Ajout de la référence au fichier CSS -->
<script src='script/creneaux.js'></script> <!-- Ajout de la référence au fichier JS -->

<?php
include 'fonction.php';
entete();
echo "<body style='background-color: rgb(32, 47, 74); color:white;'>";
navbar();
?>
<body style='background-color: rgb(32, 47, 74); color:white; ' onload="openTab(event, 'laserrun')">
<h1 style='color:white'><center>Les créneaux</center></h1>
<center><div class="cretab" style='background-color: rgb(32, 47, 74); font-size: 40px'>
  <button class="cretablinks laserrun active" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'laserrun')">Laser Run</button>
  <button class="cretablinks natation" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'natation')">Natation</button>
  <button class="cretablinks escrime" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'escrime')">Escrime</button>
  <button class="cretablinks obstacle" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'obstacle')">Obstacle</button>
</body>
</center></div>

<div id="laserrun" class="cretabcontent" style="text-align:center;">
    <h3>Mercredi 18h00-19h00</h3>
</div>
<div id="natation" class="cretabcontent" style="text-align:center;">
    <h3>Lundi 6h30-7h30</h3>
    <h3>Mercredi 6h30-7h30</h3>
    <h3>Jeudi 20h0-21h30</h3>
    <h3>Vendredi 6h30-7h30</h3>
    <h3>Samedi 8h00-9h30</h3>
</div>
<div id="escrime" class="cretabcontent" style="text-align:center;">
    <h3>Lundi 18h30-20h00</h3>
    <h3>Mercredi 19h00-20h00</h3>
</div>
<div id="obstacle" class="cretabcontent" style="text-align:center;">
    <h3>A voir</h3>
</div>

<?php 
footer(); 
?>

<?php

echo "</body>";
?>