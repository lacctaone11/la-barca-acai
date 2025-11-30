<?php
/**
 * Verifica se o usuário está autenticado
 * Use este arquivo no início de páginas protegidas
 */
require_once __DIR__ . '/jwt_helper.php';

if (!JWT::verify()) {
    header('Location: login.php');
    exit;
}

