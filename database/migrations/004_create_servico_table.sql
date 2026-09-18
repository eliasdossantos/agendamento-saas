-- ─────────────────────────────────────────────────────────────────────────────
-- Migration 004 — Create Servico Table
-- Execute: php mvc migrate
-- ─────────────────────────────────────────────────────────────────────────────
-- ── Servico ────────────────────────────────────────────────────────────
-- TODO: Implemente sua migration aqui
CREATE TABLE IF NOT EXISTS servicos (
    -- Identificação
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200) NULL,
    -- Status
    status TINYINT(1) NOT NULL DEFAULT 1 COMMENT 'Status da unidade: 1 - Ativa, 0 - Inativa',
    -- Auditoria
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;