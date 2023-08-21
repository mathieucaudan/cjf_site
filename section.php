<?php
include 'fonction.php';
entete();
navbar();
?>

<body style='background-color: rgb(32, 47, 74); color:white;'>
    <center><h1>SECTION SPORTIVE COLLEGE LE BOCAGE</h1></center>
    <div class="container">
        <div class="pdf-column">
            <center><h2>Présentation de la section</h2></center>
            <embed src="./section/articles/flyer.pdf" type="application/pdf" width="100%" height="100%" style="min-height: 500px;" />
        </div>
        <div class="articles-column">
            <?php
            // Lire le fichier JSON
            $articles = json_decode(file_get_contents('./section/articles.json'), true);

            // Affiche chaque article avec son titre et le lien vers le PDF
            foreach ($articles as $article) {
                $titre = $article['titre'];
                $pdf = $article['pdf'];
                echo "<center><h2>$titre</h2></center>";
                echo "<div class='article'>";
                echo "<embed src='$pdf' type='application/pdf' width='100%' height='100%' style='min-height: 200px;' />";
                echo "</div>";
            }
            ?>
        </div>
    </div>
<?php
footer();
echo "</body>";
?>
<style>
        /* Styles pour diviser la page en deux colonnes */
        .container {
            display: flex;
            flex-wrap: wrap; /* Permet à la disposition de passer en une seule colonne sur les petits écrans */
        }

        /* Style pour la colonne du PDF principal */
        .pdf-column {
            flex: 1;
            min-width: 300px; /* Largeur minimale de la colonne du PDF principal */
        }

        /* Style pour la colonne des articles */
        .articles-column {
            flex: 1;
            min-width: 300px; /* Largeur minimale de la colonne des articles */
        }

        /* Style pour les articles PDF */
        .article {
            margin: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }

        /* Media query pour ajuster le style en fonction de la résolution de l'écran */
        @media screen and (max-width: 768px) {
            .container {
                flex-direction: column; /* Passe à une seule colonne sur les petits écrans */
            }
            .pdf-column, .articles-column {
                min-width: 100%; /* Largeur minimale de 100% sur les petits écrans */
            }
        }
    </style>
