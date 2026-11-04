<?php
include 'fonction.php';

// Albums (Administration > Galerie) : titre, lien vers l'album en ligne, date, image de couverture
$albums = json_decode(@file_get_contents('./galerie/data.json'), true) ?: [];
usort($albums, function ($a, $b) {
    return lire_date($b['date']) <=> lire_date($a['date']);
});

entete('Photos');
navbar();
bandeau('Photos', 'Les albums des compétitions et des stages. Chaque album s\'ouvre dans un nouvel onglet.');
?>

<section class="section section--serre">
  <div class="wrap">
    <?php if (!$albums): ?>
      <p>Aucun album pour le moment.</p>
    <?php else: ?>
      <div class="albums">
        <?php foreach ($albums as $album): ?>
          <a class="album" href="<?= e($album['lien']) ?>" target="_blank" rel="noopener">
            <img src="./image/galerie_image/<?= e($album['path_image']) ?>" alt="" loading="lazy">
            <div class="album__texte">
              <h3><?= e($album['titre']) ?></h3>
              <span><?= e(date_lisible($album['date'])) ?></span>
            </div>
          </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php footer(); ?>
