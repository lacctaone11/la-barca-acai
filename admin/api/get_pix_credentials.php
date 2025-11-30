<?php
/**
 * Endpoint para obter credenciais da API PIX
 */
require_once __DIR__ . '/../auth_check.php';

header('Content-Type: application/json');

$configFile = __DIR__ . '/../data/pix_config.json';

$defaultConfig = [
    'public_key' => 'SUA_CHAVE_PUBLICA_AQUI',
    'secret_key' => 'SUA_CHAVE_SECRETA_AQUI'
];

if (file_exists($configFile)) {
    $config = json_decode(file_get_contents($configFile), true);
    if ($config) {
        echo json_encode(['success' => true, 'data' => $config]);
        exit;
    }
}

echo json_encode(['success' => true, 'data' => $defaultConfig]);

