<div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h2 class="modal-title fs-4" id="editModalLabel">Editar Perfil</h2>
                <button type="button" class="btn-close btn-close-white" onclick="closeEditModal()" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="/capiboss/controllers/upload_foto.php" method="post" enctype="multipart/form-data">
                    <div class="text-center mb-4">
                        <div class="position-relative d-inline-block">
                            <img id="photoPreview" class="rounded-circle border border-3 border-primary" style="width: 120px; height: 120px; object-fit: cover;"
                                src="<?= !empty($_SESSION['foto']) ? '/capiboss/imagens/uploads/' . htmlspecialchars($_SESSION['foto']) : '/capiboss/imagens/marca_principal_azul.png' ?>"
                                alt="Preview da foto de perfil">
                            <button type="button" class="position-absolute bottom-0 end-0 bg-info rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; border: 2px solid white;" onclick="document.getElementById('photoInput').click()">📷</button>

                            
                        </div>
                        <input type="file" id="photoInput" name="foto" class="d-none" accept="image/*" onchange="previewImage()">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nameInput" class="form-label fw-bold">Nome</label>
                            <input type="text" id="nameInput" class="form-control" value="<?= $_SESSION['usuario_nome'] ?>" readonly disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="emailInput" class="form-label fw-bold">E-mail do Responsável</label>
                            <input type="email" id="emailInput" class="form-control" value="<?= $_SESSION['usuario_email'] ?>" readonly disabled>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="closeEditModal()">Cancelar</button>
                <button type="submit" form="editForm" class="btn btn-primary">Salvar Alterações</button>
            </div>
        </div>
    </div>
</div>