<!-- Aqui enviamos para o template principal o título da página -->

<?php View::start('title'); ?>

<?= e($title ?? 'Editar Unidades') ?> | Admin

<?php View::end(); ?>


<!-- Aqui enviamos para o template principal os estilos -->

<?php View::start('styles'); ?>
<?php View::end(); ?>


<!-- Aqui enviamos para o template principal o conteúdo -->

<?php View::start('content'); ?>
<!-- Begin Page Content -->

<div class="container-fluid">

    <?= \Core\View::render('components.alerts'); ?>

    <!-- Cabeçalho -->
    <div class="card shadow mb-4">
        <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
            <div>
                <h4 class="m-0 font-weight-bold text-gray-800"><?= e($title ?? 'Editar Unidades') ?></h4>
                <div class="text-muted"><?= e($unidades->nome ?? '') ?></div>
            </div>
            <div class="mt-3 mt-md-0">
                <a href="<?= route('super.unidade.show', ['id' => $unidades->id]) ?>"
                    class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-eye"></i> Visualizar
                </a>
                <a href="<?= url('super/unidade') ?>" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>
            </div>
        </div>
    </div>

    <form method="POST" action="<?= route('super.unidade.update', ['id' => $unidades->id]) ?>"
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
                            <div class="form-group col-md-4">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control <?= hasError('nome') ? 'is-invalid' : '' ?>"
                                    name="nome" id="nome" value="<?= old('nome', $unidades->nome ?? '') ?>">
                                <?= erroInput('nome') ?>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="slug">Slug</label>
                                <input type="text" class="form-control <?= hasError('slug') ? 'is-invalid' : '' ?>"
                                    name="slug" id="slug" value="<?= old('slug', $unidades->slug ?? '') ?>">
                                <?= erroInput('slug') ?>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="descricao">Descrição da Unidade</label>
                                <textarea class="form-control <?= hasError('descricao') ? 'is-invalid' : '' ?>"
                                    name="descricao" id="descricao"
                                    placeholder="Descrição detalhada da unidade"><?= old('descricao', $unidades->descricao ?? '') ?></textarea>
                                <?= erroInput('descricao') ?>
                            </div>
                        </div>
                        <div class="custom-control custom-checkbox mt-2">
                            <input type="hidden" name="status" value="0">
                            <input class="custom-control-input" type="checkbox" id="status" name="status" value="1"
                                <?= old('status', $unidades->status ?? 1) == 1 ? 'checked' : '' ?>>
                            <label class="custom-control-label" for="status">Status do Registro</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contato -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-address-card mr-1"></i> Contato
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control <?= hasError('email') ? 'is-invalid' : '' ?>"
                                name="email" id="email" value="<?= old('email', $unidades->email ?? '') ?>"
                                placeholder="example@email.com">
                            <?= erroInput('email') ?>
                        </div>
                        <div class="form-group">
                            <label for="telefone">Telefone</label>
                            <input type="text"
                                class="form-control <?= hasError('telefone') ? 'is-invalid' : '' ?> phone_with_ddd"
                                name="telefone" id="telefone" value="<?= old('telefone', $unidades->telefone ?? '') ?>"
                                placeholder="(99) 99999-9999">
                            <?= erroInput('telefone') ?>
                        </div>
                        <div class="form-group mb-0">
                            <label for="coordenador">Coordenador</label>
                            <input type="text" class="form-control <?= hasError('coordenador') ? 'is-invalid' : '' ?>"
                                name="coordenador" id="coordenador"
                                value="<?= old('coordenador', $unidades->coordenador ?? '') ?>"
                                placeholder="Nome do coordenador">
                            <?= erroInput('coordenador') ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Funcionamento e Status -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow h-90">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-clock mr-1"></i> Funcionamento
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="hora_inicio">Hora de Início</label>
                                <input type="time"
                                    class="form-control <?= hasError('hora_inicio') ? 'is-invalid' : '' ?>"
                                    name="hora_inicio" id="hora_inicio"
                                    value="<?= old('hora_inicio', $unidades->hora_inicio ?? '') ?>">
                                <?= erroInput('hora_inicio') ?>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="hora_fim">Hora de Fim</label>
                                <input type="time" class="form-control <?= hasError('hora_fim') ? 'is-invalid' : '' ?>"
                                    name="hora_fim" id="hora_fim"
                                    value="<?= old('hora_fim', $unidades->hora_fim ?? '') ?>">
                                <?= erroInput('hora_fim') ?>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="intervalo_minutos">Tempo de Atendimento</label>
                                <select name="intervalo_minutos" id="intervalo_minutos" class="form-control">
                                    <option value="">Selecione...</option>
                                    <?php foreach ($intervalos as $value => $label): ?>
                                        <option value="<?= e($value) ?>"
                                            <?= old('intervalo_minutos', $unidades->intervalo_minutos ?? '') == $value ? 'selected' : '' ?>>
                                            <?= e($label) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?= erroInput('intervalo_minutos') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Endereço -->
            <div class="col-lg-12 mb-4">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-map-marker-alt mr-1"></i> Endereço
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="endereco">Endereço</label>
                                <input type="text" class="form-control <?= hasError('endereco') ? 'is-invalid' : '' ?>"
                                    name="endereco" id="endereco"
                                    value="<?= old('endereco', $unidades->endereco ?? '') ?>"
                                    placeholder="Endereço completo da unidade">
                                <?= erroInput('endereco') ?>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="numero">Número</label>
                                <input type="text" class="form-control <?= hasError('numero') ? 'is-invalid' : '' ?>"
                                    name="numero" id="numero" value="<?= old('numero', $unidades->numero ?? '') ?>"
                                    placeholder="Número">
                                <?= erroInput('numero') ?>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="complemento">Complemento</label>
                                <input type="text"
                                    class="form-control <?= hasError('complemento') ? 'is-invalid' : '' ?>"
                                    name="complemento" id="complemento"
                                    value="<?= old('complemento', $unidades->complemento ?? '') ?>"
                                    placeholder="Complemento">
                                <?= erroInput('complemento') ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="bairro">Bairro</label>
                                <input type="text" class="form-control <?= hasError('bairro') ? 'is-invalid' : '' ?>"
                                    name="bairro" id="bairro" value="<?= old('bairro', $unidades->bairro ?? '') ?>"
                                    placeholder="Bairro">
                                <?= erroInput('bairro') ?>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="cidade">Cidade</label>
                                <input type="text" class="form-control <?= hasError('cidade') ? 'is-invalid' : '' ?>"
                                    name="cidade" id="cidade" value="<?= old('cidade', $unidades->cidade ?? '') ?>"
                                    placeholder="Cidade">
                                <?= erroInput('cidade') ?>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="estado">Estado</label>
                                <input type="text" class="form-control <?= hasError('estado') ? 'is-invalid' : '' ?>"
                                    name="estado" id="estado" value="<?= old('estado', $unidades->estado ?? '') ?>"
                                    placeholder="Estado">
                                <?= erroInput('estado') ?>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="cep">CEP</label>
                                <input type="text" class="form-control <?= hasError('cep') ? 'is-invalid' : '' ?>"
                                    name="cep" id="cep" value="<?= old('cep', $unidades->cep ?? '') ?>"
                                    placeholder="CEP">
                                <?= erroInput('cep') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Imagem -->
            <div class="col-lg-5 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-image mr-1"></i> Imagem
                        </h6>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($unidades->imagem)): ?>
                            <div class="mb-3 d-flex align-items-center" style="gap: 10px;">
                                <img id="imagem-preview" src="<?= url('uploads/unidades/' . e($unidades->imagem)) ?>"
                                    alt="Imagem da unidade" style="
                                width: 90px;
                                height: 90px;
                                object-fit: cover;
                                border-radius: 8px;
                                border: 1px solid #ddd;
                            ">
                                <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                    data-target="#imagemModal" title="Visualizar imagem">
                                    <i class="fas fa-eye"></i>
                                    Visualizar
                                </button>
                            </div>
                        <?php else: ?>
                            <div class="mb-3">
                                <div class="text-muted small">
                                    Nenhuma imagem cadastrada.
                                </div>
                            </div>
                        <?php endif; ?>

                        <img id="imagem-preview-nova" src="" alt="Pré-visualização da nova imagem" style="
                            display: none;
                            width: 150px;
                            height: 150px;
                            object-fit: cover;
                            border-radius: 8px;
                            border: 1px solid #ddd;
                            margin-bottom: 10px;
                        ">

                        <input type="file" accept="image/*"
                            class="form-control <?= hasError('imagem') ? 'is-invalid' : '' ?>" name="imagem"
                            id="imagem">

                        <?= erroInput('imagem', 'd-block') ?>

                        <small class="form-text text-muted">
                            Deixe em branco para manter a imagem atual.
                        </small>
                    </div>
                </div>
            </div>

            <!-- Serviços -->
            <div class="col-lg-7 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-concierge-bell mr-1"></i> Serviços oferecidos
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="form-control <?= hasError('servicos') ? 'is-invalid' : '' ?> d-flex flex-wrap align-items-center gap-2"
                            id="servicos-container" style="min-height: 45px; height: auto;">

                            <div id="servicos-tags" class="d-flex flex-wrap" style="gap: 10px;"></div>

                            <div class="d-flex flex-grow-1" style="min-width: 200px; gap: 6px;">
                                <input type="text" id="servicos-input" class="border-0 flex-grow-1" enterkeyhint="done"
                                    placeholder="Digite um serviço" style="outline: none; min-width: 120px;">
                                <button type="button" id="servicos-add-btn" class="btn btn-sm btn-primary"
                                    style="white-space: nowrap;">
                                    + Adicionar
                                </button>
                            </div>
                        </div>

                        <input type="hidden" name="servicos" id="servicos"
                            value="<?= old('servicos', $unidades->servicos ?? '[]') ?>">

                        <?= erroInput('servicos') ?>

                        <small class="form-text text-muted">
                            Digite o serviço e toque em "Adicionar" (ou pressione Enter no computador).
                        </small>
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
                <a href="<?= route('super.unidade.show', ['id' => $unidades->id]) ?>" class="btn btn-primary mr-2">
                    <i class="fas fa-eye"></i> Visualizar
                </a>
                <a href="<?= url('super/unidade') ?>" class="btn btn-danger">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </div>
        </div>

    </form>
</div>

<!-- /.container-fluid -->
<?php if (!empty($unidades->imagem)): ?>
    <div class="modal fade" id="imagemModal" tabindex="-1" role="dialog" aria-labelledby="imagemModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imagemModalLabel">
                        Imagem da unidade
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img src="<?= url('uploads/unidades/' . e($unidades->imagem)) ?>" alt="Imagem da unidade"
                        class="img-fluid" style="
                        max-height: 70vh;
                        object-fit: contain;
                        border-radius: 8px;
                    ">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Fechar
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php View::end(); ?>


<!-- Aqui enviamos para o template principal os scripts -->

<?php View::start('scripts'); ?>

<!-- Scripts específicos para máscaras -->
<script src="<?= url('back/js/mask/app.js') ?>"></script>
<script src="<?= url('back/js/mask/jquery.mask.min.js') ?>"></script>

<script>
    (function() {
        // ── Tags de "Serviços oferecidos" ───────────────────────────────────────
        var tagsWrap = document.getElementById('servicos-tags');
        var input = document.getElementById('servicos-input');
        var hidden = document.getElementById('servicos');
        var addBtn = document.getElementById('servicos-add-btn');

        var servicos = [];
        try {
            servicos = JSON.parse(hidden.value || '[]');
            if (!Array.isArray(servicos)) servicos = [];
        } catch (e) {
            servicos = [];
        }

        function sync() {
            hidden.value = JSON.stringify(servicos);
        }

        function renderTags() {
            tagsWrap.innerHTML = '';
            servicos.forEach(function(servico, index) {
                var tag = document.createElement('span');
                tag.className = 'badge badge-primary d-flex align-items-center';
                tag.style.cssText = 'font-size:0.9rem;padding:6px 10px;gap:6px;';

                var text = document.createElement('span');
                text.textContent = servico;

                var remove = document.createElement('button');
                remove.type = 'button';
                remove.innerHTML = '&times;';
                remove.setAttribute('aria-label', 'Remover ' + servico);
                remove.style.cssText =
                    'background:none;border:none;color:#fff;font-weight:bold;cursor:pointer;line-height:1;padding:0;';
                remove.addEventListener('click', function() {
                    servicos.splice(index, 1);
                    sync();
                    renderTags();
                });

                tag.appendChild(text);
                tag.appendChild(remove);
                tagsWrap.appendChild(tag);
            });
        }

        function addServico(value) {
            var trimmed = (value || '').trim();
            if (!trimmed || servicos.indexOf(trimmed) !== -1) {
                input.value = '';
                return;
            }
            servicos.push(trimmed);
            sync();
            renderTags();
            input.value = '';
        }

        addBtn.addEventListener('click', function() {
            addServico(input.value);
            input.focus();
        });

        input.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ',') {
                e.preventDefault();
                addServico(input.value);
            } else if (e.key === 'Backspace' && input.value === '' && servicos.length > 0) {
                servicos.pop();
                sync();
                renderTags();
            }
        });

        input.addEventListener('blur', function() {
            if (input.value.trim() !== '') addServico(input.value);
        });

        renderTags();

        // ── Preview da imagem selecionada ───────────────────────────────────────
        var fileInput = document.getElementById('imagem');
        var previewNova = document.getElementById('imagem-preview-nova');

        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                var file = e.target.files[0];
                if (!file) {
                    previewNova.src = '';
                    previewNova.style.display = 'none';
                    return;
                }
                if (!file.type.startsWith('image/')) {
                    previewNova.src = '';
                    previewNova.style.display = 'none';
                    return;
                }
                var reader = new FileReader();
                reader.onload = function(ev) {
                    previewNova.src = ev.target.result;
                    previewNova.style.display = 'block';
                };
                reader.readAsDataURL(file);
            });
        }
    })();
</script>

<?php View::end(); ?>