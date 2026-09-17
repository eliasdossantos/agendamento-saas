<?php

/**
 * Modal de confirmação de exclusão — componente genérico e reutilizável.
 * ─────────────────────────────────────────────────────────────────────────────
 * Assim como components.alerts é incluído uma única vez e reage aos dados
 * da sessão, este modal é incluído uma única vez por página e reage aos
 * atributos data-* do botão que o abriu — não precisa de um modal duplicado
 * por linha de tabela nem por entidade (unidades, usuários, clientes, etc).
 *
 * Uso: inclua UMA VEZ na página (normalmente perto do fim, antes de View::end()):
 *   <?php \Core\View::partial('components.delete-modal'); ?>
*
* Em qualquer botão que deva abrir o modal:
* <button type="button" * data-toggle="modal" data-target="#deleteModal" *
    data-action="<?= route('unidade.destroy', ['id' => $unidade->id]) ?>" * data-nome="<?= e($unidade->nome) ?>">
    * Excluir
    * </button>
*
* Atributos suportados no gatilho:
* data-action (obrigatório) URL para onde o form do modal vai submeter
* data-nome Nome do item exibido na mensagem (padrão: "este registro")
* data-titulo Título do modal (padrão: "Confirmar exclusão")
*/
?>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow">
            <div class="modal-body text-center pt-4 pb-3 px-4">
                <button type="button" class="close position-absolute" style="top:12px;right:16px;" data-dismiss="modal"
                    aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="d-flex align-items-center justify-content-center mx-auto mb-3" style="
                    width: 64px;
                    height: 64px;
                    border-radius: 50%;
                    background: #fdecea;
                ">
                    <i class="fas fa-exclamation-triangle" style="font-size: 26px; color: #e74a3b;"></i>
                </div>

                <h5 class="font-weight-bold mb-2" id="deleteModalLabel">Confirmar exclusão</h5>

                <p class="text-muted mb-0">
                    Tem certeza que deseja excluir <strong id="deleteModalNome" class="text-gray-800">este
                        registro</strong>?
                    <br>
                    Esta ação não pode ser desfeita.
                </p>
            </div>
            <div class="modal-footer border-0 justify-content-center pb-4">
                <button type="button" class="btn btn-outline-secondary px-4" data-dismiss="modal">
                    Cancelar
                </button>
                <form id="deleteForm" method="POST" action="">
                    <?= csrf_field() ?>
                    <?= method_field('DELETE') ?>
                    <button type="submit" class="btn btn-danger px-4">
                        <i class="fas fa-trash-alt mr-1"></i> Excluir
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php \Core\View::partialOnce('components.delete-modal-script'); ?>