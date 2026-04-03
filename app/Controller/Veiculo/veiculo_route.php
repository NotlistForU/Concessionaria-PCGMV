<?php
require_once '../Config/conexao.php';
require_once '../Model/Veiculo.php';
require_once '../Repository/VeiculoRepository.php';
require_once '../Controller/VeiculoController.php';

$controller = new VeiculoController($pdo);

// 👇 AQUI entra o tal do REQUEST_METHOD

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->cadastrar();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $controller->delete($_GET['id']);
    } else {
        $veiculos = $controller->listar();
        print_r($veiculos);
    }
}
