<?php

namespace App\Requests\Unidade;

use App\Requests\FormRequest;

/**
 * UpdateUnidadeRequest
 * ─────────────────────────────────────────────────────────────────────────────
 * Centraliza validação, sanitização e autorização da atualização de uma unidade.
 *
 * Fluxo automático ao instanciar:
 *   new UpdateUnidadeRequest()
 *     → authorize()
 *     → sanitize()
 *     → validate()
 *
 * Uso no Controller:
 *   $request = new UpdateUnidadeRequest();
 *
 *   if ($request->fails()) {
 *       Session::flash('error', $request->firstError());
 *       Session::flashInput($request->all());
 *       $this->back();
 *   }
 *
 *   $data = $request->validated();
 */
class UpdateUnidadeRequest extends FormRequest
{
    /**
     * Define quem pode realizar esta ação.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Regras de validação.
     *
     * Campos baseados na tabela "unidades".
     */
    public function rules(): array
    {
        $intervalos = implode(',', array_keys(\App\Repositories\UnidadeRepository::getIntervalosMinutos()));

        return [
            // Identificação
            'nome'              => 'required|min:2|max:150|unique:unidades,nome,{id}',
            'slug'              => 'required|min:2|max:150',
            'descricao'         => 'required|max:10000',

            // Contato
            'email'             => 'required|email|max:100',
            'telefone'          => 'required|max:16',
            'coordenador'       => 'required|max:100',

            // Endereço
            'endereco'          => 'required|max:255',
            'numero'            => 'required|alphanumeric|max:10',
            'complemento'       => 'nullable|max:255',
            'bairro'            => 'required|max:150',
            'cidade'            => 'required|max:150',
            'estado'            => 'required|max:2',
            'cep'               => 'required|max:15',

            // Imagem e serviços
            'imagem'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'servicos'          => 'nullable',

            // Configurações de funcionamento
            'hora_inicio'       => 'required',
            'hora_fim'          => 'required',
            'intervalo_minutos' => "required|integer|in:{$intervalos}",

            // Status
            'status'            => 'nullable',
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

            'slug.required'      => 'O slug da unidade é obrigatório.',
            'slug.max'           => 'O slug deve ter no máximo 150 caracteres.',

            'descricao.required' => 'A descrição da unidade é obrigatória.',
            'descricao.max'      => 'A descrição deve ter no máximo 10.000 caracteres.',

            // Contato
            'email.required'     => 'O e-mail da unidade é obrigatório.',
            'email.email'        => 'Informe um e-mail válido.',
            'email.max'          => 'O e-mail deve ter no máximo 100 caracteres.',

            'telefone.required'  => 'O telefone da unidade é obrigatório.',
            'telefone.max'       => 'O telefone deve ter no máximo 15 caracteres.',

            'coordenador.required' => 'O coordenador da unidade é obrigatório.',
            'coordenador.max'      => 'O nome do coordenador deve ter no máximo 100 caracteres.',

            // Endereço
            'endereco.required'  => 'O endereço é obrigatório.',
            'endereco.max'       => 'O endereço deve ter no máximo 255 caracteres.',

            'numero.required'    => 'O número do endereço é obrigatório.',
            'numero.max'         => 'O número deve ter no máximo 10 caracteres.',
            'numero.alphanumeric' => 'Informe um número de endereço válido, como 23, 345B ou 24A.',

            'complemento.max'    => 'O complemento deve ter no máximo 255 caracteres.',

            'bairro.required'    => 'O bairro é obrigatório.',
            'bairro.max'         => 'O bairro deve ter no máximo 150 caracteres.',

            'cidade.required'    => 'A cidade é obrigatória.',
            'cidade.max'         => 'A cidade deve ter no máximo 150 caracteres.',

            'estado.required'    => 'O estado é obrigatório.',
            'estado.max'         => 'O estado deve possuir 2 caracteres.',

            'cep.required'       => 'O CEP é obrigatório.',
            'cep.max'            => 'O CEP deve ter no máximo 15 caracteres.',

            // Imagem e serviços
            'imagem.max'         => 'A URL da imagem deve ter no máximo 255 caracteres.',

            // Funcionamento
            'hora_inicio.required' => 'A hora de início é obrigatória.',
            'hora_fim.required'    => 'A hora de término é obrigatória.',
            'intervalo_minutos.required' => 'O intervalo entre agendamentos é obrigatório.',
            'intervalo_minutos.in'       => 'Selecione um intervalo válido.',

            // Status
            'status.nullable'    => 'O status da unidade Ativar/Desativar.',
        ];
    }

    public function sanitize(): array
    {
        $data = parent::sanitize();

        $data['numero'] = trim((string)($this->input['numero'] ?? ''));

        $data['intervalo_minutos'] = (int)($this->input['intervalo_minutos'] ?? 0);

        $raw = $this->input['servicos'] ?? '[]';
        $decoded = json_decode($raw, true);

        $data['servicos'] = json_last_error() === JSON_ERROR_NONE
            ? json_encode($decoded)
            : '[]';

        return $data;
    }
}
