<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/licoes.php';
session_start();

$titulo = $_POST['titulo_licao'] ?? '';
$conteudo = $_POST['conteudo_licao'] ?? '';
$aula_id = $_POST['aula_id'] ?? '';
$video = $_POST['video_licao'] ?? '';
$arquivo = $_FILES['arquivo_licao']['name'] ?? '';

$licao = new Licoes();
$licao->setTitulo($titulo);
$licao->setConteudo($conteudo);
$licao->setAulaId($aula_id);
$licao->setVideo($video);

if ($arquivo) {
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/capiboss/assets/licoes/';
    $target_file = $target_dir . basename($arquivo);
    if (move_uploaded_file($_FILES['arquivo_licao']['tmp_name'], $target_file)) {
        $licao->setArquivo($arquivo);
    } else {
        $_SESSION["msg"] = "Erro ao fazer upload do arquivo.";
        header('Location: /capiboss/views/admin/cadastro_licoes.php');
        exit();
    }
} else {
    $licao->setArquivo(null);
}


$licao->enviar();

$_SESSION["msg"] = "Lição cadastrada com sucesso!";
header('Location: /capiboss/views/admin/listar_licoes.php');
exit();
