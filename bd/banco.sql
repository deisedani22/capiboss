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
('Trilha de Matemática', 'Aprenda os conceitos básicos de matemática.', 'fundamental', 100),
('Trilha de Ciências', 'Explore o mundo das ciências naturais.', 'fundamental', 100),
('Trilha de História', 'Descubra os eventos históricos mais importantes.', 'medio', 150),
('Trilha de Geografia', 'Conheça os aspectos físicos e humanos do planeta.', 'medio', 150),
('Trilha de Português', 'Aprimore suas habilidades na língua portuguesa.', 'fundamental', 100),
('Trilha de Inglês', 'Inicie sua jornada no aprendizado do inglês.', 'fundamental', 100),
('Trilha de Artes', 'Desenvolva sua criatividade através das artes.', 'infantil', 80),
('Trilha de Educação Física', 'Mantenha-se ativo e saudável com exercícios físicos.', 'infantil', 80);

-- Dados iniciais para Aulas
INSERT INTO Aulas (trilha_id, titulo) VALUES
(1, 'Números e Operações'),
(1, 'Geometria Básica'),
(2, 'Seres Vivos'),
(2, 'Corpo Humano'),
(3, 'Antiguidade'),
(3, 'Idade Média'),
(4, 'Relevo Terrestre'),
(4, 'Climas do Mundo'),
(5, 'Gramática Básica'),
(5, 'Literatura Infantil'),
(6, 'Vocabulário Básico'),
(6, 'Frases Comuns'),
(7, 'Desenho e Pintura'),
(7, 'Música e Ritmo'),
(8, 'Exercícios ao Ar Livre'),
(8, 'Jogos e Brincadeiras');

-- Dados iniciais para Lições
INSERT INTO Licoes (aula_id, titulo, conteudo, video_url, arquivo) VALUES
(1, 'Adição e Subtração', 'Conteúdo sobre adição e subtração.', 'https://example.com/video1', 'adicao_subtracao.pdf'),
(1, 'Multiplicação e Divisão', 'Conteúdo sobre multiplicação e divisão.', 'https://example.com/video2', 'multiplicacao_divisao.pdf'),
(2, 'Formas Geométricas', 'Conteúdo sobre formas geométricas.', 'https://example.com/video3', 'formas_geometricas.pdf'),
(2, 'Perímetros e Áreas', 'Conteúdo sobre perímetros e áreas.', 'https://example.com/video4', 'perimetros_areas.pdf'),
(3, 'Classificação dos Seres Vivos', 'Conteúdo sobre classificação dos seres vivos.', 'https://example.com/video5', 'classificacao_seres_vivos.pdf'),
(3, 'Ecossistemas', 'Conteúdo sobre ecossistemas.', 'https://example.com/video6', 'ecossistemas.pdf'),
(4, 'Sistema Digestório', 'Conteúdo sobre o sistema digestório.', 'https://example.com/video7', 'sistema_digestorio.pdf'),
(4, 'Sistema Respiratório', 'Conteúdo sobre o sistema respiratório.', 'https://example.com/video8', 'sistema_respiratorio.pdf'),
(5, 'Civilizações Antigas', 'Conteúdo sobre civilizações antigas.', 'https://example.com/video9', 'civilizacoes_antigas.pdf'),
(5, 'Impérios e Reinos', 'Conteúdo sobre impérios e reinos.', 'https://example.com/video10', 'imperios_reinos.pdf'),
(6, 'Feudalismo', 'Conteúdo sobre feudalismo.', 'https://example.com/video11', 'feudalismo.pdf'),
(6, 'Renascimento',  'Conteúdo sobre renascimento.', 'https://example.com/video12', 'renascimento.pdf'),
(7, 'Relevo e Formações Terrestres',  'Conteúdo sobre relevo e formações terrestres.',  'https://example.com/video13',  'relevo_formacoes_terrestres.pdf'),
(7,  'Hidrografia Mundial',  'Conteúdo sobre hidrografia mundial.',  'https://example.com/video14',  'hidrografia_mundial.pdf'),
(8,  'Gramática e Sintaxe',  'Conteúdo sobre gramática e sintaxe.',  'https://example.com/video15',  'gramatica_sintaxe.pdf'),
(8,  'Contos e Fábulas',  'Conteúdo sobre contos e fábulas.',  'https://example.com/video16',  'contos_fabulas.pdf'),
(9,  'Vocabulário Básico em Inglês',  'Conteúdo sobre vocabulário básico em inglês.',  'https://example.com/video17',  'vocabulario_basico_ingles.pdf'),
(9,  'Frases Comuns em Inglês',  'Conteúdo sobre frases comuns em inglês.',  'https://example.com/video18',  'frases_comuns_ingles.pdf'),
(10,  'Técnicas de Desenho',  'Conteúdo sobre técnicas de desenho.',  'https://example.com/video19',  'tecnicas_desenho.pdf'),
(10,  'Teoria das Cores',  'Conteúdo sobre teoria das cores.',  'https://example.com/video20',  'teoria_cores.pdf'),
(11,  'Exercícios Físicos para Crianças',  'Conteúdo sobre exercícios físicos para crianças.',  'https://example.com/video21',  'exercicios_fisicos_criancas.pdf'),
(11,  'Brincadeiras ao Ar Livre',  'Conteúdo sobre brincadeiras ao ar livre.',  'https://example.com/video22',  'brincadeiras_ar_livre.pdf'),
(12,  'Brincadeiras Saudáveis',  'Conteúdo sobre brincadeiras saudáveis.',  'https://example.com/video23',  'brincadeiras_saudaveis.pdf'),
(12,  'Jogos Cooperativos',  'Conteúdo sobre jogos cooperativos.',  'https://example.com/video24',  'jogos_cooperativos.pdf'),
(13,  'Introdução à Música',  'Conteúdo sobre introdução à música.',  'https://example.com/video25',  'introducao_musica.pdf'),
(13,  'Ritmo e Melodia',  'Conteúdo sobre ritmo e melodia.',  'https://example.com/video26',  'ritmo_melodia.pdf'),
(14,  'Pintura com Aquarela',  'Conteúdo sobre pintura com aquarela.',  'https://example.com/video27',  'pintura_aquarela.pdf'),
(14,  'Escultura com Argila',  'Conteúdo sobre escultura com argila.',  'https://example.com/video28',  'escultura_argila.pdf'),
(15,  'Alongamentos e Aquecimentos',  'Conteúdo sobre alongamentos e aquecimentos.',  'https://example.com/video29',  'alongamentos_aquecimentos.pdf'),
(15,  'Jogos de Coordenação Motora',  'Conteúdo sobre jogos de coordenação motora.',  'https://example.com/video30',  'jogos_coordenacao_motora.pdf'),
(16,  'Atividades em Grupo',  'Conteúdo sobre atividades em grupo.',  'https://example.com/video31',  'atividades_grupo.pdf'),
(16,  'Importância do Exercício Físico',  'Conteúdo sobre a importância do exercício físico.',  'https://example.com/video32',  'importancia_exercicio_fisico.pdf');

-- Dados iniciais para Missões
INSERT INTO Missoes (aula_id, titulo, jogo_url, recompensa_capimoedas) VALUES
(1, 'Desafio da Matemática', 'https://example.com/jogo_math', 50),
(2, 'Caça ao Tesouro Geométrico', 'https://example.com/jogo_geo', 50),
(3, 'Quiz dos Seres Vivos', 'https://example.com/jogo_bio', 50),
(4, 'Aventura no Corpo Humano', 'https://example.com/jogo_corpo', 50),
(5, 'Viagem pela Antiguidade', 'https://example.com/jogo_historia1', 75),
(6, 'Missão Idade Média', 'https://example.com/jogo_historia2', 75),
(7, 'Explorando o Relevo', 'https://example.com/jogo_geografia1', 75),
(8, 'Climas do Mundo em Ação', 'https://example.com/jogo_geografia2', 75),
(9, 'Desafio Gramatical', 'https://example.com/jogo_portugues1', 50),
(10, 'Literatura em Jogo', 'https://example.com/jogo_portugues2', 50),
(11, 'Vocabulário em Ação', 'https://example.com/jogo_ingles1', 50),
(12, 'Frases em Movimento', 'https://example.com/jogo_ingles2', 50),
(13, 'Desafio Artístico', 'https://example.com/jogo_artes1', 40),
(14, 'Música e Ritmo em Jogo', 'https://example.com/jogo_artes2', 40),
(15, 'Exercícios Divertidos', 'https://example.com/jogo_educacao1', 40),
(16, 'Brincadeiras Saudáveis', 'https://example.com/jogo_educacao2', 40);



