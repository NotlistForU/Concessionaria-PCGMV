<?php
require_once __DIR__ . '/../../Config/Root.php';
require_once ROOT_PATH . '/app/Service/AgendamentoService.php';

class AgendamentosController
{
    public function __construct(private AgendamentoService $agendamentoService) {}

    public function listar()
    {
        // view consegue ter acesso a variaveis do metodo quando  usado require
        $listaAgendamentos = $this->agendamentoService->listarAgendamentos();
        $listaPropostasCompras  = $this->agendamentoService->listaPropostasCompras();
        require ROOT_PATH . '/app/Views/admin/agendamentos.php';
    }

    // TESTE DRIVE
    public function registrarAgendamento()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }
        $sucesso = $this->agendamentoService->registrarAgendamento($_POST);
        if (!$sucesso) {
            header(
                "Location: ?pagina=detalhes&id="
                    . $_POST['veiculo_id']
                    . "&erro_cnh=1"
            );
            exit;
        }
        header(
            "Location: ?pagina=detalhes&id="
                . $_POST['veiculo_id']
                . "&sucesso=1"
        );

        exit;
    }

    public function registrarPorpostaCompra()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }
        $sucesso = $this->agendamentoService->registrarPropostaCompra($_POST);
        if (!$sucesso) {
            header(
                "Location: ?pagina=detalhes&id="
                    . $_POST['veiculo_id']
                    . "&erro_whatsapp=1"
            );

            exit;
        }
        header(
            "Location: ?pagina=detalhes&id="
                . $_POST['veiculo_id']
                . "&sucesso_compra=1"
        );

        exit;
    }
}
