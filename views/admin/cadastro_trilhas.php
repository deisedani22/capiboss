<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/templates/_menu_perfil.php';

if (!Auth::isAdmin()) {
    $_SESSION["msg"] = "Acesso negado!";
    header('Location: /capiboss/index.php');
    exit;
}

?>

<main class="container my-5">
    <section>
        <h1 class="display-4 text-center mb-5">Cadastro de Trilhas</h1>
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <form action="/capiboss/controllers/cadastro_trilhas_controller.php" method="POST" enctype="multipart/form-data" class="card p-4 shadow">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="titulo_trilha" class="form-label fw-bold">Título da Trilha</label>
                            <input type="text" id="titulo_trilha" name="titulo_trilha" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="descricao_trilha" class="form-label fw-bold">Descrição da Trilha</label>
                            <textarea id="descricao_trilha" name="descricao_trilha" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="nivel_dificuldade" class="form-label fw-bold">Nível de Dificuldade</label>
                            <select id="nivel_dificuldade" name="nivel_dificuldade" class="form-select" required>
                                <option value="infantil">Infantil</option>
                                <option value="fundamental">Fundamental</option>
                                <option value="medio">Médio</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="foto_trilha" class="form-label fw-bold">Foto da Trilha</label>
                            <input type="file" id="foto_trilha" name="foto_trilha" class="form-control" accept="image/*">
                            <div class="form-text">Selecione uma imagem para a trilha (opcional).</div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Cadastrar Trilha</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

</body>
</html>