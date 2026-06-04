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

    public function buscarPorId($id): User
    {
        return $this->buscarUser('id', $id);
    }

    public function buscarPorNome($nome): User | null
    {
        return $this->buscarUser('nome', $nome);
    }

    public function buscarKey($key_valor)
    {
        try {
            $sql =
                "SELECT * FROM keys_usuarios_autorizados
                WHERE 
                    key_user = :key_valor";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['key_valor' => $key_valor]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error ao buscar key" . $e->getMessage());
        }
    }

    public function alterarStatusKey($key_valor)
    {
        try {
            $sql =
                "UPDATE keys_usuarios_autorizados
                SET key_status = 1
                WHERE 
                    key_user = :key_value";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['key_value' => $key_valor]);
            return true;
        } catch (PDOException $e) {
            die("Erro ao alterar status da key!" . $e->getMessage());
        }
    }

    public function cadastrarUser(User $user): User
    {
        try {
            $sql = "INSERT INTO usuarios (nome, senha) VALUES (:nome, :senha)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':nome' => $user->getNome(),
                ':senha' => $user->getSenha()
            ]);
            return $user;
        } catch (PDOException $e) {
            die("Erro ao cadastrar usuário: " . $e->getMessage());
        }
    }
    public function atualizar(User $user): User
    {
        try {
            $sql = "UPDATE usuarios 
                    SET nome = :nome, senha = :senha
                    WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':nome' => $user->getNome(),
                ':senha' => password_hash($user->getSenha(), PASSWORD_DEFAULT),
                ':id' => $user->getId()
            ]);
            $dados = $stmt->fetch(PDO::FETCH_ASSOC);
            return new User($dados);
        } catch (PDOException $e) {
            die("Erro ao atualizar usuário: " . $e->getMessage());
        }
    }
    public function deletar(User $user): bool
    {
        try {
            $sql = "DELETE FROM usuarios WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $user->getId()]);
            return true;
        } catch (PDOException $e) {
            die("Erro ao deletar usuário: " . $e->getMessage());
        }
    }

    public function buscarUser(string $campo, $valor): User | null
    {
        try {
            $campos_permitidos = ['id', 'nome'];
            if (!in_array($campo, $campos_permitidos)) throw new Exception("Campo inválido");
            // Os "dois pontos" (:marca) são marcadores de segurança do PDO
            $sql = "SELECT * FROM usuarios WHERE $campo = :valor";
            $stmt = $this->pdo->prepare($sql);
            // Substitui o marcado pelo dado reaL que veio do formulário
            $stmt->execute([':valor' => $valor]);
            $dados = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$dados) {
                return null;
            }

            return new User($dados);
        } catch (PDOException $e) {
            die("Erro ao buscar usuário pelo $campo: " . $e->getMessage());
        }
    }
}
