<?php
include 'fonction.php';
entete();
echo "<body style='background-color: rgb(32, 47, 74);'>";
navbar();
?>

<h1 id="calendar-title">Calendrier</h1>
<div class="calendar-navigation">
    <button onclick="previousMonth()">&#8249; Mois précédent</button>
    <button onclick="nextMonth()">Mois suivant &#8250;</button>
</div>
<div class="calendar-container">
<table>
    <tr>
        <th>Lun</th>
        <th>Mar</th>
        <th>Mer</th>
        <th>Jeu</th>
        <th>Ven</th>
        <th>Sam</th>
        <th>Dim</th>
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
        table.innerHTML = "<tr><th>Lun</th><th>Mar</th><th>Mer</th><th>Jeu</th><th>Ven</th><th>Sam</th><th>Dim</th></tr>";

        var year = currentDate.getFullYear();
        var month = currentDate.getMonth();

        var firstDayOfMonth = new Date(year, month, 1);
        var lastDayOfMonth = new Date(year, month + 1, 0);
        var firstDayOfWeek = firstDayOfMonth.getDay(); // 0 pour Dimanche, 1 pour Lundi, etc.

        var numRows = Math.ceil((lastDayOfMonth.getDate() + firstDayOfWeek) / 7);

        var day = 1 - firstDayOfWeek;

        for (var i = 0; i < numRows; i++) {
            var row = table.insertRow();
            for (var j = 0; j < 7; j++) {
                var cell = row.insertCell();
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
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(32, 47, 74);
            margin: 0;
            padding: 0;
        }

        /* Style pour le calendrier */
        .calendar-container {
            max-width: 800px;
            margin: 0 auto; /* Centrez le calendrier horizontalement */
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        /* Style pour les boutons de navigation */
        .calendar-navigation {
            margin-bottom: 10px;
            text-align: center;
        }

        .calendar-navigation button {
            font-size: 16px;
            padding: 5px 10px;
            margin: 0 10px;
            cursor: pointer;
        }

        /* Style pour les informations sous les cellules */
        .info-cell {
            font-size: 14px;
            color: #666;
            padding-top: 5px;
        }

        /* Style pour la réactivité */
        @media (max-width: 768px) {
            .calendar-container {
                max-width: 100%;
                border-radius: 0;
            }
        }
    </style>

<?php
footer();
echo "</body>";
?>
