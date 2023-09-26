<link rel='stylesheet' href='style/section.css'> <!-- Ajout de la référence au fichier CSS -->
<link rel='stylesheet' href='style/global_tab.css'> <!-- Ajout de la référence au fichier CSS -->
<script src='script/global_tab.js'></script> <!-- Ajout de la référence au fichier JS -->

<?php
include 'fonction.php';
entete();
echo "<body style='background-color: rgb(32, 47, 74); color:white;'>";
navbar();
?>

<center>
    <h1>Section sportive college le bocage</h1>
</center>
<center>
    <div class="tab" style='background-color: rgb(32, 47, 74); font-size: 40px'>
        <button class="tablinks presentation active" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'presentation')">Présentation</button>
        <button class="tablinks article" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'article')">article</button>

    </div>
</center>

<div id="presentation" class="tabcontent" style='display: block;'>
    <center>
        <h2>Présentation de la section</h2>
    </center>
    <div style='margin-left: 3%; margin-right: 3%; display: flex; justify-content: space-between; align-items: center;'>
        <div class="image-container">
            <img class='responsive-image' src="./section/section_image/LR.png">
            <img class='responsive-image' src="./section/section_image/PO.png">
            <img class='responsive-image' src="./section/section_image/nat.png">
            <img class='responsive-image' src="./section/section_image/escrime.png">
        </div>
    </div>


    <div class='text centered-text'>
        <img src="./section/section_image/label.png" width='280px' height='auto'>
        <h1><strong>SECTION SPORTIVE</strong></h1><br>
        <h1><strong>PENTATHLON MODERNE</strong></h1>
    </div>
    <div class='text centered-text' style='line-height: 20px;'>
        <p>
        <h2>COLLEGE LE BOCAGE</h2>
        </p><br>
        <p>
        <h3>SECTION UNIQUE EN FRANCE</h3>
        </p><br>
        <p>
        <h3>5 SPORTS PRATIQUES</h3>
        </p><br>
        <p>2 séances d'entraînement par semaine intégrées à l'emploi du temps</p><br>
        <p>
        <h3>COMPETITIONS SCOLAIRES ET FEDERALES</h3>
        </p><br>

        <p>
        <h2><strong>La journ&eacute;e de d&eacute;couverte du Laser Run t&apos;a plu ?</strong></h2>
        </p>
        <br></br>
        <p><strong>REJOINDRE LA SEULE SECTION SPORTIVE&nbsp;</strong></p>
        <p><strong>DE PENTATHLON MODERNE DE FRANCE, C&apos;EST POSSIBLE !!!</strong></p>
        <p><br></p>
        <p>AU SEIN DU COLL&Egrave;GE LE BOCAGE DE DINARD</p>
        <p>2 cr&eacute;neaux d&apos;entrainement int&eacute;gr&eacute;s &agrave; l&apos;emploi du temps en plus de l&apos;EPS pour</p>
        <p>d&eacute;couvrir et se perfectionner dans 4 activit&eacute;s sportives</p>
        <br>
        </br>
        <p>
            Lundi 11h30/13h15 et
            Jeudi 11h30/13h15</p>
        <p>- Laser Run (Biathlon avec Course + Tir au pistolet laser)</p>
        <p>- Escrime</p>
        <p>- Natation</p>
        <p>- Parcours d&rsquo;obstacle</p>
        <br>
        </br>
        <p>Une r&eacute;union d&rsquo;information aura lieu <strong>le jeudi 08 juin &agrave; partir de 18h</strong> au coll&egrave;ge</p>
        <p>pour pr&eacute;senter la section sportive aux parents des &eacute;l&egrave;ves int&eacute;ress&eacute;s</p>
        <br></br>
        <p>Pour &ecirc;tre candidat &agrave; la rentr&eacute;e 2023 :</p>
        <p>- Remplir le dossier d&rsquo;inscription pour le vendredi 16 juin et participer &agrave;</p>
        <p>l&apos;apr&egrave;s-midi de d&eacute;tection du <strong>mercredi 21 juin 2023</strong> et/ou &agrave; la matin&eacute;e de</p>
        <p>d&eacute;couverte de l&rsquo;activit&eacute; le <strong>dimanche 4 juin &agrave; Aquamalo</strong> (Saint-Malo) en acc&egrave;s</p>
        <p>libre de 9h30 &agrave; 12h lors du Swimcross.</p>

        <br></br>
        <p> SAVOIR NAGER !</p>
        <p>30 places disponibles en 6&eacute;mes =&gt;15 gar&ccedil;ons et 15 filles</p>
        <p>Les candidats retenus sur la liste principale devront compl&eacute;ter leur dossier pour le</p>
        <p>2 juillet (certificat m&eacute;dical - cotisation - fiche de renseignements - charte</p>
        <p>d&rsquo;engagement)</p>
        <p>Une liste compl&eacute;mentaire sera communiqu&eacute;e</p>
        <p></p>
    </div>
</div>
</div>
</div>
<div id="article" class="tabcontent">
    <?php
    // Lire le fichier JSON
    $articles = array_reverse(json_decode(file_get_contents('./section/articles.json'), true));

    // Affiche chaque article avec son titre et le lien vers le PDF
    foreach ($articles as $article) {
        $titre = $article['titre'];
        $pdf = $article['pdf'];
        echo "<center><h2>$titre</h2></center>";
        echo "<div class='secarticle'>";
        echo "<object data='./section/articles/$pdf' type='application/pdf' width='100%' height='100%'></object>";
        echo "</div>";
    }
    ?>
</div>
<div id="avenir" class="tabcontent" style="text-align:center;">
    <table style="width:100%;max-width:800px;margin:auto;">
        <tr>
            <th></th>
            <th>Lundi</th>
            <th>Mardi</th>
            <th>Mercredi</th>
            <th>Jeudi</th>
            <th>Vendredi</th>
            <th>Samedi</th>
            <th>Dimanche</th>
        </tr>
        <tr>
            <td>6h30-7h30</td>
            <td>NATATION TCE
                (Aquamalo)</td>
            <td></td>
            <td>NATATION TCE
                (Aquamalo)</td>
            <td></td>
            <td>NATATION TCE
                (Aquamalo)</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>7h30-8h00</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>NATATION TCE
                (Aquamalo)</td>
            <td></td>
        </tr>
        <tr>
            <td>8h00-8h30</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>NATATION TCE
                (Aquamalo)</td>
            <td></td>
        </tr>
        <tr>
            <td>8h30-9h00</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>NATATION TCE
                (Aquamalo)</td>
            <td></td>
        </tr>
        <tr>
            <td>9h00-9h30</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>NATATION TCE
                (Aquamalo)</td>
            <td></td>
        </tr>
        <tr>
            <td>9h30-10h00</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>10h00-10h30</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>10h30-11h00</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>11h00-11h30</td>
            <td></td>
            <td></td>
            <td></td>
            <td>Laser Run (Biathlon avec Course + Tir au pistolet laser)<br>11h30/13h15</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>11h30-12h00</td>
            <td></td>
            <td></td>
            <td></td>
            <td>Laser Run (Biathlon avec Course + Tir au pistolet laser)<br>11h30/13h15</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>12h00-12h30</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>12h30-13h00</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>13h00-13h30</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>13h30-14h00</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>14h00-14h30</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>

</div>
<?php
footer();
echo "</body>";
?>