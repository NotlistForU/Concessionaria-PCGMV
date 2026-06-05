<?php
require_once '../app/Views/components/header.php';

// Puxa TODOS os carros do banco e recorta os 4 primeiros
$todosOsCarros = $controller->listar();
$destaques = array_slice($todosOsCarros, 0, 4);
?>

<section class="hero" style="background-image: url('assets/img/foto_1.png'); background-size: cover; background-position: center; height: 85vh; position: relative; display: flex; align-items: center;">
    <div class="hero-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to right, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.1) 100%);"></div>
    <div class="container-fluid px-5 hero-content" style="position: relative; z-index: 2; color: #ffffff;">
        <div class="row">
            <div class="col-lg-6">
                <h1 style="font-size: 4.5rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; line-height: 1.1;">Puro<br>Prazer.</h1>
                <p class="mt-3 mb-4" style="font-weight: 300; font-size: 1.5rem;">Descubra a nova linha de sedans esportivos.</p>
                <a href="?pagina=modelos" class="btn btn-outline-light rounded-0 py-3 px-5 fw-bold text-uppercase" style="letter-spacing: 2px;">Ver Estoque</a>
            </div>
        </div>
    </div>
</section>

<div id="destaques" class="container-fluid px-0 mt-5 pt-5 mb-5 flex-grow-1">

    <div class="container mb-5">
        <h2 class="text-center" style="font-weight: 300; font-size: 2.5rem; color: #262626; margin: 0;">VEÍCULOS EM <span style="font-weight: 700;">DESTAQUE.</span></h2>
    </div>

    <?php
    if (!empty($destaques)) {
        $contador = 0;
        foreach ($destaques as $carro) {
            // Se o contador for par, a imagem fica na esquerda. Se for ímpar, fica na direita (flex-lg-row-reverse)
            $direcao_linha = ($contador % 2 == 0) ? '' : 'flex-lg-row-reverse text-lg-end';
    ?>

            <div class="card border-0 bg-transparent rounded-0 mb-5 pb-5 position-relative">
                <div class="container">
                    <div class="row align-items-center <?= $direcao_linha; ?>">

                        <div class="col-lg-8 mb-4 mb-lg-0">
                            <?php $img1 = $controller->obterImagemPorVeiculoETipo($carro->getId(), 'foto_1'); ?>
                            <img src="<?= $img1 ? htmlspecialchars($img1['caminho_arquivo']) : 'assets/img/default.jpg'; ?>" alt="<?= htmlspecialchars($carro->getModelo()); ?>" class="w-100 shadow-sm" style="object-fit: cover; height: 500px;">
                        </div>

                        <div class="col-lg-4 px-lg-5">
                            <p class="text-muted text-uppercase mb-2" style="font-weight: 600; letter-spacing: 2px; font-size: 0.85rem;">
                                <?= htmlspecialchars($carro->getCategoria()); ?>
                            </p>

                            <h3 class="display-5 fw-bold text-uppercase mb-3">
                                <?= htmlspecialchars($carro->getModelo()); ?>
                            </h3>

                            <p class="text-muted mb-4" style="font-weight: 300; font-size: 1.1rem; line-height: 1.6;">
                                <?= htmlspecialchars(mb_strimwidth($carro->getDescricaoExterior(), 0, 120, "...")); ?>
                            </p>

                            <a href="?pagina=detalhes&id=<?= $carro->getId(); ?>" class="stretched-link" style="color: #1c69d4; font-weight: 700; text-decoration: none; text-transform: uppercase; letter-spacing: 1px; font-size: 0.95rem;">
                                Descubra mais &gt;
                            </a>
                        </div>

                    </div>
                </div>
            </div>
    <?php
            $contador++;
        } // Fim do foreach
    } else {
        echo "<p class='text-center mt-5'>Nenhum veículo em destaque no momento.</p>";
    }
    ?>

</div>

<div class="container text-center mb-5 pb-5 border-bottom">
    <a href="?pagina=modelos" class="btn btn-dark rounded-0 py-3 px-5 fw-bold text-uppercase" style="letter-spacing: 1px;">
        VER TODOS OS MODELOS
    </a>
</div>

<?php require_once '../app/Views/components/footer.php'; ?>