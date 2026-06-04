-- Cria o banco e garante que estamos usando ele
CREATE DATABASE IF NOT EXISTS concessionaria CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE concessionaria;

-- ================================================
-- 0. Tabela de keys -> pré castro de funcionarios
-- ================================================
CREATE TABLE keys_usuarios_autorizados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    key_user VARCHAR(100) NOT NULL UNIQUE,
    key_status TINYINT(1) DEFAULT 0 
);

INSERT INTO keys_usuarios_autorizados (key_user) VALUES
('0931'),
('3111'),
('3134'),
('6774'),
('0903');

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
    pasta_fotos VARCHAR(255) DEFAULT 'serie_3', -- Apenas o nome do arquivo
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
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
    tipo_agendamento ENUM('Test Drive', 'Compra') NOT NULL, -- Alinhado com os botões da tela
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

-- Admin Padrão
INSERT INTO usuarios (nome, senha) VALUES 
('Max Verstappen', 'admin123');

-- Limpa a tabela para você rodar o script zerado sem dar erro de duplicidade
-- TRUNCATE TABLE veiculos;

-- ==========================================
-- SEDANS, HATCHES E COUPÉS (SÉRIE 1 AO 8)
-- ==========================================
INSERT INTO veiculos (modelo, versao, categoria, ano_modelo, ano_fabricacao, quilometragem, motorizacao, transmissao, potencia, aceleracao, portas, combustivel, cor, descricao_exterior, descricao_interior, preco, status, pasta_fotos) VALUES 
('Série 1', '118i M Sport', 'Hatch Premium', 2024, 2024, 0, '1.5 Turbo', 'Automático 7 marchas', '140 cv / 22,4 kgfm', '8,5 s', 4, 'Gasolina', 'Branco Alpino', 
'O autêntico prazer de dirigir em sua forma mais compacta. A icônica grade duplo-rim e as grandes entradas de ar no para-choque M Sport enfatizam seu caráter atlético e dinâmico desde o primeiro olhar.', 
'Cabine voltada para o condutor com volante M em couro e bancos esportivos. O sistema de iluminação ambiente cria uma atmosfera moderna, enquanto a conectividade de ponta garante que você esteja sempre no controle.', 
239000.00, 'Disponível', 'serie_1'),

('Série 2', '218i Gran Coupé M Sport', 'Gran Coupé', 2024, 2024, 0, '1.5 Turbo', 'Automático 7 marchas', '140 cv / 22,4 kgfm', '8,7 s', 4, 'Gasolina', 'Preto Safira', 
'A silhueta ousada do Gran Coupé rompe convenções. As portas sem moldura nos vidros e a linha de teto descendente fluem até as lanternas afiladas na traseira, criando um perfil inconfundível.', 
'Elegância subversiva no interior. O acabamento refinado se une ao BMW Live Cockpit Professional, entregando uma experiência digital fluida através de duas telas imersivas de alta resolução.', 
259000.00, 'Disponível', 'serie_2'),

('Série 3', '320i M Sport', 'Sedan Esportivo', 2024, 2024, 0, '2.0 Turbo', 'Automático 8 marchas', '184 cv / 30,6 kgfm', '7,1 s', 4, 'Gasolina', 'Cinza Brooklyn', 
'O ícone definitivo dos sedans esportivos. O design exterior é a pura expressão da esportividade, com linhas precisas, superfícies esculpidas e faróis full LED agressivos que dominam as estradas.', 
'O interior é totalmente focado no motorista. O BMW Curved Display oferece controle intuitivo, enquanto os bancos esportivos garantem conforto e estabilidade em curvas mais acentuadas.', 
320000.00, 'Disponível', 'serie_3'),

('Série 4', '430i Cabrio M Sport', 'Conversível', 2024, 2024, 0, '2.0 Turbo', 'Automático 8 marchas', '258 cv / 40,8 kgfm', '6,2 s', 2, 'Gasolina', 'Azul Portimao', 
'Liberdade sem limites. A grade vertical proeminente presta homenagem aos clássicos, enquanto a capota de tecido acústico recolhe em segundos, revelando linhas elegantes e provocantes.', 
'Experimente a emoção de dirigir ao ar livre sem abrir mão do luxo. Materiais requintados, aquecedores de pescoço integrados e som Harman Kardon tornam cada viagem inesquecível.', 
470000.00, 'Disponível', 'serie_4'),

('Série 5', '530e M Sport', 'Sedan Executivo', 2024, 2024, 0, '2.0 Híbrido Plug-in', 'Automático 8 marchas', '292 cv / 42,8 kgfm', '5,9 s', 4, 'Híbrido', 'Preto Carbono', 
'Presença executiva elevada pela tecnologia. O design clássico e sofisticado de três volumes encontra detalhes aerodinâmicos do pacote M, unindo a tradição à eficiência do futuro eletrificado.', 
'Santuário de produtividade e conforto. Acabamento primoroso, isolamento acústico supremo e assistentes de condução semi-autônoma de nível superior para viagens sem nenhum estresse.', 
490000.00, 'Disponível', 'serie_5');

-- ('Série 8', '840i M Sport', 'Gran Coupé de Luxo', 2024, 2024, 0, '3.0 6 Cilindros Turbo', 'Automático 8 marchas', '340 cv / 51,0 kgfm', '5,2 s', 4, 'Gasolina', 'Vermelho Aventurina', 
-- 'A fusão absoluta entre a esportividade M e o mais alto nível de luxo. A carroceria alongada, bitolas largas e um perfil musculoso impõem respeito por onde quer que passe.', 
-- 'O ápice do requinte. Aplicações em vidro no seletor de marchas, couro Merino por todo o habitáculo e iluminação cênica transformam a condução diária numa experiência exclusiva de primeira classe.', 
-- 850000.00, 'Vendido', 'serie_8');


-- ==========================================
-- LINHA X (SUVs: SAVs E SACs)
-- ==========================================

INSERT INTO veiculos (modelo, versao, categoria, ano_modelo, ano_fabricacao, quilometragem, motorizacao, transmissao, potencia, aceleracao, portas, combustivel, cor, descricao_exterior, descricao_interior, preco, status, pasta_fotos) VALUES 
('X1', 'sDrive20i M Sport', 'SAV (SUV Compacto)', 2024, 2024, 0, '2.0 Turbo', 'Automático 7 marchas', '204 cv / 30,6 kgfm', '7,6 s', 4, 'Gasolina', 'Branco Mineral', 
'Aventureiro e urbano na medida certa. O X1 possui uma postura elevada, linhas bem definidas na lateral e novos faróis em LED que realçam seu visual robusto e tecnológico.', 
'Maior espaço interno da categoria. Painel flutuante, BMW Curved Display e console central redesenhado entregam praticidade incomparável sem perder a veia esportiva da marca.', 
350000.00, 'Disponível', 'x_1'),

('X2', 'xDrive20i M Sport', 'SAC (SUV Coupé)', 2024, 2024, 0, '2.0 Turbo', 'Automático 7 marchas', '204 cv / 30,6 kgfm', '7,4 s', 4, 'Gasolina', 'Dourado Galvanic', 
'Extrovertido e inconfundível. O design do X2 quebra as regras com a linha do teto de um cupê e a famosa insígnia da marca na coluna C, resgatando a herança esportiva dos clássicos.', 
'A ousadia exterior se reflete num cockpit moderno. Costuras contrastantes nos bancos esportivos e tecnologia de Head-Up display mantêm seu foco no que realmente importa: a pista.', 
390000.00, 'Disponível', 'x_2'),

('X3', 'xDrive30e M Sport', 'SAV (SUV Premium)', 2024, 2024, 0, '2.0 Híbrido Plug-in', 'Automático 8 marchas', '292 cv / 42,8 kgfm', '6,1 s', 4, 'Híbrido', 'Prata Glacier', 
'Versatilidade encontra performance eletrificada. Seu design maduro exibe grades frontais marcantes e uma postura pronta para encarar qualquer desafio, no asfalto ou fora dele.', 
'Eficiência inteligente. A cabine espaçosa une o conforto para a família com a interatividade de ponta, permitindo controlar os modos de condução puramente elétricos ao toque de um botão.', 
450000.00, 'Disponível', 'x_3'),

-- ('X4', 'xDrive30i M Sport', 'SAC (SUV Coupé)', 2024, 2024, 0, '2.0 Turbo', 'Automático 8 marchas', '252 cv / 35,7 kgfm', '6,3 s', 4, 'Gasolina', 'Vermelho Piemonte', 
-- 'O provocador da família X. A queda acentuada do teto na traseira não só melhora a aerodinâmica, como confere uma aparência atlética e musculosa inigualável em seu segmento.', 
-- 'Sentar no volante do X4 é assumir o comando. A posição de dirigir baixa e esportiva contrasta com a visão privilegiada do trânsito, unindo o melhor dos dois mundos.', 
-- 490000.00, 'Disponível', 'x_4'),

('X5', 'xDrive50e M Sport', 'SAV (SUV Grande)', 2024, 2024, 0, '3.0 6 Cilindros Híbrido', 'Automático 8 marchas', '489 cv / 71,4 kgfm', '4,8 s', 4, 'Híbrido', 'Preto Safira', 
'O chefe da estrada. Presença que domina qualquer terreno. Proporções musculosas e rodas de liga leve robustas reforçam a dinâmica excepcional e a autoridade que emana do modelo.', 
'Luxo absoluto e sustentabilidade. Acabamentos em madeira fineline, bancos em couro Merino e porta-copos com refrigeração transformam a cabine num verdadeiro lounge de primeira classe.', 
750000.00, 'Disponível', 'x_5'),

('X6', 'xDrive40i M Sport', 'SAC (SUV Coupé Grande)', 2024, 2024, 0, '3.0 6 Cilindros Turbo', 'Automático 8 marchas', '381 cv / 53,0 kgfm', '5,4 s', 4, 'Gasolina', 'Cinza Dravit', 
'Um espetáculo visual de dominância. O primeiro da sua espécie. A grade Iconic Glow iluminada e os ombros extremamente largos fazem dele o veículo mais imponente da linha noturna.', 
'Máxima exclusividade no interior. A extravagância do design segue na cabine com detalhes em carbono, iluminação estelar no teto solar panorâmico e sistema de som imersivo.', 
820000.00, 'Vendido', 'x_6'),

('X7', 'M60i', 'SAV (SUV 7 Lugares)', 2024, 2024, 0, '4.4 V8 Bi-Turbo', 'Automático 8 marchas', '530 cv / 76,5 kgfm', '4,7 s', 4, 'Gasolina', 'Azul Tanzanite', 
'O ápice da linha X. Um mastodonte de elegância, capaz de carregar até 7 ocupantes. Os faróis divididos e as enormes rodas de 22 polegadas transmitem pura imponência.', 
'A definição de espaço premium. Todos os bancos têm ajuste elétrico, ar-condicionado de 5 zonas e couro acolchoado individual para cada passageiro viver uma viagem majestosa.', 
1200000.00, 'Disponível', 'x_7');