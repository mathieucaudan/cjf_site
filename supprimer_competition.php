<?php
include 'fonction.php';
exiger_admin('Supprimer une compétition');

$disciplines = ['laserrun' => 'Laser run', 'triathle' => 'Triathlé'];
$discipline = $_GET['discipline'] ?? null;
if ($discipline !== null && !isset($disciplines[$discipline])) {
    $discipline = null;
}

$message = null;
if (($competition = demande_suppression()) !== null) {
    $disc = $_POST['discipline'] ?? '';
    if (competition_valide($disc, $competition)) {
        $chemin = "./competitions/$disc/$competition";
        foreach (glob($chemin . '/*') ?: [] as $f) {
            if (is_file($f)) unlink($f);
        }
        $message = @rmdir($chemin)
            ? ["Compétition « $competition » supprimée.", 'ok']
            : ["La compétition « $competition » n'a pas pu être entièrement supprimée (sous-dossier présent).", 'erreur'];
    } else {
        $message = ['Compétition introuvable.', 'erreur'];
    }
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

entete('Supprimer une compétition');
navbar();
bandeau('Supprimer une compétition', 'La suppression efface aussi les athlètes et les temps saisis. Elle est définitive.', true);
?>

<section class="section section--serre">
  <div class="wrap">
    <p class="fil"><a href="compet.php">Compétitions</a> / Supprimer</p>
    <?php if ($message) message_admin($message[0], $message[1]); ?>

    <div class="admin-panel">
      <h2>Discipline</h2>
      <div class="boutons">
        <?php foreach ($disciplines as $id => $nom): ?>
          <a class="btn <?= $discipline === $id ? '' : 'btn--contour' ?>" href="?discipline=<?= $id ?>"><?= e($nom) ?></a>
        <?php endforeach; ?>
      </div>
    </div>

    <?php if ($discipline): ?>
      <div class="admin-panel">
        <h2>Compétitions de <?= e($disciplines[$discipline]) ?></h2>
        <?php if (!$competitions): ?>
          <p>Aucune compétition pour cette discipline.</p>
        <?php else: ?>
          <ul class="liste-admin">
            <?php foreach ($competitions as $comp): ?>
              <li>
                <span><?= e($comp) ?></span>
                <?= bouton_supprimer($comp, $comp, '', ['discipline' => $discipline]) ?>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php footer(); ?>
