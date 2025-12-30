<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/auth/auth.php';


if (!Auth::estaLogado()) {
    $_SESSION["msg"] = "Sem permissão!";
    header('Location: /capiboss/index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Aluno</title>

    <link rel="stylesheet" href="/capiboss/css/bootstrap.css">
    <script src="/capiboss/js/bootstrap.bundle.js" defer></script>

</head>

<body style="min-height: 100vh;">
    <div class="container-fluid">
        <div class="row min-vh-100">
            <!------------- -- SIDEBAR -->
            <aside class="col-md-2 d-flex flex-column bg-info">

                <header class="mb-3">
                    <a href="/capiboss/home.php" class="d-block">
                        <img src="/capiboss/imagens/logo_capiboss_branco.png" alt="Logo Capiboss" class="img-fluid">
                    </a>
                </header>

                <nav class="nav flex-column">
                    <!-- INÍCIO -->
                    <?php if (Auth::isAluno()) : ?>
                        <a href="/capiboss/views/aluno/perfil_aluno.php" class="nav-link">
                            <div class="nav-item active text-white">🏠 INÍCIO</div>
                        </a>
                    <?php elseif (Auth::isProfessor()) : ?>
                        <a href="/capiboss/views/professor/perfil_professor.php" class="nav-link">
                            <div class="nav-item active text-white">🏠 INÍCIO</div>
                        </a>
                    <?php elseif (Auth::isAdmin()) : ?>
                        <a href="/capiboss/views/aluno/perfil_aluno.php" class="nav-link">
                            <div class="nav-item active text-white">🏠 INÍCIO/Aluno</div>
                        </a>
                        <a href="/capiboss/views/professor/perfil_professor.php" class="nav-link">
                            <div class="nav-item active text-white">🏠 INÍCIO/Prof</div>
                        </a>
                        <a href="/capiboss/views/admin/perfil_admin.php" class="nav-link">
                            <div class="nav-item active text-white">🏠 INÍCIO/Admin</div>
                        </a>

                    <?php endif; ?>


                    <!-- MISSÕES -->
                    <a href="/capiboss/views/missoes.php" class="nav-link">
                        <div class="nav-item text-white">⭐ MISSÕES</div>
                    </a>

                    <!-- TRILHAS -->
                    <a href="/capiboss/views/trilhas.php" class="nav-link">
                        <div class="nav-item text-white">🛤️ TRILHAS</div>
                    </a>

                    <!-- JOGOS -->
                    <a href="/capiboss/views/jogos.php" class="nav-link">
                        <div class="nav-item text-white">🎮 JOGOS</div>
                    </a>

                    <!-- SAIR -->
                    <a href="/capiboss/controllers/logout.php" class="nav-link">
                        <div class="btn btn-outline-danger mt-3">SAIR</div>
                    </a>
                </nav>

            </aside>


            <!-- Main Content -->
            <main class="col-md-10 main-content">
                <!-- Top Stats -->
                <section class="d-flex p-4 justify-content-end align-items-center">
                    <div class="d-flex mx-1">
                        <div class="d-flex flex-column align-items-center justify-content-center rounded-circle stat-item" style="width: 60px; height: 60px; background: #B4E7F5; color: white;">
                            <span>⭐</span>
                            <span class="stat-number small"><?= $_SESSION['estrelas'] ?></span>
                        </div>
                    </div>
                    <div class="d-flex mx-1">
                        <div class="d-flex flex-column align-items-center justify-content-center rounded-circle stat-item" style="width: 60px; height: 60px; background: #FFD93D; color: white;">
                            <span>🪙</span>
                            <span class="stat-number small"><?= $_SESSION['capimoedas'] ?></span>
                        </div>
                    </div>
                    <div class="d-flex mx-1">
                        <div class="d-flex flex-column align-items-center justify-content-center rounded-circle stat-item" style="width: 60px; height: 60px; background: #FF6B7A; color: white;">
                            <span>❤️</span>
                            <span class="stat-number small"><?= $_SESSION['coracoes'] ?? 5 ?></span>
                        </div>
                    </div>
                    <div class="d-flex mx-1">
                        <div class="stat-item" style="cursor: pointer;" onclick="openEditModal()">
                            <img id="topProfilePhoto"
                                src="<?= !empty($_SESSION['foto']) ? '/capiboss/imagens/uploads/' . htmlspecialchars($_SESSION['foto']) : '/capiboss/imagens/marca_principal_azul.png' ?>"
                                alt="Foto do perfil" class="rounded-circle" style="width:60px; height:60px; object-fit:cover;">

                        </div>
                    </div>
                </section>