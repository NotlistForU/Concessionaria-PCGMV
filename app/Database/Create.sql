DROP DATABASE IF EXISTS concessionaria;
CREATE DATABASE concessionaria CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE concessionaria;



-- ==========================================
-- 1. Tabela de Administradores
-- ==========================================
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

-- ==========================================
-- 2. Tabela de Veículos 
-- ==========================================
CREATE TABLE veiculos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    modelo VARCHAR(50) NOT NULL,            -- Ex: 'Série 3'
    versao VARCHAR(50) NOT NULL,            -- Ex: '320i M Sport'
    categoria VARCHAR(50) NOT NULL,         -- Ex: 'Sedan Esportivo'
    ano_modelo YEAR NOT NULL,
    ano_fabricacao YEAR NOT NULL,
    quilometragem INT DEFAULT 0,            -- 0 para zero km
    motorizacao VARCHAR(30) NOT NULL,       -- Ex: '2.0 L'
    transmissao VARCHAR(40) NOT NULL,       -- Ex: 'Automático 8 marchas'
    potencia VARCHAR(20) NOT NULL,          -- Ex: '258 cv 54 kgfm' (VARCHAR facilita o front)
    aceleracao VARCHAR(20) NOT NULL,        -- Ex: '5,8 s' (Para o 0-100km/h da tela)
    portas TINYINT NOT NULL,
    combustivel VARCHAR(30) NOT NULL,
    cor VARCHAR(40) NOT NULL,
    descricao_exterior TEXT,                -- Para o primeiro bloco de texto
    descricao_interior TEXT,                -- Para o segundo bloco de texto
    preco DECIMAL(10, 2) NOT NULL,
    status ENUM('Disponível', 'Vendido') DEFAULT 'Disponível', -- Para o Painel Admin
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ==========================================
-- 2.1 Tabela de Imagens de Veículos (BLOB)
-- ==========================================
CREATE TABLE veiculo_imagens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    veiculo_id INT NOT NULL,
    tipo VARCHAR(50) NOT NULL, -- 'foto_1' (capa/lista), 'foto_2' (banner), 'foto_3' (interior)
    mime_type VARCHAR(100) NOT NULL,
    caminho_arquivo VARCHAR(255) NOT NULL,
    FOREIGN KEY (veiculo_id) REFERENCES veiculos(id) ON DELETE CASCADE,
    INDEX idx_veiculo_id (veiculo_id)
);

-- ==========================================
-- 3. Tabela de Agendamentos / Interesses
-- ==========================================
CREATE TABLE agendamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_cliente VARCHAR(100) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    cnh VARCHAR(11) NOT NULL,
    data_interesse DATE NOT NULL,
    veiculo_id INT NOT NULL,
    status ENUM('Pendente','Contatado','Concluído') DEFAULT 'Pendente',
    FOREIGN KEY (veiculo_id) REFERENCES veiculos(id) ON DELETE CASCADE
);

-- ==========================================
-- 4. Tabela de Compras
-- ==========================================
CREATE TABLE compras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_cliente VARCHAR(100) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    forma_pagamento VARCHAR(50) NOT NULL,
    tem_troca ENUM('Sim', 'Nao') NOT NULL,
    veiculo_id INT NOT NULL,
    data_solicitacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('Pendente','Em Negociação','Aprovado','Recusado') DEFAULT 'Pendente',
    FOREIGN KEY (veiculo_id) REFERENCES veiculos(id) ON DELETE CASCADE
);

-- ==========================================
-- INSERTS INICIAIS (Dados de Teste)
-- ==========================================

-- Admin Padrão (Senha original: admin123)
-- senha ta sendo salva em hash, pq quando fui tentar salvar em string o sistema ficou com frescura não me deixou entrar 
INSERT INTO usuarios (nome, senha) VALUES 
('admin', '$2y$10$zzEuK/x424dNIsFlJWezY.o5SdoBYPRsvVElPfFBw.0F7SWsvAqvS');