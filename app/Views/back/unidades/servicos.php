<!-- Aqui enviamos para o template principal o título da página -->
<?php View::start('title'); ?>
<?= e($title ?? 'Serviços da Unidade') ?> | Admin
<?php View::end(); ?>


<!-- Aqui enviamos para o template principal o conteúdo -->
<?php View::start('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold text-primary">
                Serviços de <?= e($unidade->nome ?? '') ?>
            </h5>
            <a href="<?= route('super.unidade.index') ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>
        <div class="card-body">
            <?= \Core\View::render('components.alerts'); ?>

            <form action="<?= route('super.unidade.servicos.update', ['unidadeId' => $unidade->id]) ?>" method="POST">

                <!-- Ações em massa -->
                <div class="mb-3">
                    <button type="button" id="btnMarcarTodos" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-check-square"></i> Marcar Todos
                    </button>
                    <button type="button" id="btnDesmarcarTodos" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-square"></i> Desmarcar Todos
                    </button>
                </div>

                <div class="row">
                    <?php if (!empty($servicos)): ?>
                        <?php foreach ($servicos as $servico): ?>
                            <div class="col-md-4 mb-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input servico-checkbox"
                                        id="servico_<?= e($servico->id) ?>" name="servicos[]" value="<?= e($servico->id) ?>"
                                        <?= in_array($servico->id, $servicoIdsAtivos ?? []) ? 'checked' : '' ?>>
                                    <label class="custom-control-label" for="servico_<?= e($servico->id) ?>">
                                        <?= e($servico->nome ?? '') ?>
                                    </label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <?= emptyDataMessage() ?>
                        </div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-success mt-3">
                    <i class="fas fa-save"></i> Salvar Serviços
                </button>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<?php View::end(); ?>


<!-- Aqui enviamos para o template principal os scripts -->
<?php View::start('scripts'); ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.servico-checkbox');
        // Marcar todos os serviços
        document.getElementById('btnMarcarTodos').addEventListener('click', function() {
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = true;
            });
        });

        // Desmarcar todos os serviços
        document.getElementById('btnDesmarcarTodos').addEventListener('click', function() {
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });
        });
    });
</script>

<?php View::end(); ?>