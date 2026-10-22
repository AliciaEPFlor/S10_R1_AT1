<?php
/**
 * ============================================================
 * index.php  —  Tela de login (entrada do sistema)
 * ============================================================
 * Fluxo:
 *  1. Recebe o nome do usuário via POST
 *  2. Salva na SESSÃO (dado temporário)
 *  3. Salva empresa no COOKIE (dado persistente)
 *  4. Redireciona para o painel
 * ============================================================
 */

// require_once: config.php é OBRIGATÓRIO (sem sessão, nada funciona)
require_once __DIR__ . '/includes/config.php';

// Se já estiver logado, não precisa logar de novo
if (estaLogado()) {
    ir('pages/painel.php');
}

$erro = '';

// Processa o formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');

    if ($nome === '') {
        $erro = 'Informe seu nome para continuar.';
    } else {
        // 🔹 SESSÃO: guarda o usuário (temporário, dura até logout)
        $_SESSION['usuario']   = $nome;
        $_SESSION['login_em']  = date('d/m/Y H:i');

        // 🔹 COOKIE: guarda preferência de empresa (persistente)
        if (!empty($_POST['empresa'])) {
            setCookiePref('empresa', trim($_POST['empresa']));
        }

        ir('pages/painel.php');
    }
}

// Dados pré-preenchidos (vindos do COOKIE)
$empresaSalva = getCookie('empresa', EMPRESA_PADRAO);

// Inclui cabeçalho
require __DIR__ . '/includes/header.php';
?>

<h2>👋 Bem-vindo</h2>
<p>Entre para acessar o sistema. Seus dados ficarão guardados na <strong>sessão</strong>.</p>

<?php if ($erro): ?>
    <p class="erro"><?= e($erro) ?></p>
<?php endif; ?>

<form method="POST" class="form">
    <label>Seu nome:</label>
    <input type="text" name="nome" required placeholder="Ex.: Jorge">

    <label>Empresa:</label>
    <input type="text" name="empresa" value="<?= e($empresaSalva) ?>">

    <button type="submit">Entrar no Sistema</button>
</form>

<p class="info">
    ℹ️ O nome será salvo na <strong>SESSÃO</strong> (temporário).<br>
    A empresa será salva no <strong>COOKIE</strong> (persistente por 30 dias).
</p>

<?php require __DIR__ . '/includes/footer.php'; ?>