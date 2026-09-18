<!-- app/Views/back/servicos/edit.php -->

<!-- Aqui enviamos para o template principal o título da página -->

<?php View::start('title'); ?>

<?= e($title ?? 'Editar Serviços') ?> | Admin

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
        <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
            <div>
                <h4 class="m-0 font-weight-bold text-gray-800"><?= e($title ?? 'Editar Serviço') ?></h4>
            </div>
            <div class="mt-3 mt-md-0">
                <a href="<?= route('super.servico.show', ['id' => $servicos->id]) ?>"
                    class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-eye"></i> Visualizar
                </a>
                <a href="<?= url('super/servico') ?>" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>
            </div>
        </div>
    </div>

    <form method="POST" action="<?= route('super.servico.update', ['id' => $servicos->id]) ?>"
        enctype="multipart/form-data">
        <?= csrf_field() ?>
        <?= method_field('PUT') ?>

        <div class="row">
            <!-- Identificação -->
            <div class="col-lg-12 mb-4">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-info-circle mr-1"></i> Identificação
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control <?= hasError('nome') ? 'is-invalid' : '' ?>"
                                    name="nome" id="nome" value="<?= old('nome', $servicos->nome ?? '') ?>">
                                <?= erroInput('nome') ?>
                            </div>
                        </div>
                        <div class="custom-control custom-checkbox mt-2">
                            <input type="hidden" name="status" value="0">
                            <input class="custom-control-input" type="checkbox" id="status" name="status" value="1"
                                <?= old('status', $servicos->status ?? 1) == 1 ? 'checked' : '' ?>>
                            <label class="custom-control-label" for="status">Status do Registro</label>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Botões -->
        <div class="card shadow mb-4">
            <div class="card-body d-flex align-items-center">
                <button type="submit" class="btn btn-success mr-2">
                    <i class="fas fa-save"></i> Atualizar
                </button>
                <a href="<?= route('super.servico.show', ['id' => $servicos->id]) ?>" class="btn btn-primary mr-2">
                    <i class="fas fa-eye"></i> Visualizar
                </a>
                <a href="<?= url('super/servico') ?>" class="btn btn-danger">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </div>
        </div>

    </form>
</div>

<?php View::end(); ?>


<!-- Aqui enviamos para o template principal os scripts -->

<?php View::start('scripts'); ?>

<script src="<?= url('back/js/mask/app.js') ?>"></script>
<script src="<?= url('back/js/mask/jquery.mask.min.js') ?>"></script>

<?php View::end(); ?>