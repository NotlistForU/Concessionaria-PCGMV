<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso Restrito - AutoMotors</title>

    <link rel="icon" type="image/svg+xml" href="assets/img/logoBmw.svg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/main.js" defer></script>
</head>

<body class="login-page">

    <div class="login-card">
        <button id="themeToggle" title="Alternar Tema">
            <span id="themeIcon" width="40" height="40" fill="currentColor">
                <!-- Icono renderizado por JS -->
            </span>
        </button>

        <h2 class=" login-title">AutoMotors<br><span style="font-size: 1rem; font-weight: 300;" class="text-body-secondary">Acesso Admin</span></h2>

        <form action="?pagina=processar-login" method="POST">
            <div class="mb-3">
                <label class="form-label text-body-secondary small fw-bold text-uppercase">Usuário</label>
                <input name="nome" type="text" class="form-control" placeholder="Digite seu usuário" required>
            </div>

            <div class="mb-4">
                <label class="form-label text-body-secondary small fw-bold text-uppercase">Senha</label>
                <input name="senha" type="password" class="form-control" placeholder="••••••••" required>
            </div>
            <?php if (isset($_GET['erro_login'])): ?>
                <div class="alert alert-danger rounded-0 small mb-4">
                    <strong>Ops!</strong> Login incorreto, tente novamente.
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-login">Entrar no Sistema</button>
        </form>

        <a href="?pagina=home" class="back-link">← Voltar para o Site</a>
    </div>

</body>

</html>