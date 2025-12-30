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
        <h1 class="display-4 text-center mb-5">Cadastro de Aulas</h1>
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <form action="/capiboss/controllers/cadastro_aulas_controller.php" method="POST" enctype="multipart/form-data" class="card p-4 shadow">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="titulo_aula" class="form-label fw-bold">Título da Aula</label>
                            <input type="text" id="titulo_aula" name="titulo_aula" class="form-control" required>
                        </div>

                        <select name="trilha_id" id="trilha_id" class="form-control" required>
                            <option value="" disabled selected>Selecione a Trilha</option>
                            <?php foreach ($trilhas as $trilha): ?>
                                <option value="<?= $trilha['id'] ?>"><?= htmlspecialchars($trilha['titulo']) ?></option>
                            <?php endforeach; ?>
                        </select>
                        
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">Cadastrar Aula</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
</body>
</html>
