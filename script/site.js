/* CJF Saint-Malo Pentathlon Moderne — comportements communs */
(function () {
  "use strict";

  var reduit = window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  /* ---------- Jeton CSRF : ajouté à chaque formulaire POST du site ---------- */
  var meta = document.querySelector("meta[name='csrf']");
  window.CJF_CSRF = meta ? meta.content : "";
  if (window.CJF_CSRF) {
    document.querySelectorAll("form").forEach(function (f) {
      if ((f.getAttribute("method") || "").toLowerCase() !== "post") return;
      if (f.querySelector("input[name='csrf']")) return;
      var champ = document.createElement("input");
      champ.type = "hidden";
      champ.name = "csrf";
      champ.value = window.CJF_CSRF;
      f.appendChild(champ);
    });
  }

  /* ---------- Menu mobile ---------- */
  var entete = document.querySelector(".entete");
  var burger = document.querySelector(".burger");
  if (entete && burger) {
    burger.addEventListener("click", function () {
      var ouvert = entete.classList.toggle("menu-ouvert");
      burger.setAttribute("aria-expanded", ouvert ? "true" : "false");
    });
  }

  /* ---------- Sous-menus ---------- */
  var deroulants = document.querySelectorAll(".nav__deroulant");
  function fermerTous(sauf) {
    deroulants.forEach(function (d) {
      if (d !== sauf) {
        d.classList.remove("ouvert");
        var b = d.querySelector("button");
        if (b) b.setAttribute("aria-expanded", "false");
      }
    });
  }
  deroulants.forEach(function (d) {
    var bouton = d.querySelector("button");
    bouton.addEventListener("click", function (e) {
      e.stopPropagation();
      var ouvert = d.classList.toggle("ouvert");
      bouton.setAttribute("aria-expanded", ouvert ? "true" : "false");
      fermerTous(d);
    });
  });
  document.addEventListener("click", function () { fermerTous(null); });
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") fermerTous(null);
  });

  /* ---------- Onglets accessibles ---------- */
  document.querySelectorAll("[role='tablist']").forEach(function (liste) {
    var onglets = Array.prototype.slice.call(liste.querySelectorAll("[role='tab']"));
    function activer(onglet, focus, memoriser) {
      onglets.forEach(function (o) {
        var actif = o === onglet;
        o.setAttribute("aria-selected", actif ? "true" : "false");
        o.tabIndex = actif ? 0 : -1;
        var panneau = document.getElementById(o.getAttribute("aria-controls"));
        if (panneau) panneau.hidden = !actif;
      });
      if (focus) onglet.focus();
      if (memoriser && liste.dataset.memoire && history.replaceState) {
        history.replaceState(null, "", "#voir-" + onglet.getAttribute("aria-controls"));
      }
    }
    onglets.forEach(function (o, i) {
      o.addEventListener("click", function () { activer(o, false, true); });
      o.addEventListener("keydown", function (e) {
        var cible = null;
        if (e.key === "ArrowRight") cible = onglets[(i + 1) % onglets.length];
        if (e.key === "ArrowLeft") cible = onglets[(i - 1 + onglets.length) % onglets.length];
        if (e.key === "Home") cible = onglets[0];
        if (e.key === "End") cible = onglets[onglets.length - 1];
        if (cible) { e.preventDefault(); activer(cible, true, true); }
      });
    });
    // Ouvre l'onglet ciblé par l'ancre de l'URL (ex. record.php#pentathlon)
    var ancre = window.location.hash.slice(1).replace(/^voir-/, "");
    var depart = onglets.filter(function (o) { return o.getAttribute("aria-controls") === ancre; })[0];
    activer(depart || onglets.filter(function (o) { return o.getAttribute("aria-selected") === "true"; })[0] || onglets[0], false);
  });

  /* ---------- Héros : diapos pilotées par la cible de laser run ----------
     Chaque changement de photo « touche » le feu suivant, comme au tir. */
  var heros = document.querySelector(".heros");
  if (heros) {
    var diapos = heros.querySelectorAll(".heros__diapo");
    var feux = heros.querySelectorAll(".cible__feu");
    var score = heros.querySelector(".cible__score");
    var courant = 0;
    var minuterie = null;

    function afficher(n) {
      courant = n;
      diapos.forEach(function (d, i) { d.classList.toggle("actif", i === n); });
      feux.forEach(function (f, i) {
        f.classList.toggle("allume", i <= n);
        f.classList.toggle("courant", i === n);
        f.setAttribute("aria-current", i === n ? "true" : "false");
      });
      if (score) score.textContent = (n + 1) + "/" + feux.length;
    }
    function suivant() { afficher((courant + 1) % diapos.length); }
    function lancer() {
      if (reduit || diapos.length < 2) return;
      clearInterval(minuterie);
      minuterie = setInterval(suivant, 5000);
    }
    feux.forEach(function (f, i) {
      f.addEventListener("click", function () { afficher(i); lancer(); });
    });

    if (diapos.length) {
      if (reduit) {
        afficher(0);
      } else {
        // Séquence d'ouverture : les feux s'allument un à un, puis la cible se réarme.
        diapos[0].classList.add("actif");
        feux.forEach(function (f, i) {
          setTimeout(function () { f.classList.add("allume"); }, 350 + i * 180);
        });
        setTimeout(function () { afficher(0); lancer(); }, 350 + feux.length * 180 + 700);
      }
    }
  }
})();
