<?php
// Certifique-se de que o backend envia a variável $listaExclusivos
// a partir do Controller (ex: $listaExclusivos = $controller->listarExclusivos();)
require_once '../app/Views/components/header.php';
?>

<!-- Estilos Customizados para a Página Exclusive agora estão no style.css -->
<script>document.body.classList.add('page-exclusive');</script>

<div class="exclusive-hero mt-5">
    <div>
        <h1 class="exclusive-title">La Collection</h1>
        <p class="text-uppercase" style="letter-spacing: 4px; color: #888; font-size: 0.95rem;">O ápice da engenharia automotiva e design.</p>
    </div>
</div>

<div class="container pb-5">
    <?php if (!empty($listaExclusivos)): ?>
        <?php foreach ($listaExclusivos as $index => $carro): ?>
            <!-- Alterna a posição da imagem (Esquerda/Direita) a cada carro para dar dinamismo -->
            <div class="row car-showcase align-items-center <?= ($index % 2 !== 0) ? 'flex-row-reverse' : '' ?>">
                
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <img src="?pagina=obter_imagem&id=<?= $carro->getId() ?>&tipo=foto_2" alt="<?= htmlspecialchars($carro->getModelo()) ?>" class="img-fluid w-100 img-luxury">
                </div>
                
                <div class="col-lg-5 <?= ($index % 2 !== 0) ? 'pe-lg-5 text-end' : 'ps-lg-5' ?>">
                    <p class="text-uppercase mb-1" style="color: #666; letter-spacing: 2px; font-size: 0.85rem;">
                        <?= htmlspecialchars($carro->getCategoria()) ?>
                    </p>
                    <h2 class="exclusive-car-title"><?= htmlspecialchars($carro->getModelo()) ?></h2>
                    <p style="color: #999; font-weight: 300; line-height: 1.9; font-size: 1.1rem; margin-bottom: 40px;">
                        <?= htmlspecialchars($carro->getDescricaoExterior()) ?>
                    </p>
                    
                    <div class="row mb-5 <?= ($index % 2 !== 0) ? 'justify-content-end text-end' : '' ?>">
                        <div class="col-auto <?= ($index % 2 !== 0) ? 'ms-4' : 'me-4' ?>">
                            <div class="car-spec-label">Motor</div>
                            <div class="car-spec-value"><?= htmlspecialchars($carro->getMotorizacao()) ?></div>
                        </div>
                        <div class="col-auto <?= ($index % 2 !== 0) ? 'ms-4' : 'me-4' ?>">
                            <div class="car-spec-label">Potência</div>
                            <div class="car-spec-value"><?= htmlspecialchars($carro->getPotencia()) ?></div>
                        </div>
                        <div class="col-auto">
                            <div class="car-spec-label">0-100 km/h</div>
                            <div class="car-spec-value"><?= htmlspecialchars($carro->getAceleracao()) ?></div>
                        </div>
                    </div>

                    <a href="?pagina=detalhes&id=<?= $carro->getId() ?>" class="btn-gold">Consultar Disponibilidade</a>
                </div>

            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="text-center py-5 my-5">
            <h3 style="font-family: 'Times New Roman', serif; color: #555; font-weight: 300;">Nosso acervo exclusivo está sendo preparado.</h3>
            <p style="color: #444; letter-spacing: 2px; text-transform: uppercase; font-size: 0.85rem; margin-top: 20px;">Retorne em breve para conhecer as obras de arte.</p>
        </div>
    <?php endif; ?>
</div>

<?php require_once '../app/Views/components/footer.php'; ?>
