document.addEventListener("DOMContentLoaded", function () {
  // Attends que le DOM soit entièrement chargé avant d'exécuter le code

  // Affiche le premier onglet par défaut
  document.querySelector(".tab button.active").click();
});

function openTab(evt, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");

  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  tablinks = document.getElementsByClassName("tablinks");

  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].classList.remove("active");
  }

  evt.currentTarget.classList.add("active");
  document.getElementById(tabName).style.display = "block";
}
