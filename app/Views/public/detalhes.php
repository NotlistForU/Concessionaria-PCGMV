<?php
require_once '../app/Views/components/header.php';

// Pega o ID da URL. Se não tiver ID, é nulo.
$id = isset($_GET['id']) ? $_GET['id'] : null;
$carro = null;

if ($id) {
    // Busca o carro no banco de dados!
    $carro = $controller->buscarPorId($id);
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
            <img src="assets/img/<?= htmlspecialchars($carro->getPastaFoto()); ?>/foto_2.png" alt="<?= htmlspecialchars($carro->getModelo()); ?>" class="img-fluid w-100" style="object-fit: cover;">
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

        <div class="col-md-6 mb-5 px-lg-4">
            <img src="assets/img/<?= htmlspecialchars($carro->getPastaFoto()); ?>/foto_3.png" class="img-fluid w-100 mb-4" alt="Exterior">
            <h4 class="fw-bold text-uppercase mb-3" style="font-size: 1.2rem;">Design Exterior</h4>
            <p class="text-muted" style="line-height: 1.8; font-weight: 300;">
                <?= htmlspecialchars($carro->getDescricaoExterior()); ?>
            </p>
        </div>

        <div class="col-md-6 mb-5 px-lg-4">
            <img src="assets/img/<?= htmlspecialchars($carro->getPastaFoto()); ?>/3.jpg" class="img-fluid w-100 mb-4" alt="Interior">
            <h4 class="fw-bold text-uppercase mb-3" style="font-size: 1.2rem;">Tecnologia e Interior</h4>
            <p class="text-muted" style="line-height: 1.8; font-weight: 300;">
                <?= htmlspecialchars($carro->getDescricaoInterior()); ?>
            </p>
        </div>
    </div>

</div>

<?php require_once '../app/Views/components/footer.php'; ?>