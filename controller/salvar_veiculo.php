<?php
require_once '../database/conexao.php';
require_once 'VeiculoController.php';

// Verifica se a requisição veio mesmo de um formulário (método POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Instancia o nosso controller
    $controller = new VeiculoController($pdo);

    // Passa a variável global $_POST (que contém tudo que foi digitado) para a função
    $sucesso = $controller->cadastrar($_POST);

    if ($sucesso) {
        // Após o cadastro retorna para ? - ali esta retornando para tela de admin
        header("Location: ../view/admin_veiculos.php?status=sucesso");
        exit;
    } else {
        echo "Ocorreu um erro ao guarda o veículo.";
    }
} else {
    // Se tentar aceder a este ficheiro diretamente pela URL, mandamos de volta
    header("Location: ../view/index.php");
    exit;
}
