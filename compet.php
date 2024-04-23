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
            <h1>Gestion des Compétitions</h1>
            <h2>Choisissez une action :</h2>
            <button class='w3-button' onclick="ouvrirCompetition()">
                Ouvrir une compétition existante
            </button>
            <button class='w3-button' onclick="creerCompetition()">Créer une nouvelle compétition</button>
            <button class='w3-button' onclick="supprimerCompetition()">
                Supprimer une compétition existante
            </button>
        </center>

        <script>
            function ouvrirCompetition() {
                // Redirection vers la page pour ouvrir une compétition existante
                window.location.href = "ouvrir_competition.php";
            }

            function creerCompetition() {
                // Redirection vers la page pour créer une nouvelle compétition avec le nom spécifié
                window.location.href = "creer_competition.php";
            }

            function supprimerCompetition() {
                // Redirection vers la page pour supprimer une compétition existante
                window.location.href = "supprimer_competition.php";
            }
        </script>
<?php
    }
} else {
    echo "<div class='w3-center w3-padding-48 w3-xxlarge' style='background-color: rgb(32, 47, 74); color: white;'>
  <h2 class='w3-center'>Autorisation non accordée</h2>
  </div>";
}
footer();
echo "</body>";
