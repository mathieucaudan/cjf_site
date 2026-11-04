<?php
include 'fonction.php';

$dossierPdf = './article/article_pdf';
$dossierImage = './image/article_image';
$articles = json_decode(@file_get_contents('./article/article.json'), true) ?: [];
usort($articles, function ($a, $b) {
    return lire_date($b['date']) <=> lire_date($a['date']);
});

entete('Articles');
navbar();
bandeau('Articles', 'Compétitions, portraits et vie du club.');
?>

<section class="section section--serre">
  <div class="wrap">
    <?php if (!$articles): ?>
      <p>Aucun article publié pour le moment.</p>
    <?php else: ?>
      <div class="articles">
        <?php foreach ($articles as $article):
          $nomPdf = pathinfo($article['image'], PATHINFO_FILENAME) . '.pdf'; ?>
          <article class="article">
            <div class="article__visuel">
              <img src="<?= e($dossierImage . '/' . $article['image']) ?>" alt="" loading="lazy">
            </div>
            <div class="article__corps">
              <div class="article__date"><?= e(date_lisible($article['date'])) ?></div>
              <h3><a href="<?= e($dossierPdf . '/' . $nomPdf) ?>" target="_blank" rel="noopener"><?= e($article['titre']) ?></a></h3>
              <p><?= e($article['description']) ?></p>
              <div class="article__actions">
                <form action="download.php" method="post">
                  <input type="hidden" name="pdf" value="<?= e(rawurlencode($nomPdf)) ?>">
                  <button type="submit" class="lien-action" name="download">Télécharger le PDF</button>
                </form>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php footer(); ?>
