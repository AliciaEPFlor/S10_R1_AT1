<?php
/**
 * ============================================================
 * painel.php  —  Dashboard do usuário (PROTEGIDO)
 * ============================================================
 * Só acessível se houver sessão ativa.
 * Exibe dados da SESSÃO + preferências do COOKIE.
 * ============================================================
 */

// require_once: config OBRIGATÓRIO
require_once __DIR__ . '/../includes/config.php';

// 🔒 PROTEÇÃO DE ROTA: sem sessão → volta ao login
if (!estaLogado()) {
    ir('../index.php');
}

// Dados vindos da SESSÃO e do COOKIE
$empresa = getCookie('empresa', EMPRESA_PADRAO);
$tema    = temaAtual();

// Cabeçalho
require __DIR__ . '/../includes/header.php';
?>

<h2>📊 Painel de <?= e($_SESSION['usuario']) ?></h2>
<p>Login realizado em: <strong><?= e($_SESSION['login_em']) ?></strong></p>

<div class="cards">
    <div class="card">
        <h3>👤 Usuário (SESSÃO)</h3>
        <p><?= e($_SESSION['usuario']) ?></p>
    </div>
    <div class="card">
        <h3>🏢 Empresa (COOKIE)</h3>
        <p><?= e($empresa) ?></p>
    </div>
    <div class="card">
        <h3>🎨 Tema (COOKIE)</h3>
        <p><?= e($tema) ?></p>
    </div>
</div>

<h3>ℹ️ Entenda a diferença</h3>
<table class="tabela">
    <tr><th>Dado</th><th>Onde fica</th><th>Duração</th></tr>
    <tr><td>Nome do usuário</td><td>Sessão ($_SESSION)</td><td>Até logout</td></tr>
    <tr><td>Hora do login</td><td>Sessão ($_SESSION)</td><td>Até logout</td></tr>
    <tr><td>Empresa</td><td>Cookie ($_COOKIE)</td><td>30 dias</td></tr>
    <tr><td>Tema</td><td>Cookie ($_COOKIE)</td><td>30 dias</td></tr>
</table>

<a href="preferencias.php" class="btn">⚙️ Alterar preferências</a>

<?php require __DIR__ . '/../includes/footer.php'; ?>