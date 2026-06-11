<?php
require_once '../app/Views/components/header.php';
?>

<div class="container-fluid flex-grow-1 d-flex flex-column">
    <div class="row flex-grow-1">

        <!-- Menu Lateral Admin -->
        <div class="col-md-2 bg-body-tertiary p-4 border-end border-opacity-10 admin-sidebar">
            <h5 class="text-uppercase fw-bold mb-4 text-body-secondary" style="letter-spacing: 2px; font-size: 0.85rem;">Painel Admin</h5>
            <ul class="nav flex-column gap-2">
                <li class="nav-item">
                    <a class="nav-link text-body fw-medium px-3 py-2 rounded-3" href="?pagina=painel" style="transition: all 0.3s ease;">Estoque de Veículos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-bg-primary fw-bold px-3 py-2 rounded-3 shadow-sm" href="?pagina=agendamentos" style="transition: all 0.3s ease;">Leads & Propostas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-bg-secondary fw-bold px-3 py-2 rounded-3 shadow-sm" href="?pagina=register-admin" style="transition: all 0.3s ease;">Registrar Funcionario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-bg-danger fw-bold px-3 py-2 rounded-3 shadow-sm" href="?pagina=logout" style="transition: all 0.3s ease;">Logout</a>
                </li>
                <li class="nav-item mt-5">
                    <a class="nav-link text-danger fw-bold px-3 py-2 rounded-3" href="?pagina=home" style="transition: all 0.3s ease;">&larr; Voltar ao Site</a>
                </li>
                <li class="nav-item mt-5">
                    <a class="nav-link small  px-3 py-2 rounded-3" href="?pagina=backup-db" style="transition: all 0.3s ease;">
                        <small>
                            Backup do banco de dados
                        </small>
                    </a>
                </li>

            </ul>
        </div>

        <!-- Conteúdo Principal -->
        <div class="col-md-10 p-3 p-md-5">


            <div class="d-flex flex-column gap-3 flex-md-row justify-content-md-between align-items-md-end mb-4 pb-2">
                <div>
                    <h2 class="fw-bold text-uppercase m-0" style="font-size: 2rem; letter-spacing: -0.5px;">Leads & Propostas</h2>
                    <p class="text-body-secondary mt-2 mb-0">Gerencie todas as solicitações de clientes e agendamentos.</p>
                </div>
            </div>

            <ul class="nav admin-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="compras-tab" data-bs-toggle="tab" data-bs-target="#compras" type="button" role="tab">Propostas de Compra</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="testdrive-tab" data-bs-toggle="tab" data-bs-target="#testdrive" type="button" role="tab">Test Drives</button>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <!-- ABA COMPRAS -->
                <div class="tab-pane fade show active" id="compras" role="tabpanel">
                    <div class="premium-table-card">
                        <div class="table-responsive">
                            <table class="table table-premium mb-0">
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Cliente</th>
                                        <th>Veículo de Interesse</th>
                                        <th>Pagamento</th>
                                        <th>Troca?</th>
                                        <th>Status</th>
                                        <th class="text-end">Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($listaPropostasCompras)): ?>
                                        <?php foreach ($listaPropostasCompras as $compra): ?>
                                            <tr>
                                                <td class="text-body-secondary small fw-medium"><?= date('d/m/Y H:i', strtotime($compra['data_solicitacao'])) ?></td>
                                                <td class="fw-bold"><?= htmlspecialchars($compra['nome_cliente']) ?></td>
                                                <td>
                                                    <span class="text-primary fw-bold"><?= htmlspecialchars($compra['modelo']) ?></span>
                                                    <span class="text-body-secondary small ms-1"><?= htmlspecialchars($compra['versao']) ?></span>
                                                </td>
                                                <td class="text-body-secondary"><?= htmlspecialchars($compra['forma_pagamento']) ?></td>
                                                <td>
                                                    <?php if ($compra['tem_troca'] == 'Sim'): ?>
                                                        <span class="badge text-bg-warning badge-premium">Sim</span>
                                                    <?php else: ?>
                                                        <span class="text-body-secondary small">Não</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <span class="badge text-bg-success badge-premium"><?= htmlspecialchars($compra['status']) ?></span>
                                                </td>
                                                <td class="text-end">
                                                    <a href="https://wa.me/55<?= preg_replace('/[^0-9]/', '', $compra['telefone']) ?>" target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-3 fw-bold shadow-sm" style="transition: all 0.3s ease;">
                                                        WhatsApp
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center py-5 text-body-secondary">
                                                <div class="d-flex flex-column align-items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-inbox text-muted mb-3" viewBox="0 0 16 16" style="opacity: 0.5;">
                                                        <path d="M4.98 4a.5.5 0 0 0-.39.188L1.54 8H6a.5.5 0 0 1 .5.5 1.5 1.5 0 1 0 3 0A.5.5 0 0 1 10 8h4.46l-3.05-3.812A.5.5 0 0 0 11.02 4H4.98zm-1.17-.437A1.5 1.5 0 0 1 4.98 3h6.04a1.5 1.5 0 0 1 1.17.563l3.7 4.625A.5.5 0 0 1 16 8.5V13a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13V8.5a.5.5 0 0 1 .19-.437l3.7-4.625zM1 8.5v4.5a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5V8.5h-4.08a2.5 2.5 0 0 1-4.84 0H1z" />
                                                    </svg>
                                                    Nenhuma proposta de compra registrada.
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- ABA TEST DRIVES -->
                <div class="tab-pane fade" id="testdrive" role="tabpanel">
                    <div class="premium-table-card">
                        <div class="table-responsive">
                            <table class="table table-premium mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Cliente</th>
                                        <th>Veículo Desejado</th>
                                        <th>Data do Teste</th>
                                        <th class="text-end">Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($listaAgendamentos)): ?>
                                        <?php foreach ($listaAgendamentos as $agenda): ?>
                                            <tr>
                                                <td class="text-body-secondary small fw-bold">#<?= $agenda['id'] ?></td>
                                                <td class="fw-bold"><?= htmlspecialchars($agenda['nome_cliente']) ?></td>
                                                <td>
                                                    <span class="fw-bold"><?= htmlspecialchars($agenda['modelo']) ?></span>
                                                    <span class="text-body-secondary small ms-1"><?= htmlspecialchars($agenda['versao']) ?></span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-body-secondary text-body badge-premium border">
                                                        <?= date('d/m/Y', strtotime($agenda['data_interesse'])) ?>
                                                    </span>
                                                </td>
                                                <td class="text-end">
                                                    <a href="https://wa.me/55<?= preg_replace('/[^0-9]/', '', $agenda['telefone']) ?>" target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-3 fw-bold shadow-sm" style="transition: all 0.3s ease;">
                                                        WhatsApp
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center py-5 text-body-secondary">
                                                <div class="d-flex flex-column align-items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-calendar-x text-muted mb-3" viewBox="0 0 16 16" style="opacity: 0.5;">
                                                        <path d="M6.146 7.146a.5.5 0 0 1 .708 0L8 8.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 9l1.147 1.146a.5.5 0 0 1-.708.708L8 9.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 9 6.146 7.854a.5.5 0 0 1 0-.708z" />
                                                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                                    </svg>
                                                    Nenhum test drive agendado.
                                                </div>
                                            </td>
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

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>