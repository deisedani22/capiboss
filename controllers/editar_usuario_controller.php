<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/usuario.php';
session_start();

$id = trim($_POST['id'] ?? '');
$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$tipo_usuario = trim($_POST['tipo_usuario'] ?? '');

$usuario = new Usuario($id);
$usuario->setNome($nome);
$usuario->setEmail($email);
$usuario->setTipoUsuario($tipo_usuario);

$usuario->atualizar();

$_SESSION["msg"] = "Usuário atualizado com sucesso!";
header('Location: /capiboss/views/admin/listar_usuarios.php');
exit;