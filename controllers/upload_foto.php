<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/usuario.php';
session_start();

// 1. Verifica se veio arquivo
if (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
    // aqui você pode tratar melhor, mas por enquanto:
    die('Nenhuma imagem enviada ou erro no upload.');
}

$arquivo = $_FILES['foto'];

// Extensões permitidas
$extPermitidas = ['jpg', 'jpeg', 'png'];

// Descobre a extensão do arquivo enviado
$ext = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));

if (!in_array($ext, $extPermitidas)) {
    die('Tipo de arquivo não permitido. Envie JPG ou PNG.');
}

// Gera um novo nome para evitar conflito
$idUsuario = $_SESSION['usuario_id'];
$novoNome = 'foto_' . uniqid('', true) . '.' . $ext;

// Pasta física onde a imagem será salva (dentro de /aluno/uploads/)
$pastaUpload = $_SERVER['DOCUMENT_ROOT'] . '/capiboss/imagens/uploads/';

// Cria a pasta, se ainda não existir
if (!is_dir($pastaUpload)) {
    mkdir($pastaUpload, 0777, true);
}

// Caminho completo no disco
$caminhoFisico = $pastaUpload . $novoNome;

// Move o arquivo temporário para a pasta definitiva
if (!move_uploaded_file($arquivo['tmp_name'], $caminhoFisico)) {
    die('Erro ao salvar a imagem no servidor.');
}

// Guarda do banco
//require_once __DIR__ . '/../auth.php';

// Guarda o nome da foto na sessão
$_SESSION['foto'] = $novoNome;

Usuario::atualizarFoto($novoNome, $idUsuario);


// Redireciona de volta para o perfil do aluno
header('Location: /capiboss/home.php');
exit;
