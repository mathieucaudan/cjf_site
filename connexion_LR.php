<?php
include 'fonction.php';
exiger_admin('Statistiques Laser Shot');

// Visites de la page Laser Shot par numéro de semaine (compteur.json)
$data = json_decode(@file_get_contents('compteur.json'), true) ?: [];
ksort($data, SORT_NUMERIC);
$semaines = array_map('strval', array_keys($data));
$connexions = array_values($data);
$total = array_sum($connexions);

entete('Statistiques Laser Shot');
navbar();
bandeau('Statistiques Laser Shot', 'Nombre de visites de la page Laser Shot, semaine par semaine.', true);
?>

<section class="section section--serre">
  <div class="wrap">
    <div class="admin-panel">
      <?php if (!$data): ?>
        <p>Aucune visite enregistrée pour le moment.</p>
      <?php else: ?>
        <h2><?= $total ?> visite<?= $total > 1 ? 's' : '' ?> au total</h2>
        <div class="graphique"><canvas id="graphique" aria-label="Visites par semaine" role="img"></canvas></div>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php if ($data): ?>
<script src="script/chart.umd.js"></script>
<script>
  new Chart(document.getElementById('graphique'), {
    type: 'bar',
    data: {
      labels: <?= json_encode($semaines) ?>.map(function (s) { return 'Sem. ' + s; }),
      datasets: [{ label: 'Visites', data: <?= json_encode($connexions) ?>, backgroundColor: '#2e6cb8', borderRadius: 4 }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: { legend: { display: false } },
      scales: { y: { beginAtZero: true, ticks: { precision: 0 } }, x: { grid: { display: false } } }
    }
  });
</script>
<?php endif; ?>

<?php footer(); ?>
