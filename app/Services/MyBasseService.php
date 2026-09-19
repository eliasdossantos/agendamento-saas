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
 *
 * Conversão de tipos:
 *   Sempre que precisar transformar um registro/campo qualquer (que pode vir
 *   do banco, de um formulário, de uma API externa etc.) em um tipo específico,
 *   use o método cast() ou os métodos específicos (toJson, toArray, toString,
 *   toInt, toBool):
 *
 *   $this->cast($valor, 'json');
 *   $this->cast($valor, 'array');
 *   $this->cast($valor, 'string');
 *   $this->cast($valor, 'int');
 *   $this->cast($valor, 'bool');
 */
class MyBasseService extends Service
{
    public function textSpan()
    {
        return '<span class="text-danger">Não há dados para serem exibidos.</span>';
    }

    /**
     * ──────────────────────────────────────────────────────────────────────
     * CONVERSÃO GENÉRICA
     * ────────────────────────────────────────────────────────────────────*/

    /**
     * Converte $value para o $type informado.
     *
     * @param mixed  $value Valor de entrada (registro, campo, string, array...)
     * @param string $type  'json' | 'array' | 'string' | 'int' | 'bool'
     * @return mixed
     *
     * Exemplo:
     *   $registro = $repository->find(1); // veio um array do banco
     *
     *   $comoJson   = $this->cast($registro, 'json');
     *   $comoArray  = $this->cast($registro, 'array');
     *   $comoTexto  = $this->cast($registro['ativo'], 'bool');
     *   $comoNumero = $this->cast($registro['preco'], 'int');
     */
    public function cast($value, string $type)
    {
        switch (strtolower($type)) {
            case 'json':
                return $this->toJson($value);
            case 'array':
                return $this->toArray($value);
            case 'string':
                return $this->toString($value);
            case 'int':
            case 'integer':
                return $this->toInt($value);
            case 'bool':
            case 'boolean':
                return $this->toBool($value);
            default:
                Logger::warning("MyBasseService::cast - tipo desconhecido: {$type}");
                return $value;
        }
    }

    /** 
     * ──────────────────────────────────────────────────────────────────────
     * CONVERSÕES ESPECÍFICAS
     * ────────────────────────────────────────────────────────────────────*/

    /**
     * Transforma array, objeto ou string em JSON válido.
     * Se já for uma string JSON válida, apenas retorna ela mesma.
     *
     * Exemplo:
     *   $dados = ['nome' => 'Elias', 'ativo' => true];
     *   $json  = $this->toJson($dados);
     *   // $json = '{"nome":"Elias","ativo":true}'
     */
    public function toJson($value): string
    {
        if (is_string($value) && $this->isJson($value)) {
            return $value;
        }

        $json = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        return $json !== false ? $json : '{}';
    }

    /**
     * Transforma JSON, objeto ou string separada por vírgula em array PHP.
     *
     * Exemplo:
     *   $json  = '{"nome":"Elias","idade":30}';
     *   $array = $this->toArray($json);
     *   // $array = ['nome' => 'Elias', 'idade' => 30]
     *
     *   $tags = $this->toArray('php,mysql,mvc');
     *   // $tags = ['php', 'mysql', 'mvc']
     */
    public function toArray($value): array
    {
        if (is_array($value)) {
            return $value;
        }

        if (is_object($value)) {
            return (array) $value;
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE && (is_array($decoded))) {
                return $decoded;
            }

            // fallback: "a,b,c" -> ['a','b','c']
            if (str_contains($value, ',')) {
                return array_map('trim', explode(',', $value));
            }

            return $value === '' ? [] : [$value];
        }

        if ($value === null) {
            return [];
        }

        return [$value];
    }

    /**
     * Transforma qualquer valor em string legível.
     * Arrays/objetos viram JSON; bool vira 'true'/'false'; null vira ''.
     *
     * Exemplo:
     *   $texto = $this->toString(true);
     *   // $texto = 'true'
     *
     *   $texto2 = $this->toString(['a' => 1, 'b' => 2]);
     *   // $texto2 = '{"a":1,"b":2}'
     */
    public function toString($value): string
    {
        if (is_string($value)) {
            return $value;
        }

        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        if (is_null($value)) {
            return '';
        }

        if (is_array($value) || is_object($value)) {
            return $this->toJson($value);
        }

        return (string) $value;
    }

    /**
     * Converte qualquer valor "numérico" (string, float, bool) em int.
     *
     * Exemplo:
     *   $numero = $this->toInt('R$ 1.250,00');
     *   // $numero = 125000  (todos os dígitos, sem pontuação)
     *
     *   $numero2 = $this->toInt('42');
     *   // $numero2 = 42
     */
    public function toInt($value): int
    {
        if (is_int($value)) {
            return $value;
        }

        if (is_bool($value)) {
            return $value ? 1 : 0;
        }

        if (is_numeric($value)) {
            return (int) $value;
        }

        if (is_string($value)) {
            // extrai apenas dígitos e sinal, ex: "R$ 1.250,00" -> 1250
            $numero = preg_replace('/[^0-9\-]/', '', $value);
            return $numero === '' ? 0 : (int) $numero;
        }

        return 0;
    }

    /**
     * Converte qualquer representação comum de verdadeiro/falso em bool.
     * Aceita: true/false, 1/0, "1"/"0", "true"/"false", "sim"/"nao",
     * "yes"/"no", "on"/"off", vazio, null.
     *
     * Exemplo:
     *   $campo1 = $this->toBool('sim');
     *   // $campo1 = true
     *
     *   $campo2 = $this->toBool('0');
     *   // $campo2 = false
     *
     *   $campo3 = $this->toBool('on'); // ex: checkbox marcado
     *   // $campo3 = true
     */
    public function toBool($value): bool
    {
        if (is_bool($value)) {
            return $value;
        }

        if (is_null($value)) {
            return false;
        }

        if (is_numeric($value)) {
            return ((float) $value) != 0;
        }

        if (is_string($value)) {
            $v = strtolower(trim($value));

            $verdadeiros = ['true', '1', 'sim', 'yes', 'on', 's'];
            $falsos      = ['false', '0', 'nao', 'não', 'no', 'off', 'n', ''];

            if (in_array($v, $verdadeiros, true)) {
                return true;
            }

            if (in_array($v, $falsos, true)) {
                return false;
            }

            // fallback: usa o comportamento padrão do PHP
            return (bool) filter_var($v, FILTER_VALIDATE_BOOLEAN);
        }

        if (is_array($value)) {
            return count($value) > 0;
        }

        return (bool) $value;
    }

    /**
     * ──────────────────────────────────────────────────────────────────────
     * HELPER INTERNO
     * ────────────────────────────────────────────────────────────────────*/

    /**
     * Verifica se uma string é um JSON válido.
     */
    private function isJson(string $value): bool
    {
        if ($value === '') {
            return false;
        }

        json_decode($value);
        return json_last_error() === JSON_ERROR_NONE;
    }
}
