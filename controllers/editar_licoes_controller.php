<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/licoes.php';
session_start();

$id = $_POST['id'] ?? null;
$titulo = $_POST['titulo_licao'] ?? '';
$conteudo = $_POST['conteudo_licao'] ?? '';
$aula_id = $_POST['aula_id'] ?? '';
$video = $_POST['video_licao'] ?? '';
$arquivo = $_FILES['arquivo_licao']['name'] ?? '';

$licao = new Licoes($id);
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
        header('Location: /capiboss/views/admin/editar_licoes.php?id=' . $id);
        exit();
    }
} else {
    // Manter o arquivo atual se nenhum novo arquivo for enviado
    $licao->setArquivo($licao->getArquivo());
}

$licao->atualizar();

$_SESSION["msg"] = "Lição atualizada com sucesso!";
header('Location: /capiboss/views/admin/listar_licoes.php');
exit();