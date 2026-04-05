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

    case 'editar':
        require_once $caminho_views . 'admin/editar.php';
        break;

    case 'agendamentos':
        // Busca rápida dos agendamentos juntando com os dados do veículo
        // Usamos o INNER JOIN para pegar o modelo e a versão do carro através do veiculo_id
        $sql = "SELECT a.*, v.modelo, v.versao 
                FROM agendamentos a 
                JOIN veiculos v ON a.veiculo_id = v.id 
                ORDER BY a.data_interesse DESC";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $listaAgendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once $caminho_views . 'admin/agendamentos.php';
        break;

    // ==========================================
    // AÇÕES DO BANCO DE DADOS (Invisíveis)
    // ==========================================

    case 'processar_agendamento':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lógica ultra rápida sem precisar criar classe nova
            $sql = "INSERT INTO agendamentos (nome_cliente, telefone, data_interesse, tipo_agendamento, veiculo_id) 
                    VALUES (:nome, :tel, :data, :tipo, :id)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nome'  => $_POST['nome_cliente'],
                ':tel'   => $_POST['telefone'],
                ':data'  => $_POST['data_interesse'],
                ':tipo'  => $_POST['tipo_agendamento'],
                ':id'    => $_POST['veiculo_id']
            ]);

            // Redireciona de volta com uma mensagem de sucesso (opcional)
            header("Location: ?pagina=detalhes&id=" . $_POST['veiculo_id'] . "&sucesso=1");
            exit;
        }
        break;

    case 'processar_cadastro':
        // Só aceita se vier de um formulário via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->cadastrar();
            // Volta para a tabela de estoque
            header("Location: ?pagina=painel");
            exit;
        }
        break;

    case 'processar_edicao':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Pega o ID que mandamos escondido no formulário
            $id = $_POST['id'];
            $controller->atualizar($id);
            header("Location: ?pagina=painel");
            exit;
        }
        break;

    case 'deletar':
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
