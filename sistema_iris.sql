
CREATE DATABASE IF NOT EXISTS sistema_iris_pro;
USE sistema_iris_pro;


CREATE TABLE niveis (
    id_nivel INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(50) UNIQUE NOT NULL 
) ENGINE=InnoDB;

CREATE TABLE funcoes (
    id_funcao INT AUTO_INCREMENT PRIMARY KEY,
    nome_funcao VARCHAR(100) UNIQUE NOT NULL 
) ENGINE=InnoDB;


CREATE TABLE funcionarios (
    -- Usamos VARCHAR(36) para armazenar o UUID formatado
    id_funcionario VARCHAR(36) PRIMARY KEY,
    matricula VARCHAR(50) UNIQUE NOT NULL,
    nome_completo VARCHAR(255) NOT NULL,
    cpf VARCHAR(14) UNIQUE NOT NULL,
    status ENUM('ATIVO', 'INATIVO') DEFAULT 'ATIVO',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;


CREATE TABLE atribuicao_contratual (
    id_atribuicao VARCHAR(36) PRIMARY KEY,
    funcionario_id VARCHAR(36) NOT NULL,
    funcao_id INT NOT NULL,
    nivel_id INT NOT NULL,
    data_inicio DATE NOT NULL,
    ativo BOOLEAN DEFAULT TRUE,
    
    CONSTRAINT fk_atribuicao_func FOREIGN KEY (funcionario_id) 
        REFERENCES funcionarios(id_funcionario) ON DELETE CASCADE,
    CONSTRAINT fk_atribuicao_funcao FOREIGN KEY (funcao_id) 
        REFERENCES funcoes(id_funcao),
    CONSTRAINT fk_atribuicao_nivel FOREIGN KEY (nivel_id) 
        REFERENCES niveis(id_nivel)
) ENGINE=InnoDB;


CREATE TABLE tipos_documento (
    id_tipo INT AUTO_INCREMENT PRIMARY KEY,
    codigo_slug VARCHAR(50) UNIQUE NOT NULL, 
    descricao VARCHAR(100) NOT NULL,
    obrigatorio BOOLEAN DEFAULT FALSE
) ENGINE=InnoDB;

CREATE TABLE imagens_funcionarios (
    id_imagem VARCHAR(36) PRIMARY KEY,
    funcionario_id VARCHAR(36) NOT NULL,
    tipo_documento_id INT NOT NULL,
    caminho_arquivo VARCHAR(1024) NOT NULL, 
    hash_sha256 VARCHAR(64), 
    status_aprovacao ENUM('PENDENTE', 'APROVADO', 'REJEITADO') DEFAULT 'PENDENTE',
    data_upload TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    data_validade DATE, 
    
    CONSTRAINT fk_img_func FOREIGN KEY (funcionario_id) 
        REFERENCES funcionarios(id_funcionario) ON DELETE CASCADE,
    CONSTRAINT fk_img_tipo FOREIGN KEY (tipo_documento_id) 
        REFERENCES tipos_documento(id_tipo)
) ENGINE=InnoDB;

CREATE INDEX idx_func_matricula ON funcionarios(matricula);
CREATE INDEX idx_img_validade ON imagens_funcionarios(data_validade);