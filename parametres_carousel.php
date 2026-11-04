<?php
include 'fonction.php';
exiger_admin("Photos d'accueil");

entete("Photos d'accueil");
navbar();
bandeau("Photos d'accueil", "Les photos qui défilent en haut de la page d'accueil.", true);
?>

<section class="section section--serre">
  <div class="wrap">
    <?php onglets(['ajoutImageCarousel' => 'Ajouter une photo', 'suppImageCarousel' => 'Gérer les photos']); ?>
    <div id="ajoutImageCarousel" role="tabpanel" aria-labelledby="onglet-ajoutImageCarousel" tabindex="0">
      <?php ajoutImageCarousel(); ?>
    </div>
    <div id="suppImageCarousel" role="tabpanel" aria-labelledby="onglet-suppImageCarousel" tabindex="0">
      <?php suppImageCarousel(); ?>
    </div>
  </div>
</section>

<?php footer(); ?>
