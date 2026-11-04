<?php
include 'fonction.php';
exiger_admin('Créer une compétition');

$message = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $discipline = $_POST['discipline'] ?? '';
    $nom = trim($_POST['nom_competition'] ?? '');

    if (!in_array($discipline, ['laserrun', 'triathle'], true) || $nom === '') {
        $message = ['Choisissez une discipline et donnez un nom à la compétition.', 'erreur'];
    } elseif ($nom !== basename($nom) || $nom[0] === '.' || preg_match('#[/\\\\<>:"|?*]#', $nom)) {
        $message = ['Le nom ne doit pas contenir de caractères spéciaux (/ \\ : * ? " < > |).', 'erreur'];
    } else {
        $dossier = "./competitions/$discipline/$nom";
        if (is_dir($dossier)) {
            $message = ['Une compétition porte déjà ce nom dans cette discipline.', 'erreur'];
        } elseif (mkdir($dossier, 0755, true)) {
            file_put_contents("$dossier/athletes.json", json_encode(['athletes' => []], JSON_PRETTY_PRINT));
            header('Location: ajouter_athletes.php?competition=' . urlencode($nom) . '&discipline=' . urlencode($discipline) . '&cree=1');
            exit;
        } else {
            $message = ['Le dossier de la compétition n\'a pas pu être créé sur le serveur.', 'erreur'];
        }
    }
}

entete('Créer une compétition');
navbar();
bandeau('Créer une compétition', null, true);
?>

<section class="section section--serre">
  <div class="wrap">
    <p class="fil"><a href="compet.php">Compétitions</a> / Créer</p>
    <div class="admin-panel">
      <?php if ($message) message_admin($message[0], $message[1]); ?>
      <form class="formulaire" method="post">
        <label for="discipline">Discipline</label>
        <select id="discipline" name="discipline" required>
          <option value="">Choisir une discipline</option>
          <option value="laserrun">Laser run</option>
          <option value="triathle">Triathlé</option>
        </select>
        <label for="nom_competition">Nom de la compétition</label>
        <input type="text" id="nom_competition" name="nom_competition" required placeholder="Ex. : Triathlé de Noël 2026">
        <button class="w3-button" type="submit">Créer la compétition</button>
      </form>
    </div>
  </div>
</section>

<?php footer(); ?>
