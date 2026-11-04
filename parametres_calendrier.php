<?php
include 'fonction.php';
exiger_admin("Calendrier");

entete('Calendrier');
navbar();
bandeau('Calendrier', 'Ajouter ou retirer un événement du calendrier.', true);
?>

<section class="section section--serre">
  <div class="wrap">
    <?php ajoutEvenement(); ?>
  </div>
</section>

<?php footer(); ?>
