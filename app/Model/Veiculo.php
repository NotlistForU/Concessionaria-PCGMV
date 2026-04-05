<?php

class Veiculo
{
    private ?int $id;
    private ?string $modelo;
    private ?string $versao;
    private ?string $categoria;
    private ?int $anoModelo;
    private ?int $anoFabricacao;
    private ?int $quilometragem;
    private ?string $motorizacao;
    private ?string $transmissao;
    private ?string $potencia;
    private ?string $aceleracao;
    private ?int $portas;
    private ?string $combustivel;
    private ?string $cor;
    private ?string $descricaoExterior;
    private ?string $descricaoInterior;
    private ?float $preco;
    private ?string $pastaFoto;
    private ?string $status;
    public function __construct($dados = [])
    {
        if (!empty($dados)) {
            if (!empty($dados)) {
                $this->id = $dados['id'] ?? null;

                $this->setModelo($dados['modelo'] ?? null);
                $this->setAnoModelo($dados['ano_modelo'] ?? null);
                $this->setPreco($dados['preco'] ?? null);

                $this->versao = $dados['versao'] ?? null;
                $this->categoria = $dados['categoria'] ?? null;
                $this->anoFabricacao = $dados['ano_fabricacao'] ?? null;
                $this->quilometragem = $dados['quilometragem'] ?? null;
                $this->motorizacao = $dados['motorizacao'] ?? null;
                $this->transmissao = $dados['transmissao'] ?? null;
                $this->potencia = $dados['potencia'] ?? null;
                $this->aceleracao = $dados['aceleracao'] ?? null;
                $this->portas = $dados['portas'] ?? null;
                $this->combustivel = $dados['combustivel'] ?? null;
                $this->cor = $dados['cor'] ?? null;
                $this->descricaoExterior = $dados['descricao_exterior'] ?? null;
                $this->descricaoInterior = $dados['descricao_interior'] ?? null;
                $this->pastaFoto = $dados['pasta_fotos'] ?? null;
                $this->status = $dados['status'] ?? 'Disponível';
            }
        }
    }
    public function print(): void
    {
        print($this->getPastaFoto());
    }
    // =====================
    // GETTERS
    // =====================

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getModelo(): ?string
    {
        return $this->modelo;
    }
    public function getVersao(): ?string
    {
        return $this->versao;
    }
    public function getCategoria(): ?string
    {
        return $this->categoria;
    }
    public function getAnoModelo(): ?int
    {
        return $this->anoModelo;
    }
    public function getAnoFabricacao(): ?int
    {
        return $this->anoFabricacao;
    }
    public function getQuilometragem(): ?int
    {
        return $this->quilometragem;
    }
    public function getMotorizacao(): ?string
    {
        return $this->motorizacao;
    }
    public function getTransmissao(): ?string
    {
        return $this->transmissao;
    }
    public function getPotencia(): ?string
    {
        return $this->potencia;
    }
    public function getaceleracao(): ?string
    {
        return $this->aceleracao;
    }
    public function getPortas(): ?int
    {
        return $this->portas;
    }
    public function getCombustivel(): ?string
    {
        return $this->combustivel;
    }
    public function getCor(): ?string
    {
        return $this->cor;
    }
    public function getDescricaoExterior(): ?string
    {
        return $this->descricaoExterior;
    }
    public function getDescricaoInterior(): ?string
    {
        return $this->descricaoInterior;
    }
    public function getPreco(): ?float
    {
        return $this->preco;
    }
    public function getPastaFoto(): ?string
    {
        return $this->pastaFoto;
    }
    public function getStatus(): ?string
    {
        return $this->status;
    }

    // =====================
    // SETTERS
    // =====================

    public function validate(): void
    {
        $this->setModelo($this->modelo);
        $this->setAnoModelo($this->anoModelo);
        $this->setPreco($this->preco);
    }

    public function setModelo(?string $modelo): void
    {
        if (empty($modelo)) {
            throw new Exception("Modelo é obrigatório");
        }
        $this->modelo = $modelo;
    }

    public function setAnoModelo(?int $ano): void
    {
        $anoAtual = (int) date('Y');
        if ($ano !== null && ($ano < 1900 || $ano > $anoAtual + 1)) {
            throw new Exception("Ano modelo inválido");
        }
        $this->anoModelo = $ano;
    }

    public function setPreco(?float $preco): void
    {
        if ($preco !== null && $preco < 0) {
            throw new Exception("Preço inválido");
        }
        $this->preco = $preco;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setVersao($versao)
    {
        $this->versao = $versao;
    }
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    public function setAnoFabricacao($anoFabricacao)
    {
        $this->anoFabricacao = $anoFabricacao;
    }
    public function setQuilometragem($quilometragem)
    {
        $this->quilometragem = $quilometragem;
    }
    public function setMotorizacao($motorizacao)
    {
        $this->motorizacao = $motorizacao;
    }
    public function setTransmissao($transmissao)
    {
        $this->transmissao = $transmissao;
    }
    public function setPotencia($potencia)
    {
        $this->potencia = $potencia;
    }
    public function setaceleracao($aceleracao)
    {
        $this->aceleracao = $aceleracao;
    }
    public function setPortas($portas)
    {
        $this->portas = $portas;
    }
    public function setCombustivel($combustivel)
    {
        $this->combustivel = $combustivel;
    }
    public function setCor($cor)
    {
        $this->cor = $cor;
    }
    public function setDescricaoExterior($descricaoExterior)
    {
        $this->descricaoExterior = $descricaoExterior;
    }
    public function setDescricaoInterior($descricaoInterior)
    {
        $this->descricaoInterior = $descricaoInterior;
    }

    public function setpastaFoto($url)
    {
        $this->pastaFoto = $url;
    }
    public function setStatus($status)
    {
        $this->status = $status;
    }



    // =====================
    // CONVERSÕES 🔥
    // =====================

    // Converte objeto para array (pra salvar no banco)
    public function toArray()
    {
        return [
            'modelo' => $this->modelo,
            'versao' => $this->versao,
            'ano_modelo' => $this->anoModelo,
            'ano_fabricacao' => $this->anoFabricacao,
            'quilometragem' => $this->quilometragem,
            'motorizacao' => $this->motorizacao,
            'transmissao' => $this->transmissao,
            'potencia' => $this->potencia,
            'aceleracao' => $this->aceleracao,
            'portas' => $this->portas,
            'combustivel' => $this->combustivel,
            'cor' => $this->cor,
            'descricao_exterior' => $this->descricaoExterior,
            'descricao_interior' => $this->descricaoInterior,
            'preco' => $this->preco,
            'pasta_fotos' => $this->pastaFoto,
        ];
    }
}
