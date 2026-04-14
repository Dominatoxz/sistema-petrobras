CREATE DATABASE sistema_infos;
USE sistema_infos;

CREATE TABLE nivel (
    id_nivel INT PRIMARY KEY AUTO_INCREMENT,
    descricao_nivel VARCHAR(50) NOT NULL 
);

CREATE TABLE funcao (
    id_funcao INT PRIMARY KEY AUTO_INCREMENT,
    nome_funcao VARCHAR(100) NOT NULL
);

CREATE TABLE funcionario (
    id_funcionario INT PRIMARY KEY AUTO_INCREMENT,
    nome_completo VARCHAR(255) NOT NULL,
    registro_corporativo VARCHAR(20) UNIQUE NOT NULL
);

CREATE TABLE atribuicao_colaborador (
    id_atribuicao INT PRIMARY KEY AUTO_INCREMENT,
    id_funcionario INT NOT NULL,
    id_funcao INT NOT NULL,
    id_nivel INT NOT NULL,
    data_inicio DATE NOT NULL,
    FOREIGN KEY (id_funcionario) REFERENCES funcionario(id_funcionario),
    FOREIGN KEY (id_funcao) REFERENCES funcao(id_funcao),
    FOREIGN KEY (id_nivel) REFERENCES nivel(id_nivel),
    UNIQUE(id_funcionario, id_funcao, id_nivel) 
);