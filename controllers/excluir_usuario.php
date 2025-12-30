<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/usuario.php';
session_start();

$id = trim($_GET['id'] ?? '');
$usuario = new Usuario($id);
$usuario->deletar();

$_SESSION["msg"] = "Usuário excluído com sucesso!";
header('Location: /capiboss/views/admin/listar_usuarios.php');
exit;