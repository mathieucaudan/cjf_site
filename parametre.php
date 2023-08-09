<?php
include 'fonction.php';
entete();
navbar();
echo "<body style='background-color: rgb(32, 47, 74);'>";
?>
<!-- <center><form action="parametre.php" method="post">
    <label for="fonction" style='font-size: 24px;  color: white;'>Choisissez une action :</label>
    <select name="fonction" id="fonction">
        <option value="ajoutimagecarousel">Carousel</option>
        <option value="ajoutarticle">Article</option>
        <option value="changerecord">Record</option>
    </select>
    <input type="submit" value="Choisir">
</form></center>-->
<?php
changerecord();
footer();
echo "</body>";
?>