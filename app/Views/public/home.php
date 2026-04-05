<?php
require_once '../app/Views/components/header.php';

// Puxa TODOS os carros do banco
$todosOsCarros = $controller->listar();

// Pega apenas os 4 primeiros para ser o "Destaque" da Home
// Assim a tela não fica gigante, e o cliente clica em "Modelos" se quiser ver mais
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

<div id="modelos" class="container mt-5 pt-5 mb-5 flex-grow-1">
    <div class="d-flex justify-content-between align-items-end mb-5">
        <h2 style="font-weight: 300; font-size: 2.5rem; color: #262626; margin: 0;">VEÍCULOS EM <span style="font-weight: 700;">DESTAQUE.</span></h2>
        <a href="?pagina=modelos" class="text-muted text-uppercase fw-bold text-decoration-none" style="font-size: 0.85rem; letter-spacing: 1px;">Ver todos os modelos &gt;</a>
    </div>

    <div class="row g-5">

        <?php
        // Faz o loop apenas com os 4 carros de destaque
        if (!empty($destaques)) {
            foreach ($destaques as $carro) {
        ?>
                <div class="col-md-6">
                    <div class="card border-0 bg-transparent rounded-0">
                        <img src="assets/img/<?= htmlspecialchars($carro->getPastaFoto()); ?>/foto_1.png" alt="<?= htmlspecialchars($carro->getModelo()); ?>" style="object-fit: cover; height: 350px; width: 100%;">

                        <div class="card-body px-0 pt-4">
                            <h5 class="card-title fw-bold" style="font-size: 1.8rem; margin-bottom: 5px; text-transform: uppercase;"><?= htmlspecialchars($carro->getModelo()); ?></h5>
                            <p class="card-text text-muted mb-4" style="font-weight: 300; font-size: 1.1rem;"><?= htmlspecialchars($carro->getCategoria()); ?></p>

                            <a href="?pagina=detalhes&id=<?= $carro->getId(); ?>" style="color: #1c69d4; font-weight: 700; text-decoration: none; text-transform: uppercase; letter-spacing: 1px; font-size: 0.9rem;">
                                Descubra mais &gt;
                            </a>
                        </div>
                    </div>
                </div>
        <?php
            } // Fim do foreach
        } else {
            echo "<p class='text-center mt-5'>Nenhum veículo em destaque no momento.</p>";
        }
        ?>

    </div>
</div>

<?php require_once '../app/Views/components/footer.php'; ?>