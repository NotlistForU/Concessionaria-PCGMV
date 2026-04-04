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
            background-color: #f4f4f4;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Roboto', sans-serif;
        }

        .login-card {
            border: none;
            border-radius: 0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background: white;
        }

        .login-title {
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-control {
            border-radius: 0;
            padding: 12px 15px;
            border: 1px solid #ddd;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #000;
        }

        .btn-login {
            background-color: #000;
            color: #fff;
            border-radius: 0;
            padding: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            width: 100%;
            transition: 0.3s;
        }

        .btn-login:hover {
            background-color: #333;
            color: #fff;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #666;
            text-decoration: none;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .back-link:hover {
            color: #000;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <h2 class="login-title">AutoMotors<br><span style="font-size: 1rem; font-weight: 300; color: #666;">Acesso Admin</span></h2>

        <form action="?pagina=painel" method="POST">
            <div class="mb-3">
                <label class="form-label text-muted small fw-bold text-uppercase">Usuário</label>
                <input type="text" class="form-control" placeholder="Digite seu usuário" required>
            </div>

            <div class="mb-4">
                <label class="form-label text-muted small fw-bold text-uppercase">Senha</label>
                <input type="password" class="form-control" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn btn-login">Entrar no Sistema</button>
        </form>

        <a href="?pagina=home" class="back-link">← Voltar para o Site</a>
    </div>

</body>

</html>