<?php
/**
 * ============================================================
 * config.php  —  Núcleo de configuração
 * ============================================================
 * ARQUIVO INCLUÍDO COM require_once EM TODAS AS PÁGINAS.
 * Motivo: se este arquivo faltar, o sistema NÃO PODE funcionar
 * (sem sessão o usuário não é reconhecido). Por isso usamos
 * require_once — interrompe o script em caso de erro e evita
 * dupla inclusão.
 * ============================================================
 */

// 🔹 Inicia a SESSÃO (memória do usuário enquanto navega)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 🔹 Constantes globais do sistema
define('APP_NOME',     'Sistema da Empresa XYZ');
define('APP_VERSAO',   '1.0.0');
define('EMPRESA_PADRAO', 'Empresa XYZ');
define('TEMA_PADRAO',    'claro');

/**
 * Verifica se o usuário está logado (dado vindo da SESSÃO).
 * Usada para PROTEÇÃO DE ROTAS.
 */
function estaLogado(): bool {
    return isset($_SESSION['usuario']);
}

/**
 * Redireciona e encerra a execução.
 */
function ir(string $url): void {
    header("Location: $url");
    exit;
}

/**
 * Escapa saída HTML (segurança contra XSS).
 */
function e(?string $t): string {
    return htmlspecialchars($t ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Lê preferência do COOKIE (dado persistente no navegador).
 */
function getCookie(string $chave, string $padrao = ''): string {
    return $_COOKIE[$chave] ?? $padrao;
}

/**
 * Grava preferência no COOKIE (30 dias).
 */
function setCookiePref(string $chave, string $valor): void {
    setcookie($chave, $valor, time() + (86400 * 30), "/");
}

/**
 * Retorna o tema atual salvo em cookie.
 */
function temaAtual(): string {
    return getCookie('tema', TEMA_PADRAO);
}
?>