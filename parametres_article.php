<?php
include 'fonction.php';
exiger_admin("Articles");

entete('Articles');
navbar();
bandeau('Articles', 'Publier un article (PDF et image) ou en retirer un.', true);
?>

<section class="section section--serre">
  <div class="wrap">
    <?php onglets(['ajoutArticle' => 'Ajouter un article', 'suppArticle' => 'Supprimer un article']); ?>
    <div id="ajoutArticle" role="tabpanel" aria-labelledby="onglet-ajoutArticle" tabindex="0">
      <?php ajoutArticle(); ?>
    </div>
    <div id="suppArticle" role="tabpanel" aria-labelledby="onglet-suppArticle" tabindex="0">
      <?php suppArticle(); ?>
    </div>
  </div>
</section>

<?php footer(); ?>
