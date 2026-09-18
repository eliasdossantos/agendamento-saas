-- ─────────────────────────────────────────────────────────────────────────────
-- Migration 005 — Create Unidade Servico Table
-- Execute: php mvc migrate
-- ─────────────────────────────────────────────────────────────────────────────
-- ── UnidadeServico ────────────────────────────────────────────────────────────
-- TODO: Implemente sua migration aqui
CREATE TABLE IF NOT EXISTS unidade_servico (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    unidade_id INT UNSIGNED NOT NULL,
    servico_id INT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY uniq_unidade_servico (unidade_id, servico_id),
    CONSTRAINT fk_unidade_servico_unidade FOREIGN KEY (unidade_id) REFERENCES unidades(id) ON DELETE CASCADE,
    CONSTRAINT fk_unidade_servico_servico FOREIGN KEY (servico_id) REFERENCES servicos(id) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;