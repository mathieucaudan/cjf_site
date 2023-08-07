<?php
include 'fonction.php';
entete();
navbar();
echo "<body style='background-color: rgb(32, 47, 74);'>";
?>
<center><form action="parametre.php" method="post">
    <label for="fonction" style='font-size: 24px;  color: white;'>Choisissez une action :</label>
    <select name="fonction" id="fonction">
        <option value="ajoutimagecarousel">Carousel</option>
        <option value="ajoutarticle">Article</option>
        <!-- Ajoutez d'autres options de fonction ici -->
    </select>
    <input type="submit" value="Choisir">
</form></center>
<?php
if(isset($_POST['fonction'])) {
    $fonction = $_POST['fonction'];
    if($fonction == 'ajoutimagecarousel') {
        ajoutimagecarousel();
    } elseif($fonction == 'ajoutarticle') {
        ajoutarticle();
    }
    // Ajoutez d'autres conditions pour les autres fonctions ici
}
footer();
echo "</body>";
?>