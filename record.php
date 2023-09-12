<link rel='stylesheet' href='style/global_tab.css'> <!-- Ajout de la référence au fichier CSS -->
<script src='script/global_tab.js'></script> <!-- Ajout de la référence au fichier JS -->

<?php
include 'fonction.php';
entete();
echo"<body style='background-color: rgb(32, 47, 74); color:white;'>";
navbar();
?>

<h1 style='color:white'><center>Les records</center></h1>
<center><div class="tab" style='background-color: rgb(32, 47, 74); font-size: 40px'>
  <button class="tablinks laserrun active" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'laserrun')">Laser Run</button>
  <button class="tablinks triathlé" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'triathlé')">Triathlé</button>
  <button class="tablinks tetrathlon" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'tetrathlon')">Tetrathlon</button>
  <button class="tablinks pentathlon" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'pentathlon')">Pentathlon</button>
</body>
</center></div>

<div id="laserrun" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white; display: block; text-align:center;'>
  <h3>Laser Run</h3>
  <table class='table'>
  <?php
        $jsonData = file_get_contents('record.json');

        $data = json_decode($jsonData, true);

        echo '<table class="table" border="1">';
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

<div id="triathlé" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white; margin: 0 auto; text-align:center;'>
  <h3>Triathlé</h3>
  <table class='table'>
  <?php
        $jsonData = file_get_contents('record.json');

        $data = json_decode($jsonData, true);

        echo '<table class="table" border="1">';
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

<div id="tetrathlon" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white; margin: 0 auto; text-align:center;'>
  <h3>Tetrathlon</h3>
  <table class='table'>
  <?php
        $jsonData = file_get_contents('record.json');

        $data = json_decode($jsonData, true);

        echo '<table class="table" border="1">';
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

<div id="pentathlon" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white; text-align:center;'>
  <h3>Pentathlon</h3>
  <table class='table'>
  <?php
        $jsonData = file_get_contents('record.json');

        $data = json_decode($jsonData, true);

        echo '<table class="table" border="1">';
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
</div>
<?php
footer();
echo "</body>";
?>