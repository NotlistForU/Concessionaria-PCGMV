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

require_once '../app/Views/components/header.php';
?>

<div class="container-fluid flex-grow-1 d-flex flex-column">
    <div class="row flex-grow-1">
        
        <!-- Menu Lateral Admin -->
        <div class="col-md-2 bg-body-tertiary p-4 border-end border-opacity-10">
            <h5 class="text-uppercase fw-bold mb-4 text-body-secondary" style="letter-spacing: 2px; font-size: 0.85rem;">Painel Admin</h5>
            <ul class="nav flex-column gap-2">
                <li class="nav-item">
                    <a class="nav-link text-bg-primary fw-bold px-3 py-2 rounded-3 shadow-sm" href="?pagina=painel" style="transition: all 0.3s ease;">Estoque de Veículos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-body fw-medium px-3 py-2 rounded-3" href="?pagina=agendamentos" style="transition: all 0.3s ease;">Leads & Propostas</a>
                </li>
                <li class="nav-item mt-5">
                    <a class="nav-link text-danger fw-bold px-3 py-2 rounded-3" href="?pagina=home" style="transition: all 0.3s ease;">&larr; Voltar ao Site</a>
                </li>
            </ul>
        </div>

        <!-- Conteúdo Principal -->
        <div class="col-md-10 p-5">
            <style>
                .form-card {
                    border: 1px solid var(--bs-border-color);
                    border-radius: 12px;
                    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
                    padding: 40px;
                    background-color: var(--bs-body-bg);
                }

                .section-title {
                    font-size: 1.1rem;
                    font-weight: bold;
                    text-transform: uppercase;
                    color: var(--bs-emphasis-color);
                    border-bottom: 2px solid var(--bs-border-color);
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
                    color: var(--bs-secondary-color);
                    text-transform: uppercase;
                }

                .form-control,
                .form-select {
                    border-radius: 6px;
                    padding: 10px 15px;
                    border: 1px solid var(--bs-border-color);
                    background-color: var(--bs-body-bg);
                    color: var(--bs-body-color);
                }

                .form-control:focus,
                .form-select:focus {
                    border-color: var(--bs-primary);
                    box-shadow: none;
                    background-color: var(--bs-body-bg);
                    color: var(--bs-body-color);
                }
            </style>

            <div class="d-flex justify-content-between align-items-end mb-4 pb-2">
                <div>
                    <h2 class="fw-bold text-uppercase m-0" style="font-size: 2rem; letter-spacing: -0.5px;">Editar Veículo <span class="text-body-secondary ms-2 fs-4">#<?= str_pad($carro->getId(), 3, '0', STR_PAD_LEFT); ?></span></h2>
                    <p class="text-body-secondary mt-2 mb-0">Atualize as informações do veículo selecionado no estoque.</p>
                </div>
                <a href="?pagina=painel" class="btn btn-outline-secondary rounded-pill fw-bold px-4 shadow-sm" style="transition: all 0.3s ease;">
                    Voltar ao Estoque
                </a>
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
                                <a href="?pagina=painel" class="btn btn-outline-secondary rounded-pill px-4 fw-bold me-2">Cancelar</a>
                                <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold">Atualizar Veículo</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require_once '../app/Views/components/footer.php'; ?>