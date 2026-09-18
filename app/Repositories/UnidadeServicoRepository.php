<?php

namespace App\Repositories;

use Core\Repository;
use App\Models\UnidadeServicoModel;

/**
 * UnidadeServicoRepository
 * ─────────────────────────────────────────────────────────────────────────────
 * Encapsula todas as queries relacionadas à entidade UnidadeServico.
 *
 * Herda do Repository base:
 *   all(), findById(), create(), update(), delete(), paginate()
 * (o próprio Repository base já instancia $this->model a partir de
 * $modelClass — não precisamos de __construct() nem de propriedade
 * $model própria aqui).
 *
 * @property-read UnidadeServicoModel $model
 */
class UnidadeServicoRepository extends Repository
{
    protected string $modelClass = UnidadeServicoModel::class;

    /**
     * IDs dos serviços atualmente vinculados a uma unidade.
     *
     * @return int[]
     */
    public function getServicoIds(int $unidadeId): array
    {
        return $this->model->servicoIdsByUnidade($unidadeId);
    }

    /**
     * Nomes dos serviços de todas as unidades, agrupados por unidade_id.
     * Usado na listagem de unidades para exibir a coluna "Serviços".
     *
     * @return array<int, string[]>
     */
    public function getNomesAgrupadosPorUnidade(): array
    {
        return $this->model->nomesAgrupadosPorUnidade();
    }

    /**
     * Sincroniza os vínculos de uma unidade: remove os antigos e grava
     * apenas os IDs de serviço informados.
     *
     * NOTA: se seu Core\Database tiver suporte a transação
     * (ex: $this->db()->beginTransaction() / commit() / rollBack()),
     * vale envolver o delete + inserts numa transação aqui para
     * evitar ficar sem nenhum vínculo caso um insert falhe no meio.
     *
     * @param int[] $servicoIds
     */
    public function sync(int $unidadeId, array $servicoIds): bool
    {
        $this->model->deleteByUnidade($unidadeId);

        foreach ($servicoIds as $servicoId) {
            $this->model->insert($unidadeId, (int) $servicoId);
        }

        return true;
    }
}
