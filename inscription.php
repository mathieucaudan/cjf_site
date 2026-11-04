<?php
include 'fonction.php';

// Saison en cours : elle bascule au 1er août
$annee = (int) date('Y');
$mois = (int) date('n');
$saison = $mois >= 8 ? $annee . ' – ' . ($annee + 1) : ($annee - 1) . ' – ' . $annee;

// Les catégories d'âge se calculent sur l'année de fin de saison à partir du 1er septembre
$decalage = $mois >= 9 ? 1 : 0;
$categories = [
    ['Master 60+', '60 ans et plus', ($annee - 60 + $decalage) . ' et avant'],
    ['Master 50+', '50 à 59 ans', ($annee - 59 + $decalage) . ' – ' . ($annee - 50 + $decalage)],
    ['Master 40+', '40 à 49 ans', ($annee - 49 + $decalage) . ' – ' . ($annee - 40 + $decalage)],
    ['Master 30+', '30 à 39 ans', ($annee - 39 + $decalage) . ' – ' . ($annee - 30 + $decalage)],
    ['Senior', '22 à 29 ans', ($annee - 29 + $decalage) . ' – ' . ($annee - 22 + $decalage)],
    ['U22', '19 à 21 ans', ($annee - 21 + $decalage) . ' – ' . ($annee - 19 + $decalage)],
    ['U19', '17 et 18 ans', ($annee - 18 + $decalage) . ' – ' . ($annee - 17 + $decalage)],
    ['U17', '15 et 16 ans', ($annee - 16 + $decalage) . ' – ' . ($annee - 15 + $decalage)],
    ['U15', '13 et 14 ans', ($annee - 14 + $decalage) . ' – ' . ($annee - 13 + $decalage)],
    ['U13', '11 et 12 ans', ($annee - 12 + $decalage) . ' – ' . ($annee - 11 + $decalage)],
    ['U11', '9 et 10 ans', ($annee - 10 + $decalage) . ' – ' . ($annee - 9 + $decalage)],
];

entete("S'inscrire");
navbar();
bandeau("S'inscrire au club", "Saison $saison. Téléchargez le dossier, remplissez-le et rapportez-le à l'entraînement.");
?>

<section class="section section--serre">
  <div class="wrap colonnes">
    <div>
      <div class="carte">
        <h2>Dossiers d'inscription</h2>
        <div class="dossiers">
          <a class="dossier" href="./inscription/majeur.pdf" download>
            <strong>Adultes</strong>
            <span>Pour les athlètes majeurs.</span>
            <em>Télécharger le dossier (PDF)</em>
          </a>
          <a class="dossier" href="./inscription/mineur.pdf" download>
            <strong>Mineurs</strong>
            <span>À remplir avec un parent ou tuteur.</span>
            <em>Télécharger le dossier (PDF)</em>
          </a>
        </div>
      </div>

      <div class="carte">
        <h2>Aides à l'inscription</h2>
        <h3>Coupon Sport 35</h3>
        <p>Une aide pouvant aller jusqu'à 40 € pour s'inscrire dans un club, pour les 11-15 ans bénéficiaires de l'allocation de rentrée scolaire. Présentez au club :</p>
        <ul>
          <li>une copie de l'attestation d'allocation de rentrée scolaire (ARS) ;</li>
          <li>une copie d'une pièce d'identité de l'enfant (livret de famille, carte d'identité ou passeport).</li>
        </ul>
        <p><a href="http://ille-et-vilaine.fr/coupon-sport35" target="_blank" rel="noopener">En savoir plus sur le Coupon Sport 35</a></p>

        <h3>Pass'Sport</h3>
        <p>Une allocation de rentrée sportive de 50 € par enfant pour s'inscrire dans un club, pour les enfants bénéficiaires de l'allocation de rentrée scolaire ou de l'allocation d'éducation de l'enfant handicapé, et les jeunes adultes bénéficiaires de l'allocation aux adultes handicapés.</p>
        <p><a href="https://www.pass.sports.gouv.fr/" target="_blank" rel="noopener">Vérifier l'éligibilité au Pass'Sport</a></p>
      </div>
    </div>

    <div class="carte">
      <h2>Catégories d'âge</h2>
      <p>Saison <?= e($saison) ?></p>
      <div class="tableau-conteneur">
        <table class="tableau">
          <thead><tr><th>Catégorie</th><th>Âge</th><th>Né·e en</th></tr></thead>
          <tbody>
            <?php foreach ($categories as [$nom, $age, $naissance]): ?>
              <tr><td class="cat"><?= e($nom) ?></td><td><?= e($age) ?></td><td><?= e($naissance) ?></td></tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<?php footer(); ?>
