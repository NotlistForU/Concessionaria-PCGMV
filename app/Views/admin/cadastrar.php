<?php require_once '../app/Views/components/header.php'; ?>

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


            <div class="d-flex justify-content-between align-items-end mb-4 pb-2">
                <div>
                    <h2 class="fw-bold text-uppercase m-0" style="font-size: 2rem; letter-spacing: -0.5px;">Novo Veículo</h2>
                    <p class="text-body-secondary mt-2 mb-0">Adicione um novo veículo ao catálogo de estoque.</p>
                </div>
                <a href="?pagina=painel" class="btn btn-outline-secondary rounded-pill fw-bold px-4 shadow-sm" style="transition: all 0.3s ease;">
                    Voltar ao Estoque
                </a>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-card">
                        <form action="?pagina=processar_cadastro" method="POST" enctype="multipart/form-data">

                            <h4 class="admin-section-title">Informações Principais</h4>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Modelo</label>
                                    <input type="text" name="modelo" class="form-control" placeholder="Ex: Série 3" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Versão</label>
                                    <input type="text" name="versao" class="form-control" placeholder="Ex: 320i M Sport" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Categoria</label>
                                    <input type="text" name="categoria" class="form-control" placeholder="Ex: Sedan Esportivo" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Ano Modelo</label>
                                    <input type="number" name="ano_modelo" class="form-control" value="2026" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Ano Fabricação</label>
                                    <input type="number" name="ano_fabricacao" class="form-control" value="2026" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Preço (R$)</label>
                                    <input type="number" step="0.01" name="preco" class="form-control" placeholder="Ex: 350000.00" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="Disponível">Disponível</option>
                                        <option value="Vendido">Vendido</option>
                                    </select>
                                </div>
                            </div>

                            <h4 class="admin-section-title">Especificações Técnicas</h4>
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label">Motorização</label>
                                    <input type="text" name="motorizacao" class="form-control" placeholder="Ex: 2.0 Turbo" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Potência / Torque</label>
                                    <input type="text" name="potencia" class="form-control" placeholder="Ex: 184 cv / 30,6 kgfm" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Aceleração (0-100)</label>
                                    <input type="text" name="aceleracao" class="form-control" placeholder="Ex: 7,1 s" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Transmissão</label>
                                    <input type="text" name="transmissao" class="form-control" placeholder="Ex: Automático 8 marchas" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Combustível</label>
                                    <select name="combustivel" class="form-select">
                                        <option value="Gasolina">Gasolina</option>
                                        <option value="Híbrido">Híbrido</option>
                                        <option value="Elétrico">Elétrico</option>
                                        <option value="Diesel">Diesel</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Quilometragem</label>
                                    <input type="number" name="quilometragem" class="form-control" value="0" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Portas</label>
                                    <input type="number" name="portas" class="form-control" value="4" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Cor Externa</label>
                                    <input type="text" name="cor" class="form-control" placeholder="Ex: Branco Mineral" required>
                                </div>
                            </div>

                            <h4 class="admin-section-title">Mídia e Textos</h4>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Imagem de Vitrine (Catálogo)</label>
                                    <input type="file" name="foto_1" class="form-control" accept="image/*" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Banner Principal (Página do Veículo)</label>
                                    <input type="file" name="foto_2" class="form-control" accept="image/*" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Fotos do Carrossel</label>
                                    <input type="file" name="foto_3[]" class="form-control" accept="image/*" multiple required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Descrição Exterior</label>
                                    <textarea name="descricao_exterior" class="form-control" rows="4" placeholder="Descreva o design exterior do veículo..." required></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Descrição Interior / Tecnologia</label>
                                    <textarea name="descricao_interior" class="form-control" rows="4" placeholder="Descreva o interior e as tecnologias..." required></textarea>
                                </div>
                            </div>

                            <div class="mt-5 text-end border-top pt-4">
                                <a href="?pagina=painel" class="btn btn-outline-secondary rounded-pill px-4 fw-bold me-2">Cancelar</a>
                                <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold">Salvar Veículo</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>