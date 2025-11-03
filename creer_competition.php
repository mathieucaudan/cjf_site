<?php
include 'fonction.php';

entete();
echo "<link rel='stylesheet' href='style/parametres.css'>";
navbar();
echo "<body style='background-color: rgb(32, 47, 74); color:white'>";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<div class='w3-center w3-padding-48 w3-xxlarge'>
            <h2>Autorisation non accordée</h2>
          </div>";
    footer();
    exit;
}
?>

<center>
    <h1>Créer une compétition</h1>

<?php
// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $discipline = $_POST["discipline"] ?? '';
    $nom_competition = trim($_POST["nom_competition"] ?? '');

    if ($discipline === '' || $nom_competition === '') {
        echo "<p style='color:red;'>Veuillez renseigner tous les champs.</p>";
    } else {
        // Chemin complet vers la nouvelle compétition
        $base_path = "./competitions/" . $discipline . "/";
        $directory = $base_path . $nom_competition;

        // Vérifie si la discipline existe
        if (!is_dir($base_path)) {
            echo "<p style='color:red;'>La discipline <b>$discipline</b> n'existe pas encore.</p>";
        } elseif (is_dir($directory)) {
            echo "<p style='color:orange;'>⚠️ Le dossier pour cette compétition existe déjà.</p>";
        } else {
            // Crée le dossier de la compétition
            if (mkdir($directory, 0777, true)) {
                echo "<p style='color:lightgreen;'>✅ Compétition <b>$nom_competition</b> créée dans <b>$discipline</b>.</p>";

                // Redirection automatique vers l’ajout d’athlètes
                echo '<script>
                        setTimeout(() => {
                            window.location.href = "ajouter_athletes.php?competition=' . urlencode($nom_competition) . '&discipline=' . urlencode($discipline) . '";
                        }, 1000);
                      </script>';
            } else {
                echo "<p style='color:red;'>❌ Erreur : impossible de créer le dossier pour la compétition.</p>";
            }
        }
    }
}
?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style="margin-top:20px;">
        <label for="discipline"><b>Discipline :</b></label><br>
        <select id="discipline" name="discipline" required style="padding:5px;">
            <option value="">-- Choisir une discipline --</option>
            <option value="laserrun">Laser Run</option>
            <option value="triathle">Triathlé</option>
        </select><br><br>

        <label for="nom_competition"><b>Nom de la compétition :</b></label><br>
        <input type="text" id="nom_competition" name="nom_competition" required placeholder="Ex : Triathlé de Noël" style="padding:5px;"><br><br>

        <button class='w3-button w3-blue' type="submit">Créer la compétition</button>
    </form>

    <br>
    <a class='w3-button w3-gray' href="compet.php">Retour à l'accueil</a>
</center>

<?php
footer();
echo "</body>";
?>
