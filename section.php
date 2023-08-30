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
            <div style='margin-left:3%; margin-right:3%'>
                <img  style='margin-right:4%' src="./section/section_image/LR.png" width=30% height='280px'>
                <img src="./section/section_image/PO.png" width=60% height='280px'>
            </div></br>
            <div style='margin-left:3%; margin-right:3%'>
                <img style='margin-right:4%' src="./section/section_image/nat.png" width=60% height='280px'>
                <img src="./section/section_image/escrime.png" width=30% height='280px'>
            </div></br>
            <div style='display:flex' >
                <img src="./section/section_image/label.png"  width='280px' height='280px'>
                <div class='text; w3-center'>
                    <h2><strong>SECTION SPORTIVE</strong></h2></br>
                    <h2><strong>PENTATHLON MODERNE</strong></h2>
                </div>
            </div>
            <div style='margin-left:3%'  style='display:flex'>
                <img src="./section/section_image/course.png">
            </div></br>
            <p style="text-align: center;">La journ&eacute;e de d&eacute;couverte du Laser Run t&apos;a plu ?</p>
            <p style="text-align: center;"><strong>REJOINDRE LA SEULE SECTION SPORTIVE&nbsp;</strong></p>
            <p style="text-align: center;"><strong>DE PENTATHLON MODERNE DE FRANCE, C&apos;EST POSSIBLE !!!</strong></p>
            <p><br></p>
            <p style="text-align: center;">AU SEIN DU COLL&Egrave;GE LE BOCAGE DE DINARD</p>
            <p style="text-align: center;">2 cr&eacute;neaux d&apos;entrainement int&eacute;gr&eacute;s &agrave; l&apos;emploi ou temps en plus de l&apos;EPS pour</p>
            <p style="text-align: center;">d&eacute;couvrir et se perfectionner dans 4 activit&eacute;s sportives : lundi 11h30/13h15 et</p>
            <p style="text-align: center;">Jeudi 11h30/13h15</p>
            <p>- Laser Run (Biathlon avec Course + Tir au pistolet laser)</p>
            <p>- Escrime</p>
            <p>- Natation</p>
            <p>- Parcours d&rsquo;obstacle</p>
            <p style="text-align: center;">Une r&eacute;union d&rsquo;information aura lieu <strong>le jeudi 08 juin &agrave; partir de 18h</strong> au coll&egrave;ge</p>
            <p style="text-align: center;">pour pr&eacute;senter la section sportive aux parents des &eacute;l&egrave;ves int&eacute;ress&eacute;s</p>
            <p style="text-align: center;">Pour &ecirc;tre candidat &agrave; la rentr&eacute;e 2023 :</p>
            <p>- Remplir le dossier d&rsquo;inscription pour le vendredi 16 juin et participer &agrave;</p>
            <p>l&apos;apr&egrave;s-midi de d&eacute;tection du <strong>mercredi 21 juin 2023</strong> et/ou &agrave; la matin&eacute;e de</p>
            <p>d&eacute;couverte de l&rsquo;activit&eacute; le <strong>dimanche 4 juin &agrave; Aquamalo</strong> (Saint-Malo) en acc&egrave;s</p>
            <p>libre de 9h30 &agrave; 12h lors du Swimcross</p>
            <p>- SAVOIR NAGER</p>
            <p style="text-align: center;">30 places disponibles en 6&eacute;mes =&gt;15 gar&ccedil;ons et 15 filles</p>
            <p style="text-align: center;">Les candidats retenus sur la liste principale devront compl&eacute;ter leur dossier pour le</p>
            <p style="text-align: center;">2 juillet (certificat m&eacute;dical - cotisation - fiche de renseignements - charte</p>
            <p style="text-align: center;">d&rsquo;engagement)</p>
            <p style="text-align: center;">Une liste compl&eacute;mentaire sera communiqu&eacute;e</p>
            <p><br></p>
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
                echo "<object data='./section/articles/$pdf' type='application/pdf' width='100%' height='100%'></object>";
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
