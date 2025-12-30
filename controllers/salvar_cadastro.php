<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/configs/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/usuario.php';
session_start();


// 1) Ler os dados que vieram do formulário (POST padrão)
$nome   = trim($_POST['nome']   ?? '');
$email  = trim($_POST['email']  ?? '');
$senha  = $_POST['senha']       ?? '';
$codigo = trim($_POST['codigo'] ?? '');
$fone   = trim($_POST['telefone'] ?? '');
// 2) Gerar hash da senha (nunca salve a senha pura)
$hash = password_hash($senha, PASSWORD_BCRYPT);

// 3) Criar o objeto usuário e preencher os dados
$novousaurio = new Usuario();
$novousaurio->setNome($nome);
$novousaurio->setEmail($email);
$novousaurio->setSenhaHash($hash);
$novousaurio->setCodigoInstituicao($codigo);
$novousaurio->setTelefone($fone);

// 4) Salvar no banco de dados
$novousaurio->enviar();


// 5) Redirecionar com mensagem de sucesso
$_SESSION["msg"] = "Cadastro realizado com sucesso!";
header('Location: /capiboss/index.php');
exit;
