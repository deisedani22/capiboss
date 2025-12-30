<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/templates/_menu_perfil.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/aulas.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/trilhas.php';

if (!Auth::isAdmin()) {
    $_SESSION["msg"] = "Acesso negado!";
    header('Location: /capiboss/index.php');
    exit;
}

$aulas_id = $_GET['id'];
$aula = new Aulas($aulas_id);

$trilas = Trilhas::listar();

?>

<main class="container my-5">
    <section>
        <h1 class="display-4 text-center mb-5">Editar Aula</h1>
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <form action="/capiboss/controllers/editar_aula_controller.php" method="POST" enctype="multipart/form-data" class="card p-4 shadow">
                    <div class="card-body">
                        <input type="hidden" name="id" value="<?= $aula->getId() ?>">

                        <div class="mb-3">
                            <label for="titulo_aula" class="form-label fw-bold">Título da Aula</label>
                            <input type="text" id="titulo_aula" name="titulo_aula" class="form-control" value="<?= htmlspecialchars($aula->getTitulo()) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="trilha_id" class="form-label fw-bold">Trilha</label>
                            <select name="trilha_id" id="trilha_id" class="form-control">
                                <option value="">Selecione uma Trilha</option>
                                <?php foreach ($trilas as $trilha): ?>
                                    <option value="<?= $trilha['id'] ?>" <?= $aula->getTrilhaId() == $trilha['id'] ? 'selected' : '' ?>><?= htmlspecialchars($trilha['titulo']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Salvar Alterações</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
</body>

</html>