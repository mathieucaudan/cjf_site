<?php
include 'fonction.php';

// Format : { "2025-12": { "13": "Triathlé de Noël" }, ... } (Administration > Calendrier)
$calendrier = json_decode(@file_get_contents('calendrier.json'), true) ?: [];

entete('Calendrier');
navbar();
bandeau('Calendrier', 'Compétitions, stages et événements du club.');
?>

<section class="section section--serre">
  <div class="wrap">
    <div class="agenda" id="agenda">
      <div class="agenda__tete">
        <button class="btn agenda__nav" type="button" data-pas="-1" aria-label="Mois précédent"><?= icone('fleche') ?></button>
        <h2 id="agenda-titre" aria-live="polite"></h2>
        <button class="btn agenda__nav" type="button" data-pas="1" aria-label="Mois suivant" style="transform: scaleX(-1);"><?= icone('fleche') ?></button>
      </div>
      <div class="agenda__grille" id="agenda-grille"></div>
      <ul class="agenda__liste" id="agenda-liste"></ul>
    </div>
    <noscript><p>Activez JavaScript pour afficher le calendrier.</p></noscript>
  </div>
</section>

<script>
(function () {
  var donnees = <?= json_encode($calendrier, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
  var mois = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
  var jours = ["Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim"];
  var aujourdhui = new Date();
  var courant = new Date(aujourdhui.getFullYear(), aujourdhui.getMonth(), 1);

  var titre = document.getElementById("agenda-titre");
  var grille = document.getElementById("agenda-grille");
  var liste = document.getElementById("agenda-liste");

  function el(tag, classe, texte) {
    var n = document.createElement(tag);
    if (classe) n.className = classe;
    if (texte !== undefined) n.textContent = texte;
    return n;
  }

  function afficher() {
    var annee = courant.getFullYear();
    var m = courant.getMonth();
    var cle = annee + "-" + String(m + 1).padStart(2, "0");
    var evts = donnees[cle] || {};
    titre.textContent = mois[m] + " " + annee;

    grille.innerHTML = "";
    liste.innerHTML = "";
    jours.forEach(function (j) { grille.appendChild(el("div", "agenda__jour-sem", j)); });

    var decalage = (new Date(annee, m, 1).getDay() + 6) % 7;
    var nbJours = new Date(annee, m + 1, 0).getDate();
    for (var i = 0; i < decalage; i++) grille.appendChild(el("div", "agenda__case agenda__case--hors"));

    var compte = 0;
    for (var jour = 1; jour <= nbJours; jour++) {
      var cas = el("div", "agenda__case");
      if (annee === aujourdhui.getFullYear() && m === aujourdhui.getMonth() && jour === aujourdhui.getDate()) {
        cas.classList.add("agenda__case--auj");
      }
      cas.appendChild(el("span", "agenda__num", jour));
      var evt = evts[jour] || evts[String(jour).padStart(2, "0")];
      if (evt) {
        cas.appendChild(el("span", "agenda__evt", evt));
        var li = el("li");
        li.appendChild(el("strong", "", jour));
        li.appendChild(el("span", "", evt));
        liste.appendChild(li);
        compte++;
      }
      grille.appendChild(cas);
    }
    if (!compte) liste.appendChild(el("li", "agenda__vide", "Aucun événement prévu ce mois-ci."));
  }

  document.querySelectorAll(".agenda__nav").forEach(function (b) {
    b.addEventListener("click", function () {
      courant.setMonth(courant.getMonth() + Number(b.dataset.pas));
      afficher();
    });
  });
  afficher();
})();
</script>

<?php footer(); ?>
