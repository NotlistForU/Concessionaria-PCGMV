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
require_once ROOT_PATH . '/app/Service/UserService.php';
require_once ROOT_PATH . '/app/Controller/User/UserController.php';
require_once ROOT_PATH . '/app/Helpers/Validadores.php';

// Iniciar o Controller
$controller = new VeiculoController($pdo);


// User
$userRepository = new UserRepository($pdo);
$userService    = new UserService($userRepository);
$userController = new UserController($userService);

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
        // 1. Busca os Test Drives
        $sqlTest = "SELECT a.*, v.modelo, v.versao 
                    FROM agendamentos a 
                    JOIN veiculos v ON a.veiculo_id = v.id 
                    ORDER BY a.data_interesse DESC";
        $stmtTest = $pdo->prepare($sqlTest);
        $stmtTest->execute();
        $listaAgendamentos = $stmtTest->fetchAll(PDO::FETCH_ASSOC);

        // 2. Busca as Propostas de Compra
        $sqlCompra = "SELECT c.*, v.modelo, v.versao 
                        FROM compras c 
                        JOIN veiculos v ON c.veiculo_id = v.id 
                        ORDER BY c.data_solicitacao DESC";
        $stmtCompra = $pdo->prepare($sqlCompra);
        $stmtCompra->execute();
        $listaCompras = $stmtCompra->fetchAll(PDO::FETCH_ASSOC);

        // Chama a tela do Painel passando as duas listas!
        require_once $caminho_views . 'admin/agendamentos.php';
        break;

    // ==========================================
    // AÇÕES DO BANCO DE DADOS (Invisíveis)
    // ==========================================

    case 'processar_agendamento':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Se for Test Drive, valida a CNH antes de continuar
            if ($_POST['tipo_agendamento'] === 'Test Drive') {
                if (!validar_cnh($_POST['cnh'])) {
                    // CNH inválida: volta pra tela do carro com erro
                    header("Location: ?pagina=detalhes&id=" . $_POST['veiculo_id'] . "&erro_cnh=1");
                    exit;
                }
            }

            // Lógica ultra rápida sem precisar criar classe nova
            $sql = "INSERT INTO agendamentos (nome_cliente, telefone, cnh, data_interesse, tipo_agendamento, veiculo_id) 
                    VALUES (:nome, :tel, :cnh, :data, :tipo, :id)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nome'  => $_POST['nome_cliente'],
                ':tel'   => $_POST['telefone'],
                ':cnh'   => $_POST['cnh'],
                ':data'  => $_POST['data_interesse'],
                ':tipo'  => $_POST['tipo_agendamento'],
                ':id'    => $_POST['veiculo_id']
            ]);

            // Redireciona de volta com uma mensagem de sucesso (opcional)
            header("Location: ?pagina=detalhes&id=" . $_POST['veiculo_id'] . "&sucesso=1");
            exit;
        }
        break;

    case 'processar_compra':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Se for Compra, valida o WhatsApp antes de continuar
            if (!validar_whatsapp($_POST['telefone'])) {
                // WhatsApp inválido: volta pra tela do carro com erro
                header("Location: ?pagina=detalhes&id=" . $_POST['veiculo_id'] . "&erro_whatsapp=1");
                exit;
            }

            $sql = "INSERT INTO compras (nome_cliente, telefone, forma_pagamento, tem_troca, veiculo_id) 
                    VALUES (:nome, :tel, :pagamento, :troca, :id)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nome'      => $_POST['nome_cliente'],
                ':tel'       => $_POST['telefone'],
                ':pagamento' => $_POST['forma_pagamento'],
                ':troca'     => $_POST['tem_troca'],
                ':id'        => $_POST['veiculo_id']
            ]);
            header("Location: ?pagina=detalhes&id=" . $_POST['veiculo_id'] . "&sucesso_compra=1");
            exit;
        }
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
