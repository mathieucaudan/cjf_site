<?php
include 'fonction.php';

// Compteur de visites par semaine (consultable dans Administration > Statistiques Laser Shot)
$fichierCompteur = 'compteur.json';
$connexions = file_exists($fichierCompteur) ? (json_decode(file_get_contents($fichierCompteur), true) ?: []) : [];
$semaine = date('W');
$connexions[$semaine] = ($connexions[$semaine] ?? 0) + 1;
file_put_contents($fichierCompteur, json_encode($connexions));

entete('Laser Shot');
navbar();
bandeau('Laser Shot', 'Le jeu de soirée des tireurs du club. À consommer avec modération.');
?>

<section class="section section--serre">
  <div class="wrap">
    <audio id="musique" src="musique.mp3" preload="none"></audio>
    <div class="boutons boutons--centre" id="lancer">
      <button class="btn btn--rouge" type="button" aria-controls="regles" aria-expanded="false">Afficher les règles</button>
    </div>

    <div class="regles carte" id="regles" hidden>
      <h2>Préparation</h2>
      <ul>
        <li>Cible à 10 m.</li>
        <li>Boisson principale : Marquisette et alcool fort, bière si rien de tout ça n'est disponible.</li>
        <li>Un pistolet minimum.</li>
      </ul>
      <h2>Déroulement</h2>
      <ul>
        <li>Un tir pour allumer la cible.</li>
        <li>Prendre son shot (alcool ou cul sec de bière).</li>
        <li>Finir la cible.</li>
        <li>Si la cible n'est pas finie, un shot supplémentaire. Sinon, joueur suivant.</li>
        <li>Sur un 5/5, un shot au joueur de ton choix.</li>
        <li>Interdiction de toucher le tireur ou la cible, et de se placer entre la cible et le tireur.</li>
      </ul>
      <h2>Variante à deux cibles</h2>
      <ul>
        <li>Tableau en quarts, demies et finale.</li>
        <li>En match 1 contre 1, le perdant est celui qui met le plus de temps à finir la cible, ou celui qui a allumé le moins de vert. Il prend un shot supplémentaire.</li>
      </ul>
    </div>
  </div>
</section>

<script>
  (function () {
    var bouton = document.querySelector('#lancer button');
    bouton.addEventListener('click', function () {
      document.getElementById('musique').play().catch(function () {});
      document.getElementById('regles').hidden = false;
      bouton.setAttribute('aria-expanded', 'true');
      document.getElementById('lancer').hidden = true;
    });
  })();
</script>

<?php footer(); ?>
