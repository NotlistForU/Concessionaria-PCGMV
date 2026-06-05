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
    public function listarTodos($modelo = '', $categoria = '', $preco_max = '')
    {
        try {
            $sql = "SELECT * FROM veiculos WHERE 1=1";

            $parametros = [];

            // FILTROS:

            // Modelo
            if (!empty($modelo)) {
                $sql .= " AND modelo LIKE :modelo";
                $parametros[':modelo'] = "%" . $modelo . "%";
            }
            // Categoria
            if (!empty($categoria)) {
                $sql .= " AND categoria LIKE :categoria";
                $parametros[':categoria'] = "%" . $categoria . "%";
            }
            // Preço
            if (!empty($preco_max)) {
                $sql .= " AND preco <= :preco";
                $parametros[':preco'] =  $preco_max;
            }
            $sql .= " ORDER BY data_cadastro DESC";


            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parametros);

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
                modelo, versao, categoria, ano_modelo, ano_fabricacao, quilometragem,
                motorizacao, transmissao, potencia, aceleracao, portas, combustivel,
                cor, preco, status, descricao_exterior, descricao_interior
            ) VALUES (
                :modelo, :versao, :categoria, :ano_modelo, :ano_fabricacao, :quilometragem,
                :motorizacao, :transmissao, :potencia, :aceleracao, :portas, :combustivel,
                :cor, :preco, :status, :descricao_exterior, :descricao_interior
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
                ':aceleracao'         => $veiculo->getAceleracao(),
                ':portas'             => $veiculo->getPortas(),
                ':combustivel'        => $veiculo->getCombustivel(),
                ':cor'                => $veiculo->getCor(),
                ':preco'              => $veiculo->getPreco(),
                ':status'             => $veiculo->getStatus(),
                ':descricao_exterior' => $veiculo->getDescricaoExterior(),
                ':descricao_interior' => $veiculo->getDescricaoInterior()
            ]);

            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            die("Erro ao cadastrar veículo: " . $e->getMessage());
        }
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
                    preco = :preco,
                    status = :status,
                    descricao_exterior = :descricao_exterior,
                    descricao_interior = :descricao_interior
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
                ':aceleracao'         => $veiculo->getAceleracao(),
                ':portas'             => $veiculo->getPortas(),
                ':combustivel'        => $veiculo->getCombustivel(),
                ':cor'                => $veiculo->getCor(),
                ':preco'              => $veiculo->getPreco(),
                ':status'             => $veiculo->getStatus(),
                ':descricao_exterior' => $veiculo->getDescricaoExterior(),
                ':descricao_interior' => $veiculo->getDescricaoInterior(),
                ':id'                 => $id
            ]);

            return true;
        } catch (PDOException $e) {
            // Mudei para DIE aqui para que, se der erro de novo, a tela trave e você veja o problema!
            die("Erro crítico ao atualizar veículo: " . $e->getMessage());
        }
    }

    public function deletar($id)
    {
        try {
            // 1. Buscar todas as imagens vinculadas ao veículo para apagá-las do disco
            $sqlImagens = "SELECT caminho_arquivo FROM veiculo_imagens WHERE veiculo_id = :id";
            $stmtImagens = $this->pdo->prepare($sqlImagens);
            $stmtImagens->execute([':id' => $id]);
            $imagens = $stmtImagens->fetchAll(PDO::FETCH_ASSOC);

            foreach ($imagens as $img) {
                $caminho = $img['caminho_arquivo'];
                if ($caminho && file_exists(ROOT_PATH . '/public/' . $caminho)) {
                    @unlink(ROOT_PATH . '/public/' . $caminho);
                }
            }

            // 2. Deletar o veículo (a chave estrangeira ON DELETE CASCADE cuidará das tabelas agendamentos, compras, veiculo_imagens no banco)
            $sql = "DELETE FROM veiculos WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            die("Erro ao deletar veiculo: " . $e->getMessage());
        }
    }

    public function salvarImagem($veiculoId, $tipo, $mimeType, $caminhoArquivo)
    {
        try {
            // Para outras (galeria/interior), permitimos múltiplos registros.
            if ($tipo === 'foto_1' || $tipo === 'foto_2') {
                $sqlCheck = "SELECT id, caminho_arquivo FROM veiculo_imagens WHERE veiculo_id = :veiculo_id AND tipo = :tipo";
                $stmtCheck = $this->pdo->prepare($sqlCheck);
                $stmtCheck->execute([
                    ':veiculo_id' => $veiculoId,
                    ':tipo'       => $tipo
                ]);
                $registroExistente = $stmtCheck->fetch(PDO::FETCH_ASSOC);

                if ($registroExistente) {
                    $idExistente = $registroExistente['id'];
                    $caminhoAntigo = $registroExistente['caminho_arquivo'];

                    // Deletar o arquivo antigo correspondente no disco
                    if ($caminhoAntigo && file_exists(ROOT_PATH . '/public/' . $caminhoAntigo)) {
                        @unlink(ROOT_PATH . '/public/' . $caminhoAntigo);
                    }

                    $sqlUpdate = "UPDATE veiculo_imagens SET mime_type = :mime_type, caminho_arquivo = :caminho_arquivo WHERE id = :id";
                    $stmtUpdate = $this->pdo->prepare($sqlUpdate);
                    $stmtUpdate->execute([
                        ':mime_type'       => $mimeType,
                        ':caminho_arquivo' => $caminhoArquivo,
                        ':id'              => $idExistente
                    ]);
                    return true;
                }
            }

            $sqlInsert = "INSERT INTO veiculo_imagens (veiculo_id, tipo, mime_type, caminho_arquivo) VALUES (:veiculo_id, :tipo, :mime_type, :caminho_arquivo)";
            $stmtInsert = $this->pdo->prepare($sqlInsert);
            $stmtInsert->execute([
                ':veiculo_id'      => $veiculoId,
                ':tipo'            => $tipo,
                ':mime_type'       => $mimeType,
                ':caminho_arquivo' => $caminhoArquivo
            ]);
            return true;
        } catch (PDOException $e) {
            die("Erro ao salvar imagem no banco: " . $e->getMessage());
        }
    }

    public function obterImagem($veiculoId, $tipo)
    {
        try {
            // Retorna o primeiro registro encontrado
            $sql = "SELECT id, mime_type, caminho_arquivo FROM veiculo_imagens WHERE veiculo_id = :veiculo_id AND tipo = :tipo ORDER BY id ASC LIMIT 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':veiculo_id' => $veiculoId,
                ':tipo'       => $tipo
            ]);
            $dados = $stmt->fetch(PDO::FETCH_ASSOC);
            return $dados ? $dados : null;
        } catch (PDOException $e) {
            die("Erro ao buscar imagem no banco: " . $e->getMessage());
        }
    }

    public function obterImagemPorId($id)
    {
        try {
            $sql = "SELECT mime_type, caminho_arquivo FROM veiculo_imagens WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
            $dados = $stmt->fetch(PDO::FETCH_ASSOC);
            return $dados ? $dados : null;
        } catch (PDOException $e) {
            die("Erro ao buscar imagem por ID no banco: " . $e->getMessage());
        }
    }

    public function listarImagensPorVeiculoETipo($veiculoId, $tipo)
    {
        try {
            $sql = "SELECT id, mime_type, caminho_arquivo FROM veiculo_imagens WHERE veiculo_id = :veiculo_id AND tipo = :tipo ORDER BY id ASC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':veiculo_id' => $veiculoId,
                ':tipo'       => $tipo
            ]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erro ao listar imagens no banco: " . $e->getMessage());
        }
    }

    public function deletarImagem($id)
    {
        try {
            // Buscar o caminho da imagem antes de deletar
            $sqlSelect = "SELECT caminho_arquivo FROM veiculo_imagens WHERE id = :id";
            $stmtSelect = $this->pdo->prepare($sqlSelect);
            $stmtSelect->execute([':id' => $id]);
            $caminho = $stmtSelect->fetchColumn();

            if ($caminho && file_exists(ROOT_PATH . '/public/' . $caminho)) {
                @unlink(ROOT_PATH . '/public/' . $caminho);
            }

            $sql = "DELETE FROM veiculo_imagens WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            die("Erro ao deletar imagem no banco: " . $e->getMessage());
        }
    }
}
