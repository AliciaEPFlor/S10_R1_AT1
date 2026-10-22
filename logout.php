<?php
/**
 * ============================================================
 * logout.php  —  Encerra a SESSÃO
 * ============================================================
 * IMPORTANTE: destrói a SESSÃO, mas NÃO os COOKIES.
 * Assim o usuário continua com suas preferências (tema/empresa)
 * mesmo ao deslogar — comportamento profissional.
 * ============================================================
 */

require_once __DIR__ . '/includes/config.php';

// Limpa variáveis da sessão
$_SESSION = [];

// Remove o cookie PHPSESSID do navegador
if (ini_get('session.use_cookies')) {
    $p = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
              $p['path'], $p['domain'], $p['secure'], $p['httponly']);
}

// Destrói a sessão no servidor
session_destroy();

// Volta para o login
ir('index.php');