<?php
include 'fonction.php';

entete('Section sportive scolaire');
navbar();
bandeau('Section sportive scolaire', 'Pentathlon moderne au collège Le Bocage de Dinard : la seule section de France.');
?>

<section class="section section--serre">
  <div class="wrap">
    <?php onglets(['presentation' => 'Présentation', 'resultats' => 'Résultats', 'planning' => 'Planning']); ?>

    <div id="presentation" role="tabpanel" aria-labelledby="onglet-presentation" tabindex="0">
      <div class="mosaique">
        <img src="./image/section_image/LR.png" alt="Laser run">
        <img src="./image/section_image/escrime2.jpg" alt="Escrime">
        <img src="./image/section_image/nat.png" alt="Natation">
        <img src="./image/section_image/PO2.jpg" alt="Parcours d'obstacles">
      </div>

      <div class="faits">
        <div class="fait"><strong>Unique en France</strong><span>La seule section sportive de pentathlon moderne</span></div>
        <div class="fait"><strong>2 séances</strong><span>par semaine, intégrées à l'emploi du temps en plus de l'EPS</span></div>
        <div class="fait"><strong>4 activités</strong><span>laser run, escrime, natation et parcours d'obstacles</span></div>
        <div class="fait"><strong>Compétitions</strong><span>scolaires (UNSS) et fédérales</span></div>
      </div>

      <div class="colonnes">
        <div class="carte">
          <div class="label-section">
            <img src="./image/section_image/label.png" alt="Label section sportive">
            <div>
              <h2>La journée découverte du laser run t'a plu ?</h2>
              <p>Rejoindre la seule section sportive de pentathlon moderne de France, c'est possible, au sein du collège Le Bocage de Dinard.</p>
            </div>
          </div>
          <h3>Entraînements</h3>
          <p>Lundi 11h30 – 13h15 et jeudi 11h30 – 13h15, pour découvrir et se perfectionner dans quatre activités :</p>
          <ul>
            <li>Laser run (course et tir au pistolet laser)</li>
            <li>Escrime</li>
            <li>Natation</li>
            <li>Parcours d'obstacles</li>
          </ul>
        </div>
        <div class="carte">
          <h2>Candidater</h2>
          <p>Une réunion d'information a lieu au collège en juin pour présenter la section aux parents des élèves intéressés.</p>
          <ul>
            <li>Savoir nager.</li>
            <li>Remplir le dossier d'inscription et participer à l'après-midi de détection (et/ou à la matinée découverte à Aquamalo lors du Swimcross).</li>
            <li>30 places en 6e : 15 garçons et 15 filles.</li>
            <li>Les candidats retenus complètent leur dossier début juillet : certificat médical, cotisation, fiche de renseignements et charte d'engagement.</li>
            <li>Une liste complémentaire est communiquée.</li>
          </ul>
          <p>Les dates exactes de la prochaine campagne sont annoncées par le collège et sur le <a href="calendrier.php">calendrier du club</a>.</p>
        </div>
      </div>
    </div>

    <div id="resultats" role="tabpanel" aria-labelledby="onglet-resultats" tabindex="0">
      <div class="image-pleine"><img src="image/section_image/FranceUNSS.png" alt="Résultats du championnat de France UNSS de laser run" loading="lazy"></div>
    </div>

    <div id="planning" role="tabpanel" aria-labelledby="onglet-planning" tabindex="0">
      <div class="image-pleine"><img src="image/planning.webp" alt="Planning de la section sportive" loading="lazy"></div>
    </div>
  </div>
</section>

<?php footer(); ?>
