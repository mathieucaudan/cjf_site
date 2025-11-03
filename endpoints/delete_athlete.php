<?php
header('Content-Type: application/json');
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['ok' => false, 'error' => 'Non autorisé']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$discipline = $input['discipline'] ?? '';
$competition = $input['competition'] ?? '';
$id = $input['id'] ?? '';

$file = "../competitions/$discipline/$competition/athletes.json";
if (!$discipline || !$competition || !$id || !file_exists($file)) {
    echo json_encode(['ok' => false, 'error' => 'Paramètres invalides']);
    exit;
}

$fp = fopen($file, 'r+');
if (flock($fp, LOCK_EX)) {
    $content = stream_get_contents($fp);
    $data = json_decode($content, true);

    if (isset($data['athletes'][$id])) {
        unset($data['athletes'][$id]);
        ftruncate($fp, 0);
        rewind($fp);
        fwrite($fp, json_encode($data, JSON_PRETTY_PRINT));
        fflush($fp);
    } else {
        echo json_encode(['ok' => false, 'error' => 'Athlète introuvable']);
        flock($fp, LOCK_UN);
        fclose($fp);
        exit;
    }

    flock($fp, LOCK_UN);
}
fclose($fp);

echo json_encode(['ok' => true]);
