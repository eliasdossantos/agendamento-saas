<script>
    (function initServicosModal() {
        if (typeof jQuery === 'undefined') {
            return setTimeout(initServicosModal, 50);
        }

        jQuery(document).on('show.bs.modal', '#servicosModal', function(event) {
            var button = jQuery(event.relatedTarget);

            var nome = button.data('nome') || 'este registro';
            var servicos = button.data('servicos') || [];

            var modal = jQuery(this);
            var lista = modal.find('#servicosModalLista');

            modal.find('#servicosModalNome').text(nome);
            lista.empty();

            if (!servicos.length) {
                lista.append(jQuery('<li></li>').addClass('text-muted').text('Nenhum serviço vinculado.'));
                return;
            }

            servicos.forEach(function(servico) {
                // Retrocompatível: aceita tanto string simples quanto {nome, status}
                var isObjeto = servico !== null && typeof servico === 'object';
                var nomeServico = isObjeto ? servico.nome : servico;
                var status = isObjeto ? parseInt(servico.status, 10) : null;

                var li = jQuery('<li></li>').addClass(
                    'py-1 d-flex align-items-center justify-content-between'
                );

                var nomeSpan = jQuery('<span></span>')
                    .append(jQuery('<i></i>').addClass('fas fa-check text-success mr-2'))
                    .append(document.createTextNode(nomeServico));

                li.append(nomeSpan);

                // Só desenha o badge se o status veio informado (não quebra
                // dados antigos que só mandavam o nome como string).
                if (status !== null && !isNaN(status)) {
                    var badge = jQuery('<span></span>')
                        .addClass('badge ' + (status === 1 ? 'badge-success' : 'badge-secondary'))
                        .text(status === 1 ? 'Ativo' : 'Inativo');

                    li.append(badge);
                }

                lista.append(li);
            });
        });
    })();
</script>