<link rel='stylesheet' href='style/global_tab.css'> <!-- Ajout de la référence au fichier CSS -->
<link rel='stylesheet' href='style/nous.css'> <!-- Ajout de la référence au fichier CSS -->
<script src='script/global_tab.js'></script> <!-- Ajout de la référence au fichier JS -->

<?php
include 'fonction.php';
entete();
echo "<body style='background-color: rgb(32, 47, 74); color:white;'>";
navbar();
?>
<style>
  :root {
    --surface-color: #fff;
    --curve: 40;
  }

  * {
    box-sizing: border-box;
  }

  body {
    font-family: 'Noto Sans JP', sans-serif;
    background-color: #fef8f8;
    margin: 0;
    /* Supprime les marges par défaut du corps */
    padding: 0;
    /* Supprime les rembourrages par défaut du corps */
  }

  .cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    padding: 0;
    list-style-type: none;
    margin: 0 auto;
    /* Centre les cartes horizontalement */
    max-width: 1200px;
    /* Limite la largeur maximale des cartes */
  }

  .card {
    position: relative;
    display: block;
    height: 100%;
    border-radius: calc(var(--curve) * 1px);
    overflow: hidden;
    text-decoration: none;
  }

  .card__image {
    width: 100%;
    height: auto;
  }

  .card__overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 1;
    border-radius: calc(var(--curve) * 1px);
    background-color: var(--surface-color);
    transform: translateY(100%);
    transition: .2s ease-in-out;
  }

  .card:hover .card__overlay {
    transform: translateY(0);
  }

  .card__header {
    position: relative;
    display: flex;
    align-items: center;
    gap: 2em;
    padding: 2em;
    border-radius: calc(var(--curve) * 1px) 0 0 0;
    background-color: var(--surface-color);
    transform: translateY(-100%);
    transition: .2s ease-in-out;
  }

  .card__arc {
    width: 80px;
    height: 80px;
    position: absolute;
    bottom: 100%;
    right: 0;
    z-index: 1;
  }

  .card__arc path {
    fill: var(--surface-color);
    d: path("M 40 80 c 22 0 40 -22 40 -40 v 40 Z");
  }

  .card:hover .card__header {
    transform: translateY(0);
  }

  .card__thumb {
    flex-shrink: 0;
    width: 50px;
    height: 50px;
    border-radius: 50%;
  }

  .card__title {
    font-size: 1em;
    margin: 0 0 .3em;
    color: #6A515E;
  }

  .card__tagline {
    display: block;
    margin: 1em 0;
    font-family: "MockFlowFont";
    font-size: .8em;
    color: #D7BDCA;
  }

  .card__status {
    font-size: .8em;
    color: #D7BDCA;
  }

  .card__description {
    padding: 0 2em 2em;
    margin: 0;
    color: #D7BDCA;
    font-family: "MockFlowFont";
    display: -webkit-box;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  /* Rendre les cartes responsives */
  @media screen and (max-width: 768px) {
    .cards {
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }
  }
</style>

<h1 style='color:white'>
  <center>Organigramme</center>
</h1>
<center>
  <div class="tab" style='background-color: rgb(32, 47, 74); font-size: 40px'>
    <button class="tablinks bureau active" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'bureau')">Bureau</button>
    <button class="tablinks coach" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'coach')">Coachs</button>
    <button class="tablinks athletes" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'athletes')">Athlètes</button>
  </div>
</center>
<div id="bureau" class="tabcontent" style='display: block;'>
  <h2 style="color:white; text-align:center;">Notre bureau</h2>
  <ul class="cards">
    <li>
      <a href="" class="card">
        <img src="image/coach/jeanlouis.webp" class="card__image" alt="" />
        <div class="card__overlay">
          <div class="card__header">
            <svg class="card__arc" xmlns="http://www.w3.org/2000/svg">
              <path />
            </svg>
            <img class="card__thumb" src="https://i.imgur.com/sjLMNDM.png" alt="" />
            <div class="card__header-text">
              <h3 class="card__title">Jean-Louis HELEU</h3>
              <h4 class="card__status">Président</h4>
            </div>
          </div>
          <p class="card__description">
            Relation Partenaires</br>
            Responsable Organisation
          </p>
        </div>
      </a>
    </li>
    <li>
      <a href="" class="card">
        <img src="image/coach/arnaud.webp" class="card__image" alt="" />
        <div class="card__overlay">
          <div class="card__header">
            <svg class="card__arc" xmlns="http://www.w3.org/2000/svg">
              <path />
            </svg>
            <img class="card__thumb" src="https://i.imgur.com/sjLMNDM.png" alt="" />
            <div class="card__header-text">
              <h3 class="card__title">Arnaud EVEILLARD</h3>
              <h4 class="card__status">Directeur sportif</h4>
            </div>
          </div>
          <p class="card__description">
            Coordination sportive et suivi des athlètes
            Responsable du développement
            Responsable de la section sportive scolaire pentathlon moderne du collège LE BOCAGE de DINARD
          </p>
        </div>
      </a>
    </li>
  </ul>
</div>



<div id="coach" class="tabcontent">
  <h2 style="color:white; text-align:center;">Qui sont les coachs?</h2>
  <ul class="cards">
    <li>
      <a href="" class="card">
        <img src="image/coach/daniel.webp" class="card__image" alt="" />
        <div class="card__overlay">
          <div class="card__header">
            <svg class="card__arc" xmlns="http://www.w3.org/2000/svg">
              <path />
            </svg>
            <img class="card__thumb" src="https://i.imgur.com/sjLMNDM.png" alt="" />
            <div class="card__header-text">
              <h3 class="card__title">Daniel BOURQUIN</h3>
              <h4 class="card__status">Course</h4>
            </div>
          </div>
          <p class="card__description">
            Professeur EPS, BEES 2e degrés, Entraineur course 3e degré expert
            (partenariat avec le CJF Athlétisme)
          </p>
        </div>
      </a>
    </li>


    <li>
      <a href="" class="card">
        <img src="image/coach/arnaud.webp" class="card__image" alt="" />
        <div class="card__overlay">
          <div class="card__header">
            <svg class="card__arc" xmlns="http://www.w3.org/2000/svg">
              <path />
            </svg>
            <img class="card__thumb" src="https://i.imgur.com/sjLMNDM.png" alt="" />
            <div class="card__header-text">
              <h3 class="card__title">Arnaud EVEILLARD</h3>
              <h4 class="card__status">Pentathlon</h4>
            </div>
          </div>
          <p class="card__description">
            BF1
          </p>
        </div>
      </a>
    </li>

    <li>
      <a href="" class="card">
        <img src="image/coach/julien.webp" class="card__image" alt="" />
        <div class="card__overlay">
          <div class="card__header">
            <svg class="card__arc" xmlns="http://www.w3.org/2000/svg">
              <path />
            </svg>
            <img class="card__thumb" src="https://i.imgur.com/sjLMNDM.png" alt="" />
            <div class="card__header-text">
              <h3 class="card__title">Julien</br>TERTRAIN</h3>
              <h4 class="card__status">Laser Run</h4>
            </div>
          </div>
          <p class="card__description">
            BF1
          </p>
        </div>
      </a>
    </li>

    <li>
      <a href="" class="card">
        <img src="image/coach/ludmila.webp" class="card__image" alt="" />
        <div class="card__overlay">
          <div class="card__header">
            <svg class="card__arc" xmlns="http://www.w3.org/2000/svg">
              <path />
            </svg>
            <img class="card__thumb" src="https://i.imgur.com/sjLMNDM.png" alt="" />
            <div class="card__header-text">
              <h3 class="card__title">Ludmila POZDEJEVA</h3>
              <h4 class="card__status">Escrime</h4>
            </div>
          </div>
          <p class="card__description">
            MAITRE D’ARME
          </p>
        </div>
      </a>
    </li>

    <li>
      <a href="" class="card">
        <img src="image/coach/fred.webp" class="card__image" alt="" />
        <div class="card__overlay">
          <div class="card__header">
            <svg class="card__arc" xmlns="http://www.w3.org/2000/svg">
              <path />
            </svg>
            <img class="card__thumb" src="https://i.imgur.com/sjLMNDM.png" alt="" />
            <div class="card__header-text">
              <h3 class="card__title">Fred</br>GARCIA</h3>
              <h4 class="card__status">Natation</h4>
            </div>
          </div>
          <p class="card__description">
            BF3 de triathlon,BF4 de Natation, BPJEPS AAN, Moniteur sportif de natation</br>
            (partenariat avec le Triathlon Côte d’Emeraude)
          </p>
        </div>
      </a>
    </li>

  </ul>
</div>
</div>

<div id="athletes" class="tabcontent">
  <h2 style="color:white; text-align:center;">Quelques athletes</h2>
  <ul class="cards">
    <li>
      <a href="" class="card">
        <img src="image/coach/aziliz.webp" class="card__image" alt="" />
        <div class="card__overlay">
          <div class="card__header">
            <svg class="card__arc" xmlns="http://www.w3.org/2000/svg">
              <path />
            </svg>
            <img class="card__thumb" src="https://i.imgur.com/sjLMNDM.png" alt="" />
            <div class="card__header-text">
              <h3 class="card__title">Aziliz Naour</h3>
              <h4 class="card__status">U22</h4>
            </div>
          </div>
          <p class="card__description">
            3ème Championnat de France U22 de tétrathlon</br>
            Championne de France 2023 de Triathlé U22 individuel et relai mixte</br>
            1 sélection internationale</br>
            Championne de FRANCE 2021 de Triathlé U22 individuel et relai mixte
          </p>
        </div>
      </a>
    </li>
    <li>
      <a href="" class="card">
        <img src="image/coach/arnaud.webp" class="card__image" alt="" />
        <div class="card__overlay">
          <div class="card__header">
            <svg class="card__arc" xmlns="http://www.w3.org/2000/svg">
              <path />
            </svg>
            <img class="card__thumb" src="https://i.imgur.com/sjLMNDM.png" alt="" />
            <div class="card__header-text">
              <h3 class="card__title">Arnaud Eveillard</h3>
              <h4 class="card__status">Master</h4>
            </div>
          </div>
          <p class="card__description">
            3ème Championnat de France de triathlé</br>
            3ème Circuit National Master
          </p>
        </div>
      </a>
    </li>
    <li>
      <a href="" class="card">
        <img src="image/coach/mathieu.webp" class="card__image" alt="" />
        <div class="card__overlay">
          <div class="card__header">
            <svg class="card__arc" xmlns="http://www.w3.org/2000/svg">
              <path />
            </svg>
            <img class="card__thumb" src="https://i.imgur.com/sjLMNDM.png" alt="" />
            <div class="card__header-text">
              <h3 class="card__title">Mathieu Caudan</h3>
              <h4 class="card__status">U22</h4>
            </div>
          </div>
          <p class="card__description">
            Champion de France de Triathlé U22 relai mixte</br>
            3ème Championnat du monde de laser run en Relai Mixte 2022</br>
            Vice Champion du monde de laser run en Relai Mixte 2023</br>
            Champion de FRANCE 2022 de LASER RUN
          </p>
        </div>
      </a>
    </li>
  </ul>
</div>

<?php
footer();
?>