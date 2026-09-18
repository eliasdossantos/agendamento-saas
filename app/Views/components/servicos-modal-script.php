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

            servicos.forEach(function(nomeServico) {
                lista.append(
                    jQuery('<li></li>')
                    .addClass('py-1')
                    .append(jQuery('<i></i>').addClass('fas fa-check text-success mr-2'))
                    .append(document.createTextNode(nomeServico))
                );
            });
        });
    })();
</script>