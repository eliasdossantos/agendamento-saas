<?php

namespace App\Models;

use Core\Model;

/**
 * UnidadeModel
 * ─────────────────────────────────────────────────────────────────────────────
 * Model responsável pela tabela `unidades`.
 *
 * Propriedades principais:
 *   $table      → nome da tabela no banco
 *   $fillable   → campos permitidos para INSERT/UPDATE (whitelist de segurança)
 *   $hidden     → campos excluídos da serialização (ex: password, tokens)
 *   $timestamps → gerencia created_at/updated_at automaticamente
 *   $softDelete → usa deleted_at ao invés de DELETE físico
 */
class UnidadeModel extends Model
{
    /** Tabela correspondente no banco de dados */
    protected string $table = 'unidades';

    /**
     * Campos aceitos em create() e update().
     * Campos fora desta lista são ignorados silenciosamente.
     */
    protected array $fillable = [
        'nome',
        'slug',
        'descricao',
        'email',
        'telefone',
        'coordenador',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'cep',
        'imagem',
        'servicos',
        'hora_inicio',
        'hora_fim',
        'intervalo_minutos',
        'status'
        // adicione os campos do seu model aqui
    ];

    /**
     * Campos ocultos ao serializar o objeto (ex: para JSON de API).
     */
    protected array $hidden = [
        'servicos'
    ];

    /** Gerencia created_at e updated_at automaticamente */
    protected bool $timestamps = true;

    /** true = usa deleted_at (soft delete) ao invés de DELETE físico */
    protected bool $softDelete = false;
}
