<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/missoes.php';
session_start();

$id = trim($_GET['id'] ?? '');
$missao = new Missoes($id);
$missao->deletar();

$_SESSION["msg"] = "Missão excluída com sucesso!";
header('Location: /capiboss/views/admin/listar_missoes.php');
exit;