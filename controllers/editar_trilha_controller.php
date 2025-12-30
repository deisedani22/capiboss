<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/trilhas.php';
session_start();

$id = trim($_POST['id'] ?? '');
$titulo = trim($_POST['titulo_trilha'] ?? '');
$descricao = trim($_POST['descricao_trilha'] ?? '');
$nivel = trim($_POST['nivel_dificuldade'] ?? '');

if (!isset($_FILES['foto_trilha']) || $_FILES['foto_trilha']['error'] !== UPLOAD_ERR_OK) {
    die('Nenhuma imagem enviada ou erro no upload.');
}

$arquivo = $_FILES['foto_trilha'];
$extPermitidas = ['jpg', 'jpeg', 'png'];
$ext = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
if (!in_array($ext, $extPermitidas)) {
    die('Tipo de arquivo não permitido. Envie JPG ou PNG.');
}
$novoNome = 'trilha_' . uniqid('', true) . '.' . $ext;
$pastaUpload = $_SERVER['DOCUMENT_ROOT'] . '/capiboss/imagens/trilhas/';
if (!is_dir($pastaUpload)) {
    mkdir($pastaUpload, 0777, true);
}
$caminhoFisico = $pastaUpload . $novoNome;
if (!move_uploaded_file($arquivo['tmp_name'], $caminhoFisico)) {
    die('Erro ao salvar a imagem no servidor.');
}

$trilha = new Trilhas($id);
$trilha->setTitulo($titulo);
$trilha->setDescricao($descricao);
$trilha->setNivelDificuldade($nivel);
$trilha->setFoto($novoNome);

$trilha->atualizar();

$_SESSION["msg"] = "Trilha atualizada com sucesso!";
header('Location: /capiboss/views/admin/listar_trilhas.php');
exit;