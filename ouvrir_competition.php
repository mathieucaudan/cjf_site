<?php
include 'fonction.php';
exiger_admin('Ouvrir une compétition');

$disciplines = ['laserrun' => 'Laser run', 'triathle' => 'Triathlé'];
$discipline = $_GET['discipline'] ?? null;
if ($discipline !== null && !isset($disciplines[$discipline])) {
    $discipline = null;
}

$competitions = [];
if ($discipline) {
    $chemin = "./competitions/$discipline/";
    foreach (is_dir($chemin) ? scandir($chemin) : [] as $entree) {
        if ($entree[0] !== '.' && is_dir($chemin . $entree)) {
            $competitions[] = $entree;
        }
    }
    natcasesort($competitions);
}

entete('Ouvrir une compétition');
navbar();
bandeau('Ouvrir une compétition', null, true);
?>

<section class="section section--serre">
  <div class="wrap">
    <p class="fil"><a href="compet.php">Compétitions</a> / Ouvrir</p>

    <div class="admin-panel">
      <h2>Discipline</h2>
      <div class="boutons">
        <?php foreach ($disciplines as $id => $nom): ?>
          <a class="btn <?= $discipline === $id ? '' : 'btn--contour' ?>" href="?discipline=<?= $id ?>"<?= $discipline === $id ? " aria-current='page'" : '' ?>><?= e($nom) ?></a>
        <?php endforeach; ?>
      </div>
    </div>

    <?php if ($discipline): ?>
      <div class="admin-panel">
        <h2>Compétitions de <?= e($disciplines[$discipline]) ?></h2>
        <?php if (!$competitions): ?>
          <p>Aucune compétition pour cette discipline. <a href="creer_competition.php">En créer une</a>.</p>
        <?php else: ?>
          <ul class="liste-admin">
            <?php foreach ($competitions as $comp):
              $q = 'competition=' . urlencode($comp) . '&discipline=' . urlencode($discipline);
              $fichier = "competitions/$discipline/$comp/athletes.json"; ?>
              <li>
                <span><?= e($comp) ?></span>
                <div class="boutons">
                  <a class="btn btn--petit" href="ajouter_athletes.php?<?= $q ?>">Athlètes</a>
                  <?php if ($discipline === 'triathle'): ?>
                    <a class="btn btn--petit btn--contour" href="ajouter_temps_nat.php?<?= $q ?>">Temps natation</a>
                  <?php endif; ?>
                  <a class="btn btn--petit btn--contour" href="ajouter_temps_lr.php?<?= $q ?>">Temps laser run</a>
                  <?php if (file_exists($fichier)): ?>
                    <a class="btn btn--petit btn--contour" href="resultats.php?title=<?= urlencode('Résultats ' . $comp) ?>&file=<?= urlencode($fichier) ?>&discipline=<?= urlencode($discipline) ?>">Résultats</a>
                  <?php endif; ?>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php footer(); ?>
