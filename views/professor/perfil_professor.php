<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/templates/_menu_perfil.php';
?>

<main class="container my-4">
    <!-- Profile Section -->
    <section class="text-center mb-5">
        <div class="position-relative d-inline-block mb-4" onclick="openEditModal()" style="cursor: pointer;">
            <img id="profilePhoto" class="rounded-circle border border-3 border-primary" style="width: 120px; height: 120px; object-fit: cover;"
                src="<?= !empty($_SESSION['foto']) ? '/capiboss/imagens/uploads/' . htmlspecialchars($_SESSION['foto']) : '/capiboss/imagens/marca_principal_azul.png' ?>"
                alt="Foto do Perfil">
            <div class="position-absolute bottom-0 end-0 bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; border: 2px solid white;">✏️</div>
        </div>
        <h1 class="display-5 mb-3">OLÁ, <?= $_SESSION['usuario_nome'] ?>!</h1>
        <div class="d-flex align-items-center justify-content-center mb-4">
            <span class="fs-4 me-2">📧</span>
            <span>E-mail: <strong id="responsibleEmail"><?= $_SESSION['usuario_email'] ?></strong></span>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="card text-center h-100 border-primary">
                    <div class="card-body">
                        <div class="fs-1 mb-3" style="color: #7B2CBF;">▶️</div>
                        <h5 class="card-title">Aulas</h5>
                        <p class="card-text fs-4 fw-bold text-primary">1/12</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center h-100 border-warning">
                    <div class="card-body">
                        <div class="fs-1 mb-3" style="color: #F0AD4E;">💰</div>
                        <h5 class="card-title">CAPIMOEDAS</h5>
                        <p class="card-text fs-4 fw-bold text-warning"><?= $_SESSION['capimoedas'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center h-100 border-success">
                    <div class="card-body">
                        <div class="fs-1 mb-3" style="color: #4CAF50;">🎓</div>
                        <h5 class="card-title">TRILHA</h5>
                        <p class="card-text small fw-bold text-success">MEU 1° COFRINHO</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Progress Section -->
    <section class="card mb-5">
        <div class="card-body">
            <h2 class="card-title">Seu Progresso</h2>
            <div class="progress mb-3" style="height: 25px;">
                <div class="progress-bar bg-primary" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="d-flex justify-content-between">
                <span>0 de 0 aulas concluídas</span>
                <span>0%</span>
            </div>
        </div>
    </section>

    <!-- Classes Section -->
    <section class="card mb-5">
        <div class="card-header bg-info text-white">
            <h3 class="card-title mb-0">SUAS TURMAS</h3>
            <p class="card-subtitle mb-0 small">Visão geral do progresso por turma</p>
        </div>
        <div class="card-body">
            <div id="classList" class="row g-3">
                <!-- Classes serão renderizadas via JS -->
            </div>
        </div>
    </section>

    <!-- Quick Actions Section -->
    <section class="card">
        <div class="card-header bg-secondary text-white">
            <h3 class="card-title mb-0">AÇÕES RÁPIDAS</h3>
            <p class="card-subtitle mb-0 small">Crie e gerencie conteúdo para suas turmas</p>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <button class="btn btn-outline-primary w-100 p-4" onclick="openAssessmentModal()">
                        <div class="fs-1 mb-2">➕</div>
                        <div>Avaliação</div>
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-outline-success w-100 p-4" onclick="openManageClassModal()">
                        <div class="fs-1 mb-2">👥</div>
                        <div>Gerenciar alunos</div>
                    </button>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Edit Profile Modal -->
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/templates/_editar_perfil_modal.php'; ?>

<!-- Assessment Modal -->
<div id="assessmentModal" class="modal fade" tabindex="-1" aria-labelledby="assessmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h2 class="modal-title" id="assessmentModalLabel">Criar Avaliação</h2>
                <button type="button" class="btn-close btn-close-white" onclick="closeAssessmentModal()" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form id="assessmentForm">
                    <div class="mb-3">
                        <label class="form-label" for="assessmentTitle">Título da Avaliação</label>
                        <input type="text" id="assessmentTitle" class="form-control" placeholder="Ex: Avaliação de Matemática - Unidade 1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="assessmentClass">Selecionar Turma</label>
                        <select id="assessmentClass" class="form-select" required>
                            <option value="">Escolha uma turma</option>
                            <option value="turma-a">Turma A - 4 a 6 anos</option>
                            <option value="turma-b">Turma B - 7 a 9 anos</option>
                            <option value="turma-c">Turma C - 10 a 12 anos</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="assessmentDescription">Descrição</label>
                        <textarea id="assessmentDescription" class="form-control" rows="3" placeholder="Descreva os objetivos e instruções da avaliação..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="assessmentDate">Data de Aplicação</label>
                        <input type="date" id="assessmentDate" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Anexar Documento (Opcional)</label>
                        <div class="border border-2 border-dashed rounded p-4 text-center" id="docUploadArea" onclick="document.getElementById('docInput').click()" style="cursor: pointer;">
                            <div class="fs-1 mb-2">📄</div>
                            <div>Clique para adicionar um documento PDF, DOC ou DOCX</div>
                        </div>
                        <input type="file" id="docInput" class="d-none" accept=".pdf,.doc,.docx">
                        <div id="uploadedFileContainer" class="mt-2"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeAssessmentModal()">Cancelar</button>
                <button type="submit" form="assessmentForm" class="btn btn-primary">Criar Avaliação</button>
            </div>
        </div>
    </div>
</div>

<!-- Manage Class Modal -->
<div id="manageClassModal" class="modal fade" tabindex="-1" aria-labelledby="manageClassModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h2 class="modal-title" id="manageClassModalLabel">Gerenciar Alunos</h2>
                <button type="button" class="btn-close btn-close-white" onclick="closeManageClassModal()" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label" for="selectClass">Selecionar Turma</label>
                    <select id="selectClass" class="form-select" onchange="loadStudents()">
                        <option value="turma-a">Turma A - 4 a 6 anos (15 alunos)</option>
                        <option value="turma-b">Turma B - 7 a 9 anos (20 alunos)</option>
                        <option value="turma-c">Turma C - 10 a 12 anos (18 alunos)</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Adicionar Novo Aluno</label>
                    <div class="input-group">
                        <input type="text" id="newStudentName" class="form-control" placeholder="Nome do aluno">
                        <button type="button" class="btn btn-primary" onclick="addStudent()">Adicionar</button>
                    </div>
                </div>
                <div class="student-list" id="studentList">
                    <!-- Students will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeManageClassModal()">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- Class Performance Modal -->
<div id="classPerformanceModal" class="modal fade" tabindex="-1" aria-labelledby="classPerformanceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h2 class="modal-title" id="classPerformanceModalLabel">Rendimento da Turma</h2>
                <button type="button" class="btn-close" onclick="closeClassPerformanceModal()" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-bold" id="performanceClassTitle">Turma</label>
                </div>
                <div id="performanceContainer">
                    <!-- Lista de alunos com atividades -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeClassPerformanceModal()">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script src="/capiboss/js/modal_edit_perfil.js"></script>
</body>

</html>