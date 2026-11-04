<?php
include 'fonction.php';
exiger_admin("Section sportive");

entete('Section sportive');
navbar();
bandeau('Section sportive', 'Les articles de la section sportive scolaire.', true);
?>

<section class="section section--serre">
  <div class="wrap">
    <?php onglets(['ajoutArticleSection' => 'Ajouter un article', 'suppArticleSection' => 'Supprimer un article']); ?>
    <div id="ajoutArticleSection" role="tabpanel" aria-labelledby="onglet-ajoutArticleSection" tabindex="0">
      <?php ajoutArticleSection(); ?>
    </div>
    <div id="suppArticleSection" role="tabpanel" aria-labelledby="onglet-suppArticleSection" tabindex="0">
      <?php suppArticleSection(); ?>
    </div>
  </div>
</section>

<?php footer(); ?>
