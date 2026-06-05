<?php
require_once '../app/Views/components/header.php';

// Pega o ID da URL. Se não tiver ID, é nulo.
$id = isset($_GET['id']) ? $_GET['id'] : null;
$carro = null;

if ($id) {
    // Busca o carro no banco de dados!
    $carro = $controller->buscarPorId($id);
    if ($carro) {
        $imagensGaleria = $controller->listarImagensPorVeiculoETipo($carro->getId(), 'foto_3');
    }
}

// Se o usuário digitou um ID que não existe ou apagou da URL
if (!$carro) {
    echo "<div class='container mt-5 pt-5 text-center flex-grow-1'>";
    echo "<h2 class='fw-bold text-uppercase'>Veículo não encontrado.</h2>";
    echo "<a href='?pagina=modelos' class='btn btn-dark mt-4 rounded-0 px-4 py-2'>VOLTAR AOS MODELOS</a>";
    echo "</div>";
    require_once '../app/Views/components/footer.php';
    exit; // Para a execução da página aqui
}
?>

<div class="container mt-5 pt-4 flex-grow-1">

    <div class="row align-items-center mb-5">

        <div class="col-lg-7 text-center mb-4 mb-lg-0">
            <img src="?pagina=obter_imagem&id=<?= $carro->getId(); ?>&tipo=foto_2" alt="<?= htmlspecialchars($carro->getModelo()); ?>" class="img-fluid w-100" style="object-fit: cover;">
        </div>

        <div class="col-lg-5 px-lg-5">
            <p class="text-uppercase text-muted mb-1" style="letter-spacing: 2px; font-size: 0.85rem;"><?= htmlspecialchars($carro->getCategoria()); ?></p>

            <h1 class="display-4 fw-bold mb-1 text-uppercase text-body-emphasis"><?= htmlspecialchars($carro->getModelo()); ?></h1>
            <h3 class="fw-light mb-4 text-uppercase text-body-secondary" style="font-size: 1.5rem;"><?= htmlspecialchars($carro->getVersao()); ?></h3>

            <div class="row text-center mb-4 g-3">
                <div class="col-4 border-end">
                    <h5 class="fw-bold mb-0" style="font-size: 1.1rem;"><?= htmlspecialchars($carro->getPotencia()); ?></h5>
                    <small class="text-muted text-uppercase" style="font-size: 0.65rem; font-weight: 700;">Potência e Torque</small>
                </div>
                <div class="col-4 border-end">
                    <h5 class="fw-bold mb-0" style="font-size: 1.1rem;"><?= htmlspecialchars($carro->getAceleracao()); ?></h5>
                    <small class="text-muted text-uppercase" style="font-size: 0.65rem; font-weight: 700;">0-100 km/h</small>
                </div>
                <div class="col-4">
                    <h5 class="fw-bold mb-0" style="font-size: 1.1rem;"><?= htmlspecialchars($carro->getMotorizacao()); ?></h5>
                    <small class="text-muted text-uppercase" style="font-size: 0.65rem; font-weight: 700;">Motor</small>
                </div>
            </div>

            <h3 class="fw-bold mb-4" style="font-size: 1.8rem;">A partir de R$ <?= number_format($carro->getPreco(), 2, ',', '.'); ?></h3>
            
            <?php if (isset($_GET['erro_cnh'])): ?>
                <div class="alert alert-danger rounded-0 small mb-4">
                    <strong>Ops!</strong> A CNH informada é inválida. Por favor, verifique os dígitos e tente novamente.
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['erro_whatsapp'])): ?>
                <div class="alert alert-danger rounded-0 small mb-4">
                    <strong>Ops!</strong> O número de WhatsApp informado é inválido. Por favor, verifique se inseriu o DDD e o número completo.
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['sucesso'])): ?>
                <div class="alert alert-success rounded-0 small mb-4">
                    <strong>Sucesso!</strong> Seu Test Drive foi agendado. Entraremos em contato em breve.
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['sucesso_compra'])): ?>
                <div class="alert alert-success rounded-0 small mb-4">
                    <strong>Sucesso!</strong> Sua proposta de compra foi enviada. Entraremos em contato em breve.
                </div>
            <?php endif; ?>

            <div class="d-grid gap-3" id="contato">
                <button type="button" class="btn btn-dark rounded-0 py-3 fw-bold text-uppercase" data-bs-toggle="modal" data-bs-target="#modalCompra">
                    Comprar / Reservar
                </button>
                <button type="button" class="btn btn-outline-dark rounded-0 py-3 fw-bold text-uppercase" style="border-width: 2px;" data-bs-toggle="modal" data-bs-target="#modalTestDrive">
                    Agendar Test Drive
                </button>
            </div>

            <!-- MODAL: TEST DRIVE -->
            <div class="modal fade" id="modalTestDrive" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-0 border-0 shadow">
                        <div class="modal-header border-0 px-4 pt-4">
                            <h5 class="modal-title fw-bold text-uppercase">Solicitar <span class="text-primary">Test Drive</span></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="?pagina=processar_agendamento" method="POST">
                            <div class="modal-body px-4 pb-4">
                                <input type="hidden" name="veiculo_id" value="<?= $carro->getId(); ?>">
                                <input type="hidden" name="tipo_agendamento" value="Test Drive">

                                <p class="text-muted small mb-4">Agende um horário para conhecer o <strong><?= htmlspecialchars($carro->getModelo()); ?></strong> de perto.</p>

                                <div class="alert border border-secondary bg-transparent text-body rounded-0 small mb-4 p-3">
                                    <strong>Endereço do Test Drive:</strong><br>
                                    Avenida Calama, 4985 - Flodoaldo Pontes Pinto - Porto Velho/RO
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-uppercase text-muted">Seu Nome</label>
                                    <input type="text" name="nome_cliente" class="form-control rounded-0" placeholder="Nome completo" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-uppercase text-muted">Telefone / WhatsApp</label>
                                    <input type="text" name="telefone" class="form-control rounded-0" placeholder="(00) 00000-0000" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-uppercase text-muted">CNH</label>
                                    <input type="text" name="cnh" class="form-control rounded-0" placeholder="Apenas números (11 dígitos)" pattern="\d{11}" title="A CNH deve conter exatamente 11 números" maxlength="11" required>
                                </div>
                                <div class="mb-0">
                                    <label class="form-label small fw-bold text-uppercase text-muted">Data de Preferência</label>
                                    <input type="date" name="data_interesse" class="form-control rounded-0" value="<?= date('Y-m-d'); ?>" required>
                                </div>
                            </div>
                            <div class="modal-footer border-0 px-4 pb-4 pt-0">
                                <button type="submit" class="btn btn-outline-dark w-100 rounded-0 py-2 fw-bold text-uppercase" style="border-width: 2px;">Confirmar Test Drive</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- MODAL: COMPRA / RESERVA -->
            <div class="modal fade" id="modalCompra" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-0 border-0 shadow">
                        <div class="modal-header border-0 px-4 pt-4">
                            <h5 class="modal-title fw-bold text-uppercase">Proposta de <span class="text-success">Compra</span></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="?pagina=processar_compra" method="POST">
                            <div class="modal-body px-4 pb-4">
                                <input type="hidden" name="veiculo_id" value="<?= $carro->getId(); ?>">

                                <p class="text-muted small mb-4">Excelente escolha. Preencha os dados abaixo para darmos andamento na compra do seu <strong><?= htmlspecialchars($carro->getModelo()); ?></strong>.</p>
                                
                                <div class="alert border border-secondary bg-transparent text-body rounded-0 small mb-4 p-3">
                                    <strong>Retirada do Veículo:</strong><br>
                                    Avenida Calama, 4985 - Flodoaldo Pontes Pinto - Porto Velho/RO
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-uppercase text-muted">Seu Nome</label>
                                    <input type="text" name="nome_cliente" class="form-control rounded-0" placeholder="Nome completo" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-uppercase text-muted">Telefone / WhatsApp</label>
                                    <input type="text" name="telefone" class="form-control rounded-0" placeholder="(00) 00000-0000" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-uppercase text-muted">Forma de Pagamento</label>
                                    <select name="forma_pagamento" class="form-select rounded-0" required>
                                        <option value="">Selecione...</option>
                                        <option value="A Vista">À Vista</option>
                                        <option value="Financiamento">Financiamento Bancário</option>
                                        <option value="Consorcio">Carta de Consórcio</option>
                                    </select>
                                </div>
                                <div class="mb-0">
                                    <label class="form-label small fw-bold text-uppercase text-muted">Possui veículo na troca?</label>
                                    <select name="tem_troca" class="form-select rounded-0" required>
                                        <option value="Nao">Não</option>
                                        <option value="Sim">Sim, tenho interesse em dar de entrada</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer border-0 px-4 pb-4 pt-0">
                                <button type="submit" class="btn btn-dark w-100 rounded-0 py-2 fw-bold text-uppercase">Enviar Proposta de Compra</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5 pt-5 border-top">
        <div class="col-12 text-center mb-5">
            <h2 class="fw-bold text-uppercase" style="font-weight: 300; font-size: 2.5rem;">Descubra os <span style="font-weight: 700;">Detalhes.</span></h2>
        </div>

        <div class="col-lg-8 mx-auto mb-5 px-lg-4 text-center">
            <?php if (!empty($imagensGaleria)): ?>
                <?php if (count($imagensGaleria) > 1): ?>
                    <div id="carouselDetalhes" class="carousel slide carousel-fade shadow-lg rounded mb-4 overflow-hidden" data-bs-ride="carousel" style="max-height: 500px;">
                        <div class="carousel-indicators" style="bottom: 15px;">
                            <?php foreach ($imagensGaleria as $index => $img): ?>
                                <button type="button" data-bs-target="#carouselDetalhes" data-bs-slide-to="<?= $index; ?>" class="<?= $index === 0 ? 'active' : ''; ?>" aria-current="<?= $index === 0 ? 'true' : 'false'; ?>" aria-label="Slide <?= $index + 1; ?>" style="width: 10px; height: 10px; border-radius: 50%; margin: 0 5px; background-color: #ffffff; opacity: <?= $index === 0 ? '1' : '0.5'; ?>; border: none; transition: opacity 0.3s ease;"></button>
                            <?php endforeach; ?>
                        </div>
                        <div class="carousel-inner" style="height: 100%; max-height: 500px;">
                            <?php foreach ($imagensGaleria as $index => $img): ?>
                                <div class="carousel-item <?= $index === 0 ? 'active' : ''; ?>" style="height: 500px; background-color: #121212;">
                                    <img src="?pagina=obter_imagem_por_id&id=<?= $img['id']; ?>" class="d-block w-100 h-100" style="object-fit: cover;" alt="Interior Veículo - Slide <?= $index + 1; ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselDetalhes" data-bs-slide="prev" style="width: 10%; filter: drop-shadow(0px 2px 4px rgba(0,0,0,0.3));">
                            <span class="carousel-control-prev-icon-custom d-flex align-items-center justify-content-center" style="background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.25); border-radius: 50%; width: 45px; height: 45px; transition: all 0.3s ease; color: #ffffff;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                  <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                </svg>
                            </span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselDetalhes" data-bs-slide="next" style="width: 10%; filter: drop-shadow(0px 2px 4px rgba(0,0,0,0.3));">
                            <span class="carousel-control-next-icon-custom d-flex align-items-center justify-content-center" style="background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.25); border-radius: 50%; width: 45px; height: 45px; transition: all 0.3s ease; color: #ffffff;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                  <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </span>
                        </button>
                    </div>
                    <style>
                        .carousel-control-prev:hover .carousel-control-prev-icon-custom,
                        .carousel-control-next:hover .carousel-control-next-icon-custom {
                            background: rgba(255, 255, 255, 0.35) !important;
                            transform: scale(1.1);
                        }
                        .carousel-indicators button:hover {
                            opacity: 0.8 !important;
                        }
                    </style>
                <?php else: ?>
                    <img src="?pagina=obter_imagem_por_id&id=<?= $imagensGaleria[0]['id']; ?>" class="img-fluid w-100 rounded mb-4 shadow-sm" style="max-height: 500px; object-fit: cover;" alt="Interior">
                <?php endif; ?>
            <?php else: ?>
                <!-- Fallback antigo caso não haja imagens com obter_imagem -->
                <img src="?pagina=obter_imagem&id=<?= $carro->getId(); ?>&tipo=foto_3" class="img-fluid w-100 rounded mb-4 shadow-sm" style="max-height: 500px; object-fit: cover;" alt="Interior">
            <?php endif; ?>
            <h4 class="fw-bold text-uppercase mb-3" style="font-size: 1.2rem;">Tecnologia e Interior</h4>
            <p class="text-muted mx-auto" style="line-height: 1.8; font-weight: 300; max-width: 800px;">
                <?= htmlspecialchars($carro->getDescricaoInterior()); ?>
            </p>
        </div>
    </div>

</div>

<?php require_once '../app/Views/components/footer.php'; ?>