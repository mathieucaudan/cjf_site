<?php
include 'fonction.php';
entete();
echo "<link rel='stylesheet' href='style/parametres.css'>";
navbar();
echo "<body style='background-color: rgb(32, 47, 74); color:white'>";
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
?>
        <center>
            <h1>Créer une compétition</h1>

            <?php
            // Traitement des données lors de la soumission du formulaire
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Récupérer le nom de la compétition
                $nom_competition = $_POST["nom_competition"];

                // Créer un nouveau dossier pour la compétition
                $directory = "./competitions/{$nom_competition}";

                // Vérifier si le dossier existe déjà
                if (!is_dir($directory)) {
                    // Créer le dossier si inexistant
                    if (!mkdir($directory)) {
                        echo "<p>Erreur : Impossible de créer le dossier pour la compétition.</p>";
                        exit();
                    }
                } else {
                    echo "<p>Le dossier pour cette compétition existe déjà.</p>";
                }
                // Redirection vers la page pour ajouter les athlètes à la compétition
                echo '<script>window.location.href = "ajouter_athletes.php?competition=' . urlencode($nom_competition) . '"</script>';

                exit();
            }
            ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="nom_competition">Nom de la compétition :</label>
                <input type="text" id="nom_competition" name="nom_competition" required><br><br>
                <button class='w3-button' type="submit">Créer la compétition</button>
            </form>
            <a class='w3-button' href="compet.php">Retour à l'accueil</a>
        </center>
<?php }
} else {
    echo "<div class='w3-center w3-padding-48 w3-xxlarge' style='background-color: rgb(32, 47, 74); color: white;'>
  <h2 class='w3-center'>Autorisation non accordée</h2>
  </div>";
}
footer();
echo "</body>";
