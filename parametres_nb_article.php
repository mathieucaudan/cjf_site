<?php
include 'fonction.php';
exiger_admin("Articles à la une");

entete('Articles à la une');
navbar();
bandeau('Articles à la une', "Combien d'articles mettre en avant sur la page d'accueil.", true);
?>

<section class="section section--serre">
  <div class="wrap">
    <?php nombre_article(); ?>
  </div>
</section>

<?php footer(); ?>
