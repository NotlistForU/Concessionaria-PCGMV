<?php
// Puxa conexão com o banco
require_once '../database/conexao.php';

class Veiculo
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

    // Função para buscar os dados de um único veículo pelo ID
    public function buscarPorId($id)
    {
        try {
            // Os "dois pontos" (:marca) são marcadores de segurança do PDO
            $sql = "SELECT * FROM veiculos WHERE isd = :id";
            $stmt = $this->pdo->prepare($sql);
            // Substitui o marcado pelo dado reaL que veio do formulário
            $stmt->execute([':id' => 'id']);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erro ao buscar veículo: " . $e->getMessage());
        }
    }

    // Função para receber os dados e salvar no banco
    public function cadastrar($dados)
    {
        try {

            $sql = "INSERT INTO veiculos (
                modelo,
                versao,
                ano,
                quilometragem,
                motorizacao,
                transmissao,
                potencia,
                torque,
                portas,
                combustivel,
                cor,
                descricao,
                preco,
                url_foto,
                data_cadastro,
                marca_id
            ) VALUES (
                :modelo,
                :versao,
                :ano,
                :quilometragem,
                :motorizacao,
                :transmissao,
                :potencia,
                :torque,
                :portas,
                :combustivel,
                :cor,
                :descricao,
                :preco,
                :url_foto,
                :data_cadastro,
                :marca_id
            )";

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                ':modelo'        => $dados['modelo'],
                ':versao'        => $dados['versao'],
                ':ano'           => $dados['ano'],
                ':quilometragem' => $dados['quilometragem'],
                ':motorizacao'   => $dados['motorizacao'],
                ':transmissao'   => $dados['transmissao'],
                ':potencia'      => $dados['potencia'],
                ':torque'        => $dados['torque'],
                ':portas'        => $dados['portas'],
                ':combustivel'   => $dados['combustivel'],
                ':cor'           => $dados['cor'],
                ':descricao'     => $dados['descricao'],
                ':preco'         => $dados['preco'],
                ':url_foto'      => empty($dados['url_foto'])
                    ? '/concessionaria-pcgm/assets/images/car_default.png'
                    : $dados['url_foto'],
                ':data_cadastro' => date('Y-m-d H:i:s'),
                ':marca_id'      => $dados['marca_id']
            ]);
        } catch (PDOException $e) {
            echo "Erro ao cadastrar veículo: " . $e->getMessage();
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
    }

    // Função para atualizar os dados no banco
    public function atualizar($id, $dados)
    {
        try {

            $sql = "UPDATE veiculos SET
                    modelo = :modelo,
                    versao = :versao,
                    ano = :ano,
                    quilometragem = :quilometragem,
                    motorizacao = :motorizacao,
                    transmissao = :transmissao,
                    potencia = :potencia,
                    torque = :torque,
                    portas = :portas,
                    combustivel = :combustivel,
                    cor = :cor,
                    descricao = :descricao,
                    preco = :preco,
                    url_foto = :url_foto,
                    marca_id = :marca_id
                WHERE id = :id";

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                ':modelo'        => $dados['modelo'],
                ':versao'        => $dados['versao'],
                ':ano'           => $dados['ano'],
                ':quilometragem' => $dados['quilometragem'],
                ':motorizacao'   => $dados['motorizacao'],
                ':transmissao'   => $dados['transmissao'],
                ':potencia'      => $dados['potencia'],
                ':torque'        => $dados['torque'],
                ':portas'        => $dados['portas'],
                ':combustivel'   => $dados['combustivel'],
                ':cor'           => $dados['cor'],
                ':descricao'     => $dados['descricao'],
                ':preco'         => $dados['preco'],
                ':url_foto'      => empty($dados['url_foto'])
                    ? '/concessionaria-pcgm/assets/images/car_default.png'
                    : $dados['url_foto'],
                ':marca_id'      => $dados['marca_id'],
                ':id'            => $id
            ]);

            return true;
        } catch (PDOException $e) {
            echo "Erro ao atualizar veículo: " . $e->getMessage();
            return false;
        }
    }
}
