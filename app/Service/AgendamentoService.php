<?php
require_once __DIR__ . '../../Config/Root.php';
require_once ROOT_PATH . '/app/Repository/Users/UserRepository.php';

class AgendamentoService
{
    public function __construct(
        private AgendamentoRepository $agendamentoRepository
    ) {}

    // TESTE DRIVE
    public function listarAgendamentos()
    {
        return $this->agendamentoRepository->listarAgendamentos();
    }
    public function listaPropostasCompras()
    {
        return $this->agendamentoRepository->listarPropostasCompras();
    }

    // TESTE DRIVE
    public function registrarAgendamento(array $dados)
    {
        if (
            !validar_cnh($dados['cnh'])
        ) {
            return false;
        }

        return $this->agendamentoRepository->registarAgendamento($dados);
    }

    public function registrarPropostaCompra(array $dados)
    {
        if (!validar_whatsapp($dados['telefone'])) {
            return false;
        }

        return $this->agendamentoRepository->registrarPropostaCompra($dados);
    }
}
