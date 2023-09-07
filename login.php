<?php
session_start();

// Charger les données des utilisateurs depuis le fichier JSON
$jsonData = file_get_contents('athletes.json');
$users = json_decode($jsonData, true)['athletes'];
if (!empty($_POST['identifiant']) and !empty($_POST['password'])) {
  $identifiant = $_POST['identifiant'];
  $password =$_POST['password'];
  // Vérification des identifiants de connexion
  foreach ($users as $user) {
    if ($user['identifiant'] === $identifiant && password_verify($password, $user['password'])) {
      $_SESSION['role'] = $user['role'];
      $_SESSION['identifiant'] = $user['identifiant'];
      header('Location: accueil.php');
      exit;
    }else{
      sleep(1);
    }
  }
  header('Location: connexion.php');
}
?>

