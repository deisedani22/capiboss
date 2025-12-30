<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/templates/_menu_perfil.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/aulas.php';

if (!Auth::isAdmin()) {
    $_SESSION["msg"] = "Acesso negado!";
    header('Location: /capiboss/index.php');
    exit;
}

$aulas = Aulas::listar();

?>

<main class="container my-5">

    <?php if (isset($_SESSION['msg'])): ?>
        <section class="session-aviso">
            <div class="textoaviso">
                <?= $_SESSION['msg'] ?>
            </div>
        </section>
        <?php unset($_SESSION['msg']); ?>
    <?php endif; ?>

    <section>
        <h1 class="display-4 text-center mb-5">Listagem de Aulas</h1>
        <div class="mb-4 text-end">
            <a href="/capiboss/views/admin/cadastro_aulas.php" class="btn btn-success">Adicionar Nova Aula</a>
        </div>
        <?php if (empty($aulas)): ?>
            <p class="text-center">Nenhuma aula cadastrada.</p>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($aulas as $aula): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($aula['titulo']) ?></h5>
                                <p class="card-text"><?= $aula['trilha_nome'] ?></p>
                                <div class="d-flex justify-content-between">
                                    <a href="/capiboss/views/admin/editar_aula.php?id=<?= $aula['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                                    <button class="btn btn-danger btn-sm" onclick="confirmarExclusao(<?= $aula['id'] ?>, '<?= htmlspecialchars($aula['titulo']) ?>')">Excluir</button>
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
        if (confirm('Tem certeza que deseja excluir a aula "' + titulo + '"?')) {
            window.location.href = '/capiboss/controllers/excluir_aula.php?id=' + id;
        }
    }
</script>

</body>

</html>