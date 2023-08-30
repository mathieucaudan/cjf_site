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
  <table>
  <?php
        $jsonData = file_get_contents('record.json');

        $data = json_decode($jsonData, true);

        echo '<table border="1">';
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
  <table>
  <?php
        $jsonData = file_get_contents('record.json');

        $data = json_decode($jsonData, true);

        echo '<table border="1">';
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
  <table>
  <?php
        $jsonData = file_get_contents('record.json');

        $data = json_decode($jsonData, true);

        echo '<table border="1">';
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
  <table>
  <?php
        $jsonData = file_get_contents('record.json');

        $data = json_decode($jsonData, true);

        echo '<table border="1">';
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
<style>
  table {
    margin: 1rem auto;
    text-align: center;
    width: 100%;
    max-width: 100%;
    border-collapse: collapse;
    border: 1px solid;
  }

  table th, table td {
    padding: 8px 0;
  }

  thead {
    background-color: rgb(32, 47, 74);
    color: white;
  }

  tbody tr:nth-child(even) {
    background-color: white;
    color: rgb(32, 47, 74);
  }

  @media only screen and (max-width: 800px) {
    table,
    thead,
    tbody,
    th,
    td,
    tr {
      display: block;
    }

    thead tr {
      position: absolute;
      top: -9999px;
      left: -9999px;
    }

    td {
      position: relative;
      padding-left: 50%;
      white-space: normal;
      text-align: left;
    }

    td:before {
      position: absolute;
      top: 6px;
      left: 6px;
      width: 45%;
      padding-right: 10px;
      font-weight: bold;
      white-space: nowrap;
      text-align: left;
      content: attr(data-title);
    }
  }

  .rectab {
    overflow: hidden;
  }

  .rectab button {
    background-color: #ccc;
    border: none;
    color: black;
    padding: 10px 20px;
    cursor: pointer;
  }

  .rectab button:hover {
    background-color: #ddd;
  }

  .rectab button.active {
    background-color: #fff;
  }

  .rectabcontent {
    display: none;
    padding: 20px;
    border: 1px solid #ccc;
  }

  /* Cacher les bordures pour les cellules vides */
  table td:empty {
    border: none;
  }
  .rectab button.active.laserrun {
  background-color: gray !important; /* Couleur de fond grise lorsque l'onglet est actif */
  color: white !important; /* Texte blanc lorsque l'onglet est actif */
  cursor: default !important; /* Désactive le curseur lorsque l'onglet est actif */
}
.rectab button.active.triathlé {
  background-color: gray !important; /* Couleur de fond grise lorsque l'onglet est actif */
  color: white !important; /* Texte blanc lorsque l'onglet est actif */
  cursor: default !important; /* Désactive le curseur lorsque l'onglet est actif */
}
.rectab button.active.tetrathlon {
  background-color: gray !important; /* Couleur de fond grise lorsque l'onglet est actif */
  color: white !important; /* Texte blanc lorsque l'onglet est actif */
  cursor: default !important; /* Désactive le curseur lorsque l'onglet est actif */
}
.rectab button.active.pentathlon {
  background-color: gray !important; /* Couleur de fond grise lorsque l'onglet est actif */
  color: white !important; /* Texte blanc lorsque l'onglet est actif */
  cursor: default !important; /* Désactive le curseur lorsque l'onglet est actif */
}
</style>

<script>
  function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("rectabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    // Supprime la classe "active" de tous les boutons d'onglet
    tablinks = document.getElementsByClassName("rectablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    // Ajoute la classe "active" à l'onglet actuel
    evt.currentTarget.className += " active";
    document.getElementById(tabName).style.display = "block";
    
    // Ajoute la classe "active" spécifique au bouton "Bureau" s'il s'agit de l'onglet "Bureau"
    if (tabName === 'laserrun') {
        document.querySelector(".rectablinks.laserrun").classList.add("active");
    }
  }

</script>
