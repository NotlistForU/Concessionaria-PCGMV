<?php
// Puxa conexão com o banco
require_once '../database/conexao.php';

class VeiculoController
{
    private $pdo;

    // Quando o controller for chamado, ele já recebe a conexão pronta
    public function __construct($conexao)
    {
        $this->pdo = $conexao;
    }

    // Função para buscar todos os carros e mandar para a vitrine
    public function listarTodos()
    {
        try {
            $sql = "SELECT * FROM veiculos ORDER BY data_cadastro DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            // Retorna um array com todos os carros do banco.
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erro ao buscar veículos: " . $e->getMessage());
        }
    }

    // Função para receber os dados e salvar no banco
    public function cadastrar($dados)
    {
        try {
            // Os "dois pontos" (:marca) são marcadores de segurança do PDO
            $sql = "INSERT INTO veiculos (marca, modelo, ano,  motorizacao, preco, url_foto)
                    VALUES (:marca, :modelo, :ano, :motorizacao, :preco, :url_foto)";
            $stmt = $this->pdo->prepare($sql);

            // Substitui os marcadores pelos dados reais que vieram do formulário
            $stmt->execute([
                ':marca'    => $dados['marca'],
                ':ano'         => $dados['ano'],
                ':motorizacao' => $dados['motorizacao'],
                ':preco'       => $dados['preco'],
                ':url_foto'    => empty($dados['url_foto']) ? '/concessionaria-pcgm/assets/images/car_default.png' : $dados['url_foto']
            ]);

            return true;
        } catch (PDOException $e) {
            die("Erro ao cadastrar veículo: " . $e->getMessage());
        }
    }
}
/*

    Exemplo de uso para o frontend:
    // No topo do arquivo view/pagina.php:
    -- Para fazer o teste descomente o codigo a baixo:
    e acesse esse arquivo no localhost: http://localhost/Concessionaria-PCGM/controller/VehicleController.php
    require_once '../database/conexao.php';
    require_once '../controller/VeiculoController.php';

    $controller = new VeiculoController($pdo);
    $listaDeCarros = $controller->listarTodos(); -> tem todos os carros do banco.
*/