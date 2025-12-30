<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/templates/_menu_perfil.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/usuario.php';

if (!Auth::isAdmin()) {
    $_SESSION["msg"] = "Acesso negado!";
    header('Location: /capiboss/index.php');
    exit;
}

if(isset($_GET['busca'])) {
    $searchTerm = $_GET['busca'];
    $users = Usuario::listPorTermo($searchTerm);
} else {
    $users = Usuario::listar();
}

?>

<main class="container my-5">
    <section>
        <?php if (isset($_SESSION['msg'])): ?>
            <section class="session-aviso">
                <div class="textoaviso">
                    <?= $_SESSION['msg'] ?>
                </div>
            </section>
            <?php unset($_SESSION['msg']); ?>
        <?php endif; ?>
        
        <h1 class="display-4 text-center mb-5">Listagem de Usuarios</h1>
        <div class="top-bar mb-4">
            <div class="search-container">
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="get">
                    <span class="search-icon">🔍</span>
                    <input type="text" class="search-input" name="busca" id="searchInput" placeholder="Buscar usuarios...">
                </form>
            </div>
        </div>
        <!-- <div class="mb-4 text-end">
            <a href="/capiboss/views/admin/cadastro_aulas.php" class="btn btn-success">Adicionar Nova Aula</a>
        </div> -->
        <?php if (empty($users)): ?>
            <p class="text-center">Nenhum usuário cadastrado.</p>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($users as $user): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($user['nome']) ?></h5>
                                <p class="card-text"><?= $user['email'] ?></p>
                                <div class="d-flex justify-content-between">
                                    <a href="/capiboss/views/admin/editar_usuario.php?id=<?= $user['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                                    <button class="btn btn-danger btn-sm" onclick="confirmarExclusao(<?= $user['id'] ?>, '<?= htmlspecialchars($user['nome']) ?>')">Excluir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
</main>

<script>
    function confirmarExclusao(id, titulo) {
        if (confirm('Tem certeza que deseja excluir o usuário "' + titulo + '"?')) {
            window.location.href = '/capiboss/controllers/excluir_usuario.php?id=' + id;
        }
    }
</script>

</body>

</html>