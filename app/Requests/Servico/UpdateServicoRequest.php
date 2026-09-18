<?php

namespace App\Requests\Serviso;

use App\Requests\FormRequest;
use Core\Auth;

/**
 * UpdateServicoRequest
 * ─────────────────────────────────────────────────────────────────────────────
 * Centraliza validação, sanitização e autorização do formulário.
 *
 * Fluxo automático ao instanciar:
 *   new UpdateServicoRequest()
 *     → authorize()   — verifica permissão
 *     → sanitize()    — limpa os dados
 *     → validate()    — aplica rules() com messages()
 *
 * Uso no Controller:
 *   $request = new UpdateServicoRequest();
 *   if ($request->fails()) {
 *       Session::flash('error', $request->firstError());
 *       Session::flashInput($request->all());
 *       $this->back();
 *   }
 *   $data = $request->validated();
 */
class UpdateServicoRequest extends FormRequest
{
    /**
     * Define quem pode realizar esta ação.
     *
     * Exemplos:
     *   return true;               // sempre permitido
     *   return Auth::check();      // apenas logados
     *   return Auth::is('admin');  // apenas admins
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Regras de validação.
     * Sintaxe: 'campo' => 'regra1|regra2|regra3:param'
     *
     * Regras disponíveis:
     *   required, email, min:N, max:N, numeric, integer,
     *   confirmed, same:outro, different:outro,
     *   in:a,b,c, not_in:a,b,c, regex:/pattern/,
     *   unique:tabela,coluna, exists:tabela,coluna, nullable
     */
    public function rules(): array
    {
        return [
            // Identificação
            'nome'              => 'required|min:2|max:150|unique:unidades,nome',
            'status'            => 'required',
        ];
    }

    /**
     * Mensagens de erro customizadas.
     */
    public function messages(): array
    {
        return [
            // Identificação
            'nome.required'      => 'O nome da unidade é obrigatório.',
            'nome.unique'        => 'Este nome de unidade já está em uso.',
            'nome.min'           => 'O nome da unidade deve ter pelo menos 2 caracteres.',
            'nome.max'           => 'O nome da unidade deve ter no máximo 150 caracteres.',

            'status.required'    => 'O status da unidade é obrigatório.',
        ];
    }
}
