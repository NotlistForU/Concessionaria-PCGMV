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

            $this->rep->cadastrar($veiculo);

            echo "Cadastrado com sucesso!";
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    public function listar()
    {
        $veiculo = $this->rep->listarTodos();
        return $veiculo;
    }

    public function delete($id)
    {
        try {
            if (!is_numeric($id)) {
                throw new Exception("ID inválido");
            }

            $this->rep->deletar($id);

            echo "Deletando com sucesso!";
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

            echo "Atualizando com sucesso!";
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
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
}
