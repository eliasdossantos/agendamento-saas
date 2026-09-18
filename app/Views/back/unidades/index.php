<!-- Aqui enviamos para o template principal o título da página -->
<?php View::start('title'); ?>
<?= e($title ?? 'Unidades') ?> | Admin
<?php View::end(); ?>


<!-- Aqui enviamos para o template principal os estilos -->
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
            <h5 class="m-0 font-weight-bold text-primary"><?= e($subtitle ?? 'Lista de Unidades'); ?></h5>
            <a href="<?= route('super.unidade.create') ?>" class="btn btn-primary btn-sm float-right"><i
                    class="fas fa-save"></i> Nova Unidade</a>
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
                            <th>Serviços</th>
                            <th>E-mail</th>
                            <th>Celular</th>
                            <th>Status</th>
                            <th>Início</th>
                            <th>Fim</th>
                            <th>Criado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($unidades)): ?>
                            <?php foreach ($unidades as $unidade): ?>
                                <?php $nomesServicos = $servicosPorUnidade[$unidade->id] ?? []; ?>
                                <tr>
                                    <td class="d-none"><?= e($unidade->id ?? ''); ?></td>
                                    <td>
                                        <div class="btn-group dropup">
                                            <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">
                                                Ações
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="<?= route('super.unidade.servicos', ['unidadeId' => $unidade->id]) ?>">
                                                    Serviços
                                                </a>
                                                <a class="dropdown-item"
                                                    href="<?= route('super.unidade.show', ['id' => $unidade->id]) ?>">
                                                    Visualizar
                                                </a>
                                                <a class="dropdown-item"
                                                    href="<?= route('super.unidade.edit', ['id' => $unidade->id]) ?>">
                                                    Editar
                                                </a>
                                                <!-- Botão de Ativar / Desativar -->
                                                <form action="<?= route('super.unidade.verstatus', ['id' => $unidade->id]) ?>"
                                                    method="POST" style="display: inline;">
                                                    <button type="submit"
                                                        class="dropdown-item <?= ((int)$unidade->status === 1) ? 'text-warning' : 'text-success' ?>">
                                                        <?= ((int)$unidade->status === 1) ? 'Desativar' : 'Ativar' ?>
                                                    </button>
                                                </form>
                                                <div class="dropdown-divider"></div>
                                                <button type="button" class="dropdown-item text-danger"
                                                    style="border:none;background:none;width:100%;text-align:left;"
                                                    data-toggle="modal" data-target="#deleteModal"
                                                    data-action="<?= route('super.unidade.destroy', ['id' => $unidade->id]) ?>"
                                                    data-nome="<?= e($unidade->nome ?? 'este usuário') ?>"
                                                    data-titulo="Excluir usuário">
                                                    Excluir
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= e($unidade->nome ?? ''); ?></td>
                                    <td>
                                        <?php if (!empty($nomesServicos)): ?>
                                            <button type="button" class="btn btn-link p-0" data-toggle="modal"
                                                data-target="#servicosModal" data-nome="<?= e($unidade->nome ?? '') ?>"
                                                data-servicos='<?= e(json_encode($nomesServicos)) ?>'>
                                                <span class="badge badge-info">
                                                    <?= count($nomesServicos) ?>
                                                    serviço<?= count($nomesServicos) > 1 ? 's' : '' ?>
                                                </span>
                                            </button>
                                        <?php else: ?>
                                            <span class="text-muted">—</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= e($unidade->email ?? ''); ?></td>
                                    <td><?= e($unidade->telefone ?? ''); ?></td>
                                    <td><span
                                            class="badge <?= e($unidade->status ? 'badge-success' : 'badge-secondary') ?> mt-2">
                                            <?= e($unidade->status ? 'Ativo' : 'Inativo') ?>
                                        </span></td>
                                    <td><?= e($unidade->hora_inicio ?? ''); ?></td>
                                    <td><?= e($unidade->hora_fim ?? ''); ?></td>
                                    <td><?= e(dateBR($unidade->created_at ?? '')); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center">
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
<?= \Core\View::render('components.delete-modal'); ?>

<!-- Modal de Serviços da Unidade -->
<?= \Core\View::render('components.servicos-modal'); ?>

<?php View::end(); ?>


<!-- Aqui enviamos para o template principal os scripts -->
<?php View::start('scripts'); ?>
<!-- Page level plugins -->
<script src="<?= url('back/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= url('back/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>

<!-- Page level custom scripts -->
<script src="<?= url('back/js/demo/datatables-demo.js') ?>"></script>

<?php View::end(); ?>