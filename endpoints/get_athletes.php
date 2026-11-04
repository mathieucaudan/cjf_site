<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../session.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['ok' => false, 'error' => 'Non autorisé']);
    exit;
}

$discipline = $_GET['discipline'] ?? '';
$competition = $_GET['competition'] ?? '';

if (!competition_valide($discipline, $competition)) {
    echo json_encode(['ok' => false, 'error' => 'Compétition inconnue']);
    exit;
}
$file = __DIR__ . "/../competitions/$discipline/$competition/athletes.json";
if (!file_exists($file)) {
    echo json_encode(['ok' => false, 'athletes' => []]);
    exit;
}

$data = json_decode(file_get_contents($file), true);
echo json_encode(['ok' => true, 'athletes' => $data['athletes'] ?? []]);
