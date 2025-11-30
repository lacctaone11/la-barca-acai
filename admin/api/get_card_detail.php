<?php
/**
 * Endpoint para obter dados completos de um cartão específico
 */
require_once __DIR__ . '/../auth_check.php';

header('Content-Type: application/json');

$cardId = $_GET['id'] ?? null;

if (!$cardId) {
    echo json_encode(['success' => false, 'error' => 'ID não fornecido']);
    exit;
}

$dataDir = __DIR__ . '/../data';
$allData = [];

if (is_dir($dataDir)) {
    $files = glob($dataDir . '/card_data_*.json');
    
    foreach ($files as $file) {
        $fileData = json_decode(file_get_contents($file), true);
        if ($fileData) {
            foreach ($fileData as $item) {
                if (isset($item['id']) && $item['id'] === $cardId) {
                    echo json_encode(['success' => true, 'data' => $item]);
                    exit;
                }
            }
        }
    }
}

echo json_encode(['success' => false, 'error' => 'Registro não encontrado']);

