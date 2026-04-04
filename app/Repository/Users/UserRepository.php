<?php
require_once __DIR__ . '/../../Config/Root.php';
// Puxa conexão com o banco
require_once ROOT_PATH . '/app/Database/Conexao.php';
require_once ROOT_PATH . '/app/Model/User.php';

class UserRepository
{
    private $pdo;

    // Quando for chamado, ele já recebe a conexão pronta
    public function __construct($conexao)
    {
        $this->pdo = $conexao;
    }

    public function listarTodos() {}
    public function buscarPorId($id) {}
    public function cadastrar() {}
    public function atualizar() {}
    public function deletar() {}
}
