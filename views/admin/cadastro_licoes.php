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
    <section>
        <h1 class="display-4 text-center mb-5">Cadastro de Lições</h1>
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <form action="/capiboss/controllers/cadastro_licoes_controller.php" method="POST" enctype="multipart/form-data" class="card p-4 shadow">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="titulo_licao" class="form-label fw-bold">Título da Lição</label>
                            <input type="text" id="titulo_licao" name="titulo_licao" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="conteudo_licao" class="form-label fw-bold">Conteúdo da Lição</label>
                            <textarea id="conteudo_licao" name="conteudo_licao" class="form-control" rows="4" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="video_licao" class="form-label fw-bold">Vídeo da Lição</label>
                            <input type="url" id="video_licao" name="video_licao" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="arquivo_licao" class="form-label fw-bold">Arquivo da Lição</label>
                            <input type="file" id="arquivo_licao" name="arquivo_licao" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="aula_id" class="form-label fw-bold">Aula</label>
                            <select name="aula_id" id="aula_id" class="form-control" required>
                                <option value="" disabled selected>Selecione a Aula</option>
                                <?php foreach ($aulas as $aula): ?>
                                    <option value="<?= $aula['id'] ?>"><?= htmlspecialchars($aula['titulo']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">Cadastrar Lição</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
</body>
</html>
