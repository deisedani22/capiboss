<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/missoes.php';
session_start();

$id = $_POST['id'] ?? null;
$titulo = $_POST['titulo_missao'] ?? '';
$jogo_url = $_POST['url_missao'] ?? '';
$aula_id = $_POST['aula_id'] ?? '';
$recompensa_capimoedas = $_POST['capimoedas'] ?? '';

$missao = new Missoes($id);
$missao->setTitulo($titulo);
$missao->setJogoUrl($jogo_url);
$missao->setAulaId($aula_id);
$missao->setRecompensaCapimoedas($recompensa_capimoedas);
$missao->atualizar();

$_SESSION["msg"] = "Missão atualizada com sucesso!";
header('Location: /capiboss/views/admin/listar_missoes.php');
exit();