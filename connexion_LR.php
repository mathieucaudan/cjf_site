<link rel='stylesheet' href='style/parametres.css'> <!-- Ajout de la référence au fichier CSS -->
<script src='script/parametres.js'></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Ajout de la référence au fichier JS -->

<body style='background-color: rgb(32, 47, 74);'>
    <?php
    include 'fonction.php';
    entete();
    navbar();
    echo "<body style='background-color: rgb(32, 47, 74);'>";
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
        // Lire le contenu du fichier compteur.json
        $json_data = file_get_contents('compteur.json');

        // Convertir le contenu JSON en tableau associatif
        $data = json_decode($json_data, true);

        $semaines = array_keys($data);
        $connexions = array_values($data);
    } else {
        echo "<div class='w3-center w3-padding-48 w3-xxlarge' style='background-color: rgb(32, 47, 74); color: white;'>
      <h2 class='w3-center'>Autorisation non accordée</h2>
      </div>";
    }
    ?>
    <center>
        <canvas id="myChart" style="width: 80%; height: 60%;"></canvas>
        <script>
            // Récupérer les données PHP
            var semaines = <?php echo json_encode($semaines); ?>;
            var connexions = <?php echo json_encode($connexions); ?>;

            // Configurer et afficher le graphique
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: semaines,
                    datasets: [{
                        label: 'Nombre de connexions par semaine',
                        data: connexions,
                        borderColor: 'blue',
                        fill: false
                    }]
                },
                options: {
                    responsive: false, // Désactiver la réponse dynamique
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            type: 'category',
                            labels: semaines
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </center>
    <?php
    footer();
    echo "</body>";
    ?>