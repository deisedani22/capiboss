<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/templates/_menu_perfil.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/aulas.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/missoes.php';

if (!Auth::isAdmin()) {
    $_SESSION["msg"] = "Acesso negado!";
    header('Location: /capiboss/index.php');
    exit;
}

$missoes_id = $_GET['id'];
$missao = new Missoes($missoes_id);

$aulas = Aulas::listar();

?>

<main class="container my-5">
    <section>
        <h1 class="display-4 text-center mb-5">Editar Missão</h1>
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <form action="/capiboss/controllers/editar_missao_controller.php" method="POST" enctype="multipart/form-data" class="card p-4 shadow">
                    <div class="card-body">
                        <input type="hidden" name="id" value="<?= $missao->getId() ?>">

                        <div class="mb-3">
                            <label for="titulo_missao" class="form-label fw-bold">Título da Missão</label>
                            <input type="text" id="titulo_missao" name="titulo_missao" class="form-control" value="<?= htmlspecialchars($missao->getTitulo()) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="url_missao" class="form-label fw-bold">URL da Missão</label>
                            <input type="url" id="url_missao" name="url_missao" class="form-control" value="<?= htmlspecialchars($missao->getJogoUrl()) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="aula_id" class="form-label fw-bold">Aula</label>
                            <select name="aula_id" id="aula_id" class="form-control">
                                <option value="">Selecione uma Aula</option>
                                <?php foreach ($aulas as $aula): ?>
                                    <option value="<?= $aula['id'] ?>" <?= $missao->getAulaId() == $aula['id'] ? 'selected' : '' ?>><?= htmlspecialchars($aula['titulo']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="capimoedas" class="form-label fw-bold">Capimoedas</label>
                            <input type="number" id="capimoedas" name="capimoedas" class="form-control" value="<?= htmlspecialchars($missao->getRecompensaCapimoedas()) ?>" required>
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