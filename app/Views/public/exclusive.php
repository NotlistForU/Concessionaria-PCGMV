<?php
// Certifique-se de que o backend envia a variável $listaExclusivos
// a partir do Controller (ex: $listaExclusivos = $controller->listarExclusivos();)
require_once '../app/Views/components/header.php';
?>

<!-- Estilos Customizados para a Página Exclusive -->
<style>
    body {
        background-color: #0a0a0a !important; /* Fundo super escuro */
        color: #f1f1f1 !important;
    }
    
    /* Para forçar a navbar a ficar dark também, já que a página toda é escura */
    .navbar {
        background-color: #050505 !important;
        border-bottom: 1px solid #222 !important;
    }
    
    .navbar .nav-link, .navbar-brand {
        color: #eee !important;
    }

    .exclusive-hero {
        height: 60vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        border-bottom: 1px solid #222;
        background: radial-gradient(circle at center, #1a1a1a 0%, #0a0a0a 100%);
    }

    .exclusive-title {
        font-family: 'Playfair Display', 'Times New Roman', serif; /* Vibe Clássica/Restaurante de Luxo */
        font-size: 4.5rem;
        letter-spacing: 8px;
        text-transform: uppercase;
        font-weight: 400;
        margin-bottom: 20px;
        color: #ffffff;
    }

    .car-showcase {
        padding: 120px 0;
        border-bottom: 1px solid #1f1f1f;
    }

    .car-title {
        font-family: 'Playfair Display', 'Times New Roman', serif;
        font-size: 3.5rem;
        font-weight: 400;
        color: #fff;
        margin-bottom: 15px;
    }

    .car-spec-label {
        font-size: 0.75rem;
        letter-spacing: 3px;
        color: #666;
        text-transform: uppercase;
        margin-bottom: 5px;
    }

    .car-spec-value {
        font-size: 1.4rem;
        font-weight: 300;
        color: #d4af37; /* Dourado luxuoso */
        margin-bottom: 25px;
    }

    .btn-gold {
        display: inline-block;
        background-color: transparent;
        color: #d4af37;
        border: 1px solid #d4af37;
        padding: 15px 45px;
        letter-spacing: 3px;
        text-transform: uppercase;
        font-size: 0.8rem;
        transition: all 0.4s ease;
        text-decoration: none;
    }

    .btn-gold:hover {
        background-color: #d4af37;
        color: #000;
    }

    .img-luxury {
        filter: drop-shadow(0px 20px 30px rgba(0,0,0,0.8));
        transition: transform 0.8s ease;
    }

    .img-luxury:hover {
        transform: scale(1.02);
    }
</style>

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
                    <img src="assets/img/<?= htmlspecialchars($carro->getPastaFoto()) ?>/foto_2.png" alt="<?= htmlspecialchars($carro->getModelo()) ?>" class="img-fluid w-100 img-luxury">
                </div>
                
                <div class="col-lg-5 <?= ($index % 2 !== 0) ? 'pe-lg-5 text-end' : 'ps-lg-5' ?>">
                    <p class="text-uppercase mb-1" style="color: #666; letter-spacing: 2px; font-size: 0.85rem;">
                        <?= htmlspecialchars($carro->getCategoria()) ?>
                    </p>
                    <h2 class="car-title"><?= htmlspecialchars($carro->getModelo()) ?></h2>
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
