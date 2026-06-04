<?php
require_once __DIR__ . '/../../Config/Root.php';
// Puxa conexão com o banco
require_once ROOT_PATH . '/app/Database/Conexao.php';

class AgendamentoRepository
{
    private $pdo;
    public function __construct($conexao)
    {
        $this->pdo = $conexao;
    }

    // TESTE DRIVE
    public function listarAgendamentos()
    {
        try {
            $sql = "SELECT a.*, v.modelo, v.versao 
                    FROM agendamentos a 
                    JOIN veiculos v ON a.veiculo_id = v.id 
                    ORDER BY a.data_interesse DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Erro ao buscar agendamentos ' . $e->getMessage());
        }
    }

    public function listarPropostasCompras()
    {
        try {
            // 2. Busca as Propostas de Compra
            $sql = "SELECT c.*, v.modelo, v.versao 
                        FROM compras c 
                        JOIN veiculos v ON c.veiculo_id = v.id 
                        ORDER BY c.data_solicitacao DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Erro ao buscar propostas de compras ' . $e->getMessage());
        }
    }

    // TESTE DRIVE
    public function registarAgendamento(array $dados): bool
    {
        try {
            $sql = "INSERT INTO agendamentos (nome_cliente, telefone, cnh, data_interesse, veiculo_id) 
                    VALUES (:nome, :tel, :cnh, :data, :id)";
            $stmt = $this->pdo->prepare($sql);

            return
                $stmt->execute([
                    ':nome' => $dados['nome_cliente'],
                    ':tel'  => $dados['telefone'],
                    ':cnh'  => $dados['cnh'],
                    ':data' => $dados['data_interesse'],
                    ':id'   => $dados['veiculo_id']
                ]);
        } catch (PDOException $e) {
            die('Erro ao registrar o agendamento de teste drive ' . $e->getMessage());
        }
    }

    public function registrarPropostaCompra(array $dados): bool
    {
        try {
            $sql = "INSERT INTO compras (nome_cliente, telefone, forma_pagamento, tem_troca, veiculo_id) 
                    VALUES (:nome, :tel, :pagamento, :troca, :id)";
            $stmt = $this->pdo->prepare($sql);
            return
                $stmt->execute([
                    ':nome'      => $dados['nome_cliente'],
                    ':tel'       => $dados['telefone'],
                    ':pagamento' => $dados['forma_pagamento'],
                    ':troca'     => $dados['tem_troca'],
                    ':id'        => $dados['veiculo_id']
                ]);
        } catch (PDOException $e) {
            die('Erro ao registrar o proposta de compra ' . $e->getMessage());
        }
    }
}
