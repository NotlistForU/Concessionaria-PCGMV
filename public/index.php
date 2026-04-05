<?php
// Inicia a sessão (você vai precisar disso para o login do vendedor depois)
session_start();

require_once __DIR__ . '/../app/Config/Root.php';
require_once ROOT_PATH . '/app/Database/Conexao.php';
require_once ROOT_PATH . '/app/Model/Veiculo.php';
require_once ROOT_PATH . '/app/Repository/Veiculos/VeiculoRepository.php';
require_once ROOT_PATH . '/app/Controller/Veiculo/VeiculoController.php';

// Iniciar o Controller
$controller = new VeiculoController($pdo);

// Pega qual página o usuário quer acessar da URL. Ex: index.php?pagina=admin
// Se ele não digitar nada, a página padrão será a 'home'
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 'home';

// Caminho base para a pasta onde estão suas telas
$caminho_views = '../app/Views/';

// O Roteador: decide qual arquivo carregar
switch ($pagina) {

    // ==========================================
    // ÁREA DO CLIENTE (PÚBLICA)
    // ==========================================
    case 'home':
        require_once $caminho_views . 'public/home.php';
        break;

    case 'detalhes':
        require_once $caminho_views . 'public/detalhes.php';
        break;

    case 'modelos':
        require_once $caminho_views . 'public/modelos.php';
        break;

    // ==========================================
    // ÁREA DO VENDEDOR (ADMIN)
    // ==========================================
    case 'login':
        require_once $caminho_views . 'admin/login.php';
        break;

    case 'painel':
        // No futuro, aqui você verifica se o vendedor está logado usando $_SESSION
        require_once $caminho_views . 'admin/painel.php';
        break;

    case 'cadastrar':
        require_once $caminho_views . 'admin/cadastrar.php';
        break;

    // ==========================================
    // ERRO 404
    // ==========================================
    default:
        echo "<div style='text-align: center; margin-top: 50px; font-family: sans-serif;'>";
        echo "<h1>Erro 404</h1>";
        echo "<p>Página não encontrada!</p>";
        echo "<a href='?pagina=home'>Voltar para a loja</a>";
        echo "</div>";
        break;
}
