<?php
require_once '../app/Views/components/header.php';

// Puxa a lista de carros do banco usando o seu Controller!
// Nota para o Backend: O controller precisará ler $_GET['busca'] e $_GET['categoria']
$listaDeCarros = $controller->listar();
?>

<div class="container mt-5 pt-4 flex-grow-1">
    <div class="row mb-5">
        <div class="col-12">
            <h1 style="font-weight: 300; font-size: clamp(2rem, 5vw, 3rem); text-transform: uppercase;">Todos os <br><span style="font-weight: 700;">Modelos.</span></h1>
            <p class="text-muted mt-3">Explore nossa linha completa de veículos premium.</p>
        </div>
    </div>

    <?php if (!empty($_GET['modelo']) || !empty($_GET['categoria']) || (!empty($_GET['preco']) && $_GET['preco'] != '1500000')): ?>
    <div class="row mb-4">
        <div class="col-12 d-flex align-items-center flex-wrap gap-2">
            <span class="text-muted small fw-bold text-uppercase me-2">Filtros ativos:</span>
            
            <?php if (!empty($_GET['modelo'])): ?>
                <span class="badge bg-dark rounded-0 px-3 py-2 fw-normal" style="font-size: 0.85rem; letter-spacing: 1px;">
                    Modelo: <?= htmlspecialchars($_GET['modelo']) ?>
                </span>
            <?php endif; ?>

            <?php if (!empty($_GET['categoria'])): ?>
                <span class="badge bg-dark rounded-0 px-3 py-2 fw-normal" style="font-size: 0.85rem; letter-spacing: 1px;">
                    Categoria: <?= htmlspecialchars($_GET['categoria']) ?>
                </span>
            <?php endif; ?>

            <?php if (!empty($_GET['preco']) && $_GET['preco'] != '1500000'): ?>
                <span class="badge bg-dark rounded-0 px-3 py-2 fw-normal" style="font-size: 0.85rem; letter-spacing: 1px;">
                    Até R$ <?= number_format($_GET['preco'], 0, ',', '.') ?>
                </span>
            <?php endif; ?>

            <a href="?pagina=modelos" class="text-danger small ms-2 text-decoration-none fw-bold text-uppercase" style="letter-spacing: 1px;">Limpar Tudo &times;</a>
        </div>
    </div>
    <?php endif; ?>

    <div class="row g-5">
        
        <!-- BARRA LATERAL DE FILTROS (FRONTEND PRONTO) -->
        <div class="col-lg-3">
            <div class="card bg-body-tertiary rounded-0 border-0 shadow-sm p-4 filter-card">
                <h4 class="fw-bold mb-4 text-uppercase" style="font-size: 1.1rem; letter-spacing: 1px;">Refinar Busca</h4>
                
                <form action="index.php" method="GET">
                    <input type="hidden" name="pagina" value="modelos">
                    
                    <div class="mb-4">
                        <label class="form-label text-muted small fw-bold text-uppercase">Pesquisar Modelo</label>
                        <input type="text" name="modelo" class="form-control rounded-0" placeholder="Ex: Serie 3, X1, 320i" value="<?= isset($_GET['modelo']) ? htmlspecialchars($_GET['modelo']) : '' ?>">
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted small fw-bold text-uppercase">Categoria</label>
                        <select name="categoria" class="form-select rounded-0">
                            <option value="">Todas as Categorias</option>
                            <option value="Sedan" <?= (isset($_GET['categoria']) && $_GET['categoria'] == 'Sedan') ? 'selected' : '' ?>>Sedan</option>
                            <option value="Hatch" <?= (isset($_GET['categoria']) && $_GET['categoria'] == 'Hatch') ? 'selected' : '' ?>>Hatch</option>
                            <option value="Coupé" <?= (isset($_GET['categoria']) && $_GET['categoria'] == 'Coupé') ? 'selected' : '' ?>>Coupé</option>
                            <option value="Conversível" <?= (isset($_GET['categoria']) && $_GET['categoria'] == 'Conversível') ? 'selected' : '' ?>>Conversível</option>
                            <option value="SUV" <?= (isset($_GET['categoria']) && $_GET['categoria'] == 'SUV') ? 'selected' : '' ?>>SUV / SAV / SAC</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted small fw-bold text-uppercase d-flex justify-content-between">
                            <span>Preço Máximo</span>
                            <span id="precoValor" class="text-body-emphasis">
                                R$ <?= isset($_GET['preco']) ? number_format($_GET['preco'], 0, ',', '.') : '1.500.000' ?>
                            </span>
                        </label>
                        <input type="range" class="form-range" name="preco" min="100000" max="1500000" step="50000" 
                               value="<?= isset($_GET['preco']) ? htmlspecialchars($_GET['preco']) : '1500000' ?>" 
                               oninput="document.getElementById('precoValor').innerText = 'R$ ' + parseInt(this.value).toLocaleString('pt-BR')">
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-dark rounded-0 py-2 fw-bold text-uppercase" style="letter-spacing: 1px; font-size: 0.85rem;">Aplicar Filtros</button>
                        <a href="?pagina=modelos" class="btn btn-outline-secondary rounded-0 py-2 fw-bold text-uppercase" style="letter-spacing: 1px; font-size: 0.85rem;">Limpar</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- LISTAGEM DOS VEÍCULOS -->
        <div class="col-lg-9">
            <div class="row g-4">
                <?php
                // Se tiver carros, faz o loop!
                if (!empty($listaDeCarros)) {
                    foreach ($listaDeCarros as $carro) {
                ?>
                        <div class="col-md-6 col-xl-4">
                            <div class="card car-card" onclick="window.location.href='?pagina=detalhes&id=<?= $carro->getId(); ?>'" style="cursor: pointer;">
                                <?php $img1 = $controller->obterImagemPorVeiculoETipo($carro->getId(), 'foto_1'); ?>
                                <img src="<?= $img1 ? htmlspecialchars($img1['caminho_arquivo']) : 'assets/img/default.jpg'; ?>" alt="<?= htmlspecialchars($carro->getModelo()); ?>">

                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($carro->getModelo()); ?></h5>
                                    <p class="card-text text-muted mb-1"><?= htmlspecialchars($carro->getVersao()); ?></p>
                                    <p class="card-text fw-bold">R$ <?= number_format($carro->getPreco(), 2, ',', '.'); ?></p>

                                    <a href="?pagina=detalhes&id=<?= $carro->getId(); ?>" class="btn-link-custom">Saiba mais &gt;</a>
                                </div>
                            </div>
                        </div>
                <?php
                    } // Fim do foreach
                } else {
                    echo "<div class='col-12'><p class='text-center mt-5 fs-5 text-muted'>Nenhum veículo encontrado para esta busca.</p></div>";
                }
                ?>
            </div>
        </div>

    </div>
</div>

<?php require_once '../app/Views/components/footer.php'; ?>