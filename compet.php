<?php
include 'fonction.php';
exiger_admin('Compétitions');

entete('Compétitions');
navbar();
bandeau('Compétitions', 'Organiser une compétition du club : athlètes, saisie des temps et résultats.', true);
?>

<section class="section section--serre">
  <div class="wrap">
    <div class="tuiles-admin">
      <a class="tuile-admin" href="ouvrir_competition.php">
        <strong>Ouvrir une compétition</strong>
        <span>Ajouter des athlètes, saisir les temps, voir les résultats.</span>
      </a>
      <a class="tuile-admin" href="creer_competition.php">
        <strong>Créer une compétition</strong>
        <span>Laser run ou triathlé.</span>
      </a>
      <a class="tuile-admin tuile-admin--danger" href="supprimer_competition.php">
        <strong>Supprimer une compétition</strong>
        <span>Efface la compétition et tous ses résultats.</span>
      </a>
    </div>
  </div>
</section>

<?php footer(); ?>
