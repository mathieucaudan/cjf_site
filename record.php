<?php
include 'fonction.php';
entete();
echo "<body>";
navbar();
?>

<div class="tab" style='background-color: rgb(32, 47, 74);'><center>
<h1 style='color: white;'>Record</h1>
  <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'table1')">Laser Run</button>
  <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'table2')">Triathlé</button>
  <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'table3')">Tetrathlon</button>
  <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'table4')">Pentathlon</button>
</center></div>

<center><div id="table1" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white'>
  <h3>Laser Run</h3>
  <table>
  <?php
        $jsonData = file_get_contents('record.json');

        $data = json_decode($jsonData, true);

        echo '<table border="1">';
        echo '<tr><th>Catégorie</th><th>Nom</th><th>Prénom</th><th>Date</th><th>Temps</th><th>Lieu</th></tr>';

        foreach ($data['Laser Run'] as $participant) {
            echo '<tr>';
            echo '<td style="text-align: center;">' . $participant['categorie'] . '</td>';
            echo '<td style="text-align: center;">' . $participant['nom'] . '</td>';
            echo '<td style="text-align: center;">' . $participant['prenom'] . '</td>';
            echo '<td style="text-align: center;">' . $participant['date'] . '</td>';
            echo '<td style="text-align: center;">' . $participant['temps'] . '</td>';
            echo '<td style="text-align: center;">' . $participant['lieux'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    ?>
  </table>
</div>

<div id="table2" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white'>
  <h3>Triathlé</h3>
  <table>
  <?php
        $jsonData = file_get_contents('record.json');

        $data = json_decode($jsonData, true);

        echo '<table border="1">';
        echo '<tr><th>Catégorie</th><th>Nom</th><th>Prénom</th><th>Date</th><th>Points</th><th>Lieu</th></tr>';

        foreach ($data['Triathlé'] as $participant) {
            echo '<tr>';
            echo '<td style="text-align: center;">' . $participant['categorie'] . '</td>';
            echo '<td style="text-align: center;">' . $participant['nom'] . '</td>';
            echo '<td style="text-align: center;">' . $participant['prenom'] . '</td>';
            echo '<td style="text-align: center;">' . $participant['date'] . '</td>';
            echo '<td style="text-align: center;">' . $participant['points'] . '</td>';
            echo '<td style="text-align: center;">' . $participant['lieux'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    ?>
  </table>
</div>

<div id="table3" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white; margin: 0 auto;'>
  <h3>Tetrathlon</h3>
  <table>
  <?php
        $jsonData = file_get_contents('record.json');

        $data = json_decode($jsonData, true);

        echo '<table border="1">';
        echo '<tr><th>Catégorie</th><th>Nom</th><th>Prénom</th><th>Date</th><th>Points</th><th>Lieu</th></tr>';

        foreach ($data['Tetrathlon'] as $participant) {
            echo '<tr>';
            echo '<td style="text-align: center;">' . $participant['categorie'] . '</td>';
            echo '<td style="text-align: center;">' . $participant['nom'] . '</td>';
            echo '<td style="text-align: center;">' . $participant['prenom'] . '</td>';
            echo '<td style="text-align: center;">' . $participant['date'] . '</td>';
            echo '<td style="text-align: center;">' . $participant['points'] . '</td>';
            echo '<td style="text-align: center;">' . $participant['lieux'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    ?>
  </table>
</div>

<div id="table4" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white'>
  <h3>Pentathlon</h3>
  <table>
  <?php
        $jsonData = file_get_contents('record.json');

        $data = json_decode($jsonData, true);

        echo '<table border="1">';
        echo '<tr><th>Catégorie</th><th>Nom</th><th>Prénom</th><th>Date</th><th>Points</th><th>Lieu</th></tr>';

        foreach ($data['Pentathlon'] as $participant) {
            echo '<tr>';
            echo '<td style="text-align: center;">' . $participant['categorie'] . '</td>';
            echo '<td style="text-align: center;">' . $participant['nom'] . '</td>';
            echo '<td style="text-align: center;">' . $participant['prenom'] . '</td>';
            echo '<td style="text-align: center;">' . $participant['date'] . '</td>';
            echo '<td style="text-align: center;">' . $participant['points'] . '</td>';
            echo '<td style="text-align: center;">' . $participant['lieux'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    ?>
  </table>
</div></center>
<style>
    .tab {
  overflow: hidden;
}

.tab button {
  background-color: #ccc;
  border: none;
  color: black;
  padding: 10px 20px;
  cursor: pointer;
}

.tab button:hover {
  background-color: #ddd;
}

.tab button.active {
  background-color: #fff;
}

.tabcontent {
  display: none;
  padding: 20px;
  border: 1px solid #ccc;
}
</style>
<script>
    function openTab(evt, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
<?php
footer();
echo "</body>";
?>