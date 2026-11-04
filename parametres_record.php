<?php
include 'fonction.php';
exiger_admin("Records");

entete('Records');
navbar();
bandeau('Records', 'Enregistrer un nouveau record du club.', true);
?>

<section class="section section--serre">
  <div class="wrap">
    <?php changeRecord(); ?>
  </div>
</section>

<?php footer(); ?>
