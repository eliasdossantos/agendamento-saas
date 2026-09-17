<!-- Aqui enviamos para o template principal o título da página -->

<?php View::start('title'); ?>

<?= e($title ?? 'Detalhes da Unidade') ?> | Admin

<?php View::end(); ?>


<!-- Aqui enviamos para o template principal os estilos -->

<?php View::start('styles'); ?>
<?php View::end(); ?>


<!-- Aqui enviamos para o template principal o conteúdo -->

<?php View::start('content'); ?>
<!-- Begin Page Content -->

<div class="container-fluid">

    <?= \Core\View::render('components.alerts'); ?>

    <?php
    $servicosList = [];
    if (!empty($unidades->servicos)) {
        $decoded = json_decode($unidades->servicos, true);
        if (is_array($decoded)) {
            $servicosList = $decoded;
        }
    }

    $intervaloLabel = '—';
    if (!empty($unidades->intervalo_minutos) && isset($intervalos[$unidades->intervalo_minutos])) {
        $intervaloLabel = $intervalos[$unidades->intervalo_minutos];
    }

    $ativo = ($unidades->status ?? 1) == 1;
    ?>

    <!-- Cabeçalho -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div class="d-flex align-items-center" style="gap: 20px;">
                    <?php if (!empty($unidades->imagem)): ?>
                    <img src="<?= url('uploads/unidades/' . e($unidades->imagem)) ?>" alt="Imagem da unidade" style="
                        width: 90px;
                        height: 90px;
                        object-fit: cover;
                        border-radius: 10px;
                        border: 1px solid #ddd;
                    ">
                    <?php else: ?>
                    <div class="d-flex align-items-center justify-content-center text-muted" style="
                        width: 90px;
                        height: 90px;
                        border-radius: 10px;
                        border: 1px dashed #ccc;
                        background: #f8f9fc;
                    ">
                        <i class="fas fa-image fa-2x"></i>
                    </div>
                    <?php endif; ?>

                    <div>
                        <h4 class="m-0 font-weight-bold text-gray-800"><?= e($unidades->nome ?? '—') ?></h4>
                        <div class="text-muted">
                            <i class="fas fa-link mr-1"></i><?= e($unidades->slug ?? '—') ?>
                        </div>
                        <span class="badge <?= $ativo ? 'badge-success' : 'badge-secondary' ?> mt-2">
                            <?= $ativo ? 'Ativo' : 'Inativo' ?>
                        </span>
                    </div>
                </div>

                <div class="mt-3 mt-md-0">
                    <a href="<?= route('unidade.edit', ['id' => $unidades->id]) ?>" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <a href="<?= url('super/unidade') ?>" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Voltar
                    </a>
                </div>
            </div>

            <?php if (!empty($unidades->descricao)): ?>
            <hr>
            <p class="mb-0 text-gray-800"><?= nl2br(e($unidades->descricao)) ?></p>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <!-- Contato -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-address-card mr-1"></i> Contato
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="font-weight-bold text-muted mb-0 small text-uppercase">E-mail</label>
                        <p class="mb-0"><?= e($unidades->email ?? '—') ?></p>
                    </div>
                    <div class="mb-3">
                        <label class="font-weight-bold text-muted mb-0 small text-uppercase">Telefone</label>
                        <p class="mb-0"><?= e($unidades->telefone ?? '—') ?></p>
                    </div>
                    <div class="mb-0">
                        <label class="font-weight-bold text-muted mb-0 small text-uppercase">Coordenador</label>
                        <p class="mb-0"><?= e($unidades->coordenador ?? '—') ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Funcionamento -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-clock mr-1"></i> Funcionamento
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <label class="font-weight-bold text-muted mb-0 small text-uppercase">Início</label>
                            <p class="mb-0"><?= e($unidades->hora_inicio ?? '—') ?></p>
                        </div>
                        <div class="col-4">
                            <label class="font-weight-bold text-muted mb-0 small text-uppercase">Fim</label>
                            <p class="mb-0"><?= e($unidades->hora_fim ?? '—') ?></p>
                        </div>
                        <div class="col-4">
                            <label class="font-weight-bold text-muted mb-0 small text-uppercase">Tempo de
                                Atendimento</label>
                            <p class="mb-0"><?= e($intervaloLabel) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Endereço -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-map-marker-alt mr-1"></i> Endereço
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="font-weight-bold text-muted mb-0 small text-uppercase">Logradouro</label>
                        <p class="mb-0">
                            <?= e($unidades->endereco ?? '—') ?><?= !empty($unidades->numero) ? ', ' . e($unidades->numero) : '' ?>
                            <?= !empty($unidades->complemento) ? ' — ' . e($unidades->complemento) : '' ?>
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="font-weight-bold text-muted mb-0 small text-uppercase">Bairro</label>
                            <p class="mb-0"><?= e($unidades->bairro ?? '—') ?></p>
                        </div>
                        <div class="col-3">
                            <label class="font-weight-bold text-muted mb-0 small text-uppercase">Cidade</label>
                            <p class="mb-0"><?= e($unidades->cidade ?? '—') ?></p>
                        </div>
                        <div class="col-3">
                            <label class="font-weight-bold text-muted mb-0 small text-uppercase">UF</label>
                            <p class="mb-0"><?= e($unidades->estado ?? '—') ?></p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="font-weight-bold text-muted mb-0 small text-uppercase">CEP</label>
                        <p class="mb-0"><?= e($unidades->cep ?? '—') ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Serviços -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-concierge-bell mr-1"></i> Serviços oferecidos
                    </h6>
                </div>
                <div class="card-body">
                    <?php if (!empty($servicosList)): ?>
                    <div class="d-flex flex-wrap" style="gap: 8px;">
                        <?php foreach ($servicosList as $servico): ?>
                        <span class="badge badge-primary" style="font-size:0.9rem;padding:6px 10px;">
                            <?= e($servico) ?>
                        </span>
                        <?php endforeach; ?>
                    </div>
                    <?php else: ?>
                    <p class="text-muted mb-0">Nenhum serviço cadastrado.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- /.container-fluid -->

<?php View::end(); ?>


<!-- Aqui enviamos para o template principal os scripts -->

<?php View::start('scripts'); ?>
<?php View::end(); ?>