<?php

class User
{
    private ?int $id;
    private ?string $nome;
    private ?string $senha;

    public function __construct(array $dados = [])
    {
        if (!empty($dados)) {
            $this->id = $dados['id'] ?? null;
            $this->setNome($dados['nome'] ?? null);
            $this->setSenha($dados['senha'] ?? null);
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

    public function getSenha(): ?string
    {
        return $this->senha;
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


    public function setSenha(?string $senha): void
    {
        if (empty($senha)) {
            throw new Exception("Senha é obrigatória");
        }

        $this->senha = $senha;
    }

    // ======================
    // TO ARRAY (pra banco)
    // ======================

    public function toArray(): array
    {
        return [
            'nome' => $this->nome,
            'senha' => $this->senha,
        ];
    }
}
