<?php

namespace App\Repositories;

use App\Models\UnidadeModel;
use Core\Repository;

/**
 * UnidadeRepository
 *
 * Responsável pelo acesso aos dados específicos
 * da tabela `unidades`.
 *
 * O Repository centraliza as consultas relacionadas
 * às unidades e impede que Controllers e Services
 * precisem conhecer diretamente o Model.
 */
class UnidadeRepository extends Repository
{
    /**
     * Model utilizado pelo Repository.
     */
    protected string $modelClass = UnidadeModel::class;

    /**
     * Colunas procuradas automaticamente (em ordem de prioridade)
     */
    protected array $colunasStatus = ['status', 'ativo', 'is_active', 'active'];

    /**
     * Intervalos de tempo disponíveis para seleção.
     *
     * As chaves representam os valores utilizados pelo sistema (em minutos),
     * enquanto os valores correspondem aos textos exibidos ao usuário.
     */
    private static array $intervalo_minutos = [
        10  => "10 minutos",
        15  => "15 minutos",
        30  => "30 minutos",
        60  => "1 hora",
        120 => "2 horas",
        180 => "3 horas",
    ];

    public static function getIntervalosMinutos(): array
    {
        return self::$intervalo_minutos;
    }

    /**
     * Busca uma unidade pelo nome.
     *
     * @param string $name Nome da unidade.
     *
     * @return object|false
     */
    public function findByName(string $name): object|false
    {
        return $this->model()->findBy('nome', $name);
    }

    /**
     * Busca uma unidade pelo slug.
     *
     * O slug normalmente é utilizado em URLs.
     *
     * @param string $slug Slug da unidade.
     *
     * @return object|false
     */
    public function findBySlug(string $slug): object|false
    {
        return $this
            ->model()
            ->findBy('slug', $slug);
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
        return $this->model()
            ->where('status', 1)
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
        return $this->model()
            ->where('nome', '%' . $term . '%', 'LIKE')
            ->orderBy('id', 'DESC')
            ->paginate($perPage, $page);
    }

    /**
     * Pesquisa unidades por nome, e-mail, bairro ou cidade (busca parcial),
     * com filtro opcional de período de criação (created_at), com paginação.
     *
     * @param string      $term       Termo buscado em nome/email/bairro/cidade.
     * @param string|null $dataInicio Data inicial (Y-m-d) para filtrar created_at.
     * @param string|null $dataFim    Data final (Y-m-d) para filtrar created_at.
     * @param int         $page
     * @param int         $perPage
     *
     * @return array{data: array, total: int, page: int, per_page: int, last_page: int, from: int, to: int}
     */
    public function searchAdvanced(
        string $term = '',
        ?string $dataInicio = null,
        ?string $dataFim = null,
        int $page = 1,
        int $perPage = 15
    ): array {
        $model = $this->model();

        if ($term !== '') {
            $like = '%' . $term . '%';

            $model
                ->where('nome', $like, 'LIKE')
                ->orWhere('email', $like, 'LIKE')
                ->orWhere('bairro', $like, 'LIKE')
                ->orWhere('cidade', $like, 'LIKE');
        }

        if (!empty($dataInicio)) {
            $model->where('created_at', $dataInicio . ' 00:00:00', '>=');
        }

        if (!empty($dataFim)) {
            $model->where('created_at', $dataFim . ' 23:59:59', '<=');
        }

        return $model
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage, $page);
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

    /**
     * Retorna unidades ativas disponíveis para agendamento.
     */
    public function disponiveisParaAgendamento(): array
    {
        return $this->model()
            ->where('status', 1)
            ->orderBy('nome', 'ASC')
            ->get();
    }
}
