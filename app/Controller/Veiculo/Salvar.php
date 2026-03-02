<?php
require_once ROOT_PATH . '/app/Database/Conexao.php';
require_once ROOT_PATH . '/app/Controller/Veiculo/Controller.php';

// Verifica se a requisição veio mesmo de um formulário (método POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Instancia o nosso controller
    $controller = new Veiculo($pdo);

    // Passa a variável global $_POST (que contém tudo que foi digitado) para a função
    $sucesso = $controller->cadastrar($_POST);

    if ($sucesso) {
        // Após o cadastro retorna para ? - A DEFINIR AINDA!;
        header("Location: ../view/admin_veiculos.php?status=sucesso");
        exit;
    } else {
        echo "Ocorreu um erro ao guarda o veículo.";
    }
} else {
    // Se tentar aceder a este ficheiro diretamente pela URL, mandamos de volta
    header("Location: /Concessionaria-PCGM/public/index.php");
    exit;
}
