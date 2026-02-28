CREATE DATABASE IF NOT EXISTS concessionaria;
USE concessionaria;

CREATE TABLE veiculos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    marca VARCHAR(30) NOT NULL,
    modelo VARCHAR(30) NOT NULL,
    motorizacao VARCHAR(30) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    url_foto VARCHAR(255)
);

CREATE TABLE agendamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_cliente VARCHAR(50) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    data_interesse DATE NOT NULL,
    veiculo_id INT,
    FOREIGN KEY (veiculo_id) REFERENCES veiculos(id)
);