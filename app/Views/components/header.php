<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoMotors</title>

    <link rel="icon" type="image/svg+xml" href="assets/img/logoBmw.svg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/main.js" defer></script>
</head>

<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container-fluid px-4 px-lg-5">
            <a class="navbar-brand" href="?pagina=home">AUTOMOTORS</a>

            <div class="d-flex align-items-center gap-3 order-lg-last">
                <!-- Alternador de Tema -->
                <button id="themeToggle" class="btn btn-link text-decoration-none p-0 d-flex align-items-center justify-content-center" style="color: var(--bs-emphasis-color); transition: color 0.3s ease;" title="Alternar Tema">
                    <span id="themeIcon" width="40" height="40" fill="currentColor">
                        <!-- Icono renderizado por JS -->
                    </span>
                </button>
                
                <!-- Acesso Admin (Visível apenas se logado em telas maiores) -->
                <?php if (estaLogado()): ?>
                    <a href="?pagina=painel" class="nav-btn d-none d-sm-inline-block">Acesso Admin</a>
                <?php endif; ?>

                <!-- Botão Toggler do Menu Mobile -->
                <button class="navbar-toggler border-0 p-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <!-- Links do Menu (Colapsáveis) -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="?pagina=modelos">Modelos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?pagina=sobre">Sobre Nós</a>
                    </li>
                    <?php if (estaLogado()): ?>
                        <!-- Acesso Admin no menu colapsado apenas para telas muito pequenas -->
                        <li class="nav-item d-sm-none mt-2">
                            <a href="?pagina=painel" class="nav-link text-primary fw-bold">Acesso Admin</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

        </div>
    </nav>