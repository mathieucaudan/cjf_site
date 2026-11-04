<?php
include 'fonction.php';

$records = json_decode(@file_get_contents('record.json'), true) ?: [];

// Clé dans record.json => [identifiant d'onglet, libellé, colonne de performance]
$disciplines = [
    'Laser Run' => ['laserrun', 'Laser run', 'temps', 'Temps'],
    'Triathlé' => ['triathle', 'Triathlé', 'points', 'Points'],
    'Tetrathlon' => ['tetrathlon', 'Tétrathlon', 'points', 'Points'],
    'Pentathlon' => ['pentathlon', 'Pentathlon', 'points', 'Points'],
];

/** Une case « - » du fichier de records signifie qu'il n'y a pas encore de record. */
function case_record($valeur, $classe = '')
{
    $valeur = trim((string) $valeur);
    if ($valeur === '' || $valeur === '-') {
        return "<span class='vide'>—</span>";
    }
    return $classe ? "<span class='$classe'>" . e($valeur) . "</span>" : e($valeur);
}

entete('Records du club');
navbar();
bandeau('Records du club', 'Les meilleures performances des athlètes du CJF, catégorie par catégorie.');
?>

<section class="section section--serre">
  <div class="wrap">
    <?php
    $liste = [];
    foreach ($disciplines as $cle => $d) {
        $liste[$d[0]] = $d[1];
    }
    onglets($liste);

    foreach ($disciplines as $cle => [$id, $libelle, $champ, $titreChamp]): ?>
      <div id="<?= $id ?>" role="tabpanel" aria-labelledby="onglet-<?= $id ?>" tabindex="0">
        <div class="tableau-conteneur">
          <table class="tableau tableau--empile">
            <caption class="sr-only">Records de <?= e($libelle) ?></caption>
            <thead>
              <tr><th>Catégorie</th><th><?= $titreChamp ?></th><th>Athlète</th><th>Date</th><th>Lieu</th></tr>
            </thead>
            <tbody>
              <?php foreach ($records[$cle] ?? [] as $r):
                $athlete = trim(($r['prenom'] ?? '') . ' ' . ($r['nom'] ?? ''));
                if ($athlete === '- -') $athlete = '-'; ?>
                <tr>
                  <td data-title="Catégorie" class="cat"><?= e($r['categorie']) ?></td>
                  <td data-title="<?= $titreChamp ?>"><?= case_record($r[$champ] ?? '', 'perf') ?></td>
                  <td data-title="Athlète"><?= case_record($athlete) ?></td>
                  <td data-title="Date"><?= case_record($r['date'] ?? '') ?></td>
                  <td data-title="Lieu"><?= case_record($r['lieux'] ?? '') ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<?php footer(); ?>
