<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/templates/_menu_perfil.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/trilhas.php';

if (!Auth::isAdmin()) {
    $_SESSION["msg"] = "Acesso negado!";
    header('Location: /capiboss/index.php');
    exit;
}

$trilha_id = $_GET['id'];
$trilha = new Trilhas($trilha_id);

?>

<main class="container my-5">
    <section>
        <h1 class="display-4 text-center mb-5">Editar Trilha</h1>
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <form action="/capiboss/controllers/editar_trilha_controller.php" method="POST" enctype="multipart/form-data" class="card p-4 shadow">
                    <div class="card-body">
                        <input type="hidden" name="id" value="<?= $trilha->getId() ?>">
                        <div class="mb-3">
                            <label for="titulo_trilha" class="form-label fw-bold">Título da Trilha</label>
                            <input type="text" id="titulo_trilha" name="titulo_trilha" class="form-control" value="<?= htmlspecialchars($trilha->getTitulo()) ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="descricao_trilha" class="form-label fw-bold">Descrição da Trilha</label>
                            <textarea id="descricao_trilha" name="descricao_trilha" class="form-control" rows="4" required><?= htmlspecialchars($trilha->getDescricao()) ?></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="nivel_dificuldade" class="form-label fw-bold">Nível de Dificuldade</label>
                            <select id="nivel_dificuldade" name="nivel_dificuldade" class="form-select" required>
                                <option value="infantil" <?= $trilha->getNivelDificuldade() === 'infantil' ? 'selected' : '' ?>>Infantil</option>
                                <option value="fundamental" <?= $trilha->getNivelDificuldade() === 'fundamental' ? 'selected' : '' ?>>Fundamental</option>
                                <option value="medio" <?= $trilha->getNivelDificuldade() === 'medio' ? 'selected' : '' ?>>Médio</option>
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label for="foto_trilha" class="form-label fw-bold">Foto da Trilha</label>
                            <input type="file" id="foto_trilha" name="foto_trilha" class="form-control" accept="image/*">
                            <div class="form-text">Selecione uma nova imagem para a trilha (deixe em branco para manter a atual).</div>
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