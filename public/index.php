<?php
// Inicia a sessão (você vai precisar disso para o login do vendedor depois)
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

require_once __DIR__ . '/../app/Config/Root.php';
require_once ROOT_PATH . '/app/Database/Conexao.php';
require_once ROOT_PATH . '/app/Model/Veiculo.php';
require_once ROOT_PATH . '/app/Repository/Veiculo/VeiculoRepository.php';
require_once ROOT_PATH . '/app/Controller/Veiculo/VeiculoController.php';
require_once ROOT_PATH . '/app/Model/User.php';
require_once ROOT_PATH . '/app/Repository/Users/UserRepository.php';
require_once ROOT_PATH . '/app/Repository/Agendamento/AgendamentoRepository.php';
require_once ROOT_PATH . '/app/Service/UserService.php';
require_once ROOT_PATH . '/app/Service/AgendamentoService.php';
require_once ROOT_PATH . '/app/Controller/User/UserController.php';
require_once ROOT_PATH . '/app/Controller/Agendamentos/AgendamentosController.php';
require_once ROOT_PATH . '/app/Helpers/Validadores.php';

// Iniciar o Controller
$controller = new VeiculoController($pdo);


// User
$userRepository = new UserRepository($pdo);
$userService    = new UserService($userRepository);
$userController = new UserController($userService);

// Agendamentos
$agendamentoRepository = new AgendamentoRepository($pdo);
$agendamentoService = new AgendamentoService($agendamentoRepository);
$agendamentoController = new AgendamentosController($agendamentoService);

// Pega qual página o usuário quer acessar da URL. Ex: index.php?pagina=admin
// Se ele não digitar nada, a página padrão será a 'home'
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 'home';

// Caminho base para a pasta onde estão suas telas
$caminho_views = '../app/Views/';


function estaLogado(): bool
{
    return isset($_SESSION['user_id']);
}

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

    case 'sobre':
        require_once $caminho_views . 'public/sobre.php';
        break;

    case 'termos-de-uso':
        require_once $caminho_views . 'public/termos.php';
        break;

    case 'politica-de-privacidade':
        require_once $caminho_views . 'public/privacidade.php';
        break;

    // ==========================================
    // ÁREA DO VENDEDOR (ADMIN)
    // ==========================================
    case 'login':
        if (estaLogado()) {
            header('Location: ?pagina=painel');
            exit;
        }

        require_once $caminho_views . 'admin/login.php';
        break;
    // CADASTRO USER
    case 'register-admin':
        require_once $caminho_views . 'admin/register_admin.php';
        break;

    case 'processar-login':
        if (
            $_SERVER['REQUEST_METHOD'] === 'POST'
            && $userController->login()
        ) {
            header('Location: ?pagina=painel');
            exit;
        }
        header('Location: ?pagina=login&erro_login=1');
        exit;

    case 'processar-cadastro-admin':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cadastrado = $userController->cadastrarUser();
        }
        if ($cadastrado) {
            header('Location: ?pagina=login');
            exit;
        }
        header('Location: ?pagina=register-admin&erro_register=1');
        exit;


    case 'painel':
        if (!estaLogado()) {
            header('Location: ?pagina=login');
            exit;
        }

        require_once $caminho_views . 'admin/painel.php';
        break;

    // CADASTRAR VEICULO
    case 'cadastrar':
        if (!estaLogado()) {
            header('Location: ?pagina=login');
            exit;
        }
        require_once $caminho_views . 'admin/cadastrar.php';
        break;

    case 'editar':
        if (!estaLogado()) {
            header('Location: ?pagina=login');
            exit;
        }
        require_once $caminho_views . 'admin/editar.php';
        break;

    case 'agendamentos':
        if (!estaLogado()) {
            header('Location: ?pagina=login');
            exit;
        }
        // TESTE DRIVER !
        $agendamentoController->listar();
        break;

    // ==========================================
    // FIM DA ÁREA DO VENDEDOR (ADMIN)
    // ==========================================

    // ==========================================
    // AÇÕES DO BANCO DE DADOS (Invisíveis)
    // ==========================================

    // TERTE DRIVE
    case 'processar_agendamento':
        $agendamentoController->registrarAgendamento();
        break;

    case 'processar_compra':
        $agendamentoController->registrarPorpostaCompra();
        break;

    case 'processar_cadastro':
        if (!estaLogado()) {
            header('Location: ?pagina=login');
            exit;
        }
        // Só aceita se vier de um formulário via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->cadastrar();
            // Volta para a tabela de estoque
            header("Location: ?pagina=painel");
            exit;
        }
        break;

    case 'processar_edicao':
        if (!estaLogado()) {
            header('Location: ?pagina=login');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Pega o ID que mandamos escondido no formulário
            $id = $_POST['id'];
            $controller->atualizar($id);
            header("Location: ?pagina=painel");
            exit;
        }
        break;

    case 'deletar':
        if (!estaLogado()) {
            header('Location: ?pagina=login');
            exit;
        }
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id) {
            $controller->delete($id);
        }
        // Volta para a tabela de estoque atualizada
        header("Location: ?pagina=painel");
        exit;
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
