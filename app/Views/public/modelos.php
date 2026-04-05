<?php
require_once '../app/Views/components/header.php';

// Puxa a lista de carros do banco usando o seu Controller!
$listaDeCarros = $controller->listar();
?>

<div class="container mt-5 pt-4 flex-grow-1">
    <div class="row mb-5">
        <div class="col-12">
            <h1 style="font-weight: 300; font-size: 3rem; text-transform: uppercase;">Todos os <br><span style="font-weight: 700;">Modelos.</span></h1>
            <p class="text-muted mt-3">Explore nossa linha completa de veículos premium.</p>
        </div>
    </div>

    <div class="row g-5">

        <?php

        // Se tiver carros, faz o loop!
        if (!empty($listaDeCarros)) {
            foreach ($listaDeCarros as $carro) {
        ?>

                <div class="col-md-4">
                    <div class="card car-card">
                        <img src="assets/img/<?= htmlspecialchars($carro->getPastaFoto()); ?>/foto_1.png" alt="<?= htmlspecialchars($carro->getModelo()); ?>">

                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($carro->getModelo()); ?></h5>
                            <p class="card-text text-muted mb-1"><?= htmlspecialchars($carro->getVersao()); ?></p>
                            <p class="card-text fw-bold">R$ <?= number_format($carro->getPreco(), 2, ',', '.'); ?></p>

                            <a href="?pagina=detalhes&id=<?= $carro->getId(); ?>" class="btn-link-custom">Configurar &gt;</a>
                        </div>
                    </div>
                </div>
        <?php
            } // Fim do foreach
        } else {
            echo "<p class='text-center mt-5'>Nenhum veículo encontrado no estoque.</p>";
        }
        ?>

    </div>
</div>

<?php require_once '../app/Views/components/footer.php'; ?>