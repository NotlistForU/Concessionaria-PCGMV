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
        <div class="container-fluid px-5">
            <a class="navbar-brand" href="?pagina=home">AUTOMOTORS</a>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="?pagina=modelos">Modelos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?pagina=sobre">Sobre Nós</a>
                    </li>
                </ul>
            </div>

            <div class="ms-auto d-flex align-items-center gap-4">
                <button id="themeToggle" class="btn btn-link text-decoration-none p-0 d-flex align-items-center justify-content-center" style="color: var(--bs-emphasis-color); transition: color 0.3s ease;" title="Alternar Tema">
                    <span id="themeIcon" width="40" height="40" fill="currentColor">
                        <!-- Icono renderizado por JS -->
                    </span>
                </button>
                <!-- <a href="?pagina=login" class="nav-btn">Acesso Admin</a> -->
                <?php if (estaLogado()): ?>
                    <div class="ms-auto">
                        <a href="?pagina=painel" class="nav-btn">Acesso Admin</a>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </nav>