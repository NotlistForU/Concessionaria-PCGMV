<?php
// Por enquanto so vi necessidade de Service para o User...
require_once __DIR__ . '../../Config/Root.php';
require_once ROOT_PATH . '/app/Model/User.php';
require_once ROOT_PATH . '/app/Repository/Users/UserRepository.php';

class UserService
{
    public function __construct(
        private UserRepository $userRepository
    ) {}

    public function login($nome, $senha): User | false
    {
        $user = $this->userRepository->buscarPorNome($nome);
        if (!$user) return false;
        if (!password_verify($senha, $user->getSenha())) return false;

        return $user;
    }

    public function cadastrarUser($nome, $senha, $key_value)
    {
        if (strlen($senha) < 8) {
            throw new Exception('Senha muito curta');
        }
        if ($this->userRepository->buscarPorNome($nome) != null) {
            throw new Exception('Usuário já existe');
        }
        $key = $this->userRepository->buscarKey($key_value);
        if (!$key) {
            throw new Exception('Key desconhecida!');
        }

        if ($key['key_status'] == 1) {
            throw new Exception('Key indisponível');
        }
        $user = new User([
            'nome' => $nome,
            'senha' => password_hash($senha, PASSWORD_DEFAULT)
        ]);
        $this->userRepository->cadastrarUser($user);

        $this->userRepository->alterarStatusKey($key_value);

        return true;
    }
}
