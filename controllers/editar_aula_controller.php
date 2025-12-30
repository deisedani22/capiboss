<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/aulas.php';
session_start();

$id = trim($_POST['id'] ?? '');
$titulo = trim($_POST['titulo_aula'] ?? '');
$trilha_id = trim($_POST['trilha_id'] ?? '');

$aula = new Aulas($id);
$aula->setTitulo($titulo);
$aula->setTrilhaId($trilha_id);

$aula->atualizar();

$_SESSION["msg"] = "Aula atualizada com sucesso!";
header('Location: /capiboss/views/admin/listar_aulas.php');
exit;
