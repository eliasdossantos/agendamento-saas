-- ─────────────────────────────────────────────────────────────────────────────
-- Migration 001 — Create Unidades Table
-- Execute: php mvc migrate
-- ─────────────────────────────────────────────────────────────────────────────
-- ── Unidades ────────────────────────────────────────────────────────────
-- TODO: Implemente sua migration aqui
CREATE TABLE IF NOT EXISTS unidades (
    -- Identificação
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NULL,
    slug VARCHAR(150) NULL UNIQUE COMMENT 'Slug da unidade, usado para URLs amigáveis',
    descricao TEXT NULL COMMENT 'Descrição detalhada da unidade',
    -- Contato
    email VARCHAR(100) NULL,
    telefone VARCHAR(15) NULL COMMENT 'Telefone no formato (99) 99999-9999',
    coordenador VARCHAR(100) NULL COMMENT 'Nome do coordenador da unidade',
    -- Endereço
    endereco VARCHAR(255) NULL COMMENT 'Endereço completo da unidade',
    numero VARCHAR(10) NULL COMMENT 'Número do endereço da unidade',
    complemento VARCHAR(255) NULL COMMENT 'Complemento do endereço da unidade',
    bairro VARCHAR(150) NULL COMMENT 'Bairro da unidade',
    cidade VARCHAR(150) NULL COMMENT 'Cidade da unidade',
    estado VARCHAR(2) NULL COMMENT 'Estado da unidade (UF)',
    cep VARCHAR(15) NULL COMMENT 'CEP no formato 99999-999',
    -- Imagem e serviços
    imagem VARCHAR(255) NULL COMMENT 'URL da imagem da unidade',
    servicos JSON NULL COMMENT 'Serviços oferecidos pela unidade em formato JSON',
    -- Configurações de funcionamento
    hora_inicio TIME NULL COMMENT 'Hora de início do expediente da unidade',
    hora_fim TIME NULL COMMENT 'Hora de término do expediente da unidade',
    intervalo_minutos INT UNSIGNED NULL DEFAULT 30 COMMENT 'Intervalo em minutos entre os agendamentos',
    -- Status
    status TINYINT(1) NOT NULL DEFAULT 1 COMMENT 'Status da unidade: 1 - Ativa, 0 - Inativa',
    -- Auditoria
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;