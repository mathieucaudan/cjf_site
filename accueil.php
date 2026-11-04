<?php
include 'fonction.php';

/* ---------- Données ---------- */

// Photos du héros (gérées dans Administration > Photos d'accueil)
$diapos = glob("image/carousel/*.{jpg,png,gif,JPG,Jpg,jpeg,Jpeg,webp}", GLOB_BRACE) ?: [];
$diapos = array_slice($diapos, 0, 5); // la cible de laser run compte 5 feux

// Infos et résultats (Administration > Infos et résultats), les plus récents d'abord
$infos = json_decode(@file_get_contents('./resultat.json'), true) ?: [];
$infos = array_reverse($infos);

// Articles à la une (Administration > Articles à la une)
$nb_art = (int) trim((string) @file_get_contents('nb_art.txt'));
if ($nb_art < 1 || $nb_art > 2) {
    $nb_art = 1;
}
$dossierPdf = './article/article_pdf';
$dossierImage = './image/article_image';
$articles = json_decode(@file_get_contents('./article/article.json'), true) ?: [];
usort($articles, function ($a, $b) {
    return lire_date($b['date']) <=> lire_date($a['date']);
});
$aLaUne = array_slice($articles, 0, $nb_art);

entete();
navbar();
?>

<section class="heros" aria-label="Présentation du club">
  <div class="heros__diapos">
    <?php foreach ($diapos as $i => $image): ?>
      <img class="heros__diapo" src="<?= e($image) ?>" alt="" <?= $i === 0 ? '' : 'loading="lazy"' ?>>
    <?php endforeach; ?>
  </div>
  <div class="wrap heros__contenu">
    <p class="heros__club">Cercle Jules Ferry Saint-Malo</p>
    <h1>Pentathlon moderne</h1>
    <p class="heros__disciplines">Laser run, natation, escrime et parcours d'obstacles. Des premiers pas aux championnats du monde.</p>
    <div class="boutons">
      <a class="btn btn--rouge" href="inscription.php">Nous rejoindre</a>
      <a class="btn btn--contour-clair" href="creneaux.php">Voir les créneaux</a>
    </div>
    <?php if (count($diapos) > 1): ?>
      <div class="cible">
        <div class="cible__plaque" role="group" aria-label="Choisir la photo">
          <?php foreach ($diapos as $i => $image): ?>
            <button class="cible__feu" type="button" aria-label="Photo <?= $i + 1 ?>"></button>
          <?php endforeach; ?>
        </div>
        <span class="cible__score" aria-hidden="true"></span>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php if ($infos): ?>
<section class="section section--serre">
  <div class="wrap">
    <div class="section-titre">
      <h2>Au programme</h2>
      <a href="calendrier.php">Tout le calendrier</a>
    </div>
    <div class="infos">
      <?php foreach ($infos as $info): ?>
        <article class="info">
          <div class="info__visuel">
            <?php if (!empty($info['image']) && file_exists($info['image'])): ?>
              <img src="<?= e($info['image']) ?>" alt="" loading="lazy">
            <?php else: ?>
              <img src="image/favicon.webp" alt="" loading="lazy" style="object-fit: contain; padding: 24px;">
            <?php endif; ?>
          </div>
          <div class="info__corps">
            <?php if (!empty($info['date'])): ?>
              <div class="info__date"><?= e(date_lisible($info['date'])) ?></div>
            <?php endif; ?>
            <h3><?= e($info['titre']) ?></h3>
            <?php if (!empty($info['description'])): ?>
              <p><?= e($info['description']) ?></p>
            <?php endif; ?>
            <div class="info__liens">
              <?php if (!empty($info['pdf'])): ?>
                <a href="<?= e($info['pdf']) ?>" target="_blank" rel="noopener">Voir l'affiche</a>
              <?php endif; ?>
              <?php if (!empty($info['url'])): ?>
                <a href="<?= e($info['url']) ?>" target="_blank" rel="noopener">En savoir plus</a>
              <?php endif; ?>
            </div>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if ($aLaUne): ?>
<section class="section section--blanc">
  <div class="wrap">
    <div class="section-titre">
      <h2>À la une</h2>
      <a href="article.php">Tous les articles</a>
    </div>
    <div class="articles articles--une">
      <?php foreach ($aLaUne as $article):
        $pdf = $dossierPdf . '/' . pathinfo($article['image'], PATHINFO_FILENAME) . '.pdf'; ?>
        <article class="article">
          <div class="article__visuel">
            <img src="<?= e($dossierImage . '/' . $article['image']) ?>" alt="" loading="lazy">
          </div>
          <div class="article__corps">
            <div class="article__date"><?= e(date_lisible($article['date'])) ?></div>
            <h3><a href="<?= e($pdf) ?>" target="_blank" rel="noopener"><?= e($article['titre']) ?></a></h3>
            <p><?= e($article['description']) ?></p>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<section class="section">
  <div class="wrap">
    <div class="section-titre">
      <h2>Quatre épreuves, un seul sport</h2>
      <a href="creneaux.php">Les horaires d'entraînement</a>
    </div>
    <div class="disciplines">
      <a class="discipline" href="creneaux.php#laserrun">
        <img src="image/section_image/LR.png" alt="" loading="lazy">
        <div class="discipline__texte"><h3>Laser run</h3><p>Course à pied et tir au pistolet laser, enchaînés.</p></div>
      </a>
      <a class="discipline" href="creneaux.php#natation">
        <img src="image/section_image/nat.png" alt="" loading="lazy">
        <div class="discipline__texte"><h3>Natation</h3><p>200 m nage libre pour les seniors.</p></div>
      </a>
      <a class="discipline" href="creneaux.php#escrime">
        <img src="image/section_image/escrime2.jpg" alt="" loading="lazy">
        <div class="discipline__texte"><h3>Escrime</h3><p>À l'épée, avec une maîtresse d'armes.</p></div>
      </a>
      <a class="discipline" href="creneaux.php#obstacle">
        <img src="image/section_image/PO2.jpg" alt="" loading="lazy">
        <div class="discipline__texte"><h3>Obstacles</h3><p>Le parcours qui remplace l'équitation depuis 2025.</p></div>
      </a>
    </div>
  </div>
</section>

<section class="appel">
  <div class="wrap">
    <div>
      <h2>Envie d'essayer ?</h2>
      <p>Les dossiers d'inscription adultes et mineurs sont en ligne.</p>
    </div>
    <a class="btn btn--clair" href="inscription.php">S'inscrire au club</a>
  </div>
</section>

<?php footer(); ?>
