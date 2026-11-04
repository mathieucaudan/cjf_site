<?php
include 'fonction.php';

$groupes = [
    'indiv' => ['Individuels', glob('resultats/indiv/*.pdf') ?: []],
    'relais' => ['Relais', glob('resultats/relais/*.pdf') ?: []],
];

entete('Résultats officiels');
navbar();
bandeau('Résultats officiels', 'Championnat de France de triathlé : les classements au format PDF.');
?>

<section class="section section--serre">
  <div class="wrap">
    <?php onglets(['indiv' => 'Individuels', 'relais' => 'Relais']); ?>
    <?php foreach ($groupes as $id => [$titre, $fichiers]): ?>
      <div id="<?= $id ?>" role="tabpanel" aria-labelledby="onglet-<?= $id ?>" tabindex="0">
        <?php if (!$fichiers): ?>
          <p>Aucun classement publié pour le moment.</p>
        <?php else: ?>
          <ul class="documents">
            <?php foreach ($fichiers as $fichier): ?>
              <li class="document">
                <a href="<?= e($fichier) ?>" target="_blank" rel="noopener"><?= icone('pdf', 26) ?><?= e(pathinfo($fichier, PATHINFO_FILENAME)) ?></a>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<?php footer(); ?>
