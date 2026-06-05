-- Script de inserção de dados de exemplo compatível com o NOVO modelo de File System
USE concessionaria;

-- Limpa dados anteriores
-- SET FOREIGN_KEY_CHECKS = 0;
-- TRUNCATE TABLE veiculo_imagens;
-- TRUNCATE TABLE veiculos;
-- SET FOREIGN_KEY_CHECKS = 1;

-- ==============================================================
-- 1. Inserção de Veículos
-- ==============================================================
INSERT INTO veiculos (id, modelo, versao, categoria, ano_modelo, ano_fabricacao, quilometragem, motorizacao, transmissao, potencia, aceleracao, portas, combustivel, cor, descricao_exterior, descricao_interior, preco, status) VALUES
(1, 'Série 1', '118i M Sport', 'Hatch', 2024, 2024, 0, '1.5 Turbo', 'Automático 7 marchas', '140 cv / 22,4 kgfm', '8,5 s', 4, 'Gasolina', 'Branco Alpino', 'O autêntico prazer de dirigir em sua forma mais compacta. A icônica grade duplo-rim e as grandes entradas de ar no para-choque M Sport enfatizam seu caráter atlético e dinâmico desde o primeiro olhar.', 'Cabine voltada para o condutor com volante M em couro e bancos esportivos. O sistema de iluminação ambiente cria uma atmosfera moderna, enquanto a conectividade de ponta garante que você esteja sempre no controle.', 239000.00, 'Disponível'),
(2, 'Série 3', '320i M Sport', 'Sedan', 2024, 2024, 0, '2.0 TwinPower Turbo', 'Automático 8 marchas', '184 cv / 30,6 kgfm', '7,1 s', 4, 'Gasolina', 'Preto Safira', 'O sedan esportivo mais icônico do mundo. O design renovado apresenta faróis Full LED mais afilados e para-choques redesenhados que reforçam a postura larga e agressiva característica da Série 3.', 'O inovador BMW Curved Display une o painel de instrumentos de 12,3" e a tela central de 14,9" em uma única peça de vidro. O acabamento M Sport em Alcantara e sensatec eleva a experiência a outro nível.', 340950.00, 'Disponível'),
(3, 'X1', 'sDrive20i X-Line', 'SUV', 2024, 2024, 0, '2.0 TwinPower Turbo', 'Automático 7 marchas', '204 cv / 30,6 kgfm', '7,6 s', 4, 'Gasolina', 'Prata Space', 'Versatilidade encontra design impressionante. O novo X1 possui uma presença muito mais imponente, com grade frontal quase quadrada e faróis LED adaptativos com a nova assinatura luminosa em X.', 'Espaço de sobra para todas as suas aventuras. O interior completamente redesenhado traz o BMW Operating System 8 e uma cabine minimalista, removendo a maioria dos botões físicos em favor de controles por toque e voz.', 320950.00, 'Disponível');


-- ==============================================================
-- 2. Inserção de Imagens (Apontando para a pasta assets/img/)
-- ==============================================================

-- Imagens Série 1
INSERT INTO veiculo_imagens (veiculo_id, tipo, mime_type, caminho_arquivo) VALUES 
(1, 'foto_1', 'image/png', 'assets/img/serie_1/foto_1.png'),
(1, 'foto_2', 'image/png', 'assets/img/serie_1/foto_2.png'),
(1, 'foto_3', 'image/jpeg', 'assets/img/serie_1/3.jpg');

-- Imagens Série 3
INSERT INTO veiculo_imagens (veiculo_id, tipo, mime_type, caminho_arquivo) VALUES 
(2, 'foto_1', 'image/png', 'assets/img/serie_3/foto_1.png'),
(2, 'foto_2', 'image/png', 'assets/img/serie_3/foto_2.png'),
(2, 'foto_3', 'image/jpeg', 'assets/img/serie_3/3.jpg');

-- Imagens X1
INSERT INTO veiculo_imagens (veiculo_id, tipo, mime_type, caminho_arquivo) VALUES 
(3, 'foto_1', 'image/png', 'assets/img/x_1/foto_1.png'),
(3, 'foto_2', 'image/png', 'assets/img/x_1/foto_2.png'),
(3, 'foto_3', 'image/jpeg', 'assets/img/x_1/3.jpg');

