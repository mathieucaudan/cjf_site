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
    window.onload = function () {
        updateCalendar();
    };