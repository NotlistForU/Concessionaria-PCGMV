<?php

class User
{
    private ?int $id;
    private ?string $nome;
    private ?string $email;
    private ?string $senha;
    private ?string $userRole;

    public function __construct(array $dados = [])
    {
        if (!empty($dados)) {
            $this->id = $dados['id'] ?? null;
            $this->setNome($dados['nome'] ?? null);
            $this->setEmail($dados['email'] ?? null);
            $this->setSenha($dados['senha'] ?? null);
            $this->setUserRole($dados['user_role'] ?? null);
        }
    }

    // ======================
    // GETTERS
    // ======================

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getNome(): ?string
    {
        return $this->nome;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function getSenha(): ?string
    {
        return $this->senha;
    }
    public function getUserRole(): ?string
    {
        return $this->userRole;
    }

    // ======================
    // SETTERS (com validação)
    // ======================

    public function setNome(?string $nome): void
    {
        if (empty($nome)) {
            throw new Exception("Nome é obrigatório");
        }
        $this->nome = $nome;
    }

    public function setEmail(?string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Email inválido");
        }
        $this->email = $email;
    }

    public function setSenha(?string $senha): void
    {
        if (empty($senha)) {
            throw new Exception("Senha é obrigatória");
        }

        // 🔥 já salva criptografada
        $this->senha = password_hash($senha, PASSWORD_DEFAULT);
    }

    public function setUserRole(?string $role): void
    {
        $rolesValidas = ['cliente', 'vendedor'];

        if (!in_array($role, $rolesValidas)) {
            throw new Exception("Tipo de usuário inválido");
        }

        $this->userRole = $role;
    }

    // ======================
    // TO ARRAY (pra banco)
    // ======================

    public function toArray(): array
    {
        return [
            'nome' => $this->nome,
            'email' => $this->email,
            'senha' => $this->senha,
            'user_role' => $this->userRole
        ];
    }
}
