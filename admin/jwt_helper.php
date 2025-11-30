<?php
/**
 * Helper para gerenciar JWT (JSON Web Tokens)
 */

class JWT {
    private static $secret = 'sua_chave_secreta_super_segura_aqui_mude_em_producao_2024';
    
    /**
     * Gera um token JWT
     */
    public static function encode($payload) {
        $header = [
            'typ' => 'JWT',
            'alg' => 'HS256'
        ];
        
        $headerEncoded = self::base64UrlEncode(json_encode($header));
        $payloadEncoded = self::base64UrlEncode(json_encode($payload));
        
        $signature = hash_hmac('sha256', $headerEncoded . '.' . $payloadEncoded, self::$secret, true);
        $signatureEncoded = self::base64UrlEncode($signature);
        
        return $headerEncoded . '.' . $payloadEncoded . '.' . $signatureEncoded;
    }
    
    /**
     * Decodifica e valida um token JWT
     */
    public static function decode($token) {
        $parts = explode('.', $token);
        
        if (count($parts) !== 3) {
            return false;
        }
        
        list($headerEncoded, $payloadEncoded, $signatureEncoded) = $parts;
        
        $signature = self::base64UrlDecode($signatureEncoded);
        $expectedSignature = hash_hmac('sha256', $headerEncoded . '.' . $payloadEncoded, self::$secret, true);
        
        if (!hash_equals($signature, $expectedSignature)) {
            return false;
        }
        
        $payload = json_decode(self::base64UrlDecode($payloadEncoded), true);

        if (isset($payload['exp']) && $payload['exp'] < time()) {
            return false;
        }
        
        return $payload;
    }
    
    /**
     * Verifica se o usuário está autenticado
     */
    public static function verify() {
        if (!isset($_COOKIE['admin_token'])) {
            return false;
        }
        
        $token = $_COOKIE['admin_token'];
        $payload = self::decode($token);
        
        return $payload !== false;
    }
    
    /**
     * Obtém os dados do usuário autenticado
     */
    public static function getUser() {
        if (!isset($_COOKIE['admin_token'])) {
            return null;
        }
        
        $token = $_COOKIE['admin_token'];
        return self::decode($token);
    }
    
    private static function base64UrlEncode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
    
    private static function base64UrlDecode($data) {
        return base64_decode(strtr($data, '-_', '+/'));
    }
}

