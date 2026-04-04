<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoMotors</title>
    <link rel="icon" type="image/svg+xml" href="assets/img/logoBmw.svg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <style>
        /* Importando uma fonte que lembra a da montadora */
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #ffffff;
            color: #262626;
            overflow-x: hidden;
        }

        /* Navbar Super Limpa (Fundo Branco) */
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

        /* Hero Section (Banner Gigante) */
        .hero {
            /* Aqui usamos a foto_1 como fundo gigante da tela toda */
            background-image: url('assets/img/foto_3.png');
            background-size: cover;
            background-position: center;
            height: 85vh;
            /* Ocupa 85% da tela do usuário */
            position: relative;
            display: flex;
            align-items: center;
        }

        /* Degradê para o texto ficar legível em cima de qualquer foto */
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.1) 100%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: #ffffff;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            line-height: 1.1;
        }

        .hero-subtitle {
            font-weight: 300;
            font-size: 1.5rem;
            margin-bottom: 40px;
        }

        .btn-hero {
            border: 2px solid #ffffff;
            background: transparent;
            color: #ffffff;
            padding: 15px 40px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-hero:hover {
            background-color: #ffffff;
            color: #000000;
        }

        /* Seção de Modelos */
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
            /* Fotos grandes e alinhadas */
            width: 100%;
        }

        .car-card .card-body {
            padding: 25px 0 0 0;
            /* Espaço só em cima, alinhado à esquerda */
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
            /* Azul estilo link de montadora */
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

        /* Footer Seco */
        footer {
            border-top: 1px solid #f0f0f0;
            padding: 40px 0;
            margin-top: 80px;
        }
    </style>
</head>

<body>

    <?php require_once '../app/Views/components/header.php'; ?>

    <section class="hero">
        <div class="hero-overlay"></div>
        <div class="container-fluid px-5 hero-content">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="hero-title">Puro<br>Prazer.</h1>
                    <p class="hero-subtitle mt-3">Descubra a nova linha de sedans esportivos.</p>
                    <a href="?pagina=detalhes&id=1" class="btn-hero d-inline-block mt-2">Configurar</a>
                </div>
            </div>
        </div>
    </section>

    <div id="modelos" class="container mt-5 pt-5">
        <h2 class="section-title">ENCONTRE O SEU MODELO.</h2>

        <div class="row g-5">

            <div class="col-md-6">
                <div class="card car-card">
                    <img src="assets/img/foto_1.png" alt="Modelo 1">
                    <div class="card-body">
                        <h5 class="card-title">Série 3</h5>
                        <p class="card-text">O sedan esportivo definitivo.</p>
                        <a href="?pagina=detalhes&id=1" class="btn-link-custom">Descubra mais &gt;</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card car-card">
                    <img src="assets/img/foto_1.png" alt="Modelo 2">
                    <div class="card-body">
                        <h5 class="card-title">X5 M Competition</h5>
                        <p class="card-text">Presença imponente, performance irretocável.</p>
                        <a href="?pagina=detalhes&id=2" class="btn-link-custom">Descubra mais &gt;</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card car-card">
                    <img src="assets/img/foto_4.png" alt="Modelo 3">
                    <div class="card-body">
                        <h5 class="card-title">i4 M50</h5>
                        <p class="card-text">100% elétrico. 100% adrenalina.</p>
                        <a href="?pagina=detalhes&id=3" class="btn-link-custom">Descubra mais &gt;</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card car-card">
                    <img src="assets/img/foto_5.png" alt="Modelo 4">
                    <div class="card-body">
                        <h5 class="card-title">Série 4 Cabrio</h5>
                        <p class="card-text">Liberdade sem limites.</p>
                        <a href="?pagina=detalhes&id=4" class="btn-link-custom">Descubra mais &gt;</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php require_once '../app/Views/components/footer.php'; ?>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>