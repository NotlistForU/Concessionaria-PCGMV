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
            background-color: #ffffff;
            color: #262626;
            overflow-x: hidden;
        }

        .navbar {
            background-color: #ffffff !important;
            padding: 20px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: 2px;
            color: #000000 !important;
        }

        .nav-link {
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #000 !important;
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
            color: #000;
            border: 1px solid #000;
            padding: 8px 20px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .nav-btn:hover {
            background-color: #000;
            color: #fff;
        }

        /* Estilos globais úteis */
        .section-title {
            font-weight: 300;
            font-size: 2.5rem;
            color: #262626;
            margin-bottom: 50px;
            text-align: center;
        }

        .car-card {
            border: none;
            border-radius: 0;
            background: transparent;
        }

        .car-card img {
            border-radius: 0;
            object-fit: cover;
            height: 350px;
            width: 100%;
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
        }

        .btn-link-custom:hover {
            color: #0b4392;
            text-decoration: underline;
        }

        footer {
            border-top: 1px solid #f0f0f0;
            padding: 40px 0;
            margin-top: 80px;
        }
    </style>
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

            <div class="ms-auto">
                <a href="?pagina=login" class="nav-btn">Acesso Admin</a>
            </div>
        </div>
    </nav>