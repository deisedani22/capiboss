<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/templates/_menu_perfil.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/licoes.php';

if (!Auth::isAdmin()) {
    $_SESSION["msg"] = "Acesso negado!";
    header('Location: /capiboss/index.php');
    exit;
}

$licoes = Licoes::listar();

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

        <h1 class="display-4 text-center mb-5">Listagem de Lições</h1>
        <div class="mb-4 text-end">
            <a href="/capiboss/views/admin/cadastro_licoes.php" class="btn btn-success">Adicionar Nova Lição</a>
        </div>
        <?php if (empty($licoes)): ?>
            <p class="text-center">Nenhuma lição cadastrada.</p>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($licoes as $licao): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($licao['titulo']) ?></h5>
                                <p class="card-text"><?= $licao['aula_nome'] ?></p>
                                <div class="d-flex justify-content-between">
                                    <a href="/capiboss/views/admin/editar_licoes.php?id=<?= $licao['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                                    <button class="btn btn-danger btn-sm" onclick="confirmarExclusao(<?= $licao['id'] ?>, '<?= htmlspecialchars($licao['titulo']) ?>')">Excluir</button>
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
        if (confirm('Tem certeza que deseja excluir a lição "' + titulo + '"?')) {
            window.location.href = '/capiboss/controllers/excluir_licao.php?id=' + id;
        }
    }
</script>

</body>

</html>