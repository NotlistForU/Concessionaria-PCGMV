<?php

class Veiculo
{
    private ?int $id;
    private ?string $modelo;
    private ?string $versao;
    private ?int $anoModelo;
    private ?int $anoFabricacao;
    private ?int $quilometragem;
    private ?string $motorizacao;
    private ?string $transmissao;
    private ?int $potencia;
    private ?string $torque;
    private ?int $portas;
    private ?string $combustivel;
    private ?string $cor;
    private ?string $descricao;
    private ?float $preco;
    private ?string $urlFoto;
    private ?int $marcaId;

    public function __construct($dados = [])
    {
        if (!empty($dados)) {
            if (!empty($dados)) {
                $this->id = $dados['id'] ?? null;

                $this->setModelo($dados['modelo'] ?? null);
                $this->setAnoModelo($dados['ano_modelo'] ?? null);
                $this->setPreco($dados['preco'] ?? null);

                $this->versao = $dados['versao'] ?? null;
                $this->anoFabricacao = $dados['ano_fabricacao'] ?? null;
                $this->quilometragem = $dados['quilometragem'] ?? null;
                $this->motorizacao = $dados['motorizacao'] ?? null;
                $this->transmissao = $dados['transmissao'] ?? null;
                $this->potencia = $dados['potencia'] ?? null;
                $this->torque = $dados['torque'] ?? null;
                $this->portas = $dados['portas'] ?? null;
                $this->combustivel = $dados['combustivel'] ?? null;
                $this->cor = $dados['cor'] ?? null;
                $this->descricao = $dados['descricao'] ?? null;
                $this->urlFoto = $dados['url_foto'] ?? null;
                $this->marcaId = $dados['marca_id'] ?? null;
            }
        }
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
    public function getPotencia(): ?int
    {
        return $this->potencia;
    }
    public function getTorque(): ?string
    {
        return $this->torque;
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
    public function getDescricao(): ?string
    {
        return $this->descricao;
    }
    public function getPreco(): ?float
    {
        return $this->preco;
    }
    public function getUrlFoto(): ?string
    {
        return $this->urlFoto;
    }
    public function getMarcaId(): ?int
    {
        return $this->marcaId;
    }
    // =====================
    // SETTERS
    // =====================

    public function validate(): void
    {
        $this->setModelo($this->modelo);
        $this->setAnoModelo($this->anoModelo);
        $this->setPreco($this->preco);
        $this->setMarcaId($this->marcaId);
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

    public function setMarcaId(?int $marcaId): void
    {
        if ($marcaId === null) {
            throw new Exception("Marca é obrigatória");
        }
        $this->marcaId = $marcaId;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setVersao($versao)
    {
        $this->versao = $versao;
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
    public function setTorque($torque)
    {
        $this->torque = $torque;
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
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function setUrlFoto($url)
    {
        $this->urlFoto = $url;
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
            'torque' => $this->torque,
            'portas' => $this->portas,
            'combustivel' => $this->combustivel,
            'cor' => $this->cor,
            'descricao' => $this->descricao,
            'preco' => $this->preco,
            'url_foto' => $this->urlFoto,
            'marca_id' => $this->marcaId
        ];
    }

    public static function fromArray(array $dados): Veiculo
    {
        return new Veiculo($dados);
    }
}
