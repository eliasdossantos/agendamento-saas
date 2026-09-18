<?php

namespace App\Repositories;

use Core\Repository;
use App\Models\ServicoModel;

/**
 * ServicoRepository
 * ─────────────────────────────────────────────────────────────────────────────
 * Encapsula todas as queries relacionadas à entidade ServServicoModeliso.
 *
 * Herda do Repository base:
 *   all(), findById(), create(), update(), delete(), paginate()
 *
 * Adicione aqui apenas queries específicas desta entidade.
 * Lógica de negócio → Service (nunca aqui).
 *
 * Uso no Controller ou Service:
 *   $repo = new ServicoModelRepository();
 *   $item = $repo->findById(42);
 *   $list = $repo->paginate(15, (int)($_GET['page'] ?? 1));
 */
class ServicoRepository extends Repository
{
    /** Model associado a este repository */
    protected string $modelClass = ServicoModel::class;

    /**
     * Colunas procuradas automaticamente (em ordem de prioridade)
     */
    protected array $colunasStatus = ['status', 'ativo', 'is_active', 'active'];

    // ── Buscas customizadas ───────────────────────────────────────────────────

    /**
     * Busca uma unidade pelo nome.
     *
     * @param string $name Nome da unidade.
     *
     * @return object|false
     */
    public function findByName(string $name): object|false
    {
        return $this
            ->model()
            ->findBy('nome', $name);
    }

    /**
     * Lista somente unidades ativas.
     *
     * Ajuste o valor de `status` conforme a estrutura
     * definida na sua tabela.
     *
     * Exemplo:
     * - ativo / inativo
     * - 1 / 0
     */
    public function getActive(): array
    {
        return $this
            ->model()
            ->where('status', 'ativo')
            ->orderBy('nome', 'ASC')
            ->get();
    }

    /**
     * Pesquisa unidades pelo nome.
     *
     * @param string $term Termo da pesquisa.
     * @param int $page Página atual.
     * @param int $perPage Quantidade por página.
     *
     * @return array
     */
    public function search(
        string $term = '',
        int $page = 1,
        int $perPage = 15
    ): array {
        $model = $this
            ->model()
            ->orderBy('id', 'DESC');

        if ($term !== '') {
            $model->where(
                'nome',
                '%' . $term . '%',
                'LIKE'
            );
        }

        return $model->paginate($perPage, $page);
    }

    /**
     * Alterna o status do registro detectando automaticamente a coluna.
     *
     * @param int $id ID do registro
     * @param string|null $coluna Nome da coluna caso queira forçar uma específica
     * @return bool
     */
    public function verStatus(int $id, ?string $coluna = null): bool
    {
        $registro = $this->findById($id);

        if (!$registro) {
            return false;
        }

        $colunaAlvo = $coluna ?? $this->detectarColunaStatus($registro);

        if (!$colunaAlvo) {
            return false;
        }

        $valorAtual = (int) ($registro->{$colunaAlvo} ?? 0);
        $novoValor  = ($valorAtual === 1) ? 0 : 1;

        return $this->update($id, [$colunaAlvo => $novoValor]);
    }

    /**
     * Identifica automaticamente qual coluna de status existe no registro.
     */
    protected function detectarColunaStatus(object $registro): ?string
    {
        // property_exists — Verifica se o objeto ou a classe tem uma propriedade
        foreach ($this->colunasStatus as $coluna) {
            if (property_exists($registro, $coluna) || isset($registro->{$coluna})) {
                return $coluna;
            }
        }

        return null;
    }
}
