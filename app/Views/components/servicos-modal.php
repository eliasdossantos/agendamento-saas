<?php

/**
 * Modal de listagem de serviços de uma unidade — componente genérico e reutilizável.
 * ─────────────────────────────────────────────────────────────────────────────
 * Assim como components.delete-modal, este modal é incluído uma única vez por
 * página e reage aos atributos data-* do botão/badge que o abriu — não precisa
 * de um modal duplicado por linha de tabela nem por entidade.
 *
 * Uso: inclua UMA VEZ na página (normalmente perto do fim, antes de View::end()):
 *   <?php \Core\View::partial('components.servicos-modal'); ?>
 *
 * Em qualquer botão/badge que deva abrir o modal, passe data-servicos como um
 * array JSON de objetos {nome, status} — não mais apenas strings de nome:
 *
 * <button type="button" data-toggle="modal" data-target="#servicosModal" * data-nome="<?= e($unidade->nome) ?>" *
    data-servicos='<?= e(json_encode($nomesServicos)) ?>'>
 * <?= count($nomesServicos) ?> serviços
 * </button>
 *
 * Onde $nomesServicos vem de UnidadeServicoModel::nomesAgrupadosPorUnidade():
 * [['nome' => 'Corte', 'status' => 1], ['nome' => 'Escova', 'status' => 0], ...]
 *
 * Atributos suportados no gatilho:
 * data-servicos (obrigatório) Array JSON de {nome, status} (status: 1 ativo / 0 inativo)
 * data-nome Nome do item exibido no título (padrão: "este registro")
 *
 * Retrocompatível: se algum item vier como string simples (sem status), o
 * modal exibe só o nome, sem o badge.
 */
?>
<div class="modal fade" id="servicosModal" tabindex="-1" role="dialog" aria-labelledby="servicosModalLabel"
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
                    background: #eaf1fd;
                ">
                    <i class="fas fa-concierge-bell" style="font-size: 26px; color: #4e73df;"></i>
                </div>

                <h5 class="font-weight-bold mb-3" id="servicosModalLabel">
                    Serviços de <span id="servicosModalNome" class="text-gray-800">este registro</span>
                </h5>

                <ul id="servicosModalLista" class="list-unstyled text-left mb-0"></ul>
            </div>
            <div class="modal-footer border-0 justify-content-center pb-4">
                <button type="button" class="btn btn-outline-secondary px-4" data-dismiss="modal">
                    Fechar
                </button>
            </div>
        </div>
    </div>
</div>

<?php \Core\View::partialOnce('components.servicos-modal-script'); ?>