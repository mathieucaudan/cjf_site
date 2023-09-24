<?php
include 'fonction.php';
entete();
echo "<body>";
navbar();
?>
<div style='background-color: rgb(32, 47, 74); color: white; display: flex; justify-content: center; align-items: center; height: 100vh;flex-direction: column;'>
    <div>
        <center>
            <h1 class='titre' style='font-size: 32px;'>Connexion</h1>
        </center>
        <form action='/login.php' method='post'>
            <div class='form-group'>
                <label for='identifiant'>Nom d'utilisateur:</label>
                <input type='text' id='identifiant' name='identifiant' required>
            </div>
            <div class='form-group'>
                <label for='password'>Mot de passe:</label>
                <input type='password' id='password' name='password' required>
            </div>
            <div class='form-group'>
                <input type='submit' value='Se connecter'>
            </div>
        </form>
    </div>
    <h4>Si vous êtes athlète, connectez vous sur le site de la Fédération francaise de Pentathlon Moderne</h4>
    <div class='form-group'>
        <a href='https://ffpentathlon.fr/espace-licencie/' target='_blank'><button>Se connecter sur ffpm</button></a>
    </div>
</div>

<?php
footer();
echo "</body>";
?>