<?php
include 'fonction.php';
entete();
echo "<body style='background-color: rgb(32, 47, 74); color:white;'>";
navbar();
?>
<body style='background-color: rgb(32, 47, 74); color:white; ' onload="openTab(event, 'laserrun')">
<h1 style='color:white'><center>CRENEAUX</center></h1>
<center><div class="tab" style='background-color: rgb(32, 47, 74); font-size: 40px'>
  <button class="tablinks laserrun active" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'laserrun')">Laser Run</button>
  <button class="tablinks natation" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'natation')">Natation</button>
  <button class="tablinks escrime" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'escrime')">Escrime</button>
  <button class="tablinks obstacle" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'obstacle')">Obstacle</button>
</body>
</center></div>

<div id="laserrun" class="tabcontent" style="text-align:center;">
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


<div class="footer">
    <?php footer(); ?>
</div>
<?php

echo "</body>";
?>
<style>

/* Styles pour le footer */
.footer {
      padding: 10px;
      background-color: rgb(32, 47, 74);
      color: white;
      position: fixed;
      left: 0;
      bottom: 0;
      width: 100%;
}

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
.tab button.active.laserrun {
  background-color: gray !important; /* Couleur de fond grise lorsque l'onglet est actif */
  color: white !important; /* Texte blanc lorsque l'onglet est actif */
  cursor: default !important; /* Désactive le curseur lorsque l'onglet est actif */
}
.tab button.active.natation {
  background-color: gray !important; /* Couleur de fond grise lorsque l'onglet est actif */
  color: white !important; /* Texte blanc lorsque l'onglet est actif */
  cursor: default !important; /* Désactive le curseur lorsque l'onglet est actif */
}
.tab button.active.escrime {
  background-color: gray !important; /* Couleur de fond grise lorsque l'onglet est actif */
  color: white !important; /* Texte blanc lorsque l'onglet est actif */
  cursor: default !important; /* Désactive le curseur lorsque l'onglet est actif */
}
.tab button.active.obstacle {
  background-color: gray !important; /* Couleur de fond grise lorsque l'onglet est actif */
  color: white !important; /* Texte blanc lorsque l'onglet est actif */
  cursor: default !important; /* Désactive le curseur lorsque l'onglet est actif */
}
</style>
<script>
  function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    // Supprime la classe "active" de tous les boutons d'onglet
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    // Ajoute la classe "active" à l'onglet actuel
    evt.currentTarget.className += " active";
    document.getElementById(tabName).style.display = "block";
    
    // Ajoute la classe "active" spécifique au bouton "Bureau" s'il s'agit de l'onglet "Bureau"
    if (tabName === 'laserrun') {
        document.querySelector(".tablinks.laserrun").classList.add("active");
    }
}

</script>