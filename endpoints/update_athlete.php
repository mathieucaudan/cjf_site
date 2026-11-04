<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../session.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['ok' => false, 'error' => 'Non autorisé']);
    exit;
}
if (!csrf_valide()) {
    http_response_code(403);
    echo json_encode(['ok' => false, 'error' => 'Session expirée : rechargez la page.']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {
    echo json_encode(['ok' => false, 'error' => 'Aucune donnée reçue']);
    exit;
}

$discipline = $input['discipline'] ?? '';
$competition = $input['competition'] ?? '';
$id = $input['id'] ?? '';
$nom = trim($input['nom'] ?? '');
$club = trim($input['club'] ?? '');
$categorie = trim($input['categorie'] ?? '');

if (!competition_valide($discipline, $competition)) {
    echo json_encode(['ok' => false, 'error' => 'Compétition inconnue']);
    exit;
}
$file = __DIR__ . "/../competitions/$discipline/$competition/athletes.json";
if (!$discipline || !$competition || !$id || !file_exists($file)) {
    echo json_encode(['ok' => false, 'error' => 'Paramètres invalides']);
    exit;
}

$fp = fopen($file, 'r+');
if (flock($fp, LOCK_EX)) {
    $content = stream_get_contents($fp);
    $data = json_decode($content, true);

    if (isset($data['athletes'][$id])) {
        $data['athletes'][$id]['nom'] = htmlspecialchars($nom, ENT_QUOTES);
        $data['athletes'][$id]['club'] = htmlspecialchars($club, ENT_QUOTES);
        $data['athletes'][$id]['categorie'] = htmlspecialchars($categorie, ENT_QUOTES);

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
