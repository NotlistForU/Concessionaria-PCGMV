<?php require_once '../app/Views/components/header.php'; ?>

<div class="container mt-5 pt-4 flex-grow-1">
    <div class="row mb-5">
        <div class="col-12">
            <h1 style="font-weight: 300; font-size: 3rem; text-transform: uppercase;">Todos os <br><span style="font-weight: 700;">Modelos.</span></h1>
            <p class="text-muted mt-3">Explore nossa linha completa de veículos premium.</p>
        </div>
    </div>

    <div class="row g-5">

        <div class="col-md-4">
            <div class="card car-card">
                <img src="assets/img/foto_2.jpg" alt="Série 3">
                <div class="card-body">
                    <h5 class="card-title">Série 3</h5>
                    <p class="card-text">Sedan</p>
                    <a href="?pagina=detalhes&id=1" class="btn-link-custom">Configurar &gt;</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card car-card">
                <img src="assets/img/foto_3.jpg" alt="X5">
                <div class="card-body">
                    <h5 class="card-title">X5</h5>
                    <p class="card-text">SAV (SUV Premium)</p>
                    <a href="?pagina=detalhes&id=2" class="btn-link-custom">Configurar &gt;</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card car-card">
                <img src="assets/img/foto_4.jpg" alt="i4">
                <div class="card-body">
                    <h5 class="card-title">i4</h5>
                    <p class="card-text">Gran Coupé Elétrico</p>
                    <a href="?pagina=detalhes&id=3" class="btn-link-custom">Configurar &gt;</a>
                </div>
            </div>
        </div>

    </div>
</div>

<?php require_once '../app/Views/components/footer.php'; ?>