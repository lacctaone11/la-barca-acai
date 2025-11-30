<?php

require_once __DIR__ . '/cart_helpers.php';

header('Content-Type: application/json; charset=utf-8');

$cart          = acai_get_cart();
$totalCarrinho = acai_cart_total($cart);

echo json_encode([
    'success'       => true,
    'totalCarrinho' => acai_format_money($totalCarrinho),
    'items'         => array_values($cart),
]);


