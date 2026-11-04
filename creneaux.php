<?php
include 'fonction.php';

// Créneaux d'entraînement par discipline : [jour, horaire]
$creneaux = [
    'laserrun' => ['Laser run', 'laser', [['Mercredi', '18h00 – 19h00']]],
    'natation' => ['Natation', 'nat', [
        ['Lundi', '6h30 – 7h30'],
        ['Mercredi', '6h30 – 7h30'],
        ['Jeudi', '20h00 – 21h30'],
        ['Vendredi', '6h30 – 7h30'],
        ['Samedi', '8h00 – 9h30'],
    ]],
    'escrime' => ['Escrime', 'escrime', [
        ['Lundi', '18h30 – 20h00'],
        ['Mercredi', '19h00 – 20h00'],
    ]],
    'obstacle' => ['Obstacles', 'obstacle', []],
];

entete("Créneaux d'entraînement");
navbar();
bandeau("Créneaux d'entraînement", 'Les horaires de la saison, discipline par discipline.');
?>

<section class="section section--serre">
  <div class="wrap">
    <div class="creneaux">
      <?php foreach ($creneaux as $id => [$nom, $classe, $seances]): ?>
        <div class="creneau creneau--<?= $classe ?>" id="<?= $id ?>">
          <h3><?= e($nom) ?></h3>
          <?php if ($seances): ?>
            <ul>
              <?php foreach ($seances as [$jour, $heure]): ?>
                <li><strong><?= e($jour) ?></strong><span><?= e($heure) ?></span></li>
              <?php endforeach; ?>
            </ul>
          <?php else: ?>
            <p class="vide">Horaires à venir. Renseignez-vous auprès des coachs.</p>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
    <p style="margin-top: 28px;">Une question sur un créneau ? Appelez le <a href="tel:+33608105644">06 08 10 56 44</a> ou écrivez-nous à <a href="mailto:cjf.saintmalo.pentathlonmoderne@gmail.com">cjf.saintmalo.pentathlonmoderne@gmail.com</a>.</p>
  </div>
</section>

<?php footer(); ?>
