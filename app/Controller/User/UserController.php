<?php
require_once __DIR__ . '/../../Config/Root.php';
require_once ROOT_PATH . '/app/Service/UserService.php';

class UserController
{
    public function __construct(
        private UserService $userService
    ) {}

    public function login(): bool
    {
        $nome = $_POST['nome'] ?? '';
        $senha = $_POST['senha'] ?? '';

        $user = $this->userService->login($nome, $senha);
        if (!$user) return false;

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['user_id'] = $user->getId();
        $_SESSION['user_name'] = $user->getNome();

        return true;
    }

    public function cadastrarUser()
    {
        $nome = $_POST['nome'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $user = $this->userService->cadastrarUser($nome, $senha);

        if ($user) return true;
    }
}
