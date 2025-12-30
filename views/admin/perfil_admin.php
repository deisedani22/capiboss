<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/templates/_menu_perfil.php';

if (!Auth::isAdmin()) {
    $_SESSION["msg"] = "Acesso negado!";
    header('Location: /capiboss/index.php');
    exit;
}

?>

<main class="container my-5">
    <section class="text-center">
        <h1 class="display-4 mb-3">Perfil do Administrador</h1>
        <p class="lead mb-4">Bem-vindo ao perfil do administrador!</p>
        <div>
            <a href="/capiboss/views/admin/listar_trilhas.php" class="btn btn-primary btn-lg">Listar Trilhas</a>
            <a href="/capiboss/views/admin/listar_aulas.php" class="btn btn-primary btn-lg">Listar Aulas</a>
            <a href="/capiboss/views/admin/listar_missoes.php" class="btn btn-primary btn-lg">Listar Missões</a>
            <a href="/capiboss/views/admin/listar_licoes.php" class="btn btn-primary btn-lg">Listar Lições</a>
            <a href="/capiboss/views/admin/listar_usuarios.php" class="btn btn-primary btn-lg">Listar Usuários</a>
        </div>
    </section>
</main>

</body>
</html>