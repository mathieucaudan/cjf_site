function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("noutabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    // Supprime la classe "active" de tous les boutons d'onglet
    tablinks = document.getElementsByClassName("noutablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    // Ajoute la classe "active" à l'onglet actuel
    evt.currentTarget.className += " active";
    document.getElementById(tabName).style.display = "block";
    
    // Ajoute la classe "active" spécifique au bouton "Bureau" s'il s'agit de l'onglet "Bureau"
    if (tabName === 'bureau') {
        document.querySelector(".noutablinks.bureau").classList.add("active");
    }
}