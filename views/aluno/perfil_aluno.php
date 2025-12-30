<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/templates/_menu_perfil.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/progresso.php';

$trilhas = Progresso::progressoDeTrilhas($_SESSION['usuario_id']);

$totalMissoes = 0;
$concluidas = 0;

foreach ($trilhas as $t) {
    $totalMissoes += $t['total'];
    $concluidas   += $t['concluidas'];
}

$percentual = $totalMissoes > 0 ? round(($concluidas / $totalMissoes) * 100) : 0;
?>

<section>
    <!-- Profile Section -->
    <div class="card shadow d-grid p-4 rounded-3 mb-4">
        <div class="row align-items-center mb-4">
            <!-- Level Meter -->
            <div class="col">
                <div class="card text-center p-4 h-100">
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="arc-meter mb-3">
                            <svg class="arc-svg" viewBox="0 0 100 60" width="150" height="90">
                                <path d="M 10 50 A 40 40 0 0 1 30 15" stroke="#FF6B7A" stroke-width="8" fill="none"
                                    stroke-linecap="round" />
                                <path d="M 30 15 A 40 40 0 0 1 50 10" stroke="#FFD93D" stroke-width="8" fill="none"
                                    stroke-linecap="round" />
                                <path d="M 50 10 A 40 40 0 0 1 70 15" stroke="#B8E986" stroke-width="8" fill="none"
                                    stroke-linecap="round" />
                                <path d="M 70 15 A 40 40 0 0 1 90 50" stroke="#4CAF50" stroke-width="8" fill="none"
                                    stroke-linecap="round" />
                            </svg>
                        </div>
                        <div class="crown fs-1 mb-2">👑</div>
                        <div class="level-text fw-bold fs-4 mb-2">NÍVEL 1</div>
                        <div class="level-progress text-muted small">30% para o nível 2</div>
                    </div>
                </div>
            </div>

            <!-- Profile Photo -->
            <div class="col d-flex justify-content-center">
                <div class="position-relative d-inline-block" onclick="openEditModal()" style="cursor: pointer;">
                    <img id="profilePhoto" src="<?= !empty($_SESSION['foto']) ? '/capiboss/imagens/uploads/' . htmlspecialchars($_SESSION['foto']) : '/capiboss/imagens/marca_principal_azul.png' ?>" alt="Foto do Perfil" class="rounded-circle img-fluid shadow" style="width: 120px; height: 120px; object-fit: cover;">
                    <div class="position-absolute top-0 end-0 bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; border: 2px solid white;">✏️</div>
                </div>
            </div>

            <!-- Profile Info -->
            <div class="col text-center">
                <h1 id="greeting" class="mb-3 display-6">OLÁ, <?= $_SESSION['usuario_nome'] ?>!</h1>
                <div class="d-flex align-items-center justify-content-center mb-2">
                    <span class="me-2 fs-4">📧</span>
                    <div>
                        <div class="fw-bold small">E-mail do responsável:</div>
                        <div id="responsibleEmail" class="text-muted"><?= $_SESSION['usuario_email'] ?></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Badges -->
        <div class="d-flex justify-content-center flex-wrap gap-3">
            <span class="badge rounded-pill d-inline-flex align-items-center p-3 flex-fill text-center" style="background: #5BC0DE; color: white; min-width: 200px;">
                <span class="me-2 fs-4">⭐</span>
                <span>MISSÕES: <?= $_SESSION['estrelas'] ?></span>
            </span>

            <span class="badge rounded-pill d-inline-flex align-items-center p-3 flex-fill text-center" style="background: #F0AD4E; color: white; min-width: 200px;">
                <span class="me-2 fs-4">🪙</span>
                <span>CAPIMOEDAS: <?= $_SESSION['capimoedas'] ?></span>
            </span>

            <span class="badge rounded-pill d-inline-flex align-items-center p-3 flex-fill text-center" style="background: #D9534F; color: white; min-width: 200px;">
                <span class="me-2 fs-4">❤️</span>
                <span>LIÇÕES: <span id="profileLessonsValue">0</span> / <span id="profileTotalLessons">16</span></span>
            </span>
        </div>
    </div>
</section>

<section>
    <!-- Progress Section -->
    <div class="card shadow p-4 mb-4">
        <div class="card-body w-100">

            <h2 class="card-title">Seu Progresso Geral</h2>

            <p class="text-muted small mb-3">
                <?= count($trilhas); ?> trilhas (<?= $totalMissoes; ?> missões totais)
            </p>

            <div class="progress mb-3">
                <div class="progress-bar bg-success"
                    role="progressbar"
                    style="width: <?= $percentual; ?>%"
                    aria-valuenow="<?= $percentual; ?>"
                    aria-valuemin="0"
                    aria-valuemax="100">
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <span id="profileProgressText">
                    <?= $concluidas; ?> de <?= $totalMissoes; ?> missões concluídas
                </span>

                <span id="profileProgressPercent">
                    <?= $percentual; ?>%
                </span>
            </div>

        </div>
    </div>

</section>

<section>
    <!-- Achievements Section -->
    <div class="card shadow p-4 mb-4">
        <h2 class="card-title mb-4">SUAS CONQUISTAS</h2>
        <div class="row g-3">
            <div class="col-md-3">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="fs-1 mb-2">🏆</div>
                        <div class="fw-bold">1º Módulo</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="fs-1 mb-2">🏅</div>
                        <div class="fw-bold">1º Nível</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="fs-1 mb-2">🐷</div>
                        <div class="fw-bold">Cofrinho</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="fs-1 mb-2">🤝</div>
                        <div class="fw-bold">Amizade</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Edit Profile Modal -->
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/templates/_editar_perfil_modal.php'; ?>

<script src="/capiboss/js/modal_edit_perfil.js"></script>
</body>

</html>