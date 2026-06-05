<?php
require_once __DIR__ . '/../../Config/Root.php';
class VeiculoController
{
    private VeiculoRepository $rep;

    public function __construct($pdo)
    {
        $this->rep = new VeiculoRepository($pdo);
    }

    public function cadastrar()
    {
        try {
            $veiculo = new Veiculo($_POST);

            $veiculoId = $this->rep->cadastrar($veiculo);
            
            // Trata o upload das fotos (foto_1 e foto_2 únicos, foto_3 múltiplo para galeria/interior)
            foreach (['foto_1', 'foto_2', 'foto_3'] as $tipo) {
                if (isset($_FILES[$tipo])) {
                    if (is_array($_FILES[$tipo]['name'])) {
                        // Multiplos uploads (foto_3 galeria)
                        $count = count($_FILES[$tipo]['name']);
                        for ($i = 0; $i < $count; $i++) {
                            if ($_FILES[$tipo]['error'][$i] === UPLOAD_ERR_OK) {
                                $dados = file_get_contents($_FILES[$tipo]['tmp_name'][$i]);
                                $mimeType = $_FILES[$tipo]['type'][$i];
                                $this->rep->salvarImagem($veiculoId, $tipo, $mimeType, $dados);
                            }
                        }
                    } else {
                        // Upload único
                        if ($_FILES[$tipo]['error'] === UPLOAD_ERR_OK) {
                            $dados = file_get_contents($_FILES[$tipo]['tmp_name']);
                            $mimeType = $_FILES[$tipo]['type'];
                            $this->rep->salvarImagem($veiculoId, $tipo, $mimeType, $dados);
                        }
                    }
                }
            }
            return $veiculoId;
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    public function listar()
    {
        $modelo = isset($_GET['modelo']) ? $_GET['modelo'] : '';
        $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
        $preco  = isset($_GET['preco']) ? $_GET['preco'] : '';

        $veiculo = $this->rep->listarTodos($modelo, $categoria, $preco);
        return $veiculo;
    }

    public function delete($id)
    {
        try {
            if (!is_numeric($id)) {
                throw new Exception("ID inválido");
            }

            $this->rep->deletar($id);
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    public function atualizar($id)
    {
        try {
            if (!is_numeric($id)) {
                throw new Exception("ID inválido");
            }

            $veiculo = new Veiculo($_POST);

            $this->rep->atualizar($id, $veiculo);
            
            // Trata o upload das fotos enviadas na edição (foto_1 e foto_2 únicos, foto_3 múltiplo)
            foreach (['foto_1', 'foto_2', 'foto_3'] as $tipo) {
                if (isset($_FILES[$tipo])) {
                    if (is_array($_FILES[$tipo]['name'])) {
                        // Multiplos uploads (foto_3 galeria)
                        $count = count($_FILES[$tipo]['name']);
                        for ($i = 0; $i < $count; $i++) {
                            if ($_FILES[$tipo]['error'][$i] === UPLOAD_ERR_OK) {
                                $dados = file_get_contents($_FILES[$tipo]['tmp_name'][$i]);
                                $mimeType = $_FILES[$tipo]['type'][$i];
                                $this->rep->salvarImagem($id, $tipo, $mimeType, $dados);
                            }
                        }
                    } else {
                        // Upload único
                        if ($_FILES[$tipo]['error'] === UPLOAD_ERR_OK) {
                            $dados = file_get_contents($_FILES[$tipo]['tmp_name']);
                            $mimeType = $_FILES[$tipo]['type'];
                            $this->rep->salvarImagem($id, $tipo, $mimeType, $dados);
                        }
                    }
                }
            }
            return true;
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    public function buscarPorId($id)
    {
        try {
            if (!is_numeric($id)) {
                return null;
            }
            return $this->rep->buscarPorId($id);
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
            return null;
        }
    }

    public function obterImagemPorVeiculoETipo($veiculoId, $tipo)
    {
        try {
            if (!is_numeric($veiculoId)) {
                return null;
            }
            return $this->rep->obterImagem($veiculoId, $tipo);
        } catch (Exception $e) {
            return null;
        }
    }

    public function obterImagemPorId($id)
    {
        try {
            if (!is_numeric($id)) {
                return null;
            }
            return $this->rep->obterImagemPorId($id);
        } catch (Exception $e) {
            return null;
        }
    }

    public function listarImagensPorVeiculoETipo($veiculoId, $tipo)
    {
        try {
            if (!is_numeric($veiculoId)) {
                return [];
            }
            return $this->rep->listarImagensPorVeiculoETipo($veiculoId, $tipo);
        } catch (Exception $e) {
            return [];
        }
    }

    public function deletarImagem($id)
    {
        try {
            if (!is_numeric($id)) {
                return false;
            }
            return $this->rep->deletarImagem($id);
        } catch (Exception $e) {
            return false;
        }
    }
}
