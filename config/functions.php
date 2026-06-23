<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| XSS Koruması
|--------------------------------------------------------------------------
*/

function e(?string $value): string
{
    return htmlspecialchars(
        $value ?? '',
        ENT_QUOTES,
        'UTF-8'
    );
}

/*
|--------------------------------------------------------------------------
| CSRF Token Oluştur
|--------------------------------------------------------------------------
*/

function generateCsrfToken(): string
{
    if (empty($_SESSION['csrf_token'])) {

        $_SESSION['csrf_token'] =
            bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

/*
|--------------------------------------------------------------------------
| CSRF Token Kontrol
|--------------------------------------------------------------------------
*/

function verifyCsrfToken(?string $token): bool
{
    return isset($_SESSION['csrf_token'])
        && hash_equals(
            $_SESSION['csrf_token'],
            $token ?? ''
        );
}

/*
|--------------------------------------------------------------------------
| Login Kontrol
|--------------------------------------------------------------------------
*/

function isLoggedIn(): bool
{
    return isset($_SESSION['user_id']);
}

/*
|--------------------------------------------------------------------------
| Login Zorunlu
|--------------------------------------------------------------------------
*/

function requireLogin(): void
{
    if (!isLoggedIn()) {

        header('Location: /ustaasistan/auth/login.php');
        exit;
    }
}

/*
|--------------------------------------------------------------------------
| Session Yenile
|--------------------------------------------------------------------------
*/

function regenerateSession(): void
{
    session_regenerate_id(true);
}

/*
|--------------------------------------------------------------------------
| Güvenli Yönlendirme
|--------------------------------------------------------------------------
*/

function redirect(string $url): void
{
    header("Location: {$url}");
    exit;
}

/*
|--------------------------------------------------------------------------
| Flash Mesaj
|--------------------------------------------------------------------------
*/

function setFlash(
    string $type,
    string $message
): void {

    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message
    ];
}

function getFlash(): ?array
{
    if (!isset($_SESSION['flash'])) {
        return null;
    }

    $flash = $_SESSION['flash'];

    unset($_SESSION['flash']);

    return $flash;
}