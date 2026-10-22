<?php
$tema = temaAtual();
$corBg    = $tema === 'escuro' ? '#1e1e2f' : '#f5f5f5';
$corTexto = $tema === 'escuro' ? '#f5f5f5' : '#1e1e2f';
$corCard  = $tema === 'escuro' ? '#2a2a40' : '#ffffff';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?= APP_NOME ?></title>
    <link rel="stylesheet" href="/sistema-aula10/style.css">
</head>
<body style="background:<?= $corBg ?>;color:<?= $corTexto ?>;">

    <header class="topbar">
        <h1>🏢 <?= APP_NOME ?></h1>
        <nav>
            <?php if (estaLogado()): ?>
                <a href="/sistema-aula10/pages/painel.php">Painel</a>
                <a href="/sistema-aula10/pages/preferencias.php">Preferências</a>
                <a href="/sistema-aula10/logout.php">Sair</a>
            <?php else: ?>
                <a href="/sistema-aula10/index.php">Entrar</a>
            <?php endif; ?>
        </nav>
    </header>

    <main class="container" style="background:<?= $corCard ?>;">