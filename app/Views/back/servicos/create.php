<!-- Aqui enviamos para o template principal o título da página -->

<?php View::start('title'); ?>

<?= e($title ?? 'Novo Servisos') ?> | Admin

<?php View::end(); ?>


<!-- Aqui enviamos para o template principal os estilos -->

<?php View::start('styles'); ?>

<?php View::end(); ?>


<!-- Aqui enviamos para o template principal o conteúdo -->

<?php View::start('content'); ?>

<div class="container-fluid">

    <?= \Core\View::render('components.alerts'); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold text-primary"><?= e($title ?? 'Nova Serviço') ?></h5>
            <a href="<?= url('super/servico') ?>" class="btn btn-primary btn-sm">Voltar</a>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= route("super.servico.store") ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control <?= hasError('nome') ? 'is-invalid' : '' ?>" name="nome"
                            id="nome" value="<?= old('nome') ?>">
                        <?= erroInput('nome') ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="status" name="status" value="1"
                            <?= old('status', 1) == 1 ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="status">Status do Registro</label>
                    </div>
                </div>

                <!-- Botões Salvar e Cancelar um ao lado do outro -->
                <div class="form-group mt-4 d-flex align-items-center">
                    <button type="submit" class="btn btn-success mr-2">Salvar</button>
                    <a href="<?= url('super/servico') ?>" class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php View::end(); ?>


<!-- Aqui enviamos para o template principal os scripts -->

<?php View::start('scripts'); ?>

<?php View::end(); ?>