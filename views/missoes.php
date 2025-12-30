<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/templates/_menu_perfil.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/missoes.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/trilhas.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/aulas.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/progresso.php';

$trilhas = Trilhas::listar();
$missoes = Missoes::listar();

if (isset($_GET['trilha_id'])) {
    $trilha_id = $_GET['trilha_id'];
} else {
    $trilha_id = 1;
}

$trilha = new Trilhas($trilha_id);
$qtd_aulas = $trilha->countAulas($trilha_id);
$qtd_missoes = $trilha->countMissoes($trilha_id);
$qtd_licoes = $trilha->countLicoes($trilha_id);
$aulas = $trilha->getAulasPorTrilha($trilha_id);

$progresso = Progresso::contarProgressoTrilha($_SESSION['usuario_id'], $trilha_id);

?>

<main class="container my-4">

    <?php if (!empty($trilhas)): ?>
        <section class="mb-5 text-center">
            <h1 class="mb-4">Escolha sua Trilha de Aprendizado</h1>
            <div class="d-flex justify-content-center flex-wrap gap-3">
                <?php foreach ($trilhas as $trilha): ?>
                    <a href="<?= $_SERVER['PHP_SELF']  ?>?trilha_id=<?= $trilha['id'] ?>" class="text-white text-decoration-none">
                        <span class="badge rounded-pill d-inline-flex align-items-center p-3 flex-fill text-center justify-content-center bg-info">
                            <span><?= $trilha['titulo'] ?></span>
                        </span>
                    </a>
                <?php endforeach; ?>
            </div>
        </section>
    <?php else: ?>
        <div class="alert alert-info text-center" role="alert">
            Nenhuma trilha de aprendizado disponível no momento. Por favor, volte mais tarde.
        </div>
    <?php endif; ?>

    <?php if (isset($trilha)): ?>
        <!-- Progress Cards -->
        <!-- <section class="mb-5">
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="card text-center h-100 border-primary">
                        <div class="card-body">
                            <div class="fs-1 mb-3">⭐</div>
                            <h5 class="card-title">MISSÕES</h5>
                            <p class="card-text fs-4 fw-bold text-primary"><?= $_SESSION['estrelas'] ?>/<?= $qtd_missoes ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center h-100 border-warning">
                        <div class="card-body">
                            <div class="fs-1 mb-3">🪙</div>
                            <h5 class="card-title">CAPIMOEDAS</h5>
                            <p class="card-text fs-4 fw-bold text-warning"><?= $_SESSION['capimoedas'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center h-100 border-danger">
                        <div class="card-body">
                            <div class="fs-1 mb-3">❤️</div>
                            <h5 class="card-title">LIÇÕES</h5>
                            <p class="card-text fs-4 fw-bold text-danger"><?= $_SESSION['coracoes'] ?? 5 ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->

        <!-- Progress Section -->
        <section class="card mb-5">
            <div class="card-body">
                <h3 class="card-title">Seu Progresso na Trilha</h3>
                <p class="text-muted">Continue aprendendo para desbloquear novas lições!</p>
                <div class="progress mb-3" style="height: 30px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: <?= $progresso['percentual'] ?>%" aria-valuenow="<?= $progresso['percentual'] ?>" aria-valuemin="0" aria-valuemax="100">
                        <span class="position-absolute start-50"><?= $progresso['percentual'] ?>%</span>
                    </div>
                </div>
                <p class="text-center"><?= $progresso['concluidas'] ?> de <?= $qtd_missoes ?> Missões concluídas</p>
            </div>
        </section>

        <?php foreach ($aulas as $aula): ?>
            <?php
            $aulaAtual = new Aulas($aula['id']);
            $licoes = $aulaAtual->getLicoesPorAula($aulaAtual->getId());
            $missoes = $aulaAtual->getMissoesPorAula($aulaAtual->getId());
            ?>
            <article class="card mb-5">
                <div class="card-header bg-primary text-white">
                    <h2 class="h4 mb-0">Aula: <?= $aula['titulo'] ?></h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <?php foreach ($licoes as $licao): ?>
                                <!-- verificar se ja foi feita a lição -->
                                <?php $progressoLicao = Progresso::verificarProgresso($_SESSION['usuario_id'], 'licao', $licao['id']); ?>
                                <div class="mb-4">
                                    <?php if (isset($aula['presencial'])): ?>
                                        <div class="d-flex align-items-center mb-3 p-3 border rounded">
                                            <div class="fs-2 me-3">💬</div>
                                            <div class="flex-grow-1">
                                                <h4 class="h5 mb-1">RODA DE CONVERSA</h4>
                                                <p class="text-muted mb-0">Código: SFLVKSKVJSF</p>
                                            </div>
                                            <button class="btn btn-primary">Participar</button>
                                        </div>
                                    <?php endif; ?>
                                    <div class="d-flex align-items-center p-3 border rounded mb-3 <?= $progressoLicao ? 'bg-success-subtle' : '' ?>">
                                        <div class="fs-2 me-3">▶️</div>
                                        <div class="flex-grow-1">
                                            <h4 class="h5 mb-0"><?= $licao['titulo'] ?></h4>
                                        </div>
                                        <?php if (!$progressoLicao): ?>
                                            <form action="/capiboss/controllers/progresso_controller.php" method="post">
                                                <input type="hidden" name="acao" value="concluir_licao">
                                                <input type="hidden" name="user_id" value="<?= $_SESSION['usuario_id'] ?>">
                                                <input type="hidden" name="tipo" value="licao">
                                                <input type="hidden" name="referencia_id" value="<?= $licao['id'] ?>">
                                                <input type="hidden" name="licao_url" value="<?= $licao['video_url'] ?>">

                                                <button type="submit" class="btn btn-success me-2">Assistir</button>
                                            </form>
                                        <?php else: ?>
                                            <a href="<?= $licao['video_url'] ?>" class="btn btn-success">Assistido</a>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (isset($licao['arquivo'])): ?>
                                        <div class="d-flex align-items-center p-3 border rounded">
                                            <div class="fs-2 me-3">🏠</div>
                                            <div class="flex-grow-1">
                                                <h4 class="h5 mb-0"><?= $licao['titulo'] ?></h4>
                                            </div>
                                            <a href="/capiboss/assets/aulas/<?= $licao['arquivo'] ?>" class="btn btn-info" download>Baixar arquivo</a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="col-md-4">
                            <?php foreach ($missoes as $missao): ?>
                                <?php $progressoMissao = Progresso::verificarProgresso($_SESSION['usuario_id'], 'missao', $missao['id']); ?>
                                <div class="card border-warning <?= $progressoMissao ? 'bg-success-subtle' : '' ?>">
                                    <div class="card-body text-center">
                                        <div class="fs-1 mb-2"><?= Progresso::licoesConcluidasNaAula($_SESSION['usuario_id'], $aula['id']) ? "🔓" : "🔒" ?></div>
                                        <div class="fs-4 fw-bold text-warning mb-2">🪙 <?= $missao['recompensa_capimoedas'] ?>+</div>
                                        <h5 class="card-title"><?= $missao['titulo'] ?></h5>
                                        <img src="/capiboss/imagens/bau.png" alt="Baú de Surpresa" class="img-fluid mb-3" style="max-height: 100px;">
                                        <?php if (!$progressoMissao && Progresso::licoesConcluidasNaAula($_SESSION['usuario_id'], $aula['id'])): ?>
                                            <form action="/capiboss/controllers/progresso_controller.php" method="post">
                                                <input type="hidden" name="acao" value="concluir_missao">
                                                <input type="hidden" name="user_id" value="<?= $_SESSION['usuario_id'] ?>">
                                                <input type="hidden" name="tipo" value="missao">
                                                <input type="hidden" name="referencia_id" value="<?= $missao['id'] ?>">
                                                <input type="hidden" name="recompensa" value="<?= $missao['recompensa_capimoedas'] ?>">
                                                <input type="hidden" name="missao_url" value="<?= $missao['jogo_url'] ?>">

                                                <button type="submit" class="btn btn-warning mb-2">Jogar</button>
                                            </form>
                                        <?php elseif (!Progresso::licoesConcluidasNaAula($_SESSION['usuario_id'], $aula['id'])): ?>
                                            <button class="btn mb-2" disabled>Jogar</button>
                                        <?php else: ?>
                                            <a href="<?= $missao['jogo_url'] ?>" class="btn btn-success">Jogar De Novo</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <!-- <div class="card-footer bg-light text-end">
                        <form action="/capiboss/controller/missoes_controller.php" method="POST" class="m-3">
                            <input type="hidden" name="acao" value="concluir_licao">
                            <input type="hidden" name="licao_id" value="">
                            <input type="hidden" name="trilha_id" value="">
                            <button type="submit" class="btn btn-success w-100">Concluir Lição</button>
                        </form>
                    </div> -->
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
</main>

<script>
    // recarrega a pagina se usar o 'voltar' do navegador, atualizando os dados dinamicos
    window.addEventListener("pageshow", function(event) {
        if (event.persisted) {
            window.location.reload();
        }
    });
</script>


</body>

</html>