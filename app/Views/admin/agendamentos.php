<?php
require_once '../app/Views/components/header.php';
?>

<div class="container-fluid flex-grow-1 d-flex flex-column bg-white">
    <div class="row flex-grow-1">
        
        <!-- Menu Lateral Admin -->
        <div class="col-md-2 bg-light p-4 border-end">
            <h5 class="text-uppercase fw-bold mb-4" style="letter-spacing: 2px; font-size: 0.9rem; color: #666;">Painel Admin</h5>
            <ul class="nav flex-column gap-2">
                <li class="nav-item">
                    <a class="nav-link text-dark fw-bold px-3" href="?pagina=painel">Estoque de Veículos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link bg-dark rounded fw-bold px-3 shadow-sm" style="color: #ffffff !important;" href="?pagina=agendamentos">Leads & Propostas</a>
                </li>
                <li class="nav-item mt-5">
                    <a class="nav-link text-danger fw-bold px-3" href="?pagina=home">&larr; Voltar ao Site</a>
                </li>
            </ul>
        </div>

        <!-- Conteúdo Principal -->
        <div class="col-md-10 p-5">
            <style>
                .nav-pills .nav-link.active {
                    background-color: #111 !important;
                    color: #fff !important;
                    border: 1px solid #111 !important;
                }
                .nav-pills .nav-link {
                    color: #555 !important;
                    background-color: #f8f9fa !important;
                    border: 1px solid #ddd !important;
                }
                .nav-pills .nav-link:not(.active):hover {
                    background-color: #e9ecef !important;
                }
            </style>

            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                <h2 class="fw-bold text-uppercase m-0" style="font-size: 2rem; color: #111;">Leads & Propostas</h2>
            </div>

            <ul class="nav nav-pills mb-4 gap-3" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold text-uppercase px-4 py-2 rounded-0" id="compras-tab" data-bs-toggle="tab" data-bs-target="#compras" type="button" role="tab" style="letter-spacing: 1px;">Propostas de Compra</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold text-uppercase px-4 py-2 rounded-0" id="testdrive-tab" data-bs-toggle="tab" data-bs-target="#testdrive" type="button" role="tab" style="letter-spacing: 1px;">Test Drives</button>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <!-- ABA COMPRAS -->
                <div class="tab-pane fade show active" id="compras" role="tabpanel">
                    <div class="card rounded-0 shadow-sm" style="border: 1px solid #eee;">
                        <div class="card-body p-0">
                            <table class="table table-hover align-middle mb-0">
                                <thead style="background-color: #f8f9fa;">
                                    <tr>
                                        <th class="py-3 px-4 fw-bold text-uppercase text-muted border-bottom" style="font-size: 0.75rem; letter-spacing: 1px;">Data</th>
                                        <th class="py-3 px-4 fw-bold text-uppercase text-muted border-bottom" style="font-size: 0.75rem; letter-spacing: 1px;">Cliente</th>
                                        <th class="py-3 px-4 fw-bold text-uppercase text-muted border-bottom" style="font-size: 0.75rem; letter-spacing: 1px;">Veículo de Interesse</th>
                                        <th class="py-3 px-4 fw-bold text-uppercase text-muted border-bottom" style="font-size: 0.75rem; letter-spacing: 1px;">Forma de Pagto.</th>
                                        <th class="py-3 px-4 fw-bold text-uppercase text-muted border-bottom" style="font-size: 0.75rem; letter-spacing: 1px;">Tem Troca?</th>
                                        <th class="py-3 px-4 fw-bold text-uppercase text-muted border-bottom" style="font-size: 0.75rem; letter-spacing: 1px;">Status</th>
                                        <th class="py-3 px-4 fw-bold text-uppercase text-muted border-bottom text-end" style="font-size: 0.75rem; letter-spacing: 1px;">Contato</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($listaCompras)): ?>
                                        <?php foreach ($listaCompras as $compra): ?>
                                            <tr>
                                                <td class="py-3 px-4"><?= date('d/m/Y H:i', strtotime($compra['data_solicitacao'])) ?></td>
                                                <td class="py-3 px-4 fw-bold"><?= htmlspecialchars($compra['nome_cliente']) ?></td>
                                                <td class="py-3 px-4 text-primary fw-bold">
                                                    <?= htmlspecialchars($compra['modelo']) ?> <span class="text-muted fw-normal"><?= htmlspecialchars($compra['versao']) ?></span>
                                                </td>
                                                <td class="py-3 px-4"><?= htmlspecialchars($compra['forma_pagamento']) ?></td>
                                                <td class="py-3 px-4">
                                                    <?php if ($compra['tem_troca'] == 'Sim'): ?>
                                                        <span class="badge bg-warning text-dark">Sim</span>
                                                    <?php else: ?>
                                                        <span class="text-muted">Não</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="py-3 px-4">
                                                    <span class="badge bg-success rounded-0 px-2 py-1"><?= htmlspecialchars($compra['status']) ?></span>
                                                </td>
                                                <td class="py-3 px-4 text-end">
                                                    <a href="https://wa.me/55<?= preg_replace('/[^0-9]/', '', $compra['telefone']) ?>" target="_blank" class="btn btn-sm btn-outline-success rounded-0 fw-bold">WhatsApp</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center py-5 text-muted">Nenhuma proposta de compra registrada.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- ABA TEST DRIVES -->
                <div class="tab-pane fade" id="testdrive" role="tabpanel">
                    <div class="card rounded-0 shadow-sm" style="border: 1px solid #eee;">
                        <div class="card-body p-0">
                            <table class="table table-hover align-middle mb-0">
                                <thead style="background-color: #f8f9fa;">
                                    <tr>
                                        <th class="py-3 px-4 fw-bold text-uppercase text-muted border-bottom" style="font-size: 0.75rem; letter-spacing: 1px;">Solicitado em</th>
                                        <th class="py-3 px-4 fw-bold text-uppercase text-muted border-bottom" style="font-size: 0.75rem; letter-spacing: 1px;">Cliente</th>
                                        <th class="py-3 px-4 fw-bold text-uppercase text-muted border-bottom" style="font-size: 0.75rem; letter-spacing: 1px;">Veículo Desejado</th>
                                        <th class="py-3 px-4 fw-bold text-uppercase text-muted border-bottom" style="font-size: 0.75rem; letter-spacing: 1px;">Data do Teste</th>
                                        <th class="py-3 px-4 fw-bold text-uppercase text-muted border-bottom text-end" style="font-size: 0.75rem; letter-spacing: 1px;">Contato</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($listaAgendamentos)): ?>
                                        <?php foreach ($listaAgendamentos as $agenda): ?>
                                            <tr>
                                                <td class="py-3 px-4 text-muted small">ID #<?= $agenda['id'] ?></td>
                                                <td class="py-3 px-4 fw-bold"><?= htmlspecialchars($agenda['nome_cliente']) ?></td>
                                                <td class="py-3 px-4">
                                                    <strong><?= htmlspecialchars($agenda['modelo']) ?></strong> <span class="text-muted"><?= htmlspecialchars($agenda['versao']) ?></span>
                                                </td>
                                                <td class="py-3 px-4">
                                                    <span class="badge bg-dark rounded-0 px-3 py-2 fw-normal" style="font-size: 0.9rem; letter-spacing: 1px;">
                                                        <?= date('d/m/Y', strtotime($agenda['data_interesse'])) ?>
                                                    </span>
                                                </td>
                                                <td class="py-3 px-4 text-end">
                                                    <a href="https://wa.me/55<?= preg_replace('/[^0-9]/', '', $agenda['telefone']) ?>" target="_blank" class="btn btn-sm btn-outline-success rounded-0 fw-bold">WhatsApp</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center py-5 text-muted">Nenhum test drive agendado.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<?php require_once '../app/Views/components/footer.php'; ?>