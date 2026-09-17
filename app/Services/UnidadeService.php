<?php

namespace App\Services;

use Core\Service;
use Core\Logger;
use App\Repositories\UnidadeRepository;

/**
 * UnidadeService
 * ─────────────────────────────────────────────────────────────────────────────
 * Camada de lógica de negócio da entidade Unidade.
 */
class UnidadeService extends Service
{
    private UnidadeRepository $unidadeRepository;

    public function __construct()
    {
        $this->unidadeRepository = new UnidadeRepository();
    }

    public function obterHorarioFuncionamento(int $unidadeId): array
    {
        // Busca a unidade no banco
        $unidade = $this->unidadeRepository->findById($unidadeId);

        // Verifica se a unidade existe
        if (!$unidade) {
            return [
                'success' => false,
                'message' => 'Unidade não encontrada.',
            ];
        }

        // Pega os dados da unidade
        $inicio = $unidade->hora_inicio;
        $fim = $unidade->hora_fim;
        $intervalo = $unidade->intervalo_minutos;

        return [
            'success' => true,
            'hora_inicio' => $inicio,
            'hora_fim' => $fim,
            'intervalo_minutos' => $intervalo,
        ];
    }
}
