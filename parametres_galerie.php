<?php
include 'fonction.php';
exiger_admin("Galerie");

entete('Galerie');
navbar();
bandeau('Galerie', 'Ajouter un album photo ou en retirer un.', true);
?>

<section class="section section--serre">
  <div class="wrap">
    <?php onglets(['ajoutGalerie' => 'Ajouter un album', 'suppGalerie' => 'Supprimer un album']); ?>
    <div id="ajoutGalerie" role="tabpanel" aria-labelledby="onglet-ajoutGalerie" tabindex="0">
      <?php ajoutGalerie(); ?>
    </div>
    <div id="suppGalerie" role="tabpanel" aria-labelledby="onglet-suppGalerie" tabindex="0">
      <?php suppGalerie(); ?>
    </div>
  </div>
</section>

<?php footer(); ?>
