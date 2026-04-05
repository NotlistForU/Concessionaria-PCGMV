<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamentos - AutoMotors</title>

    <link rel="icon" type="image/svg+xml" href="assets/img/logoBmw.svg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-admin {
            background-color: #111;
        }

        .card-panel {
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .table-custom th {
            background-color: #f1f3f5;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            border-bottom: 2px solid #dee2e6;
        }

        .table-custom td {
            vertical-align: middle;
        }

        .badge-tipo {
            font-size: 0.75rem;
            padding: 5px 8px;
            border-radius: 4px;
            text-transform: uppercase;
        }

        .bg-compra {
            background-color: #000;
            color: #fff;
        }

        .bg-test {
            background-color: #e9ecef;
            color: #212529;
            border: 1px solid #ced4da;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-admin py-3">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold" style="letter-spacing: 1px;" href="?pagina=painel">AUTOMOTORS | ADMIN</a>

            <div class="collapse navbar-collapse ms-4">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="?pagina=painel">Estoque</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fw-bold text-white" href="?pagina=agendamentos">Agendamentos</a>
                    </li>
                </ul>
            </div>

            <div class="ms-auto text-white">
                <span class="me-3">Olá, Vendedor</span>
                <a href="?pagina=home" class="btn btn-outline-light btn-sm">Sair do Sistema</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid px-4 mt-4 mb-5">

        <div class="row mb-4 align-items-center">
            <div class="col-12">
                <h2 class="fw-bold m-0">Interesses e Test Drives</h2>
                <p class="text-muted">Lista de clientes que solicitaram contato pelo site.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-panel">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-4">Data Solicitada</th>
                                        <th>Cliente</th>
                                        <th>Telefone</th>
                                        <th>Veículo de Interesse</th>
                                        <th>Tipo</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php if (!empty($listaAgendamentos)): ?>
                                        <?php foreach ($listaAgendamentos as $agendamento): ?>
                                            <tr>
                                                <td class="ps-4 fw-bold text-muted">
                                                    <?= date('d/m/Y', strtotime($agendamento['data_interesse'])); ?>
                                                </td>

                                                <td class="fw-bold"><?= htmlspecialchars($agendamento['nome_cliente']); ?></td>

                                                <td><?= htmlspecialchars($agendamento['telefone']); ?></td>

                                                <td><?= htmlspecialchars($agendamento['modelo'] . ' ' . $agendamento['versao']); ?></td>

                                                <td>
                                                    <?php $classeTipo = ($agendamento['tipo_agendamento'] === 'Compra') ? 'bg-compra' : 'bg-test'; ?>
                                                    <span class="badge-tipo <?= $classeTipo; ?>">
                                                        <?= htmlspecialchars($agendamento['tipo_agendamento']); ?>
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="badge bg-warning text-dark">Pendente</span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center py-5 text-muted">Nenhum agendamento recebido ainda.</td>
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

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>