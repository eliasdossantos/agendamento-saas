<!-- app/Views/back/servicos/index.php -->

<!-- Aqui enviamos para o template principal o título da página -->

<?php View::start('title'); ?>

<?= e($title ?? 'Serviços') ?> | Admin

<?php View::end(); ?>


!-- Aqui enviamos para o template principal os estilos -->
<?php View::start('styles'); ?>
<!-- Custom styles for this page -->
<link href="<?= url('back/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
<?php View::end(); ?>


<!-- Aqui enviamos para o template principal o conteúdo -->
<?php View::start('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary"><?= e($subtitle ?? 'Lista de Serviços'); ?></h5>
            <a href="<?= route('super.servico.create') ?>" class="btn btn-primary btn-sm float-right"><i
                    class="fas fa-save"></i> Novo Serviço</a>
        </div>
        <div class="card-body">
            <?= \Core\View::render('components.alerts'); ?>
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="d-none">ID</th>
                            <th>Ações</th>
                            <th>Nome</th>
                            <th>Situação</th>
                            <th>Criado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($servicos)): ?>
                            <?php foreach ($servicos as $servico): ?>
                                <tr>
                                    <td class="d-none"><?= e($servico->id ?? ''); ?></td>
                                    <td>
                                        <div class="btn-group dropup">
                                            <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">
                                                Ações
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="<?= route('super.servico.show', ['id' => $servico->id]) ?>">
                                                    Visualizar
                                                </a>
                                                <a class="dropdown-item"
                                                    href="<?= route('super.servico.edit', ['id' => $servico->id]) ?>">
                                                    Editar
                                                </a>
                                                <!-- Botão de Ativar / Desativar -->
                                                <form action="<?= route('super.servico.verstatus', ['id' => $servico->id]) ?>"
                                                    method="POST" style="display: inline;">
                                                    <button type="submit"
                                                        class="dropdown-item <?= ((int)$servico->status === 1) ? 'text-warning' : 'text-success' ?>">
                                                        <?= ((int)$servico->status === 1) ? 'Desativar' : 'Ativar' ?>
                                                    </button>
                                                </form>
                                                <div class="dropdown-divider"></div>
                                                <button type="button" class="dropdown-item text-danger"
                                                    style="border:none;background:none;width:100%;text-align:left;"
                                                    data-toggle="modal" data-target="#deleteModal"
                                                    data-action="<?= route('super.servico.destroy', ['id' => $servico->id]) ?>"
                                                    data-nome="<?= e($servico->nome ?? 'este serviço') ?>"
                                                    data-titulo="Excluir serviço">
                                                    Excluir
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= e($servico->nome ?? ''); ?></td>
                                    <td><span
                                            class="badge <?= e($servico->status ? 'badge-success' : 'badge-secondary') ?> mt-2">
                                            <?= e($servico->status ? 'Ativo' : 'Inativo') ?>
                                        </span></td>
                                    <td><?= e(dateBR($servico->created_at ?? '')); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">
                                    <?= emptyDataMessage() ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<!-- Modal de confirmação de exclusão -->
<?php \Core\View::partial('components.delete-modal'); ?>

<?php View::end(); ?>


<!-- Aqui enviamos para o template principal os scripts -->
<?php View::start('scripts'); ?>
<!-- Page level plugins -->
<script src="<?= url('back/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= url('back/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>

<!-- Page level custom scripts -->
<script src="<?= url('back/js/demo/datatables-demo.js') ?>"></script>
<script>
    $('#deleteModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var action = button.data('action');
        var nome = button.data('nome');

        $('#deleteForm').attr('action', action);
        $('#deleteModalNome').text(nome);
    });
</script>
<?php View::end(); ?>