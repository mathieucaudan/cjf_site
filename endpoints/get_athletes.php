<?php
header('Content-Type: application/json');
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['ok' => false, 'error' => 'Non autorisé']);
    exit;
}

$discipline = $_GET['discipline'] ?? '';
$competition = $_GET['competition'] ?? '';

$file = "../competitions/$discipline/$competition/athletes.json";
if (!file_exists($file)) {
    echo json_encode(['ok' => false, 'athletes' => []]);
    exit;
}

$data = json_decode(file_get_contents($file), true);
echo json_encode(['ok' => true, 'athletes' => $data['athletes'] ?? []]);
