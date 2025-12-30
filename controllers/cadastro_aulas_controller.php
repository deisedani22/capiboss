<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/aulas.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/trilhas.php';
session_start();

$titulo_aula = trim($_POST['titulo_aula'] ?? '');
$trilha_id = trim($_POST['trilha_id'] ?? '');


$novaAula = new Aulas();
$novaAula->setTitulo($titulo_aula);
$novaAula->setTrilhaId($trilha_id);

$novaAula->enviar();

$_SESSION["msg"] = "Aula cadastrada com sucesso!";
header('Location: /capiboss/views/admin/listar_aulas.php');
exit();