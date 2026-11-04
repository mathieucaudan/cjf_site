<?php
include 'fonction.php';

// [photo, nom, rôle, [lignes de description]]
$bureau = [
    ['jeanlouis.webp', 'Jean-Louis Heleu', 'Président', ['Relation partenaires', 'Responsable organisation']],
    ['arnaud.webp', 'Arnaud Eveillard', 'Directeur sportif', [
        'Coordination sportive et suivi des athlètes',
        'Responsable du développement',
        'Responsable de la section sportive scolaire pentathlon moderne du collège Le Bocage de Dinard',
    ]],
];

$coachs = [
    ['daniel.webp', 'Daniel Bourquin', 'Course', ['Professeur d\'EPS, BEES 2e degré', 'Entraîneur course 3e degré expert', 'Partenariat avec le CJF Athlétisme']],
    ['arnaud.webp', 'Arnaud Eveillard', 'Pentathlon', ['BF1']],
    ['julien.webp', 'Julien Tertrain', 'Laser run', ['BF1']],
    ['ludmila.webp', 'Ludmila Pozdejeva', 'Escrime', ['Maître d\'armes']],
    ['fred.webp', 'Fred Garcia', 'Natation', [
        'BF3 de triathlon, BF4 de natation',
        'BPJEPS AAN, moniteur sportif de natation',
        'Partenariat avec le Triathlon Côte d\'Émeraude',
    ]],
];

$athletes = [
    ['aziliz.webp', 'Aziliz Naour', 'U22', [
        '3e du championnat de France U22 de tétrathlon',
        'Championne de France 2023 de triathlé U22, individuel et relais mixte',
        'Championne de France 2021 de triathlé U22, individuel et relais mixte',
        '1 sélection internationale',
    ]],
    ['arnaud.webp', 'Arnaud Eveillard', 'Master', ['3e du championnat de France de triathlé', '3e du circuit national Master']],
    ['mathieu.webp', 'Mathieu Caudan', 'U22', [
        'Vice-champion du monde de laser run en relais mixte 2023',
        '3e du championnat du monde de laser run en relais mixte 2022',
        'Champion de France 2022 de laser run',
        'Champion de France de triathlé U22 en relais mixte',
    ]],
];

function personnes($liste)
{
    echo "<ul class='personnes'>";
    foreach ($liste as [$photo, $nom, $role, $lignes]) {
        echo "<li class='personne'>
            <div class='personne__photo'><img src='image/coach/" . e($photo) . "' alt='" . e($nom) . "' loading='lazy'></div>
            <div class='personne__texte'>
              <span class='personne__role'>" . e($role) . "</span>
              <h3>" . e($nom) . "</h3><ul>";
        foreach ($lignes as $ligne) {
            echo "<li>" . e($ligne) . "</li>";
        }
        echo "</ul></div></li>";
    }
    echo "</ul>";
}

entete('Qui sommes-nous ?');
navbar();
bandeau('Qui sommes-nous ?', 'Les bénévoles, les coachs et quelques athlètes qui font vivre le club.');
?>

<section class="section section--serre">
  <div class="wrap">
    <?php onglets(['bureau' => 'Bureau', 'coachs' => 'Coachs', 'athletes' => 'Athlètes']); ?>
    <div id="bureau" role="tabpanel" aria-labelledby="onglet-bureau" tabindex="0"><?php personnes($bureau); ?></div>
    <div id="coachs" role="tabpanel" aria-labelledby="onglet-coachs" tabindex="0"><?php personnes($coachs); ?></div>
    <div id="athletes" role="tabpanel" aria-labelledby="onglet-athletes" tabindex="0"><?php personnes($athletes); ?></div>
  </div>
</section>

<?php footer(); ?>
