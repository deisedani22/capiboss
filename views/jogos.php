<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/templates/_menu_perfil.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/model/missoes.php';

if (isset($_GET['busca'])) {
    $searchTerm = $_GET['busca'];
    $jogos = Missoes::listPorTermo($searchTerm);
} else {
    $jogos = Missoes::listar();
}


?>
<!-- Top Bar -->
<div class="top-bar">
    <div class="search-container">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="get">
            <span class="search-icon">🔍</span>
            <input type="text" class="search-input" name="busca" id="searchInput" placeholder="Buscar jogos...">
        </form>
    </div>
</div>

<!-- Page Title -->
<h1 class="page-title">NOSSOS JOGOS</h1>

<?php if (!empty($jogos)): ?>
    <section class="container">
        <div class="row">
            <?php foreach ($jogos as $jogo): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow hover:shadow-lg text-center">
                        <div class="card-body">
                            <h1><?= $jogo['titulo'] ?></h1>
                            <div class="d-flex justify-content-center mt-3">
                                <span class="badge rounded-pill d-inline-flex align-items-center px-4 py-2" style="background: #F0AD4E; color: white; cursor: pointer">+<span class="me-2 fs-4">🪙</span><?= $jogo["recompensa_capimoedas"];  ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php else: ?>
    <div class="alert alert-info text-center" role="alert">
        Nenhum jogo encontrado. Tente novamente mais tarde.
    </div>
<?php endif; ?>



</body>

</html>