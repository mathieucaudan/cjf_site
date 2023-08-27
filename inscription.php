<?php
include 'fonction.php';
entete();
echo "<body style='background-color: rgb(32, 47, 74); color: white'>";
navbar();
?>
 <h1>Dossiers d'inscription</h1>
    
    <h2>Adultes</h2>
    <p>Téléchargez le dossier d'inscription pour les adultes :</p>
    <a href="./inscription/majeur.pdf" download>
        <button>Télécharger le dossier pour adultes</button>
    </a>

    <h2>Mineurs</h2>
    <p>Téléchargez le dossier d'inscription pour les mineurs :</p>
    <a href="./inscription/mineur.pdf" download>
        <button>Télécharger le dossier pour mineurs</button>
    </a>
<?php
footer();
echo "</body>";
?>