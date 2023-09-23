<?php
include 'fonction.php';
entete();
echo "<body style='background-color: rgb(32, 47, 74); color:white;'>";
navbar();
?>
<?php
$currentDate = new DateTime();
$currentYear = $currentDate->format('Y');
$month = $currentDate->format('n');
$days = range(1, 31);
$dayOfWeek = array("mon", "tue", "wed", "thr", "fri", "sat", "sun");
// Obtenez le premier jour du mois actuel
$firstDayOfMonth = new DateTime("{$currentDate->format('Y-m')}-01");

// Obtenez le nombre de jours dans le mois actuel
$daysInMonth = $firstDayOfMonth->format('t');

// Obtenez le jour de la semaine du premier jour du mois (1 pour lundi, 7 pour dimanche)
$firstDayOfWeek = (int)$firstDayOfMonth->format('N');

// Commencez à compter les jours
$day = 1 - $firstDayOfWeek;

echo '<div id="calendar">';
echo '<header><i class="icons icon-arrow-left"></i>';
echo '<p class="month">' . $month . '</p><i class="icons icon-arrow-right"></i>';
echo '</header><div class="dayOfWeeks">';

foreach ($dayOfWeek as $day) {
  echo '<span class="' . $day . '">' . substr($day, 0, 3) . '</span>';
}

echo '</div><div class="weeks"><div class="week">';

foreach ($dayOfWeek as $day) {
  echo '<div class="week">'; // Ajouter cette ligne pour commencer une nouvelle semaine

  foreach ($days as $day) {
    echo '<div class="day" id="d' . $day . '">';
    echo '<div class="date"><span class="day">' . $day . '</span><span class="dayOfWeek ' . $dayOfWeek[$day % 7] . '">' . substr($dayOfWeek[$day % 7], 0, 3) . '</span></div>';
    echo '<div class="events">';
    echo '<div class="event">';
    echo '<div class="logo"><i class="icon-game-controller"></i></div>';
    echo '<div class="title">';
    echo '<p>Game Event Title</p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';

    if ($dayOfWeek[$day % 7] == "mon") {
      echo '</div>'; // Fermer la classe "week" le dimanche
    }
  }

  echo '</div>'; // Ajouter cette ligne pour fermer la semaine
}

echo '</div></div></div>';
?>
<?php
footer();
echo "</body>";
?>
<style>
  div,
  p {
    margin: 0;
    padding: 0;
    border: 0;
    outline: 0;
    font-weight: inherit;
    font-style: inherit;
    font-family: inherit;
    font-size: 100%;
    vertical-align: baseline;
  }

  body {
    line-height: 1;
    color: #000;
    background: #fff;
  }

  ol,
  ul {
    list-style: none;
  }

  table {
    border-collapse: separate;
    border-spacing: 0;
    vertical-align: middle;
  }

  caption,
  th,
  td {
    text-align: left;
    font-weight: normal;
    vertical-align: middle;
  }

  a img {
    border: none;
  }

  .sun {
    color: #f78686;
  }

  .sat {
    color: #86bbf7;
  }

  * {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
  }

  :root {
    font-size: 16px;
    font-family: 'Roboto';
    font-weight: 300;
  }

  html {
    display: block;
    height: auto;
    color: #575757;
  }

  .bg,
  .border {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
  }

  .bg {
    background: -webkit-linear-gradient(bottom, #f78686, #bbfcfc);
    background: -moz-linear-gradient(bottom, #f78686, #bbfcfc);
    background: -o-linear-gradient(bottom, #f78686, #bbfcfc);
    background: -ms-linear-gradient(bottom, #f78686, #bbfcfc);
    background: linear-gradient(to top, #f78686, #bbfcfc);
    z-index: -1;
  }

  .border {
    border: 15px solid #fff;
    z-index: 10;
  }

  .border {
    position: fixed;
    top: 0;
    left: 0;
  }

  #calendar {
    margin: 0 auto;
    display: block;
    background: rgba(255, 255, 255, 0.4);
  }

  header {
    display: -webkit-box;
    display: -moz-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: box;
    display: flex;
    -webkit-box-pack: justify;
    -moz-box-pack: justify;
    -o-box-pack: justify;
    -ms-flex-pack: justify;
    -webkit-justify-content: space-between;
    justify-content: space-between;
    padding: 1.5rem 0;
    border-bottom: 1px solid #f78686;
  }

  header p.month {
    text-align: center;
    font-size: 1.5rem;
    font-size: 1.5rem;
  }

  header i.icons {
    padding: 0.4rem;
  }

  #calendar .dayOfWeeks {
    display: none;
  }

  #calendar .week {
    display: block;
  }

  #calendar .week>.day {
    display: -webkit-box;
    display: -moz-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: box;
    display: flex;
    border-bottom: 1px solid #e6e6e6;
    padding: 1rem 0.5rem;
    min-height: 80px;
  }

  #calendar .week>.day#d12 {
    border-bottom: 1px solid #f78686;
  }

  #calendar .week>.day .date {
    -webkit-box-flex: 1;
    -moz-box-flex: 1;
    -o-box-flex: 1;
    box-flex: 1;
    -webkit-flex: 0 0 80px;
    -ms-flex: 0 0 80px;
    flex: 0 0 80px;
    display: -webkit-box;
    display: -moz-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: box;
    display: flex;
    -webkit-box-pack: justify;
    -moz-box-pack: justify;
    -o-box-pack: justify;
    -ms-flex-pack: justify;
    -webkit-justify-content: space-between;
    justify-content: space-between;
    -webkit-box-align: baseline;
    -moz-box-align: baseline;
    -o-box-align: baseline;
    -ms-flex-align: baseline;
    -webkit-align-items: baseline;
    align-items: baseline;
    padding: 0 2rem 0 0;
    text-align: right;
  }

  #calendar .week>.day .date span.day {
    font-size: 1.2rem;
    -webkit-box-flex: 1;
    -moz-box-flex: 1;
    -o-box-flex: 1;
    box-flex: 1;
    -webkit-flex: 0 0 30px;
    -ms-flex: 0 0 30px;
    flex: 0 0 30px;
  }

  #calendar .week>.day .date span.dayOfWeek {
    font-size: 0.8rem;
    margin: 0 0 0 0.2em;
    text-transform: uppercase;
  }

  #calendar .week>.day .events {
    width: 100%;
  }

  #calendar .week>.day .events .event {
    display: -webkit-box;
    display: -moz-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: box;
    display: flex;
    margin: 0 0 0.5rem 0;
  }

  #calendar .week>.day .events .event:last-child {
    margin: 0;
  }

  #calendar .week>.day .events .event .logo {
    -webkit-box-flex: 1;
    -moz-box-flex: 1;
    -o-box-flex: 1;
    box-flex: 1;
    -webkit-flex: 0 0 20px;
    -ms-flex: 0 0 20px;
    flex: 0 0 20px;
    margin: 0 0.5rem 0 0;
    font-size: 1rem;
  }

  #calendar .week>.day .events .event .title {
    font-size: 1rem;
  }

  @media only screen and (min-width: 700px) {
    #calendar {
      margin-top: 5vh;
      max-width: 1000px;
      padding: 5rem;
    }

    #calendar header {
      margin-bottom: 4rem;
      border: none;
      width: 90%;
      margin-left: auto;
      margin-right: auto;
    }

    #calendar .dayOfWeeks {
      display: -webkit-box;
      display: -moz-box;
      display: -webkit-flex;
      display: -ms-flexbox;
      display: box;
      display: flex;
      -webkit-box-pack: justify;
      -moz-box-pack: justify;
      -o-box-pack: justify;
      -ms-flex-pack: justify;
      -webkit-justify-content: space-between;
      justify-content: space-between;
      text-transform: uppercase;
      margin: 0 0 2rem 0;
    }

    #calendar .dayOfWeeks span {
      text-align: center;
      -webkit-box-flex: 1;
      -moz-box-flex: 1;
      -o-box-flex: 1;
      box-flex: 1;
      -webkit-flex: 0 0 calc(100% / 7);
      -ms-flex: 0 0 calc(100% / 7);
      flex: 0 0 calc(100% / 7);
    }

    #calendar .week {
      display: -webkit-box;
      display: -moz-box;
      display: -webkit-flex;
      display: -ms-flexbox;
      display: box;
      display: flex;
    }

    #calendar .week:first-child {
      -webkit-box-pack: end;
      -moz-box-pack: end;
      -o-box-pack: end;
      -ms-flex-pack: end;
      -webkit-justify-content: flex-end;
      justify-content: flex-end;
    }

    #calendar .week>.day {
      -webkit-box-flex: 1;
      -moz-box-flex: 1;
      -o-box-flex: 1;
      box-flex: 1;
      -webkit-flex: 0 0 calc(100% / 7);
      -ms-flex: 0 0 calc(100% / 7);
      flex: 0 0 calc(100% / 7);
      margin: 0;
      padding: 0.5rem;
      height: auto;
      display: block;
      height: 110px;
      border: none;
    }

    #calendar .week>.day#d12 {
      border: none;
    }

    #calendar .week>.day#d12 .date .day:after {
      content: '';
      position: absolute;
      bottom: -0.2rem;
      left: 0;
      width: 100%;
      border-bottom: 1px solid #f78686;
    }

    #calendar .week>.day .date {
      -webkit-box-pack: center;
      -moz-box-pack: center;
      -o-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      text-align: center;
      margin: 0 0 1.5rem 0;
      padding: 0;
    }

    #calendar .week>.day .date .dayOfWeek {
      display: none;
    }

    #calendar .week>.day .date .day {
      position: relative;
    }

    #calendar .week>.day .events {
      display: -webkit-box;
      display: -moz-box;
      display: -webkit-flex;
      display: -ms-flexbox;
      display: box;
      display: flex;
      -webkit-box-pack: center;
      -moz-box-pack: center;
      -o-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
    }

    #calendar .week>.day .events .event {
      margin: 0 0.5rem 0 0;
    }

    #calendar .week>.day .events .event:last-child {
      margin: 0;
    }

    #calendar .week>.day .events .event .logo {
      margin: 0;
    }

    #calendar .week>.day .title {
      margin: 0.5rem;
      display: none;
    }
  }
</style>