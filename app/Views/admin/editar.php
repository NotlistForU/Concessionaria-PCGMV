<?php
// 1. Pega o ID da URL
$id = isset($_GET['id']) ? $_GET['id'] : null;
$carro = null;

if ($id) {
    // 2. Busca o carro no banco de dados usando o Controller já instanciado no index.php
    $carro = $controller->buscarPorId($id);
    if ($carro) {
        $imagensGaleria = $controller->listarImagensPorVeiculoETipo($carro->getId(), 'foto_3');
    }
}

// Se não achar o carro ou tentarem acessar sem ID, volta pro painel
if (!$carro) {
    header("Location: ?pagina=painel");
    exit;
}

require_once '../app/Views/components/header.php';
?>

<!-- Modal de Confirmação de Exclusão de Imagem -->
<div class="modal fade" id="modalExcluirImagem" tabindex="-1" aria-labelledby="modalExcluirImagemLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 14px; overflow: hidden;">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <div class="d-flex align-items-center gap-2">
                    <div style="width: 40px; height: 40px; background: rgba(220,53,69,0.12); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="var(--bs-danger)" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                        </svg>
                    </div>
                    <h6 class="modal-title fw-bold mb-0" id="modalExcluirImagemLabel">Excluir Foto?</h6>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body px-4 pt-2 pb-2">
                <p class="text-body-secondary mb-0" style="font-size: 0.875rem;">Esta acao remove a foto permanentemente do servidor e nao pode ser desfeita.</p>
            </div>
            <div class="modal-footer border-0 px-4 pb-4 pt-2 gap-2">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-3 fw-medium btn-sm" data-bs-dismiss="modal">Cancelar</button>
                <a id="btnConfirmarExclusaoImagem" href="#" class="btn btn-danger rounded-pill px-3 fw-bold btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                    </svg>
                    Sim, excluir
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid flex-grow-1 d-flex flex-column">
    <div class="row flex-grow-1">

        <!-- Menu Lateral Admin -->
        <div class="col-md-2 bg-body-tertiary p-4 border-end border-opacity-10 admin-sidebar">
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
        <div class="col-md-10 p-3 p-md-5">


            <div class="d-flex flex-column gap-3 flex-md-row justify-content-md-between align-items-md-end mb-4 pb-2">
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
                        <form action="?pagina=processar_edicao" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $carro->getId(); ?>">

                            <h4 class="admin-section-title">Informações Principais</h4>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Modelo (Série)</label>
                                    <select name="modelo" class="form-select" data-selecionado="<?= htmlspecialchars($carro->getModelo()); ?>" required>
                                        <option value=""><?= htmlspecialchars($carro->getModelo()); ?></option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Versão</label>
                                    <select name="versao" class="form-select" data-selecionado="<?= htmlspecialchars($carro->getVersao()); ?>" required>
                                        <option value=""><?= htmlspecialchars($carro->getVersao()); ?></option>
                                    </select>
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

                            <h4 class="admin-section-title">Especificações Técnicas</h4>
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

                            <h4 class="admin-section-title">Midia e Textos</h4>
                            <?php
                            $img1 = $controller->obterImagemPorVeiculoETipo($carro->getId(), 'foto_1');
                            $img2 = $controller->obterImagemPorVeiculoETipo($carro->getId(), 'foto_2');
                            // Detecta se uma foto foi removida nesta visita (vindo do redirect)
                            $fotoRemovida = isset($_GET['foto_removida']) ? $_GET['foto_removida'] : null;
                            $foto1Ausente = !$img1 || $fotoRemovida === 'foto_1';
                            $foto2Ausente = !$img2 || $fotoRemovida === 'foto_2';
                            ?>
                            <div class="row g-3">
                                <!-- FOTO 1: VITRINE -->
                                <div class="col-md-4">
                                    <label class="form-label d-flex align-items-center gap-2">
                                        Imagem de Vitrine (Catalogo)
                                        <?php if ($foto1Ausente): ?>
                                            <span class="badge bg-danger" style="font-size: 0.7rem;">Obrigatorio</span>
                                        <?php endif; ?>
                                    </label>
                                    <input type="file" id="foto_1_input" name="foto_1" class="form-control <?= $foto1Ausente ? 'border-danger' : ''; ?>" accept="image/*" <?= $foto1Ausente ? 'required' : ''; ?>>
                                    <?php if ($foto1Ausente): ?>
                                        <div class="text-danger small mt-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16" class="me-1">
                                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                            </svg>
                                            Imagem removida. Carregue uma nova antes de salvar.
                                        </div>
                                    <?php endif; ?>
                                    <div class="mt-2 text-center position-relative d-inline-block" style="width: 100%;">
                                        <?php if ($img1 && !$foto1Ausente): ?>
                                            <div class="position-relative d-inline-block">
                                                <img src="<?= htmlspecialchars($img1['caminho_arquivo']); ?>" class="img-thumbnail" style="max-height: 110px;" id="preview_foto1">
                                                <button
                                                    type="button"
                                                    class="btn btn-danger btn-sm position-absolute top-0 end-0 rounded-circle shadow"
                                                    style="width: 24px; height: 24px; font-size: 0.8rem; padding: 0; line-height: 1; transform: translate(35%, -35%); z-index: 10;"
                                                    title="Excluir imagem de vitrine"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalExcluirImagem"
                                                    data-delete-url="?pagina=deletar_imagem&id=<?= $img1['id']; ?>&veiculo_id=<?= $carro->getId(); ?>&tipo=foto_1">&times;</button>
                                            </div>
                                            <div class="text-muted small mt-1">Atual</div>
                                        <?php elseif (!$foto1Ausente): ?>
                                            <div class="text-muted small mt-2">Nenhuma imagem cadastrada.</div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- FOTO 2: BANNER -->
                                <div class="col-md-4">
                                    <label class="form-label d-flex align-items-center gap-2">
                                        Banner Principal (Pagina do Veiculo)
                                        <?php if ($foto2Ausente): ?>
                                            <span class="badge bg-danger" style="font-size: 0.7rem;">Obrigatorio</span>
                                        <?php endif; ?>
                                    </label>
                                    <input type="file" id="foto_2_input" name="foto_2" class="form-control <?= $foto2Ausente ? 'border-danger' : ''; ?>" accept="image/*" <?= $foto2Ausente ? 'required' : ''; ?>>
                                    <?php if ($foto2Ausente): ?>
                                        <div class="text-danger small mt-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16" class="me-1">
                                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                            </svg>
                                            Imagem removida. Carregue uma nova antes de salvar.
                                        </div>
                                    <?php endif; ?>
                                    <div class="mt-2 text-center">
                                        <?php if ($img2 && !$foto2Ausente): ?>
                                            <div class="position-relative d-inline-block">
                                                <img src="<?= htmlspecialchars($img2['caminho_arquivo']); ?>" class="img-thumbnail" style="max-height: 110px;" id="preview_foto2">
                                                <button
                                                    type="button"
                                                    class="btn btn-danger btn-sm position-absolute top-0 end-0 rounded-circle shadow"
                                                    style="width: 24px; height: 24px; font-size: 0.8rem; padding: 0; line-height: 1; transform: translate(35%, -35%); z-index: 10;"
                                                    title="Excluir banner principal"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalExcluirImagem"
                                                    data-delete-url="?pagina=deletar_imagem&id=<?= $img2['id']; ?>&veiculo_id=<?= $carro->getId(); ?>&tipo=foto_2">&times;</button>
                                            </div>
                                            <div class="text-muted small mt-1">Atual</div>
                                        <?php elseif (!$foto2Ausente): ?>
                                            <div class="text-muted small mt-2">Nenhuma imagem cadastrada.</div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- FOTO 3: CARROSSEL -->
                                <div class="col-md-4">
                                    <label class="form-label">Fotos do Carrossel</label>
                                    <input type="file" name="foto_3[]" class="form-control" accept="image/*" multiple>
                                    <div class="mt-3">
                                        <div class="text-muted small mb-2">Imagens Atuais na Galeria:</div>
                                        <?php if (!empty($imagensGaleria)): ?>
                                            <div class="d-flex flex-wrap gap-2 justify-content-center bg-body-tertiary p-2 border border-opacity-10 rounded">
                                                <?php foreach ($imagensGaleria as $img): ?>
                                                    <div class="position-relative text-center border p-1 rounded bg-body" style="width: 90px;">
                                                        <img src="<?= htmlspecialchars($img['caminho_arquivo']); ?>" class="img-fluid rounded" style="height: 60px; object-fit: cover; width: 100%;">
                                                        <button
                                                            type="button"
                                                            class="btn btn-danger btn-sm position-absolute top-0 end-0 rounded-circle shadow"
                                                            style="width: 22px; height: 22px; font-size: 0.75rem; padding: 0; line-height: 1; transform: translate(35%, -35%); z-index: 10;"
                                                            title="Excluir imagem"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalExcluirImagem"
                                                            data-delete-url="?pagina=deletar_imagem&id=<?= $img['id']; ?>&veiculo_id=<?= $carro->getId(); ?>">&times;</button>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php else: ?>
                                            <p class="text-muted small text-center mb-0">Nenhuma imagem cadastrada.</p>
                                        <?php endif; ?>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <label class="form-label">Descricao Interior / Tecnologia</label>
                                    <textarea name="descricao_interior" class="form-control" rows="6" required><?= htmlspecialchars($carro->getDescricaoInterior()); ?></textarea>
                                </div>
                            </div>

                            <?php if ($foto1Ausente || $foto2Ausente): ?>
                                <div class="alert alert-danger border-0 rounded-3 mt-4 d-flex align-items-center gap-3" style="background: rgba(220,53,69,0.10);">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="var(--bs-danger)" viewBox="0 0 16 16" class="flex-shrink-0">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                    </svg>
                                    <div>
                                        <strong>Imagem obrigatoria ausente.</strong>
                                        Voce removeu uma imagem principal. Carregue uma nova
                                        <?php if ($foto1Ausente && $foto2Ausente): ?>imagem de vitrine e um novo banner<?php elseif ($foto1Ausente): ?>imagem de vitrine<?php else: ?>banner principal<?php endif; ?>
                                        antes de salvar o veiculo.
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="mt-4 text-end border-top pt-4">
                                <a href="?pagina=painel" class="btn btn-outline-secondary rounded-pill px-4 fw-bold me-2">Cancelar</a>
                                <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold">Atualizar Veiculo</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/editar-veiculo.js"></script>
<script>
    // Popula o link do modal com a URL de exclusão da imagem selecionada
    document.getElementById('modalExcluirImagem').addEventListener('show.bs.modal', function(event) {
        var btn = event.relatedTarget;
        var deleteUrl = btn.getAttribute('data-delete-url');
        document.getElementById('btnConfirmarExclusaoImagem').href = deleteUrl;
    });
</script>
</body>

</html>