<?php
/**
 * Endpoint para salvar credenciais da API PIX
 */
require_once __DIR__ . '/../auth_check.php';

header('Content-Type: application/json');

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data || !isset($data['public_key']) || !isset($data['secret_key'])) {
    echo json_encode(['success' => false, 'error' => 'Dados incompletos']);
    exit;
}

$dataDir = __DIR__ . '/../data';
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}

$config = [
    'public_key' => $data['public_key'],
    'secret_key' => $data['secret_key'],
    'updated_at' => date('Y-m-d H:i:s')
];

$configFile = $dataDir . '/pix_config.json';
file_put_contents($configFile, json_encode($config, JSON_PRETTY_PRINT));

$createPixFile = __DIR__ . '/../../api/create_pix.php';
$checkPixFile = __DIR__ . '/../../api/check_pix_status.php';

function updateApiCredentials($filePath, $publicKey, $secretKey) {
    if (!file_exists($filePath)) {
        return false;
    }
    
    $content = file_get_contents($filePath);

    $publicKeyEscaped = preg_quote($publicKey, '/');
    $secretKeyEscaped = preg_quote($secretKey, '/');

    $content = preg_replace(
        "/define\('TITANSHUB_PUBLIC_KEY',\s*'[^']*'\);/",
        "define('TITANSHUB_PUBLIC_KEY', '" . addslashes($publicKey) . "');",
        $content
    );

    $content = preg_replace(
        "/define\('TITANSHUB_SECRET_KEY',\s*'[^']*'\);/",
        "define('TITANSHUB_SECRET_KEY', '" . addslashes($secretKey) . "');",
        $content
    );
    
    return file_put_contents($filePath, $content) !== false;
}

$updateResults = [];
$updateResults['create_pix'] = updateApiCredentials($createPixFile, $data['public_key'], $data['secret_key']);
$updateResults['check_pix'] = updateApiCredentials($checkPixFile, $data['public_key'], $data['secret_key']);

echo json_encode(['success' => true, 'message' => 'Credenciais atualizadas com sucesso']);

