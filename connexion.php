<?php
include 'fonction.php';

$erreur = $_SESSION['erreur'] ?? null;
unset($_SESSION['erreur']);

entete('Connexion');
navbar();
bandeau('Connexion');
?>

<section class="section section--serre">
  <div class="wrap">
    <div class="connexion">
      <div class="carte">
        <h2>Espace du club</h2>
        <p>Réservé aux membres du bureau et aux administrateurs du site.</p>
        <?php if ($erreur):
          $messages = [
            'bloque' => 'Trop de tentatives. Réessayez dans 15 minutes.',
            'expire' => 'La page a expiré. Saisissez à nouveau vos identifiants.',
          ]; ?>
          <div class="message message--erreur" role="alert"><?= e($messages[$erreur] ?? 'Identifiant ou mot de passe incorrect. Vérifiez-les et réessayez.') ?></div>
        <?php endif; ?>
        <form action="login.php" method="post">
          <?= champ_csrf() ?>
          <label for="identifiant">Nom d'utilisateur</label>
          <input type="text" id="identifiant" name="identifiant" autocomplete="username" required>
          <label for="password">Mot de passe</label>
          <input type="password" id="password" name="password" autocomplete="current-password" required>
          <input type="submit" value="Se connecter">
        </form>
      </div>
      <div class="carte">
        <h2>Vous êtes athlète ?</h2>
        <p>Votre licence, vos résultats et vos inscriptions aux compétitions se gèrent sur l'espace licencié de la Fédération française de pentathlon moderne.</p>
        <a class="btn btn--contour" href="https://ffpentathlon.fr/espace-licencie/" target="_blank" rel="noopener">Aller sur l'espace licencié FFPM</a>
      </div>
    </div>
  </div>
</section>

<?php footer(); ?>
