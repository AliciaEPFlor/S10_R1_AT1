<?php
/**
 * ============================================================
 * preferencias.php  —  Alterar preferências (COOKIES)
 * ============================================================
 * Altera tema e empresa salvos em COOKIE.
 * Persistem mesmo após logout (diferente da sessão).
 * ============================================================
 */

require_once __DIR__ . '/../includes/config.php';

// 🔒 Proteção de rota
if (!estaLogado()) {
    ir('../index.php');
}

$mensagem = '';

// Processa alteração
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['tema'])) {
        setCookiePref('tema', $_POST['tema']);
    }
    if (isset($_POST['empresa'])) {
        setCookiePref('empresa', trim($_POST['empresa']));
    }
    $mensagem = '✅ Preferências salvas no cookie!';
}

$temaAtual    = temaAtual();
$empresaAtual = getCookie('empresa', EMPRESA_PADRAO);

require __DIR__ . '/../includes/header.php';
?>

<h2>⚙️ Preferências do usuário</h2>

<?php if ($mensagem): ?>
    <p class="sucesso"><?= e($mensagem) ?></p>
<?php endif; ?>

<form method="POST" class="form">
    <label>Tema da interface:</label>
    <select name="tema">
        <option value="claro"  <?= $temaAtual === 'claro'  ? 'selected' : '' ?>>Claro</option>
        <option value="escuro" <?= $temaAtual === 'escuro' ? 'selected' : '' ?>>Escuro</option>
    </select>

    <label>Nome da empresa:</label>
    <input type="text" name="empresa" value="<?= e($empresaAtual) ?>">

    <button type="submit">Salvar preferências</button>
</form>

<p class="info">
    ℹ️ Esses dados são salvos em <strong>COOKIE</strong> —
    permanecem no navegador por <strong>30 dias</strong>, mesmo após logout.
</p>

<a href="painel.php" class="btn">← Voltar ao painel</a>

<?php require __DIR__ . '/../includes/footer.php'; ?>