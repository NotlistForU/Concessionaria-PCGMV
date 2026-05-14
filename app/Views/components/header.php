<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoMotors</title>

    <link rel="icon" type="image/svg+xml" href="assets/img/logoBmw.svg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
            overflow-x: hidden;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .navbar {
            background-color: var(--bs-body-bg) !important;
            padding: 20px 0;
            border-bottom: 1px solid var(--bs-border-color);
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: 2px;
            color: var(--bs-emphasis-color) !important;
        }

        .nav-link {
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--bs-emphasis-color) !important;
            margin-left: 20px;
        }

        .nav-link:hover {
            color: #1c69d4 !important;
        }

        .nav-btn {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
            color: var(--bs-emphasis-color);
            border: 1px solid var(--bs-emphasis-color);
            padding: 8px 20px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .nav-btn:hover {
            background-color: var(--bs-emphasis-color);
            color: var(--bs-body-bg);
        }

        /* Estilos globais úteis */
        .section-title {
            font-weight: 300;
            font-size: 2.5rem;
            color: var(--bs-emphasis-color);
            margin-bottom: 50px;
            text-align: center;
        }

        /* Inversão automática dos botões dark no modo escuro */
        [data-bs-theme="dark"] .btn-dark {
            background-color: var(--bs-body-color);
            color: var(--bs-body-bg);
            border-color: var(--bs-body-color);
        }
        [data-bs-theme="dark"] .btn-dark:hover {
            background-color: rgba(255, 255, 255, 0.8);
            color: #000;
            border-color: rgba(255, 255, 255, 0.8);
        }
        [data-bs-theme="dark"] .btn-outline-dark {
            color: var(--bs-body-color);
            border-color: var(--bs-body-color);
        }
        [data-bs-theme="dark"] .btn-outline-dark:hover {
            background-color: var(--bs-body-color);
            color: var(--bs-body-bg);
        }

        .car-card {
            border: none;
            border-radius: 0;
            background: transparent;
            transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .car-card:hover {
            transform: translateY(-10px);
        }

        .car-card img {
            border-radius: 0;
            object-fit: cover;
            height: 350px;
            width: 100%;
            transition: box-shadow 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .car-card:hover img {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .car-card .card-body {
            padding: 25px 0 0 0;
        }

        .car-card .card-title {
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 5px;
        }

        .car-card .card-text {
            font-weight: 300;
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 20px;
        }

        .btn-link-custom {
            color: #1c69d4;
            font-weight: 700;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .btn-link-custom:hover,
        .car-card:hover .btn-link-custom {
            color: #0b4392;
            text-decoration: underline;
        }

        footer {
            border-top: 1px solid var(--bs-border-color);
            padding: 40px 0;
            margin-top: 80px;
        }
    </style>

    <script>
        // Executa imediatamente para evitar piscar tela branca no modo escuro
        (function() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme) {
                document.documentElement.setAttribute('data-bs-theme', savedTheme);
            } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.setAttribute('data-bs-theme', 'dark');
            }
        })();
    </script>
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
                </ul>
            </div>

            <div class="ms-auto d-flex align-items-center gap-4">
                <button id="themeToggle" class="btn btn-link text-decoration-none p-0 d-flex align-items-center justify-content-center" style="color: var(--bs-emphasis-color); transition: color 0.3s ease;" title="Alternar Tema">
                    <svg id="themeIcon" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                        <!-- Icon will be injected by JS -->
                    </svg>
                </button>
                <a href="?pagina=login" class="nav-btn">Acesso Admin</a>
            </div>
        </div>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const themeToggle = document.getElementById('themeToggle');
            const themeIcon = document.getElementById('themeIcon');
            const htmlElement = document.documentElement;

            const iconSun = '<path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>';
            const iconMoon = '<path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.279 7.306 7.279.13 0 .258-.005.386-.015a.768.768 0 0 1 .904.904 8.5 8.5 0 1 1-7.798-12.484.768.768 0 0 1 .002 0z"/>';

            const updateIcon = () => {
                const isDark = htmlElement.getAttribute('data-bs-theme') === 'dark';
                themeIcon.innerHTML = isDark ? iconSun : iconMoon;
            };

            updateIcon(); // Define o ícone inicial

            themeToggle.addEventListener('click', () => {
                const isDark = htmlElement.getAttribute('data-bs-theme') === 'dark';
                const newTheme = isDark ? 'light' : 'dark';
                
                htmlElement.setAttribute('data-bs-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                updateIcon();
            });
        });
    </script>