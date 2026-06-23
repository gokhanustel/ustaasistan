<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Güvenli Session Ayarları
|--------------------------------------------------------------------------
*/

if (session_status() === PHP_SESSION_NONE) {

    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'domain'   => '',
        'secure'   => isset($_SERVER['HTTPS']),
        'httponly' => true,
        'samesite' => 'Strict'
    ]);

    session_start();
}

/*
|--------------------------------------------------------------------------
| Session Hijacking Koruması
|--------------------------------------------------------------------------
*/

if (!isset($_SESSION['ip_address'])) {

    $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'] ?? '';
}

if (!isset($_SESSION['user_agent'])) {

    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'] ?? '';
}

/*
|--------------------------------------------------------------------------
| IP ve Browser Kontrolü
|--------------------------------------------------------------------------
*/

if (
    ($_SESSION['ip_address'] !== ($_SERVER['REMOTE_ADDR'] ?? '')) ||
    ($_SESSION['user_agent'] !== ($_SERVER['HTTP_USER_AGENT'] ?? ''))
) {

    session_unset();
    session_destroy();

    header('Location: /ustaasistan/auth/login.php');
    exit;
}

/*
|--------------------------------------------------------------------------
| Session Süresi Kontrolü
|--------------------------------------------------------------------------
*/

$sessionTimeout = 1800; // 30 dakika

if (isset($_SESSION['last_activity'])) {

    if (
        (time() - $_SESSION['last_activity'])
        > $sessionTimeout
    ) {

        session_unset();
        session_destroy();

        header('Location: /ustaasistan/auth/login.php');
        exit;
    }
}

$_SESSION['last_activity'] = time();