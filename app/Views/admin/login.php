<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso Restrito - AutoMotors</title>

    <link rel="icon" type="image/svg+xml" href="assets/img/logoBmw.svg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <style>
        body {
            background-color: var(--bs-tertiary-bg);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Roboto', sans-serif;
            transition: background-color 0.3s ease;
        }

        .login-card {
            position: relative;
            border: 1px solid var(--bs-border-color);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background: var(--bs-body-bg);
            transition: background-color 0.3s ease;
        }

        .login-title {
            color: var(--bs-emphasis-color);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-control {
            border-radius: 6px;
            padding: 12px 15px;
            border: 1px solid var(--bs-border-color);
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
        }

        .form-control:focus {
            box-shadow: none;
            border-color: var(--bs-primary);
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
        }

        .btn-login {
            background-color: var(--bs-emphasis-color);
            color: var(--bs-body-bg);
            border-radius: 6px;
            padding: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            width: 100%;
            transition: 0.3s;
            border: 1px solid transparent;
        }

        .btn-login:hover {
            background-color: var(--bs-body-bg);
            color: var(--bs-emphasis-color);
            border-color: var(--bs-emphasis-color);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: var(--bs-secondary-color);
            text-decoration: none;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: var(--bs-emphasis-color);
        }

        #themeToggle {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            color: var(--bs-secondary-color);
            cursor: pointer;
            transition: color 0.3s ease;
        }
        #themeToggle:hover {
            color: var(--bs-emphasis-color);
        }
    </style>

    <script>
        // Previne piscar no modo escuro
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

<body>

    <div class="login-card">
        <button id="themeToggle" title="Alternar Tema">
            <svg id="themeIcon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                <!-- Icono renderizado por JS -->
            </svg>
        </button>

        <h2 class="login-title">AutoMotors<br><span style="font-size: 1rem; font-weight: 300;" class="text-body-secondary">Acesso Admin</span></h2>

        <form action="?pagina=painel" method="POST">
            <div class="mb-3">
                <label class="form-label text-body-secondary small fw-bold text-uppercase">Usuário</label>
                <input type="text" class="form-control" placeholder="Digite seu usuário" required>
            </div>

            <div class="mb-4">
                <label class="form-label text-body-secondary small fw-bold text-uppercase">Senha</label>
                <input type="password" class="form-control" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn btn-login">Entrar no Sistema</button>
        </form>

        <a href="?pagina=home" class="back-link">← Voltar para o Site</a>
    </div>

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
</body>

</html>