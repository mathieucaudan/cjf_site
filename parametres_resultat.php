<?php
include 'fonction.php';
exiger_admin("Infos et résultats");

entete('Infos et résultats');
navbar();
bandeau('Infos et résultats', "Le bloc « Au programme » de la page d'accueil.", true);
?>

<section class="section section--serre">
  <div class="wrap">
    <?php onglets(['ajoutResultat' => 'Publier une info', 'suppResultat' => 'Supprimer une info']); ?>
    <div id="ajoutResultat" role="tabpanel" aria-labelledby="onglet-ajoutResultat" tabindex="0">
      <?php ajoutResultat(); ?>
    </div>
    <div id="suppResultat" role="tabpanel" aria-labelledby="onglet-suppResultat" tabindex="0">
      <?php suppResultat(); ?>
    </div>
  </div>
</section>

<?php footer(); ?>
