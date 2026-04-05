<?php
// 1. Pega o ID da URL
$id = isset($_GET['id']) ? $_GET['id'] : null;
$carro = null;

if ($id) {
    // 2. Busca o carro no banco de dados usando o Controller já instanciado no index.php
    $carro = $controller->buscarPorId($id);
}

// Se não achar o carro ou tentarem acessar sem ID, volta pro painel
if (!$carro) {
    header("Location: ?pagina=painel");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Veículo - AutoMotors</title>

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

        .form-card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            padding: 30px;
            background-color: #fff;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: bold;
            text-transform: uppercase;
            color: #111;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 20px;
            margin-top: 30px;
        }

        .section-title:first-child {
            margin-top: 0;
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #555;
            text-transform: uppercase;
        }

        .form-control,
        .form-select {
            border-radius: 4px;
            padding: 10px 15px;
            border: 1px solid #ddd;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #111;
            box-shadow: none;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-admin py-3">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold" style="letter-spacing: 1px;" href="?pagina=painel">AUTOMOTORS | ADMIN</a>
            <div class="ms-auto text-white">
                <span class="me-3">Olá, Vendedor</span>
                <a href="?pagina=home" class="btn btn-outline-light btn-sm">Sair do Sistema</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4 mb-5">

        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <h2 class="fw-bold m-0">Editar Veículo <span class="text-muted">#<?= str_pad($carro->getId(), 3, '0', STR_PAD_LEFT); ?></span></h2>
            </div>
            <div class="col-md-6 text-end">
                <a href="?pagina=painel" class="btn btn-outline-secondary px-4 fw-bold">Voltar ao Estoque</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="form-card">
                    <form action="?pagina=processar_edicao" method="POST">
                        <input type="hidden" name="id" value="<?= $carro->getId(); ?>">

                        <h4 class="section-title">Informações Principais</h4>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Modelo</label>
                                <input type="text" name="modelo" class="form-control" value="<?= htmlspecialchars($carro->getModelo()); ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Versão</label>
                                <input type="text" name="versao" class="form-control" value="<?= htmlspecialchars($carro->getVersao()); ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Categoria</label>
                                <input type="text" name="categoria" class="form-control" value="<?= htmlspecialchars($carro->getCategoria()); ?>" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Ano Modelo</label>
                                <input type="number" name="ano_modelo" class="form-control" value="<?= htmlspecialchars($carro->getAnoModelo()); ?>" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Ano Fabricação</label>
                                <input type="number" name="ano_fabricacao" class="form-control" value="<?= htmlspecialchars($carro->getAnoFabricacao()); ?>" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Preço (R$)</label>
                                <input type="number" step="0.01" name="preco" class="form-control" value="<?= htmlspecialchars($carro->getPreco()); ?>" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="Disponível" <?= ($carro->getStatus() === 'Disponível') ? 'selected' : ''; ?>>Disponível</option>
                                    <option value="Vendido" <?= ($carro->getStatus() === 'Vendido') ? 'selected' : ''; ?>>Vendido</option>
                                </select>
                            </div>
                        </div>

                        <h4 class="section-title">Especificações Técnicas</h4>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Motorização</label>
                                <input type="text" name="motorizacao" class="form-control" value="<?= htmlspecialchars($carro->getMotorizacao()); ?>" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Potência / Torque</label>
                                <input type="text" name="potencia" class="form-control" value="<?= htmlspecialchars($carro->getPotencia()); ?>" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Aceleração (0-100)</label>
                                <input type="text" name="aceleracao" class="form-control" value="<?= htmlspecialchars($carro->getAceleracao()); ?>" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Transmissão</label>
                                <input type="text" name="transmissao" class="form-control" value="<?= htmlspecialchars($carro->getTransmissao()); ?>" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Combustível</label>
                                <select name="combustivel" class="form-select">
                                    <option value="Gasolina" <?= ($carro->getCombustivel() === 'Gasolina') ? 'selected' : ''; ?>>Gasolina</option>
                                    <option value="Híbrido" <?= ($carro->getCombustivel() === 'Híbrido') ? 'selected' : ''; ?>>Híbrido</option>
                                    <option value="Elétrico" <?= ($carro->getCombustivel() === 'Elétrico') ? 'selected' : ''; ?>>Elétrico</option>
                                    <option value="Diesel" <?= ($carro->getCombustivel() === 'Diesel') ? 'selected' : ''; ?>>Diesel</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Quilometragem</label>
                                <input type="number" name="quilometragem" class="form-control" value="<?= htmlspecialchars($carro->getQuilometragem()); ?>" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Portas</label>
                                <input type="number" name="portas" class="form-control" value="<?= htmlspecialchars($carro->getPortas()); ?>" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Cor Externa</label>
                                <input type="text" name="cor" class="form-control" value="<?= htmlspecialchars($carro->getCor()); ?>" required>
                            </div>
                        </div>

                        <h4 class="section-title">Mídia e Textos</h4>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Nome da Pasta de Fotos</label>
                                <input type="text" name="pasta_fotos" class="form-control" value="<?= htmlspecialchars($carro->getPastaFoto()); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Descrição Exterior</label>
                                <textarea name="descricao_exterior" class="form-control" rows="6" required><?= htmlspecialchars($carro->getDescricaoExterior()); ?></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Descrição Interior / Tecnologia</label>
                                <textarea name="descricao_interior" class="form-control" rows="6" required><?= htmlspecialchars($carro->getDescricaoInterior()); ?></textarea>
                            </div>
                        </div>

                        <div class="mt-5 text-end border-top pt-4">
                            <a href="?pagina=painel" class="btn btn-light px-4 me-2">Cancelar</a>
                            <button type="submit" class="btn btn-primary px-5 fw-bold">Atualizar Veículo</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>