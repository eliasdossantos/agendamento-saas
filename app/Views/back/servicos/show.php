<!-- app/Views/back/servicos/show.php -->

<!-- Aqui enviamos para o template principal o título da página -->

<?php View::start('title'); ?>

<?= e($title ?? 'Detalhes') ?> | Admin

<?php View::end(); ?>


<!-- Aqui enviamos para o template principal os estilos -->

<?php View::start('styles'); ?>

<?php View::end(); ?>


<!-- Aqui enviamos para o template principal o conteúdo -->

<?php View::start('content'); ?>

<div class="container-fluid">

    <?= \Core\View::render('components.alerts'); ?>

    <!-- Cabeçalho -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div class="d-flex align-items-center" style="gap: 20px;">
                    <div>
                        <h4 class="m-0 font-weight-bold text-gray-800"><?= e($title ?? '—') ?></h4>
                    </div>
                </div>

                <div class="mt-3 mt-md-0">
                    <a href="<?= route('servico.edit', ['id' => $servicos->id]) ?>" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <a href="<?= url('super/servico') ?>" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Voltar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Serviço -->
        <div class="col-lg-12 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-address-card mr-1"></i> Serviço
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="font-weight-bold text-muted mb-0 small text-uppercase">Nome: </label>
                        <p class="mb-0"><?= e($servicos->nome ?? '—') ?></p>
                    </div>

                    <div class="mb-3">
                        <label class="font-weight-bold text-muted mb-0 small text-uppercase">Status do Serviço: </label>
                        <?php
                        $ativo = ($servicos->status ?? 1) == 1;
                        ?>
                        <p class="mb-0"><span class="badge <?= $ativo ? 'badge-success' : 'badge-secondary' ?> mt-2">
                                <?= $ativo ? 'Ativo' : 'Inativo' ?>
                            </span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php View::end(); ?>


<!-- Aqui enviamos para o template principal os scripts -->

<?php View::start('scripts'); ?>

<script src="<?= asset('js/demo.js') ?>"></script>

<?php View::end(); ?>