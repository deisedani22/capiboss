<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/aulas.php';
session_start();

$id = trim($_GET['id'] ?? '');
$aula = new Aulas($id);
$aula->deletar();

$_SESSION["msg"] = "Aula excluída com sucesso!";
header('Location: /capiboss/views/admin/listar_aulas.php');
exit;