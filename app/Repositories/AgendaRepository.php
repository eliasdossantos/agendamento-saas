<?php

namespace App\Repositories;

use Core\Repository;
use App\Models\UnidadeModel;

/**
 * UnidadeRepository
 * ─────────────────────────────────────────────────────────────────────────────
 * Encapsula todas as queries relacionadas à entidade UnidadeModel.
 *
 * Herda do Repository base:
 *   all(), findById(), create(), update(), delete(), paginate()
 *
 * Adicione aqui apenas queries específicas desta entidade.
 * Lógica de negócio → Service (nunca aqui).
 *
 * Uso no Controller ou Service:
 *   $repo = new UnidadeModelRepository();
 *   $item = $repo->findById(42);
 *   $list = $repo->paginate(15, (int)($_GET['page'] ?? 1));
 */
class UnidadeRepository extends Repository
{
    /** Model associado a este repository */
    protected string $modelClass = UnidadeModel::class;

    // ── Buscas customizadas ───────────────────────────────────────────────────

    /**
     * Busca por nome exato.
     */
    public function findByName(string $name): object|false
    {
        return $this->model()->findBy('name', $name);
    }

    /**
     * Retorna registros ativos (se a tabela tiver campo 'active').
     */
    public function getActive(): array
    {
        return $this->model()
            ->where('active', 1)
            ->orderBy('name', 'ASC')
            ->get();
    }

    /**
     * Busca paginada com filtro de texto por nome.
     * Usa o query builder do Model — evite escrever SQL manual aqui.
     *
     * @return array{data: array, total: int, page: int, per_page: int, last_page: int, from: int, to: int}
     */
    public function search(string $term = '', int $page = 1, int $perPage = 15): array
    {
        return $this->model()
            ->where('name', '%' . $term . '%', 'LIKE')
            ->orderBy('id', 'DESC')
            ->paginate($perPage, $page);
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
    public function renderUnidade(): string
    {
        $unidades = model(UnidadeRepository::class)
            ->where('status', 1)
            ->where('servicos', null, '!=')
            ->where('servicos', '', '!=')
            ->orderBy('nome', 'ASC')
            ->get();

        if (empty($unidades)) {
            return '<div class="text-info mt-5">
            Não há Unidades disponíveis para agendamento
        </div>';
        }

        $radios = '';

        foreach ($unidades as $unidade) {
            $radios .= '<div class="form-check mb-2">';

            $radios .= sprintf(
                '<input type="radio"
                name="unidade_id"
                data-unidade="%s"
                value="%d"
                class="form-check-input"
                id="radio-unidade-%d">',
                htmlspecialchars($unidade->nome, ENT_QUOTES, 'UTF-8'),
                $unidade->id,
                $unidade->id
            );

            $radios .= sprintf(
                '<label class="form-check-label" for="radio-unidade-%d">
                %s<br>
                %s
            </label>',
                $unidade->id,
                htmlspecialchars($unidade->nome, ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($unidade->endereco ?? '', ENT_QUOTES, 'UTF-8')
            );

            $radios .= '</div>';
        }

        return $radios;
    }
}
