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
      $date = date("Y-m-d H:i:s");
      $utilisateur = $user['identifiant'];
      $adresseIP = $_SERVER['REMOTE_ADDR'];
      $logLine = "$date - Utilisateur: $utilisateur - Adresse IP: $adresseIP\n";
      $logFile = "connexion.txt";
      if ($file = fopen($logFile, "a")){
        fwrite($file, $logLine);
        fclose($file);
      }
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

