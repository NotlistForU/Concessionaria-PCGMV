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

    public function autenticarUser($nome, $senha): User | false
    {
        try {
            $sql = "SELECT * FROM usuarios WHERE nome = :nome";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':nome' => $nome]);
            $dados = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$dados) return false;

            if (password_verify($senha, $dados['senha'])) {
                return new User($dados);
            }
            return false;
        } catch (PDOException $e) {
            die("Erro ao autenticar usuário: " . $e->getMessage());
        }
    }

    public function buscarPorId($id): User
    {
        return $this->buscarUser('id', $id);
    }

    public function buscarPorNome($nome): User
    {
        return $this->buscarUser('nome', $nome);
    }

    public function cadastrar(User $user): User
    {
        try {
            if ($this->buscarPorNome($user->getNome())) {
                throw new Exception("Usuário já existe!");
            }
            $sql = "INSERT INTO usuarios (nome, senha) VALUES (:nome, :senha)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':nome' => $user->getNome(),
                ':senha' => password_hash($user->getSenha(), PASSWORD_DEFAULT)
            ]);

            $dados = $stmt->fetch(PDO::FETCH_ASSOC);
            return new User($dados);
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
