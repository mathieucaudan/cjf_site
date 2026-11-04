<?php
require_once __DIR__ . '/session.php';

/* Traitement du formulaire de connexion (connexion.php). */

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: connexion.php');
    exit;
}

$identifiant = trim((string) ($_POST['identifiant'] ?? ''));
$password = (string) ($_POST['password'] ?? '');

// Limite d'essais : 5 échecs par adresse IP bloquent 15 minutes.
$ip = $_SERVER['REMOTE_ADDR'] ?? 'inconnue';
$fichierEssais = sys_get_temp_dir() . '/cjf_essais_' . hash('sha256', $ip) . '.json';
$essais = file_exists($fichierEssais) ? (json_decode(file_get_contents($fichierEssais), true) ?: []) : [];
$essais = array_values(array_filter($essais, function ($t) {
    return $t > time() - 900;
}));

if (count($essais) >= 5) {
    $_SESSION['erreur'] = 'bloque';
    header('Location: connexion.php');
    exit;
}

if (!csrf_valide()) {
    $_SESSION['erreur'] = 'expire';
    header('Location: connexion.php');
    exit;
}

$comptes = json_decode(@file_get_contents(fichier_comptes()), true)['athletes'] ?? [];
$trouve = null;
foreach ($comptes as $compte) {
    if (hash_equals($compte['identifiant'], $identifiant) && password_verify($password, $compte['password'])) {
        $trouve = $compte;
        break;
    }
}

if ($trouve) {
    @unlink($fichierEssais);
    session_regenerate_id(true);
    $_SESSION['role'] = $trouve['role'];
    $_SESSION['identifiant'] = $trouve['identifiant'];
    unset($_SESSION['csrf']);

    // Journal des connexions, conservé 90 jours.
    $journal = fichier_journal();
    $limite = date('Y-m-d', strtotime('-90 days'));
    $lignes = file_exists($journal) ? file($journal, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];
    $lignes = array_filter($lignes, function ($l) use ($limite) {
        return substr($l, 0, 10) >= $limite;
    });
    $lignes[] = date('Y-m-d H:i:s') . " - Utilisateur: {$trouve['identifiant']} - Adresse IP: $ip";
    file_put_contents($journal, implode("\n", $lignes) . "\n", LOCK_EX);

    header('Location: accueil.php');
    exit;
}

$essais[] = time();
file_put_contents($fichierEssais, json_encode($essais), LOCK_EX);
sleep(1);
$_SESSION['erreur'] = 'identifiants';
header('Location: connexion.php');
exit;
