<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/auth/auth.php';

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
$foto = $_POST['foto'] ?? '';
Auth::login($email, $senha, $foto);
