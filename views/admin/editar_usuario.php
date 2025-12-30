<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/templates/_menu_perfil.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/usuario.php';

if (!Auth::isAdmin()) {
    $_SESSION["msg"] = "Acesso negado!";
    header('Location: /capiboss/index.php');
    exit;
}

$usuario_id = $_GET['id'];
$usuario = new Usuario($usuario_id);
?>

<main class="container my-5">
    <section>
        <h1 class="display-4 text-center mb-5">Editar Usuário</h1>
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <form action="/capiboss/controllers/editar_usuario_controller.php" method="POST" enctype="multipart/form-data" class="card p-4 shadow">
                    <div class="card-body">
                        <input type="hidden" name="id" value="<?= $usuario->getId() ?>">

                        <div class="mb-3">
                            <label for="nome" class="form-label fw-bold">Nome</label>
                            <input type="text" id="nome" name="nome" class="form-control" value="<?= htmlspecialchars($usuario->getNome()) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars($usuario->getEmail()) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="tipo_usuario" class="form-label fw-bold">Tipo de Usuário</label>
                            <select id="tipo_usuario" name="tipo_usuario" class="form-select" required>
                                <option value="aluno" <?= $usuario->getTipoUsuario() === 'aluno' ? 'selected' : '' ?>>Aluno</option>
                                <option value="professor" <?= $usuario->getTipoUsuario() === 'professor' ? 'selected' : '' ?>>Professor</option>
                                <option value="admin" <?= $usuario->getTipoUsuario() === 'admin' ? 'selected' : '' ?>>Admin</option>
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