function openTab(evt, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  // Supprime la classe "active" de tous les boutons d'onglet
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  // Ajoute la classe "active" à l'onglet actuel
  evt.currentTarget.className += " active";
  document.getElementById(tabName).style.display = "block";

  // Ajoute la classe "active" spécifique au bouton "Bureau" s'il s'agit de l'onglet "Bureau"
  if (tabName === "bureau") {
    document.querySelector(".tablinks.bureau").classList.add("active");
  }
  if (tabName === "laserrun") {
    document.querySelector(".tablinks.laserrun").classList.add("active");
  }
  if (tabName === "presentation") {
    document.querySelector(".tablinks.presentation").classList.add("active");
  }
  if (tabName === "partenaire") {
    document.querySelector(".tablinks.partenaire").classList.add("active");
  }
}
