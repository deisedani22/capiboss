<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/templates/_menu_perfil.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/trilhas.php';

if (isset($_GET['busca'])) {
    $searchTerm = $_GET['busca'];
    $trilhas = Trilhas::listPorTermo($searchTerm);
} else {
    $trilhas = Trilhas::listar();
}


?>
<!-- Top Bar -->
<div class="top-bar">
    <div class="search-container">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="get">
            <span class="search-icon">🔍</span>
            <input type="text" class="search-input" name="busca" id="searchInput" placeholder="Buscar trilhas...">
        </form>
    </div>
</div>

<!-- Page Title -->
<h1 class="page-title">NOSSAS TRILHAS</h1>
<?php if (!empty($trilhas)): ?>
    <section class="container">
        <div class="row">
            <?php foreach ($trilhas as $trilha): ?>
                <?php
                $trilhaAtual = new Trilhas($trilha['id']);
                $qtd_aulas = $trilhaAtual->countAulas($trilha['id']);
                $qtd_missoes = $trilhaAtual->countMissoes($trilha['id']);
                $qtd_licoes = $trilhaAtual->countLicoes($trilha['id']);
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow hover:shadow-lg text-center">
                        <div class="d-flex justify-content-center mt-3">
                            <img src="<?= !empty($trilha['foto']) ? '/capiboss/imagens/trilhas/' . htmlspecialchars($trilha['foto']) : '/capiboss/imagens/marca_principal_azul.png' ?>" class="card-img-top" style="width: 120px; height: 120px; object-fit: cover;" alt="...">
                        </div>

                        <div class="card-body">
                            <h1><?= $trilha['titulo'] ?></h1>
                            <p><?= $trilha['descricao'] ?></p>
                            <p><?= $qtd_aulas ?> aulas</p>
                            <p><?= $qtd_missoes ?> missões</p>
                            <div class="d-flex justify-content-center mt-3">
                                <span class="badge rounded-pill d-inline-flex align-items-center px-4 py-2" style="background: #F0AD4E; color: white; cursor: pointer">+<span class="me-2 fs-4">🪙</span><?= $trilha["recompensa_capimoedas"];  ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php else: ?>
    <div class="alert alert-info text-center" role="alert">
        Nenhuma trilha encontrada. Tente novamente mais tarde.
    </div>
<?php endif; ?>



</body>

</html>