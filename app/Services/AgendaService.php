<?php

namespace App\Services;

use Core\Service;
use Core\Logger;
use App\Repositories\UnidadeRepository;

/**
 * AgendaService
 * ─────────────────────────────────────────────────────────────────────────────
 * Camada de lógica de negócio da entidade Agenda.
 *
 * Regras desta camada:
 *   ✅ Contém: regras de negócio, orquestração, validações de domínio
 *   ❌ Não contém: $_POST, $_GET, header(), redirect(), HTML
 *
 * Controllers são finos: recebem request → chamam Service → retornam response.
 *
 * Uso no Controller:
 *   $service = new AgendaService();
 *   $result  = $service->create($data, $userId);
 *   if ($result['success']) { ... }
 */
class AgendaService extends Service
{
    private UnidadeRepository $unidades;

    public function __construct()
    {
        $this->unidades = new UnidadeRepository();
    }

    /**
     * Renderiza as unidades disponíveis para agendamento.
     */
    public function renderUnidade(): string
    {
        $unidades = $this->unidades->disponiveisParaAgendamento();

        if (empty($unidades)) {
            return '<div class="text-info mt-5">
                Não há Unidades disponíveis para agendamento
            </div>';
        }

        $radios = '';

        foreach ($unidades as $unidade) {
            $id = (int) $unidade->id;

            $nome = e(
                $unidade->nome ?? '',
                ENT_QUOTES,
                'UTF-8'
            );

            $endereco = e(
                $unidade->endereco ?? '',
                ENT_QUOTES,
                'UTF-8'
            );

            $radios .= '<div class="form-check mb-2">';

            $radios .= sprintf(
                '<input
                    type="radio"
                    name="unidade_id"
                    data-unidade="%s"
                    value="%d"
                    class="form-check-input"
                    id="radio-unidade-%d"
                >',
                $nome,
                $id,
                $id
            );

            $radios .= sprintf(
                '<label class="form-check-label" for="radio-unidade-%d">
                    %s<br>
                    %s
                </label>',
                $id,
                $nome,
                $endereco
            );

            $radios .= '</div>';
        }

        return $radios;
    }
}
