<?php
header('Content-Type: application/json');
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['ok' => false, 'error' => 'Non autorisé']);
    exit;
}

$discipline = $_POST['discipline'] ?? '';
$competition = $_POST['competition'] ?? '';
$nom = trim($_POST['nom'] ?? '');
$club = trim($_POST['club'] ?? '');
$categorie = trim($_POST['categorie'] ?? '');

if (!$discipline || !$competition || !$nom || !$club || !$categorie) {
    echo json_encode(['ok' => false, 'error' => 'Champs manquants']);
    exit;
}

$file = "../competitions/$discipline/$competition/athletes.json";
if (!file_exists($file)) {
    file_put_contents($file, json_encode(['athletes' => []], JSON_PRETTY_PRINT));
}

$fp = fopen($file, 'c+');
if (flock($fp, LOCK_EX)) {
    $content = stream_get_contents($fp);
    $data = $content ? json_decode($content, true) : ['athletes' => []];

    $id = uniqid('a', true);
    $data['athletes'][$id] = [
        'nom' => htmlspecialchars($nom, ENT_QUOTES),
        'club' => htmlspecialchars($club, ENT_QUOTES),
        'categorie' => htmlspecialchars($categorie, ENT_QUOTES)
    ];

    ftruncate($fp, 0);
    rewind($fp);
    fwrite($fp, json_encode($data, JSON_PRETTY_PRINT));
    fflush($fp);
    flock($fp, LOCK_UN);
}
fclose($fp);

echo json_encode(['ok' => true]);
