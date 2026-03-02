-- Cria o banco e garante que estamos usando ele
CREATE DATABASE IF NOT EXISTS concessionaria CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE concessionaria;

-- Tabela de Administradores (Para o CRUD)
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL -- Na prática -> password_hash()
);

-- Tabela de Marcas
CREATE TABLE marcas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL
);

-- Tabela de Veículos (O Catálogo)
CREATE TABLE veiculos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    modelo VARCHAR(50) NOT NULL,
    versao VARCHAR(50) NOT NULL,
    ano YEAR NOT NULL,
    quilometragem INT NOT NULL,
    motorizacao VARCHAR(30) NOT NULL,
    transmissao VARCHAR(40) NOT NULL,
    potencia INT UNSIGNED NOT NULL,
    torque VARCHAR(30) NOT NULL,
    portas TINYINT NOT NULL,
    combustivel VARCHAR(30) NOT NULL,
    cor VARCHAR(40) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10, 2) NOT NULL,
    url_foto VARCHAR(255) DEFAULT 'https://via.placeholder.com/300x200?text=Sem+Foto',
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    marca_id INT,
    FOREIGN KEY (marca_id) REFERENCES marcas(id)
);

-- Tabela de Agendamentos / Interesses
CREATE TABLE agendamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_cliente VARCHAR(100) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    data_interesse DATE NOT NULL,
    veiculo_id INT NOT NULL,
    status ENUM('Pendente','Contatado','Concluído') DEFAULT 'Pendente',
    FOREIGN KEY (veiculo_id) REFERENCES veiculos(id) ON DELETE CASCADE
);

-- INSERTS INICIAIS;

-- Inserindo um usuário admin padrão para testes (senha: admin123)
INSERT INTO usuarios (nome, email, senha) VALUES 
('Administrador', 'admin@concessionaria.com', 'admin123');

-- Inserindo marcas iniciais
INSERT INTO marcas (nome) VALUES 
('Volkswagen'),
('Toyota'),
('Fiat'),
('BMW');

-- Inserindo alguns carros de teste para o grupo já ter o que mostrar no Front-end
INSERT INTO veiculos 
(marca_id, modelo, versao, ano, quilometragem, motorizacao, transmissao, potencia, torque, portas, combustivel, cor, descricao, preco, url_foto) 
VALUES 

(1, 'Polo', 'Highline', 2023, 15000, '1.0 TSI', 'Automático', 128, '20,4 kgfm', 4, 'Flex', 'Prata', 
'Veículo revisado, único dono, completo.', 95000.00, 'assets/images/marcas/volkswagen/polo.jpg'),

(2, 'Corolla', 'Altis Premium', 2022, 20000, '2.0', 'CVT', 177, '21,4 kgfm', 4, 'Flex', 'Branco', 
'Sedan confortável, bancos em couro, multimídia completa.', 145000.00, 'assets/images/marcas/toyota/corolla.jpg'),

(3, 'Strada', 'Volcano', 2025, 5000, '1.3', 'Manual', 107, '13,7 kgfm', 2, 'Flex', 'Vermelha', 
'Picape ideal para trabalho, baixa quilometragem.', 115000.00, 'assets/images/marcas/fiat/strada.jpg'),

(4, 'Série 3', '320i M Sport', 2024, 14000, '2.0 Turbo', 'Automático 8 marchas', 184, '30,6 kgfm', 4, 'Gasolina', 'Preto', 
'Sedan premium com pacote M Sport, teto solar e painel digital.', 320000.00, 'assets/images/marcas/bmw/bmw320i.jpg');