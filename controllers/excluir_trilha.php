<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/trilhas.php';
session_start();

$id = trim($_GET['id'] ?? '');
$trilha = new Trilhas($id);
$trilha->deletar();

$_SESSION["msg"] = "Trilha excluída com sucesso!";
header('Location: /capiboss/views/admin/listar_trilhas.php');
exit;