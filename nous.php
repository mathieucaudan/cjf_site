<link rel='stylesheet' href='style/global_tab.css'> <!-- Ajout de la référence au fichier CSS -->
<link rel='stylesheet' href='style/nous.css'> <!-- Ajout de la référence au fichier CSS -->

<script src='script/global_tab.js'></script> <!-- Ajout de la référence au fichier JS -->

<?php
include 'fonction.php';
entete();
echo"<body style='background-color: rgb(32, 47, 74); color:white;'>";
navbar();
?>

<h1 style='color:white'><center>Organigramme</center></h1>
<center><div class="tab" style='background-color: rgb(32, 47, 74); font-size: 40px'>
  <button class="tablinks bureau active" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'bureau')">Bureau</button>
  <button class="tablinks coach" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'coach')">Coach</button>
  <button class="tablinks athletes" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'athletes')">Athlètes</button>
</body>
  </div></center>

<div id="bureau" class="tabcontent" style='display: block;'>
    <!-- Contenu de l'onglet Bureau -->
    <h2 style="color:white; text-align:center;">Notre bureau</h2>
    <div class="w3-row">
      <div class="w3-half w3-container" style="text-align:center;">
        <div class="card">
          <h3>Président</h3>
          <img src="image/coach/avatar.png" style="display:block; margin:auto;">
          <h3>JEAN-LOUIS HELEU</h3>
          <p>Relation Partenaires</p>
          <p>Responsable Organisation</p>
        </div>
      </div>
      <div class="w3-half w3-container" style="text-align:center;">
      <div class="card">
        <h3>Directeur sportif</h3>
        <img src="image/coach/avatar.png" style="display:block; margin:auto;">
        <h3>ARNAUD EVEILLARD</h3>
        <p>Coordination sportive et suivi des athlètes</p>
        <p>Responsable du développement</p>
        <p>Responsable de la Section Sportive Scolaire PENTATHLON MODERNE du collège LE BOCAGE
        de DINARD</p>
      </div>
      </div>
    </div>
</div>


<div id="coach" class="tabcontent">
    <!-- Contenu de l'onglet Coach -->
    <h2 style="color:white; text-align:center;">Qui sont les coachs?</h2>
    <div class="w3-row">
      <div class="w3-quarter w3-container" style="text-align:center;">
        <h3>Laser Run</h3>
        <img src="image/coach/avatar.png" class="imageSize" style="display:block; margin:auto;">
        <h4>ARNAUD EVEILLARD (BF1)</h4>
        <img src="image/coach/avatar.png"  class="imageSize" style="display:block; margin:auto;">
        <h4>JULIEN TERTRAIN (BF1)</h4>
        <img src="image/coach/daniel.JPG" class="imageSize" style="display:block; margin:auto; height:50%;">
        <h4>DANIEL BOURQUIN<h4> <p>(partenariat avec le CJF Athlétisme)</p>
        <p>(Professeur EPS, BEES 2e degrés, Entraineur course 3e degré expert)</p>
      </div>
      <div class="w3-quarter w3-container" style="text-align:center;">
        <h3>Natation</h3>
        <img src="image/coach/fred.JPG" class="imageSize" style="display:block; margin:auto; height:50%;">
        <h4>FRED GARCIA</h4> <p>(partenariat avec le Triathlon Côte d’Emeraude)</p>
        <p>(BF3 de triathlon,BF4 de Natation, BPJEPS AAN, Moniteur sportif de natation)</p>
        <img src="image/coach/avatar.png" class="imageSize" style="display:block; margin:auto;">
        <h4>ARNAUD EVEILLARD</h4><p>(BF1)</p>
      </div>
      <div class="w3-quarter w3-container" style="text-align:center;">
        <h3>Escrime</h3>
        <img src="image/coach/ludmila.jpg" class="imageSize" style="display:block; margin:auto; height:50%;">
        <h4>LUDMILLA POZDEEVA (MAITRE D’ARME)</h4>
      </div>
      <div class="w3-quarter w3-container" style="text-align:center;">
        <h3>Obstacle</h3>
        <img src="image/coach/avatar.png" class="imageSize" style="display:block; margin:auto;">
        <h4>ARNAUD EVEILLARD (BF1)</h4>
      </div>
    </div>
</div>


<div id="athletes" class="tabcontent">
    <!-- Contenu de l'onglet Athlètes -->
    <h2 style="color:white; text-align:center;">Quelques athletes</h2>
    <div class="w3-row">
      <div class="w3-third w3-container" style="text-align:center;">
        <h3>ARNAUD EVEILLARD</h3>
        <img src="image/coach/avatar.png" style="display:block; margin:auto;">
        <h3>Palmares</h3>
        <p>3ème Championnat de France de triathlé</p>
        <p>3ème Circuit National Master</p>
      </div>
      <div class="w3-third w3-container" style="text-align:center;">
        <h3>AZILIZ NAOUR</h3>
        <img src="image/coach/avatar.png" style="display:block; margin:auto;">
        <p>3ème Championnat de France U22 de tétrathlon</p>
        <p>Championne de France 2023 de Triathlé U22 individuel et relai mixte</p>
        <p>1 sélection internationale</p>
        <p>Championne de FRANCE 2021 de Triathlé U22 individuel et relai mixte</p>
      </div>
      <div class="w3-third w3-container" style="text-align:center;">
        <h3>MATHIEU CAUDAN</h3>
        <img src="image/coach/avatar.png" style="display:block; margin:auto;">
        <h3>Palmares</h3>
        <p>Champion de France de Triathlé U22 relai mixte</p>
        <p>3ème Championnat du monde de laser run en Relai Mixte (Avec Lizea SINTES)
        2022</p>
        <p>Champion de FRANCE 2022 de LASER RUN</p>
      </div>
    </div>
</div>  



<?php 
footer(); 
?>
