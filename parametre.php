<?php
include 'fonction.php';
entete();
navbar();
echo "<body style='background-color: rgb(32, 47, 74);'>";




if(isset($_GET['action'])) {
    $action = $_GET['action'];
    echo "<button onclick='goBack()' style='font-size: 24px; color: white; background-color: rgb(32, 47, 74);'>Retour</button>";
    if($action == 'ajoutimagecarousel') {
        ajoutimagecarousel();
    } elseif($action == 'ajoutarticle') {
        ajoutarticle();
    } elseif($action == 'changerecord') {
        changerecord();
    }
} else {
    echo "<center id='actionLinks'>
    <a href='parametre.php?action=ajoutimagecarousel' style='font-size: 24px; color: white;' onclick='hideLinks();'>Ajouter une image au Carousel</a><br>
    <a href='parametre.php?action=ajoutarticle' style='font-size: 24px; color: white;' onclick='hideLinks();'>Ajouter un article</a><br>
    <a href='parametre.php?action=changerecord' style='font-size: 24px; color: white;' onclick='hideLinks();'>Modifier les enregistrements</a>
</center>";

}


footer();
echo "</body>";
?>
<script>
    function hideLinks() {
        var links = document.getElementById("actionLinks");
        links.style.display = "none";
    }
    function goBack() {
        window.history.back();
    }
</script>
