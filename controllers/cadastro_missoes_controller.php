<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/missoes.php';
session_start();

$titulo = $_POST['titulo_missao'] ?? '';
$jogo_url = $_POST['url_missao'] ?? '';
$aula_id = $_POST['aula_id'] ?? '';

$missao = new Missoes();
$missao->setTitulo($titulo);
$missao->setJogoUrl($jogo_url);
$missao->setAulaId($aula_id);
$missao->enviar();

$_SESSION["msg"] = "Missão cadastrada com sucesso!";
header('Location: /capiboss/views/admin/listar_missoes.php');
exit();
