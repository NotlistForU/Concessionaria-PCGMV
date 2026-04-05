<?php
require_once __DIR__ . '/../../Config/Root.php';
// Puxa conexão com o banco
require_once ROOT_PATH . '/app/Database/Conexao.php';
require_once ROOT_PATH . '/app/Model/Veiculo.php';

class VeiculoRepository
{
    private $pdo;

    // Quando for chamado, ele já recebe a conexão pronta
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

            $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!$dados) {
                return [];
            }

            foreach ($dados as $row) { // Apilida $dados de $row                                                           array                  array            
                $veiculos[] = new Veiculo($row); // e prencher o objeto com dados  (dados é um array de arrays) entao tem varios veiculos e cada veiculo comm seus dados
                //                                                                                              e ta passando esses dados para cada objeto
            }

            return $veiculos;
        } catch (PDOException $e) {
            die("Erro ao buscar veículos: " . $e->getMessage());
        }
    }

    // Função para buscar os dados de um único veículo pelo ID
    public function buscarPorId($id)
    {
        try {
            // Os "dois pontos" (:marca) são marcadores de segurança do PDO
            $sql = "SELECT * FROM veiculos WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            // Substitui o marcado pelo dado reaL que veio do formulário
            $stmt->execute([':id' => $id]);
            $dados = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$dados) {
                return null;
            }

            return new Veiculo($dados);
        } catch (PDOException $e) {
            die("Erro ao buscar veículo: " . $e->getMessage());
        }
    }

    // Função para receber os dados e salvar no banco
    public function cadastrar(Veiculo $veiculo)
    {
        try {

            $sql = "INSERT INTO veiculos (
                modelo,
                versao,
                categoria,
                ano_modelo,
                ano_fabricacao,
                quilometragem,
                motorizacao,
                transmissao,
                potencia,
                aceleracao,
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
                :categoria,
                :ano_modelo,
                :ano_fabricacao,
                :quilometragem,
                :motorizacao,
                :transmissao,
                :potencia,
                :aceleracao,
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
                ':modelo'             => $veiculo->getModelo(),
                ':versao'             => $veiculo->getVersao(),
                ':categoria'          => $veiculo->getCategoria(),
                ':ano_modelo'         => $veiculo->getAnoModelo(),
                ':ano_fabricacao'     => $veiculo->getAnoFabricacao(),
                ':quilometragem'      => $veiculo->getQuilometragem(),
                ':motorizacao'        => $veiculo->getMotorizacao(),
                ':transmissao'        => $veiculo->getTransmissao(),
                ':potencia'           => $veiculo->getPotencia(),
                ':aceleracao'         => $veiculo->getaceleracao(),
                ':portas'             => $veiculo->getPortas(),
                ':combustivel'        => $veiculo->getCombustivel(),
                ':cor'                => $veiculo->getCor(),
                ':descricao_exterior' => $veiculo->getDescricaoExterior(),
                ':descricao_interior' => $veiculo->getDescricaoInterior(),
                ':preco'              => $veiculo->getPreco(),
                ':url_foto'           => $veiculo->getPastaFoto()
                    ?: '/concessionaria-pcgm/assets/images/car_default.png',
                ':data_cadastro'      => date('Y-m-d H:i:s')
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
        require_once '../Repository/VeiculoRepository.php';

        $veiculoRepository = new VeiculoRepository($pdo);
        $listaDeCarros = $veiculoRepository->listarTodos(); -> tem todos os carros do banco.
    */
    }

    // Função para atualizar os dados no banco
    public function atualizar($id, Veiculo $veiculo)
    {
        try {

            $sql = "UPDATE veiculos SET
                    modelo = :modelo,
                    versao = :versao,
                    categoria = :categoria,
                    ano_modelo = :ano_modelo,
                    ano_fabricacao = :ano_fabricacao,
                    quilometragem = :quilometragem,
                    motorizacao = :motorizacao,
                    transmissao = :transmissao,
                    potencia = :potencia,
                    aceleracao = :aceleracao,
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
                ':modelo'             => $veiculo->getModelo(),
                ':versao'             => $veiculo->getVersao(),
                ':categoria'          => $veiculo->getCategoria(),
                ':ano_modelo'         => $veiculo->getAnoModelo(),
                ':ano_fabricacao'     => $veiculo->getAnoFabricacao(),
                ':quilometragem'      => $veiculo->getQuilometragem(),
                ':motorizacao'        => $veiculo->getMotorizacao(),
                ':transmissao'        => $veiculo->getTransmissao(),
                ':potencia'           => $veiculo->getPotencia(),
                ':aceleracao'         => $veiculo->getaceleracao(),
                ':portas'             => $veiculo->getPortas(),
                ':combustivel'        => $veiculo->getCombustivel(),
                ':cor'                => $veiculo->getCor(),
                ':descricao_exterior' => $veiculo->getDescricaoExterior(),
                ':descricao_interior' => $veiculo->getDescricaoInterior(),
                ':preco'              => $veiculo->getPreco(),
                ':url_foto'           => $veiculo->getPastaFoto()
                    ?: '/concessionaria-pcgm/assets/images/car_default.png',
                ':id'             => $id
            ]);

            return true;
        } catch (PDOException $e) {
            echo "Erro ao atualizar veículo: " . $e->getMessage();
            return false;
        }
    }

    public function deletar($id)
    {
        try {
            $sql = "DELETE FROM veiculos WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            die("Erro ao deletar veiculo: " . $e->getMessage());
        }
    }
}
