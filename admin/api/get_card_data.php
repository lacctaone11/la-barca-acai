<?php
/**
 * Endpoint para obter dados dos cartões salvos
 */
require_once __DIR__ . '/../auth_check.php';

header('Content-Type: application/json');

$dataDir = __DIR__ . '/../data';
$allData = [];

if (is_dir($dataDir)) {
    $files = glob($dataDir . '/card_data_*.json');
    
    foreach ($files as $file) {
        $fileData = json_decode(file_get_contents($file), true);
        if ($fileData) {
            $allData = array_merge($allData, $fileData);
        }
    }
}

usort($allData, function($a, $b) {
    return strtotime($b['timestamp']) - strtotime($a['timestamp']);
});

echo json_encode(['success' => true, 'data' => $allData]);

