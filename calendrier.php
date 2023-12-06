<link rel='stylesheet' href='style/calendrier.css'> <!-- Ajout de la référence au fichier CSS -->
<script src='script/calendrier.js'></script> <!-- Ajout de la référence au fichier JS -->
<?php
include 'fonction.php';
entete();
echo "<body style='background-color: rgb(32, 47, 74); color:white;'>";
navbar();
?>

<h1 id="calcalendar-title" class="calcentered">Calendrier</h1>
<div class="calcalendar-navigation">
    <button class="calbuttonMois" onclick="previousMonth()">
        Mois précédent
        <span class="calfirst"></span>
        <span class="calsecond"></span>
        <span class="calthird"></span>
        <span class="calfourth"></span>
    </button>

    <button class="calbuttonMois" onclick="nextMonth()">
        Mois suivant
        <span class="calfirst"></span>
        <span class="calsecond"></span>
        <span class="calthird"></span>
        <span class="calfourth"></span>
    </button>

</div>
<div class="calcalendar-container">
    <table class="caltab">
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
        $currentDay = $currentDate->format('j');

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
                    echo "<td class='calcalendar-cell'>$day<div class='calinfo-cell'>$dayInfo</div></td>";
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
        var calendarTitle = document.getElementById("calcalendar-title");
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
                cell.classList.add("calbigger-cell"); // Ajoutez la classe pour agrandir les cellules

                if (day <= 0 || day > lastDayOfMonth.getDate()) {
                    // Jours du mois précédent ou suivant
                    cell.innerHTML = "";
                } else {
                    // Jours du mois actuel avec informations sous le numéro de jour
                    var yearMonthKey = year + '-' + (month + 1).toString().padStart(2, '0');
                    var dayInfo = calendarData[yearMonthKey] && calendarData[yearMonthKey][day] ? calendarData[yearMonthKey][day] : '';
                    cell.innerHTML = day + "<div class='calinfo-cell'>" + dayInfo + "</div>";
                }
                day++;
            }
        }
    }
    // Appelez la fonction de mise à jour du calendrier au chargement de la page
    updateCalendar();
</script>
<?php
footer();
echo "</body>";
?>