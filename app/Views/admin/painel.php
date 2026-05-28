<?php
// Puxa a lista de carros usando o Controller que já foi carregado no index.php
$listaDeCarros = $controller->listar();
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


            <div class="d-flex justify-content-between align-items-end mb-4 pb-2">
                <div>
                    <h2 class="fw-bold text-uppercase m-0" style="font-size: 2rem; letter-spacing: -0.5px;">Gestão de Estoque</h2>
                    <p class="text-body-secondary mt-2 mb-0">Controle e atualize a frota de veículos disponíveis.</p>
                </div>
                <a href="?pagina=cadastrar" class="btn btn-primary rounded-pill fw-bold px-4 shadow-sm" style="transition: all 0.3s ease;">
                    <i class="bi bi-plus-lg me-1"></i> Cadastrar Veículo
                </a>
            </div>

            <div class="premium-table-card">
                <div class="table-responsive">
                    <table class="table table-premium mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Imagem</th>
                                <th>Modelo</th>
                                <th>Categoria</th>
                                <th>Preço</th>
                                <th>Status</th>
                                <th class="text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($listaDeCarros)): ?>
                                <?php foreach ($listaDeCarros as $carro): ?>
                                    <tr>
                                        <td class="text-body-secondary small fw-bold">#<?= str_pad($carro->getId(), 3, '0', STR_PAD_LEFT); ?></td>
                                        
                                        <td>
                                            <img src="assets/img/<?= htmlspecialchars($carro->getPastaFoto()); ?>/foto_1.png" class="img-thumbnail-car">
                                        </td>
                                        
                                        <td>
                                            <span class="fw-bold"><?= htmlspecialchars($carro->getModelo()); ?></span>
                                            <span class="text-body-secondary small ms-1"><?= htmlspecialchars($carro->getVersao()); ?></span>
                                        </td>
                                        
                                        <td class="text-body-secondary"><?= htmlspecialchars($carro->getCategoria()); ?></td>
                                        
                                        <td class="fw-medium">R$ <?= number_format($carro->getPreco(), 2, ',', '.'); ?></td>
                                        
                                        <td>
                                            <?php
                                            $status = $carro->getStatus();
                                            if ($status === 'Vendido') {
                                                echo '<span class="badge text-bg-danger badge-premium">' . htmlspecialchars($status) . '</span>';
                                            } else {
                                                echo '<span class="badge text-bg-success badge-premium">' . htmlspecialchars($status) . '</span>';
                                            }
                                            ?>
                                        </td>
                                        
                                        <td class="text-end">
                                            <a href="?pagina=editar&id=<?= $carro->getId(); ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-bold me-1">Editar</a>
                                            <a href="?pagina=deletar&id=<?= $carro->getId(); ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold" onclick="return confirm('Tem certeza que deseja excluir este veículo permanentemente?')">Excluir</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-body-secondary">
                                        <div class="d-flex flex-column align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-car-front text-muted mb-3" viewBox="0 0 16 16" style="opacity: 0.5;">
                                              <path d="M4 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm10 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2H6ZM4.862 4.276 3.906 6.19a.51.51 0 0 0 .497.731c.91-.073 2.35-.17 3.597-.17s2.688.097 3.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 10.691 4H5.309a.5.5 0 0 0-.447.276Z"/>
                                              <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679q.05.242.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.8.8 0 0 0 .381-.404l.792-1.848ZM4.82 3a1.5 1.5 0 0 0-1.379.91l-.792 1.847a1.8 1.8 0 0 1-.853.904.8.8 0 0 0-.43.564L1.03 8.904a1.5 1.5 0 0 0-.03.294v.413c0 .796.62 1.448 1.408 1.484 1.555.07 3.786.155 5.592.155s4.037-.084 5.592-.155A1.48 1.48 0 0 0 15 9.611v-.413q0-.148-.03-.294l-.335-1.68a.8.8 0 0 0-.43-.563 1.8 1.8 0 0 1-.853-.904l-.792-1.848A1.5 1.5 0 0 0 11.18 3H4.82Z"/>
                                            </svg>
                                            Nenhum veículo cadastrado no estoque.
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

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>