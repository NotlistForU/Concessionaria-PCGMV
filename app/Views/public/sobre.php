<?php
require_once '../app/Views/components/header.php';

// Ícone de check armazenado em variável para manter o código limpo e evitar nomes/SVGs gigantescos no meio do HTML
$iconCheck = '<svg class="am-icon-check" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16">
    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
</svg>';

// Lógica para buscar as imagens do carrossel automaticamente
$carrosselDir = 'assets/img/carrossel';
$imagensCarrossel = [];
if (is_dir($carrosselDir)) {
    $arquivos = scandir($carrosselDir);
    foreach ($arquivos as $arquivo) {
        $extensao = strtolower(pathinfo($arquivo, PATHINFO_EXTENSION));
        // Filtra apenas arquivos de imagem válidos
        if (in_array($extensao, ['jpg', 'jpeg', 'png', 'webp'])) {
            $imagensCarrossel[] = $arquivo;
        }
    }
}
?>

<!-- CSS Componentizado Exclusivo para a página Sobre -->
<style>
    /* =========================================
       1. Comportamento do Ícone (Dark/Light Mode)
       ========================================= */
    .am-icon-check {
        fill: #1C69D4; /* Cor primária no Light Mode */
        transition: fill 0.4s ease; /* Transição suave */
    }
    
    /* Quando o Dark Mode estiver ativo via atributo no HTML */
    [data-bs-theme="dark"] .am-icon-check {
        fill: #FFFFFF; /* Ícone branco para melhor contraste */
    }

    /* =========================================
       2. Estilos da Imagem Principal
       ========================================= */
    .am-img-backdrop {
        position: absolute; 
        top: 2px; 
        right: 0; 
        bottom: 0; 
        left: 2px; 
        background-color: var(--am-blue-light, #eaf2fc); 
        border-radius: 16px; 
        z-index: -1;
        transition: background-color 0.4s ease;
    }
    [data-bs-theme="dark"] .am-img-backdrop {
        background-color: #1a2a40; /* Adaptação suave para modo escuro */
    }

    /* =========================================
       3. Estilos Premium do Carrossel
       ========================================= */
    .am-carousel-container {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }
    .am-carousel-img {
        aspect-ratio: 3 / 4;
        object-fit: cover; /* Evita distorção da imagem */
        width: 100%;
        height: auto;
    }
</style>

<main class="flex-grow-1" style="padding-top: 80px; padding-bottom: 100px;">
    <div class="container px-4 px-lg-5">

        <!-- Header da Página -->
        <div class="row mb-5 text-center reveal">
            <div class="col-12">
                <p class="text-uppercase fw-bold mb-2" style="letter-spacing: 0.15em; color: var(--bs-secondary-color); font-size: 0.85rem;">Nossa História</p>
                <h1 style="font-family: 'Cormorant Garamond', serif; font-size: clamp(2.5rem, 5vw, 4.5rem); font-weight: 700;">
                    Sobre a <strong style="color: #1C69D4;">AutoMotors</strong>
                </h1>
                <p class="mt-4 mx-auto" style="color: var(--bs-secondary-color); font-size: 1.15rem; max-width: 750px; line-height: 1.7;">
                    Nossa missão vai além de entregar veículos de alta performance. Entregamos <strong>experiências de luxo, segurança inabalável e uma relação de confiança</strong> que acompanha você desde o primeiro aperto de mão até a estrada.
                </p>
            </div>
        </div>

        <!-- Seção Principal com Imagem e Texto -->
        <div class="row align-items-center g-5 mt-3 pt-4 mb-5 pb-5 border-bottom border-secondary-subtle">
            <div class="col-lg-6 reveal reveal-delay-1">
                <div style="position: relative; padding-right: 20px; padding-bottom: 20px;">
                    <div class="am-img-backdrop"></div>
                    <img src="assets/img/sobre.png" alt="Equipe de especialistas AutoMotors pronta para oferecer um atendimento exclusivo" class="img-fluid w-100" style="object-fit: cover; border-radius: 16px; box-shadow: 0 8px 24px rgba(0,0,0,0.15);">
                </div>
            </div>

            <div class="col-lg-6 ps-lg-5 reveal reveal-delay-2">
                <h2 style="font-family: 'Cormorant Garamond', serif; font-size: 2.5rem; font-weight: 700; margin-bottom: 24px;">
                    Tradição e Excelência em Cada Detalhe
                </h2>
                
                <p style="line-height: 1.8; color: var(--bs-body-color); font-size: 1.05rem; margin-bottom: 20px;">
                    Na AutoMotors, compreendemos que a aquisição de um veículo premium é a realização de um sonho e a materialização do seu sucesso. Por isso, nossa equipe de consultores é meticulosamente treinada para superar suas expectativas, compreendendo suas necessidades de forma exclusiva e oferecendo um atendimento verdadeiramente consultivo.
                </p>
                
                <p style="line-height: 1.8; color: var(--bs-body-color); font-size: 1.05rem; margin-bottom: 32px;">
                    A <strong>transparência</strong> e a <strong>integridade</strong> são os pilares que sustentam nossa reputação. Cada veículo de nosso showroom é submetido a um rigoroso processo de certificação técnica. Conosco, você tem a absoluta certeza de estar fazendo um investimento seguro e inteligente.
                </p>
                
                <div class="d-flex flex-column gap-3 mt-4">
                    <div class="d-flex align-items-center gap-3">
                        <?= $iconCheck ?>
                        <span style="font-weight: 600; font-size: 1.1rem;">Atendimento Premium e Personalizado</span>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <?= $iconCheck ?>
                        <span style="font-weight: 600; font-size: 1.1rem;">Certificação Rigorosa de 150 Itens</span>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <?= $iconCheck ?>
                        <span style="font-weight: 600; font-size: 1.1rem;">Garantia Absoluta de Procedência</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nova Seção: Confiança e Autoridade + Carrossel -->
        <div class="row pt-4 align-items-center">
            
            <!-- Texto de Confiança (Desktop: 6 colunas, Mobile: 100%) -->
            <div class="col-lg-6 mb-5 mb-lg-0 reveal text-center text-lg-start pe-lg-4">
                <p class="text-uppercase fw-bold mb-2" style="letter-spacing: 0.15em; color: #1C69D4; font-size: 0.85rem;">
                    Autoridade no Mercado
                </p>
                <h2 style="font-family: 'Cormorant Garamond', serif; font-size: clamp(2.2rem, 4vw, 3.2rem); font-weight: 700; line-height: 1.1; margin-bottom: 1.5rem;">
                    Mais de 300 carros vendidos todos os meses
                </h2>
                <p style="color: var(--bs-secondary-color); font-size: 1.15rem; line-height: 1.7;">
                    A confiança não se compra, conquista-se. Com um alto volume de vendas e o mais elevado índice de satisfação de clientes exigentes, nossa reputação é o seu maior aval.
                </p>
                <p style="color: var(--bs-secondary-color); font-size: 1.15rem; line-height: 1.7; margin-bottom: 0;">
                    Escolher a AutoMotors é investir com total credibilidade, segurança e a certeza de ter a maior autoridade do mercado premium lado a lado com você.
                </p>
            </div>

            <!-- Carrossel de Imagens Automático (Desktop: 5 colunas com offset, Mobile: 100%) -->
            <div class="col-lg-5 offset-lg-1 reveal reveal-delay-2">
                <div class="am-carousel-container">
                    <?php if (!empty($imagensCarrossel)): ?>
                        <!-- Bootstrap Carousel (carousel-fade = Transição Suave | data-bs-interval="5000" = 5s | data-bs-touch="true" = Swipe Mobile) -->
                        <div id="carouselSobre" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000" data-bs-touch="true">
                            
                            <!-- Indicadores (Bolinhas) -->
                            <div class="carousel-indicators">
                                <?php foreach ($imagensCarrossel as $index => $imagem): ?>
                                    <button type="button" data-bs-target="#carouselSobre" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>" aria-label="Slide <?= $index + 1 ?>"></button>
                                <?php endforeach; ?>
                            </div>

                            <!-- Imagens Internas -->
                            <div class="carousel-inner">
                                <?php foreach ($imagensCarrossel as $index => $imagem): ?>
                                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                        <img src="<?= $carrosselDir . '/' . htmlspecialchars($imagem) ?>" class="d-block w-100 am-carousel-img" alt="Estrutura e veículos da AutoMotors">
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <!-- Setas de Navegação -->
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselSobre" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: drop-shadow(0 2px 4px rgba(0,0,0,0.5));"></span>
                                <span class="visually-hidden">Anterior</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselSobre" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true" style="filter: drop-shadow(0 2px 4px rgba(0,0,0,0.5));"></span>
                                <span class="visually-hidden">Próximo</span>
                            </button>
                        </div>
                    <?php else: ?>
                        <!-- Fallback visual profissional caso a pasta esteja vazia -->
                        <div class="d-flex align-items-center justify-content-center bg-body-tertiary w-100 am-carousel-img" style="border: 2px dashed var(--bs-border-color);">
                            <div class="text-center p-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="text-muted mb-3" viewBox="0 0 16 16"><path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/><path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"/></svg>
                                <p class="text-muted fw-bold mb-1">Galeria de Imagens</p>
                                <p class="text-muted small">Adicione as fotos na pasta <code>public/assets/img/carrossel</code></p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>

    </div>
</main>

<?php require_once '../app/Views/components/footer.php'; ?>