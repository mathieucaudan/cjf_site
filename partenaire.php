<?php
include 'fonction.php';
entete();
echo "<body style='background-color: rgb(32, 47, 74);'>";
navbar();
?>
<h1 style="color: white;"><center>NOS PARTENAIRES</center></h1>

<div class="card" style="text-align: left; margin-left: 10px">
    <a href="https://www.google.fr"><img src="image/swisslife.png" style="width: 30vw;"></a>
    <div class="card-description">
        <h2 style="color: white;">Swiss Life</h2>
        <p style="color: white;">Description du partenaire</p>
    </div>
</div>

<?php
footer();
echo "</body>";
?>