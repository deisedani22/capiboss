<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/licoes.php';
session_start();

$id = trim($_GET['id'] ?? '');
$licao = new Licoes($id);
$licao->deletar();

$_SESSION["msg"] = "Lição excluída com sucesso!";
header('Location: /capiboss/views/admin/listar_licoes.php');
exit;