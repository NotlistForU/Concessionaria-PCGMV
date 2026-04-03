<?php
require_once __DIR__ . '/../Config/Root.php';
require_once ROOT_PATH . '/app/Database/Conexao.php';
require_once ROOT_PATH . '/app/Model/Veiculo.php';
require_once ROOT_PATH . '/app/Repository/Veiculos/VeiculoRepository.php';

echo "<pre>"; // só pra formatar saída bonitinha

$repo = new VeiculoRepository($pdo);

// Descomente parte a parte para ir testando. Testado 03/04/2026 :
// Listar todos OK; Buscar por ID OK; Cadastrar ok; Atualizar OK; Deletar OK;

try {
    // echo "=== TESTE LISTAR TODOS ===\n";
    // $lista = $repo->listarTodos();

    // foreach ($lista as $v) {
    //     echo "ID: " . $v->getId() . "\n";
    //     echo "Modelo: " . $v->getModelo() . "\n";
    //     echo "Preço: " . $v->getPreco() . "\n";
    //     echo "-------------------\n";
    // }

    // echo "=== TESTE CADASTRAR ===\n";

    // $veiculo = new Veiculo([
    //     'modelo' => 'Civic',
    //     'versao' => 'EXL',
    //     'ano_modelo' => 2022,
    //     'ano_fabricacao' => 2022,
    //     'quilometragem' => 15000,
    //     'motorizacao' => '2.0',
    //     'transmissao' => 'Automático',
    //     'potencia' => 155,
    //     'torque' => '19kgfm',
    //     'portas' => 4,
    //     'combustivel' => 'Flex',
    //     'cor' => 'Preto',
    //     'descricao' => 'Carro top',
    //     'preco' => 120000,
    //     'url_foto' => '',
    //     'marca_id' => 1
    // ]);

    // $repo->cadastrar($veiculo);

    // echo "Cadastrado!\n\n";


    // echo "=== TESTE LISTAR TODOS ===\n";

    // $lista = $repo->listarTodos();

    // foreach ($lista as $v) {
    //     echo "ID: " . $v->getId() . "\n";
    //     echo "Modelo: " . $v->getModelo() . "\n";
    //     echo "Preço: " . $v->getPreco() . "\n";
    //     echo "-------------------\n";
    // }


    // echo "\n=== TESTE BUSCAR POR ID ===\n";

    // $v = $repo->buscarPorId(9);

    // if ($v) {
    //     echo "Id: " . $v->getId() . "\n";
    //     echo "Encontrado: " . $v->getModelo() . "\n";
    // } else {
    //     echo "Não encontrado\n";
    // }


    // echo "\n=== TESTE ATUALIZAR ===\n";

    // $veiculoAtualizado = new Veiculo([
    //     'modelo' => 'Civic Atualizado',
    //     'versao' => 'Touring',
    //     'ano_modelo' => 2023,
    //     'ano_fabricacao' => 2023,
    //     'quilometragem' => 10000,
    //     'motorizacao' => '2.0',
    //     'transmissao' => 'Automático',
    //     'potencia' => 160,
    //     'torque' => '20kgfm',
    //     'portas' => 4,
    //     'combustivel' => 'Flex',
    //     'cor' => 'Branco',
    //     'descricao' => 'Atualizado',
    //     'preco' => 130000,
    //     'url_foto' => '',
    //     'marca_id' => 1
    // ]);

    // $repo->atualizar(9, $veiculoAtualizado);

    // echo "Atualizado!\n";

    // echo "\n=== TESTE BUSCAR POR ID ===\n";

    // $v = $repo->buscarPorId(9);

    // if ($v) {
    //     echo "Id: " . $v->getId() . "\n";
    //     echo "Encontrado: " . $v->getModelo() . "\n";
    // } else {
    //     echo "Não encontrado\n";
    // }



    // echo "\n=== TESTE DELETAR ===\n";

    // $repo->deletar(9);

    // echo "Deletado!\n";

    //     echo "\n=== TESTE BUSCAR POR ID ===\n";

    // $v = $repo->buscarPorId(9);

    // if ($v) {
    //     echo "Id: " . $v->getId() . "\n";
    //     echo "Encontrado: " . $v->getModelo() . "\n";
    // } else {
    //     echo "Não encontrado\n";
    // }

} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
