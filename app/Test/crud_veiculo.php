<?php
require_once __DIR__ . '/../Config/Root.php';
require_once ROOT_PATH . '/app/Database/Conexao.php';
require_once ROOT_PATH . '/app/Model/Veiculo.php';
require_once ROOT_PATH . '/app/Repository/Veiculos/VeiculoRepository.php';

$rep = new VeiculoRepository($pdo);

// TESTE CADASTRAR
// $rep->cadastrar([
//     'modelo' => 'Civic',
//     'versao' => 'EXL',
//     'ano_modelo' => 2022,
//     'ano_fabricacao' => 2022,
//     'quilometragem' => 15000,
//     'motorizacao' => '2.0',
//     'transmissao' => 'Automático',
//     'potencia' => '155cv',
//     'torque' => '19kgfm',
//     'portas' => 4,
//     'combustivel' => 'Flex',
//     'cor' => 'Preto',
//     'descricao' => 'Carro top',
//     'preco' => 120000,
//     'url_foto' => '',
//     'marca_id' => 1
// ]);

echo "Cadastrado com sucesso!<br>";

// TESTE LISTAR
// $lista = $rep->listarTodos();
echo "<pre>";
print_r($rep->buscarPorId(1));
echo "</pre>";


// $rep->deletar(6);
// $rep->deletar(8);
