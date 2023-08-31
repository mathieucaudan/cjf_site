<link rel='stylesheet' href='style/record.css'> <!-- Ajout de la référence au fichier CSS -->
<script src='script/record.js'></script> <!-- Ajout de la référence au fichier JS -->

<?php
include 'fonction.php';
entete();
echo "<body>";
navbar();
?>

<body style='background-color: rgb(32, 47, 74); color:white; ' onload="openTab(event, 'laserrun')">
<h1 style='color:white'><center>RECORD</center></h1>
<center><div class="rectab" style='background-color: rgb(32, 47, 74); font-size: 40px'>
  <button class="rectablinks laserrun active" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'laserrun')">Laser Run</button>
  <button class="rectablinks triathlé" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'triathlé')">Triathlé</button>
  <button class="rectablinks tetrathlon" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'tetrathlon')">Tetrathlon</button>
  <button class="rectablinks pentathlon" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'pentathlon')">Pentathlon</button>
</body>
</center></div>

<center><div id="laserrun" class="rectabcontent" style='background-color: rgb(32, 47, 74); color: white'>
  <h3>Laser Run</h3>
  <table class='rectable'>
  <?php
        $jsonData = file_get_contents('record.json');

        $data = json_decode($jsonData, true);

        echo '<table class="rectable" border="1">';
        echo '<thead><tr><th>Catégorie</th><th>Nom</th><th>Prénom</th><th>Date</th><th>Temps</th><th>Lieu</th></tr></thead><tbody>';

        foreach ($data['Laser Run'] as $participant) {
          echo '<tr>';
          echo '<td style="text-align: center;" data-title="Catégorie">' . $participant['categorie'] . '</td>';
          echo '<td style="text-align: center;" data-title="Nom">' . $participant['nom'] . '</td>';
          echo '<td style="text-align: center;" data-title="Prénom">' . $participant['prenom'] . '</td>';
          echo '<td style="text-align: center;" data-title="Date">' . $participant['date'] . '</td>';
          echo '<td style="text-align: center;" data-title="Temps">' . $participant['temps'] . '</td>';
          echo '<td style="text-align: center;" data-title="Lieu">' . $participant['lieux'] . '</td>';
          echo '</tr>';
        }
        echo '</tbody></table>';
    ?>
  </table>
</div>

<div id="triathlé" class="rectabcontent" style='background-color: rgb(32, 47, 74); color: white'>
  <h3>Triathlé</h3>
  <table class='rectable'>
  <?php
        $jsonData = file_get_contents('record.json');

        $data = json_decode($jsonData, true);

        echo '<table class="rectable" border="1">';
        echo '<thead><tr><th>Catégorie</th><th>Nom</th><th>Prénom</th><th>Date</th><th>Points</th><th>Lieu</th></tr></thead><tbody>';

        foreach ($data['Triathlé'] as $participant) {
          echo '<tr>';
          echo '<td style="text-align: center;" data-title="Catégorie">' . $participant['categorie'] . '</td>';
          echo '<td style="text-align: center;" data-title="Nom">' . $participant['nom'] . '</td>';
          echo '<td style="text-align: center;" data-title="Prénom">' . $participant['prenom'] . '</td>';
          echo '<td style="text-align: center;" data-title="Date">' . $participant['date'] . '</td>';
          echo '<td style="text-align: center;" data-title="Points">' . $participant['points'] . '</td>';
          echo '<td style="text-align: center;" data-title="Lieu">' . $participant['lieux'] . '</td>';
          echo '</tr>';
        }

        echo '</tbody></table>';
    ?>
  </table>
</div>

<div id="tetrathlon" class="rectabcontent" style='background-color: rgb(32, 47, 74); color: white; margin: 0 auto;'>
  <h3>Tetrathlon</h3>
  <table class='rectable'>
  <?php
        $jsonData = file_get_contents('record.json');

        $data = json_decode($jsonData, true);

        echo '<table class="rectable" border="1">';
        echo '<thead><tr><th>Catégorie</th><th>Nom</th><th>Prénom</th><th>Date</th><th>Points</th><th>Lieu</th></tr></thead><tbody>';

        foreach ($data['Tetrathlon'] as $participant) {
          echo '<tr>';
          echo '<td style="text-align: center;" data-title="Catégorie">' . $participant['categorie'] . '</td>';
          echo '<td style="text-align: center;" data-title="Nom">' . $participant['nom'] . '</td>';
          echo '<td style="text-align: center;" data-title="Prénom">' . $participant['prenom'] . '</td>';
          echo '<td style="text-align: center;" data-title="Date">' . $participant['date'] . '</td>';
          echo '<td style="text-align: center;" data-title="Points">' . $participant['points'] . '</td>';
          echo '<td style="text-align: center;" data-title="Lieu">' . $participant['lieux'] . '</td>';
          echo '</tr>';
        }

        echo '</tbody></table>';
    ?>
  </table>
</div>

<div id="pentathlon" class="rectabcontent" style='background-color: rgb(32, 47, 74); color: white'>
  <h3>Pentathlon</h3>
  <table class='rectable'>
  <?php
        $jsonData = file_get_contents('record.json');

        $data = json_decode($jsonData, true);

        echo '<table class="rectable" border="1">';
        echo '<thead><tr><th>Catégorie</th><th>Nom</th><th>Prénom</th><th>Date</th><th>Points</th><th>Lieu</th></tr></thead><tbody>';

        foreach ($data['Pentathlon'] as $participant) {
            echo '<tr>';
            echo '<td style="text-align: center;" data-title="Catégorie">' . $participant['categorie'] . '</td>';
            echo '<td style="text-align: center;" data-title="Nom">' . $participant['nom'] . '</td>';
            echo '<td style="text-align: center;" data-title="Prénom">' . $participant['prenom'] . '</td>';
            echo '<td style="text-align: center;" data-title="Date">' . $participant['date'] . '</td>';
            echo '<td style="text-align: center;" data-title="Points">' . $participant['points'] . '</td>';
            echo '<td style="text-align: center;" data-title="Lieu">' . $participant['lieux'] . '</td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    ?>
  </table>
</div></center>
<?php
footer();
echo "</body>";
?>

