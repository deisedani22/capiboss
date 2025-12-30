-- Script para criar o banco de dados Capiboss
CREATE DATABASE capiboss;

-- Usar o banco de dados Capiboss
USE capiboss;

-- Criar tabela Users
CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha_hash VARCHAR(255) NOT NULL,
    codigo_instituicao VARCHAR(50) NOT NULL,
    tipo_usuario ENUM('admin', 'aluno', 'professor') DEFAULT 'aluno',
    foto VARCHAR(255),
    estrelas INT DEFAULT 0,
    coracoes INT DEFAULT 5,
    capimoedas INT DEFAULT 0,
    telefone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Criar tabela Trilhas
CREATE TABLE Trilhas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT,
    nivel_dificuldade ENUM('fundamental', 'infantil', 'medio') NOT NULL,
    foto VARCHAR(255),
    recompensa_capimoedas INT DEFAULT 100,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Criar tabela Aulas
CREATE TABLE Aulas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    trilha_id INT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (trilha_id) REFERENCES Trilhas(id) ON DELETE CASCADE
);

-- Criar tabela Licoes
CREATE TABLE Licoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    aula_id INT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    conteudo TEXT NOT NULL,
    video_url VARCHAR(255),
    arquivo VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (aula_id) REFERENCES Aulas(id) ON DELETE CASCADE
);

-- Criar tabela Missao
CREATE TABLE Missoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    aula_id INT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    jogo_url VARCHAR(255) NOT NULL,
    recompensa_capimoedas INT DEFAULT 50,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (aula_id) REFERENCES Aulas(id) ON DELETE CASCADE
);

-- Criar tabela Progresso
CREATE TABLE Progresso (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,

    tipo ENUM('trilha', 'aula', 'licao', 'missao') NOT NULL,
    referencia_id INT NOT NULL,

    status ENUM('bloqueado', 'iniciado', 'concluido') DEFAULT 'bloqueado',

    progresso_percentual INT DEFAULT 0,
    tentativas INT DEFAULT 0,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    UNIQUE KEY unique_progresso (user_id, tipo, referencia_id),
    FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE CASCADE
);

-- Composicao das seeds, 8 trilhas, 2 aulas por trilha, 2 lições por aula, 1 missão por aula



-- Dados iniciais para Trilhas

INSERT INTO Trilhas (titulo, descricao, nivel_dificuldade, recompensa_capimoedas) VALUES
('Dinheiro tem valor', 'Aprenda os conceitos fundamentais sobre o valor do dinheiro, sua história e importância na sociedade moderna.', 'infantil', 100), 
('Investigando hábitos de consumo', 'Desenvolva uma compreensão profunda sobre hábitos de consumo e como fazer escolhas conscientes.', 'infantil', 100), 
('Guardando com Proposito', 'Descubra a importância de poupar dinheiro com objetivos claros e como criar um plano de poupança eficaz.', 'infantil', 100), 
('Dinheiro não dá em Árvores', 'Entenda que o dinheiro vem do trabalho e esforço, explorando diferentes formas de ganhar e valorizar o dinheiro.', 'infantil', 100), 
('Compartilhar e cuidar', 'Ajude a Tartaruga-de-Pente Visionária, você vai descobrir que sonhos importantes podem virar metas quando a gente planeja, guarda um pouquinho e espera com paciência.', 'infantil', 100), 
('Projetando o futuro', 'Você vai descobrir que as emoções influenciam nossas escolhas e que pensar antes de gastar ajuda a cuidar do dinheiro, das pessoas e do planeta', 'infantil', 100), 
('Usando dinheiro com sabedoria', 'Descubra que é possível gastar, guardar e compartilhar sem ficar sem o que é essencial.', 'infantil', 100);



-- Dados iniciais para Aulas

INSERT INTO Aulas (trilha_id, titulo) VALUES
(1, 'Dinheiro tem valor ?'),
(1, 'História do dinheiro'),
(2, 'Desejo x Necessidade'),
(2, 'Publicidade e Consumo'),
(3, 'Por que poupar ?'),
(3, 'Como criar um cofrinho'),
(4, 'De onde vem o dinheiro ?'),
(4, 'Trabalho e renda'),
(5, 'Compartilhar é cuidar'),
(5, 'Metas de compartilhamento'),
(6, 'Emoções e dinheiro'),
(6, 'Planejamento financeiro'),
(7, 'Gastar com sabedoria'),
(7, 'Equilíbrio financeiro');



-- Dados iniciais para Lições

INSERT INTO Licoes (aula_id, titulo, conteudo, video_url) VALUES
(1, 'roda de conversa', '', 'https://www.youtube.com/watch?v=pTGyVpDSVDo'),
(2, 'momento capiboss', '', 'https://www.youtube.com/watch?v=pTGyVpDSVDo');


-- Dados iniciais para missões
INSERT INTO Missoes (aula_id, titulo, jogo_url, recompensa_capimoedas) VALUES
(1, 'Baú de surpresas', 'https://capnoss-fase-01.netlify.app/', 50),
(2, 'Supermercado','https://capiboss-supermarket-game.vercel.app/game', 50);
