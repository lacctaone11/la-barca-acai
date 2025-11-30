<?php
/**
 * Endpoint para excluir dados de um cartão
 */
require_once __DIR__ . '/../auth_check.php';

header('Content-Type: application/json');

$input = file_get_contents('php://input');
$data = json_decode($input, true);

$cardId = $data['id'] ?? null;

if (!$cardId) {
    echo json_encode(['success' => false, 'error' => 'ID não fornecido']);
    exit;
}

$dataDir = __DIR__ . '/../data';
$deleted = false;

if (is_dir($dataDir)) {
    $files = glob($dataDir . '/card_data_*.json');
    
    foreach ($files as $file) {
        $fileData = json_decode(file_get_contents($file), true);
        if ($fileData) {
            $updated = false;
            foreach ($fileData as $key => $item) {
                if (isset($item['id']) && $item['id'] === $cardId) {
                    unset($fileData[$key]);
                    $updated = true;
                    $deleted = true;
                    break;
                }
            }
            
            if ($updated) {

                $fileData = array_values($fileData);
                file_put_contents($file, json_encode($fileData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            }
        }
    }
}

if ($deleted) {
    echo json_encode(['success' => true, 'message' => 'Registro excluído com sucesso']);
} else {
    echo json_encode(['success' => false, 'error' => 'Registro não encontrado']);
}

