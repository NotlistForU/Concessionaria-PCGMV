<?php
/*
Como isso será usado: 
Sempre for fazer uma listagem de carros ou salvar um formulário no controller,
basta colocar um require_once '../database/conexao.php'; no topo do arquivo. 
Isso injeta a variável $pdo, que é a chave do banco, direto no código.
*/

$host = 'localhost';
$dbname = 'concessionaria';
$usuario = 'root'; // Padrão do XAMPP
$senha = ''; // Padrão do XAMPP
// $port = ? -> precisa colocar a porta q esta sendo usuada !!!!
// $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4;$port=?", $usuario, $senha);

try {
    // Tenta conectar ao banco de dados usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $usuario, $senha);
    // Configura o PDO para jogar um Erro na tela caso algum comando SQL dê errado
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Descomente a linha abaixo apenas para testar se funcionou, depois apague / comenta dnv.
    // echo "Conexão com o banco de dados realizada com sucesso!";
} catch (PDOException $e) {
    die("Erro ao conectar com o banco de dados. Verifique se o XAMPP está rodando. Erro: " . $e->getMessage());
}
