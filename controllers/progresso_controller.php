<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/progresso.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/usuario.php';
session_start();

if ($_POST['acao'] == 'concluir_licao') {
    $progresso = new Progresso();
    $progresso->setUserId($_POST['user_id']);
    $progresso->setTipo($_POST['tipo']);
    $progresso->setReferenciaId($_POST['referencia_id']);
    $progresso->setStatus('concluido');
    $progresso->criar();


    header("Location: " . $_POST['licao_url']);
    exit();
} elseif ($_POST['acao'] == 'concluir_missao') {
    $progresso = new Progresso();
    $progresso->setUserId($_POST['user_id']);
    $progresso->setTipo($_POST['tipo']);
    $progresso->setReferenciaId($_POST['referencia_id']);
    $progresso->setStatus('concluido');
    $progresso->criar();

    Usuario::atualizarCapimoedas($_POST['user_id'], $_POST['recompensa']);
    Usuario::atualizarEstrelas($_POST['user_id']);
    $_SESSION['estrelas'] = $_SESSION['estrelas'] + 1;
    $_SESSION['capimoedas'] = $_SESSION['capimoedas'] + (int)$_POST['recompensa'];

    header("Location: " . $_POST['missao_url']);
    exit();
}
