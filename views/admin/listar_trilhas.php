<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/templates/_menu_perfil.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/trilhas.php';

if (!Auth::isAdmin()) {
    $_SESSION["msg"] = "Acesso negado!";
    header('Location: /capiboss/index.php');
    exit;
}

$trilhas = Trilhas::listar();
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
        
        <h1 class="display-4 text-center mb-5">Listagem de Trilhas</h1>
        <div class="mb-4 text-end">
            <a href="/capiboss/views/admin/cadastro_trilhas.php" class="btn btn-success">Adicionar Nova Trilha</a>
        </div>
        <?php if (empty($trilhas)): ?>
            <p class="text-center">Nenhuma trilha cadastrada.</p>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($trilhas as $trilha): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($trilha['titulo']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($trilha['descricao']) ?></p>
                                <p class="card-text"><small class="text-muted">Nível: <?= htmlspecialchars($trilha['nivel_dificuldade']) ?></small></p>
                                <div class="d-flex justify-content-between">
                                    <a href="/capiboss/views/admin/editar_trilha.php?id=<?= $trilha['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                                    <button class="btn btn-danger btn-sm" onclick="confirmarExclusao(<?= $trilha['id'] ?>, '<?= htmlspecialchars($trilha['titulo']) ?>')">Excluir</button>
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
        if (confirm('Tem certeza que deseja excluir a trilha "' + titulo + '"?')) {
            window.location.href = '/capiboss/controllers/excluir_trilha.php?id=' + id;
        }
    }
</script>

</body>

</html>