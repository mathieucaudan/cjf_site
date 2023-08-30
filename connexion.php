<?php
  include 'fonction.php';
entete();
echo"<body>";
navbar();
?>
<div style='background-color: rgb(32, 47, 74); color: white; display: flex; justify-content: center; align-items: center; height: 100vh;>
        <div>
            <center><h1 class='titre' style='font-size: 32px;'>Connexion</h1></center>
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
    </div>
<?php
footer();
echo"</body>";
?>