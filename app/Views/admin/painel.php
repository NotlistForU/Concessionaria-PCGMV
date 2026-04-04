<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Vendedor - AutoMotors</title>

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

        .table-custom {
            margin-bottom: 0;
        }

        .table-custom th {
            background-color: #f1f3f5;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #dee2e6;
        }

        .table-custom td {
            vertical-align: middle;
        }

        .img-thumbnail-car {
            width: 80px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
        }

        .status-badge {
            padding: 5px 10px;
            font-size: 0.75rem;
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 4px;
        }

        .status-disponivel {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .status-vendido {
            background-color: #f8d7da;
            color: #842029;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-admin py-3">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold" style="letter-spacing: 1px;" href="#">AUTOMOTORS | ADMIN</a>
            <div class="ms-auto text-white">
                <span class="me-3">Olá, Vendedor</span>
                <a href="?pagina=home" class="btn btn-outline-light btn-sm">Sair do Sistema</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid px-4 mt-4">

        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <h2 class="fw-bold m-0">Gestão de Estoque</h2>
            </div>
            <div class="col-md-6 text-end">
                <button class="btn btn-primary fw-bold px-4">+ Cadastrar Novo Veículo</button>
            </div>
        </div>

        <div class="row">
            <div class="col-12">

                <div class="card card-panel">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-custom">
                                <thead>
                                    <tr>
                                        <th class="ps-4">ID</th>
                                        <th>Imagem</th>
                                        <th>Modelo</th>
                                        <th>Categoria</th>
                                        <th>Preço</th>
                                        <th>Status</th>
                                        <th class="text-end pe-4">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td class="ps-4 fw-bold text-muted">#001</td>
                                        <td><img src="assets/img/foto_2.jpg" alt="Série 3" class="img-thumbnail-car"></td>
                                        <td class="fw-bold">Série 3 Sedan</td>
                                        <td>Sedan Esportivo</td>
                                        <td>R$ 320.000,00</td>
                                        <td><span class="status-badge status-disponivel">Disponível</span></td>
                                        <td class="text-end pe-4">
                                            <button class="btn btn-sm btn-outline-secondary">Editar</button>
                                            <button class="btn btn-sm btn-outline-danger">Excluir</button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="ps-4 fw-bold text-muted">#002</td>
                                        <td><img src="assets/img/foto_3.jpg" alt="X5" class="img-thumbnail-car"></td>
                                        <td class="fw-bold">X5 M Competition</td>
                                        <td>SUV Premium</td>
                                        <td>R$ 780.000,00</td>
                                        <td><span class="status-badge status-vendido">Vendido</span></td>
                                        <td class="text-end pe-4">
                                            <button class="btn btn-sm btn-outline-secondary">Editar</button>
                                            <button class="btn btn-sm btn-outline-danger">Excluir</button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="ps-4 fw-bold text-muted">#003</td>
                                        <td><img src="assets/img/foto_4.jpg" alt="i4" class="img-thumbnail-car"></td>
                                        <td class="fw-bold">i4 M50 Elétrico</td>
                                        <td>Gran Coupé</td>
                                        <td>R$ 450.000,00</td>
                                        <td><span class="status-badge status-disponivel">Disponível</span></td>
                                        <td class="text-end pe-4">
                                            <button class="btn btn-sm btn-outline-secondary">Editar</button>
                                            <button class="btn btn-sm btn-outline-danger">Excluir</button>
                                        </td>
                                    </tr>

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