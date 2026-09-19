<?php

namespace App\Models;

use Core\Model;

/**
 * UnidadeServicoModel
 * ─────────────────────────────────────────────────────────────────────────────
 * Tabela pivô N:N entre Unidade e Serviço.
 * Veja migration_unidade_servico.sql para a estrutura da tabela.
 */
class UnidadeServicoModel extends Model
{
    protected string $table      = 'unidade_servico';
    protected bool   $softDelete = false;

    /**
     * IDs dos serviços vinculados a uma unidade.
     *
     * @return int[]
     */
    public function servicoIdsByUnidade(int $unidadeId): array
    {
        $rows = $this->db
            ->query("SELECT servico_id FROM {$this->table} WHERE unidade_id = :unidade_id")
            ->bind(':unidade_id', $unidadeId)
            ->fetchAll();

        return array_map(fn($row) => (int) $row->servico_id, $rows ?: []);
    }

    /** Remove todos os vínculos de uma unidade. */
    public function deleteByUnidade(int $unidadeId): bool
    {
        return $this->db
            ->query("DELETE FROM {$this->table} WHERE unidade_id = :unidade_id")
            ->bind(':unidade_id', $unidadeId)
            ->execute();
    }

    /** Insere um vínculo unidade ↔ serviço. */
    public function insert(int $unidadeId, int $servicoId): bool
    {
        return $this->db
            ->query("INSERT INTO {$this->table} (unidade_id, servico_id) VALUES (:unidade_id, :servico_id)")
            ->bind(':unidade_id', $unidadeId)
            ->bind(':servico_id', $servicoId)
            ->execute();
    }

    /**
     * Nomes (+ status) dos serviços de TODAS as unidades, agrupados por unidade_id.
     * Uma única query (JOIN) em vez de uma consulta por linha da listagem.
     *
     * Ajuste o nome da tabela/coluna 'servicos'/'nome'/'status' se forem
     * diferentes no seu projeto.
     *
     * @return array<int, array<int, array{nome: string, status: int}>>
     *         ex: [3 => [['nome' => 'Corte', 'status' => 1], ['nome' => 'Escova', 'status' => 0]]]
     */
    public function nomesAgrupadosPorUnidade(): array
    {
        $rows = $this->db
            ->query("
                SELECT us.unidade_id, s.nome, s.status
                FROM {$this->table} us
                INNER JOIN servicos s ON s.id = us.servico_id
                ORDER BY s.nome
            ")
            ->fetchAll();

        $agrupado = [];
        foreach ($rows ?: [] as $row) {
            $agrupado[(int) $row->unidade_id][] = [
                'nome'   => $row->nome,
                'status' => (int) $row->status,
            ];
        }

        return $agrupado;
    }
}
