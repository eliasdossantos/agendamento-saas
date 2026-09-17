<script>
$(document).on('show.bs.modal', '#deleteModal', function(event) {
    var button = $(event.relatedTarget);

    var action = button.data('action') || '';
    var nome = button.data('nome') || 'este registro';
    var titulo = button.data('titulo') || 'Confirmar exclusão';

    var modal = $(this);
    modal.find('#deleteModalLabel').text(titulo);
    modal.find('#deleteModalNome').text(nome);
    modal.find('#deleteForm').attr('action', action);
});
</script>