<?php

namespace App\Services;

use Core\Service;
use Core\Logger;
use App\Repositories\MyBasseRepository;

/**
 * MyBasseService
 * ─────────────────────────────────────────────────────────────────────────────
 * Camada de lógica de negócio da entidade MyBasse.
 *
 * Regras desta camada:
 *   ✅ Contém: regras de negócio, orquestração, validações de domínio
 *   ❌ Não contém: $_POST, $_GET, header(), redirect(), HTML
 *
 * Controllers são finos: recebem request → chamam Service → retornam response.
 *
 * Uso no Controller:
 *   $service = new MyBasseService();
 *   $result  = $service->create($data, $userId);
 *   if ($result['success']) { ... }
 */
class MyBasseService extends Service
{

    public function textSpan()
    {
        return '<span class="text-danger">Não há dados para serem exibidos.</span>';
    }
}
