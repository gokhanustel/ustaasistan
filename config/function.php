<?php

/**
 * XSS koruması için çıktı temizleme
 */
function e($value)
{
    return htmlspecialchars(
        $value,
        ENT_QUOTES | ENT_HTML5,
        'UTF-8'
    );
}

/**
 * CSRF Token oluşturur
 */
function generateCsrfToken()
{
    if (empty($_SESSION['csrf_token'])) {

        $_SESSION['csrf_token'] = bin2hex(
            random_bytes(32)
        );

    }

    return $_SESSION['csrf_token'];
}

/**
 * CSRF Token doğrular
 */
function verifyCsrfToken($token)
{
    return isset($_SESSION['csrf_token'])
        && hash_equals(
            $_SESSION['csrf_token'],
            $token
        );
}