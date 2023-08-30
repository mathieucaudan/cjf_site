<?php
include 'fonction.php';
entete();
echo "<body style='background-color: rgb(32, 47, 74);'>";
navbar();
?>

<h1 id="calendar-title" class="centered">Calendrier</h1>
<div class="calendar-navigation">
    <button class="buttonMois" onclick="previousMonth()">
       Mois précédent
      <span class="first"></span>
      <span class="second"></span>
      <span class="third"></span>
      <span class="fourth"></span>
    </button>

    <button class="buttonMois" onclick="nextMonth()">
       Mois suivant
      <span class="first"></span>
      <span class="second"></span>
      <span class="third"></span>
      <span class="fourth"></span>
    </button>
    
</div>
<div class="calendar-container">
<table>
    <tr>
        <th>Lundi</th>
        <th>Mardi</th>
        <th>Mercredi</th>
        <th>Jeudi</th>
        <th>Vendredi</th>
        <th>Samedi</th>
        <th>Dimanche</th>
    </tr>
    <?php
    // Obtenez la date actuelle en PHP
    $currentDate = new DateTime();
    $currentYear = $currentDate->format('Y');
    $currentMonth = $currentDate->format('n');

    // Obtenez le premier jour du mois actuel
    $firstDayOfMonth = new DateTime("{$currentDate->format('Y-m')}-01");

    // Obtenez le nombre de jours dans le mois actuel
    $daysInMonth = $firstDayOfMonth->format('t');

    // Obtenez le jour de la semaine du premier jour du mois (1 pour lundi, 7 pour dimanche)
    $firstDayOfWeek = (int)$firstDayOfMonth->format('N');

    // Commencez à compter les jours
    $day = 1 - $firstDayOfWeek;

    // Lisez le fichier JSON
    $jsonData = file_get_contents('calendrier.json');
    $calendarData = json_decode($jsonData, true);

        // Déterminez le nombre de lignes nécessaires
    $numRows = ceil(($daysInMonth + $firstDayOfWeek - 1) / 7);
    // Boucle pour générer les cases du calendrier
    for ($i = 0; $i < $numRows; $i++) {
        echo "<tr>";
        for ($j = 0; $j < 7; $j++) {
            if ($day <= 0 || $day > $daysInMonth) {
                // Jours du mois précédent ou suivant
                echo "<td></td>";
            } else {
                // Jours du mois actuel avec informations sous le numéro de jour
                $yearMonthKey = $currentYear . '-' . str_pad($currentMonth + 1, 2, '0', STR_PAD_LEFT); // Notez l'ajout de 1 ici
                $dayInfo = isset($calendarData[$yearMonthKey][$day]) ? $calendarData[$yearMonthKey][$day] : '';
                echo "<td class='calendar-cell'>$day<div class='info-cell'>$dayInfo</div></td>";
            }
            $day++;
        }
        echo "</tr>";
    }
    
    ?>
</table>
</div>
<script>
    var currentDate = new Date();
    var calendarData = <?php echo json_encode($calendarData); ?>;

    // Fonction pour passer au mois précédent
    function previousMonth() {
        currentDate.setMonth(currentDate.getMonth() - 1);
        updateCalendar();
    }

    // Fonction pour passer au mois suivant
    function nextMonth() {
        currentDate.setMonth(currentDate.getMonth() + 1);
        updateCalendar();
    }

    function updateCalendar() {
        var calendarTitle = document.getElementById("calendar-title");
        var monthNames = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
        calendarTitle.innerText = monthNames[currentDate.getMonth()] + " " + currentDate.getFullYear();

        var table = document.querySelector("table");
        table.innerHTML = "<tr><th>Lundi</th><th>Mardi</th><th>Mercredi</th><th>Jeudi</th><th>Vendredi</th><th>Samedi</th><th>Dimanche</th></tr>";

        var year = currentDate.getFullYear();
        var month = currentDate.getMonth();

        var firstDayOfMonth = new Date(year, month, 1);
        var lastDayOfMonth = new Date(year, month + 1, 0);
        var firstDayOfWeek = (firstDayOfMonth.getDay() + 6) % 7;

        var numRows = Math.ceil((lastDayOfMonth.getDate() + firstDayOfWeek) / 7);

        var day = 1 - firstDayOfWeek;

        for (var i = 0; i < numRows; i++) {
            var row = table.insertRow();
            for (var j = 0; j < 7; j++) {
                var cell = row.insertCell();
                cell.classList.add("bigger-cell"); // Ajoutez la classe pour agrandir les cellules

            if (day <= 0 || day > lastDayOfMonth.getDate()) {
                // Jours du mois précédent ou suivant
                cell.innerHTML = "";
            } else {
                // Jours du mois actuel avec informations sous le numéro de jour
                var yearMonthKey = year + '-' + (month + 1).toString().padStart(2, '0');
                var dayInfo = calendarData[yearMonthKey] && calendarData[yearMonthKey][day] ? calendarData[yearMonthKey][day] : '';
                cell.innerHTML = day + "<div class='info-cell'>" + dayInfo + "</div>";
            }
            day++;
        }
    }

    }

    // Appelez la fonction de mise à jour du calendrier au chargement de la page
    window.onload = function () {
        updateCalendar();
    };
</script>

<style>

    .calendar-container {
        width: 100%;
        margin: 0 auto; /* Centrez le calendrier horizontalement */
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border: 2px solid white; /* Bordures blanches et épaisses */
        width: 14.2857%; /* 100% / 7 = 14.2857% */
        height: 5vh;
        text-align: center;
        font-size: 1.5vw;
        cursor: pointer;
        color: white; /* Texte blanc */
    }
    /* Style pour la div enveloppant le calendrier */
.calendar-container {
    width: 100%;
    margin: 0 auto; /* Facultatif : centrez le calendrier horizontalement */
    padding: 0 20px;
}


    /* Style pour les cellules du calendrier */
    .calendar-cell {
        position: relative;
    }

    /* Style pour les informations sous les cellules */
    .info-cell {
        font-size: 1.5vw; /* Ajustez la taille de la police des informations */
        color: white
        padding-top: 5px;
    }

    /* Style pour les boutons de navigation */
    .calendar-navigation {
        margin-bottom: 10px;
        text-align: center;
    }

    .calendar-navigation button {
        font-size: 16px; /* Ajustez la taille de la police des boutons */
        padding: 5px 10px;
        margin: 0 10px; /* Ajustez la marge entre les boutons */
        cursor: pointer;
    }

    /* Style pour centrer le titre du mois et de l'année */
.centered {
    text-align: center;
    color: white;
    font-size: 3vw !important;
    margin-bottom: 20px; /* Espacement sous le titre */
}

.buttonMois {
        border: none;
        padding: 20px 40px;
        font-size: 1.5vw !important;
        position: relative;
        background: transparent;
        color: white;
        text-transform: uppercase;
        border: 3px solid white;
        cursor: pointer;
        transition: all 0.7s;
        overflow: hidden;
        border-radius: 100px;
      }

      .buttonMois:hover {
        color: #000;
      }
      span {
        transition: all 0.7s;
        z-index: -1;
      }

      .buttonMois .first {
        content: "";
        position: absolute;
        right: 100%;
        top: 0;
        width: 25%;
        height: 100%;
        background: white;
      }

      .buttonMois:hover .first {
        top: 0;
        right: 0;
      }
      .buttonMois .second {
        content: "";
        position: absolute;
        left: 25%;
        top: -100%;
        height: 100%;
        width: 25%;
        background: white;
      }

      .buttonMois:hover .second {
        top: 0;
        left: 50%;
      }

      .buttonMois .third {
        content: "";
        position: absolute;
        left: 50%;
        height: 100%;
        top: 100%;
        width: 25%;
        background: white;
      }

      .buttonMois:hover .third {
        top: 0;
        left: 25%;
      }

      .buttonMois .fourth {
        content: "";
        position: absolute;
        left: 100%;
        top: 0;
        height: 100%;
        width: 25%;
        background: white;
      }

      .buttonMois:hover .fourth {
        top: 0;
        left: 0;
      }
      

</style>


<?php
footer();
echo "</body>";
?>
