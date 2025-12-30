<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/auth/auth.php';

if (!Auth::estaLogado()) {
    $_SESSION["msg"] = "Por favor, faça login para acessar a página inicial.";
    header('Location: /capiboss/index.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Educação</title>

    <!-- CSS -->
    <link rel="stylesheet" href="/capiboss/css/home.css">

    <!-- Fontes -->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
</head>

<body>

    <div class="container">
        <div class="content">
            <img src="/capiboss/imagens/mascote_pose_pulando.png" alt="Mascote saltando" class="mascote-img">

            <div class="selection-area">
                <h1>Vamos começar?</h1>

                <div class="buttons-group">

                    <?php if (Auth::isAluno() || Auth::isAdmin()): ?>
                        <!-- Botão ALUNO -->
                        <a href="/capiboss/views/aluno/perfil_aluno.php" style="text-decoration:none; color:inherit;">
                            <div class="button-card">
                                <div class="icon-container">
                                    <img src="/capiboss/imagens/transformação.png" class="icon-img">
                                </div>
                                <span class="label">ALUNO</span>
                            </div>
                        </a>
                    <?php endif; ?>

                    <?php if (Auth::isProfessor() || Auth::isAdmin()): ?>
                        <!-- Botão PROFESSOR -->
                        <a href="/capiboss/views/professor/perfil_professor.php" style="text-decoration:none; color:inherit;">
                            <div class="button-card">
                                <div class="icon-container hands">
                                    <img src="/capiboss/imagens/palmas.png" alt="Palmas" class="icon-img">
                                </div>
                                <span class="label">PROFESSOR</span>
                            </div>
                        </a>
                    <?php endif; ?>

                    <?php if (Auth::isAdmin()): ?>
                        <!-- Botão ADMIN -->
                        <a href="/capiboss/views/admin/perfil_admin.php" style="text-decoration:none; color:inherit;">
                            <div class="button-card">
                                <div class="icon-container hands">
                                    <img src="/capiboss/imagens/mascote_pose_afirmacao.png" alt="Palmas" class="icon-img">
                                </div>
                                <span class="label">Admin</span>
                            </div>
                        </a>
                    <?php endif; ?>
                    
                </div>
            </div>
        </div>
    </div>

</body>

</html>