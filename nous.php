<?php
include 'fonction.php';
entete();
navbar();
?>
<body style='background-color: rgb(32, 47, 74); color:white; '>
<body onload="openTab(event, 'bureau')">
<h1 style='color:white'><center>Organigramme</center></h1>
<center><div class="tab" style='background-color: rgb(32, 47, 74); font-size: 40px'>
    <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'bureau')">Bureau</button>
    <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'coach')">Coach</button>
    <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'athletes')">Athlètes</button>
</body>
  </div></center>

<div id="bureau" class="tabcontent">
    <!-- Contenu de l'onglet Bureau -->
    <h1 style="color:white; text-align:center;">NOTRE BUREAU</h1>
    <div class="w3-row">
      <div class="w3-half w3-container" style="text-align:center;">
        <h2>JEAN-LOUIS HELEU</h2>
        <img src="image/" style="display:block; margin:auto;">
        <h3>Président</h3>
        <p>Relation Partenaires</p>
        <p>Responsable Organisation</p>
      </div>
      <div class="w3-half w3-container" style="text-align:center;">
        <h2>ARNAUD EVEILLARD</h2>
        <img src="image/" style="display:block; margin:auto;">
        <h3>Directeur sportif</h3>
        <p>Coordination sportive et suivi des athlètes</p>
        <p>Responsable du développement</p>
        <p>Responsable de la Section Sportive Scolaire PENTATHLON MODERNE du collège LE BOCAGE
        de DINARD</p>
      </div>
    </div>
</div>


<div id="coach" class="tabcontent">
    <!-- Contenu de l'onglet Coach -->
    <h1 style="color:white; text-align:center;">Qui sont les coachs?</h1>
    <div class="w3-row">
      <div class="w3-quarter w3-container" style="text-align:center;">
        <h2>Laser Run</h2>
        <img src="image/" style="display:block; margin:auto;">
        <p>ARNAUD EVEILLARD (BF1)</p>
        <img src="image/" style="display:block; margin:auto;">
        <p>JULIEN TERTRAIN (BF1)</p>
        <img src="image/" style="display:block; margin:auto;">
        <p>DANIEL BOURQUIN (partenariat avec le CJF Athlétisme)</p>
      </div>
      <div class="w3-quarter w3-container" style="text-align:center;">
        <h2>Natation</h2>
        <img src="image/" style="display:block; margin:auto;">
        <p>ARNAUD EVEILLARD (BF1)</p>
        <img src="image/" style="display:block; margin:auto;">
        <p>FRED GARCIA (partenariat avec le Triathlon Côte d’Emeraude)</p>
      </div>
      <div class="w3-quarter w3-container" style="text-align:center;">
        <h2>Escrime</h2>
        <img src="image/" style="display:block; margin:auto;">
        <p>LUDMILLA POZDEEVA (MAITRE D’ARME)</p>
      </div>
      <div class="w3-quarter w3-container" style="text-align:center;">
        <h2>Obstacle</h2>
        <img src="image/" style="display:block; margin:auto;">
        <p>ARNAUD EVEILLARD (BF1)</p>
      </div>
    </div>
</div>


<div id="athletes" class="tabcontent">
    <!-- Contenu de l'onglet Athlètes -->
    <h1 style="color:white; text-align:center;">Quelques athletes</h1>
    <div class="w3-row">
      <div class="w3-third w3-container" style="text-align:center;">
        <h2>ARNAUD EVEILLARD</h2>
        <img src="image/" style="display:block; margin:auto;">
        <h3>Palmares</h3>
        <p>3ème Championnat de France de triathlé</p>
        <p>3ème Circuit National Master</p>
      </div>
      <div class="w3-third w3-container" style="text-align:center;">
        <h2>AZILIZ NAOUR</h2>
        <img src="image/" style="display:block; margin:auto;">
        <p>3ème Championnat de France U22 de tétrathlon</p>
        <p>Championne de France 2023 de Triathlé U22 individuel et relai mixte</p>
        <p>1 sélection internationale</p>
        <p>Championne de FRANCE 2021 de Triathlé U22 individuel et relai mixte</p>
      </div>
      <div class="w3-third w3-container" style="text-align:center;">
        <h2>MATHIEU CAUDAN</h2>
        <img src="image/" style="display:block; margin:auto;">
        <h3>Palmares</h3>
        <p>Champion de France de Triathlé U22 relai mixte</p>
        <p>3ème Championnat du monde de laser run en Relai Mixte (Avec Lizea SINTES)
        2022</p>
        <p>Champion de FRANCE 2022 de LASER RUN</p>
      </div>
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