<?php
include 'fonction.php';

$dossierPartenaires = './partenaires/Dossier partenaires CJF Pentathlon Moderne.pdf';

entete('Partenaires');
navbar();
bandeau('Partenaires', 'Ils soutiennent le club et ses athlètes. Merci à eux.');
?>

<section class="section section--serre">
  <div class="wrap">
    <?php onglets(['prives' => 'Partenaires privés', 'publics' => 'Partenaires publics', 'evenement' => 'Événement entreprises']); ?>

    <div id="prives" role="tabpanel" aria-labelledby="onglet-prives" tabindex="0">
      <div class="partenaires">
        <article class="partenaire">
          <div class="partenaire__logo partenaire__logo--photo"><img src="./image/partenaires_images/swisslife.webp" alt="Valentin Vivier, Swiss Life, avec les athlètes du club"></div>
          <div class="partenaire__texte">
            <h3>Valentin Vivier</h3>
            <div class="partenaire__qui">Swiss Life</div>
            <p>Expertise en protection sociale et patrimoniale. Pour les dirigeants d'entreprise : prévoyance, complémentaire santé et retraite, protection sociale des salariés, obligations conventionnelles, indemnités de fin de carrière, trésorerie.</p>
            <p>Pour les particuliers : assurance emprunteur, protection de la famille, complémentaire santé, optimisation fiscale, placement et gestion de patrimoine.</p>
            <a class="btn btn--contour btn--petit" href="https://agences.swisslife-direct.fr/assurance/agence-valentin-vivier-id0065363" target="_blank" rel="noopener">Voir l'agence</a>
          </div>
        </article>
        <article class="partenaire">
          <div class="partenaire__logo partenaire__logo--photo"><img src="./image/partenaires_images/axa.webp" alt="Ludmila Pozdejeva, AXA, avec les athlètes du club"></div>
          <div class="partenaire__texte">
            <h3>Ludmila Pozdejeva</h3>
            <div class="partenaire__qui">AXA Saint-Malo</div>
            <p>Mutuelle santé, prévoyance et assurance de prêt. Assurance vie et épargne retraite, contrats collectifs et individuels.</p>
            <p>Experte en protection sociale et gestion du patrimoine, elle accompagne particuliers, professions libérales et chefs d'entreprise sur l'investissement, la retraite et la prévoyance.</p>
            <a class="btn btn--contour btn--petit" href="https://agence.axa.fr/bretagne/ille-et-vilaine/saint-malo/ludmila-pozdejeva" target="_blank" rel="noopener">Voir l'agence</a>
          </div>
        </article>
      </div>
    </div>

    <div id="publics" role="tabpanel" aria-labelledby="onglet-publics" tabindex="0">
      <div class="partenaires">
        <article class="partenaire">
          <div class="partenaire__logo"><img src="./image/partenaires_images/logo_ans.webp" alt="Agence nationale du Sport"></div>
          <div class="partenaire__texte">
            <h3>ANS</h3>
            <div class="partenaire__qui">Agence nationale du Sport</div>
            <a class="btn btn--contour btn--petit" href="https://www.agencedusport.fr/" target="_blank" rel="noopener">Voir le site</a>
          </div>
        </article>
      </div>
    </div>

    <div id="evenement" role="tabpanel" aria-labelledby="onglet-evenement" tabindex="0">
      <div class="image-pleine" style="max-width: 860px; margin: 0 auto;">
        <img src="./partenaires/LR_Entreprise.jpg" alt="Affiche du laser run des entreprises">
      </div>
    </div>
  </div>
</section>

<section class="appel">
  <div class="wrap">
    <div>
      <h2>Devenir partenaire</h2>
      <p>Visibilité, événements entreprises et soutien aux athlètes : tout est dans notre dossier.</p>
    </div>
    <a class="btn btn--clair" href="<?= e($dossierPartenaires) ?>" target="_blank" rel="noopener">Lire le dossier partenaires</a>
  </div>
</section>

<?php footer(); ?>
