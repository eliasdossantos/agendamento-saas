<!-- Aqui enviamos para o template principal o título da página -->

<?php View::start('title'); ?>

<?= e($title ?? 'Nova Unidade') ?> | Admin

<?php View::end(); ?>


<!-- Aqui enviamos para o template principal os estilos -->

<?php View::start('styles'); ?>
<?php View::end(); ?>


<!-- Aqui enviamos para o template principal o conteúdo -->

<?php View::start('content'); ?>
<!-- Begin Page Content -->

<div class="container-fluid">

    <?= \Core\View::render('components.alerts'); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold text-primary"><?= e($title ?? 'Nova Unidade') ?></h5>
            <a href="<?= url('super/unidade') ?>" class="btn btn-primary btn-sm">Voltar</a>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= route("unidade.store") ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control <?= hasError('nome') ? 'is-invalid' : '' ?>" name="nome"
                            id="nome" value="<?= old('nome') ?>">
                        <?= erroInput('nome') ?>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control <?= hasError('slug') ? 'is-invalid' : '' ?>" name="slug"
                            id="slug" value="<?= old('slug') ?>">
                        <?= erroInput('slug') ?>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="descricao">Descrição da Unidade</label>
                        <textarea class="form-control <?= hasError('descricao') ? 'is-invalid' : '' ?>" name="descricao"
                            id="descricao"
                            placeholder="Descrição detalhada da unidade"><?= old('descricao') ?></textarea>
                        <?= erroInput('descricao') ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control <?= hasError('email') ? 'is-invalid' : '' ?>"
                            name="email" id="email" value="<?= old('email') ?>" placeholder="example@email.com">
                        <?= erroInput('email') ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="telefone">Telefone</label>
                        <input type="text"
                            class="form-control <?= hasError('telefone') ? 'is-invalid' : '' ?> phone_with_ddd"
                            name="telefone" id="telefone" value="<?= old('telefone') ?>" placeholder="(99) 99999-9999">
                        <?= erroInput('telefone') ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="coordenador">Coordenador</label>
                        <input type="text" class="form-control <?= hasError('coordenador') ? 'is-invalid' : '' ?>"
                            name="coordenador" id="coordenador" value="<?= old('coordenador') ?>"
                            placeholder="Nome do coordenador">
                        <?= erroInput('coordenador') ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="endereco">Endereço</label>
                        <input type="text" class="form-control <?= hasError('endereco') ? 'is-invalid' : '' ?>"
                            name="endereco" id="endereco" value="<?= old('endereco') ?>"
                            placeholder="Endereço completo da unidade">
                        <?= erroInput('endereco') ?>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="numero">Número</label>
                        <input type="text" class="form-control <?= hasError('numero') ? 'is-invalid' : '' ?>"
                            name="numero" id="numero" value="<?= old('numero') ?>" placeholder="Número">
                        <?= erroInput('numero') ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="complemento">Complemento</label>
                        <input type="text" class="form-control <?= hasError('complemento') ? 'is-invalid' : '' ?>"
                            name="complemento" id="complemento" value="<?= old('complemento') ?>"
                            placeholder="Complemento">
                        <?= erroInput('complemento') ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="bairro">Bairro</label>
                        <input type="text" class="form-control <?= hasError('bairro') ? 'is-invalid' : '' ?>"
                            name="bairro" id="bairro" value="<?= old('bairro') ?>" placeholder="Bairro">
                        <?= erroInput('bairro') ?>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="cidade">Cidade</label>
                        <input type="text" class="form-control <?= hasError('cidade') ? 'is-invalid' : '' ?>"
                            name="cidade" id="cidade" value="<?= old('cidade') ?>" placeholder="Cidade">
                        <?= erroInput('cidade') ?>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="estado">Estado</label>
                        <input type="text" class="form-control <?= hasError('estado') ? 'is-invalid' : '' ?>"
                            name="estado" id="estado" value="<?= old('estado') ?>" placeholder="Estado">
                        <?= erroInput('estado') ?>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="cep">CEP</label>
                        <input type="text" class="form-control <?= hasError('cep') ? 'is-invalid' : '' ?>" name="cep"
                            id="cep" value="<?= old('cep') ?>" placeholder="CEP">
                        <?= erroInput('cep') ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="imagem">Imagem</label>

                        <!-- Preview da imagem selecionada -->
                        <img id="imagem-preview-nova" src="" alt="Pré-visualização da imagem" style="
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
                            Selecione uma imagem para a unidade (opcional).
                        </small>
                    </div>
                    <div class="form-group col-md-7">
                        <label for="servicos-input">Serviços oferecidos</label>

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

                        <input type="hidden" name="servicos" id="servicos" value="<?= old('servicos', '[]') ?>">

                        <?= erroInput('servicos') ?>

                        <small class="form-text text-muted">
                            Digite o serviço e toque em "Adicionar" (ou pressione Enter no computador).
                        </small>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="hora_inicio">Hora de Início</label>
                        <input type="time" class="form-control <?= hasError('hora_inicio') ? 'is-invalid' : '' ?>"
                            name="hora_inicio" id="hora_inicio" value="<?= old('hora_inicio') ?>">
                        <?= erroInput('hora_inicio') ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="intervalo_minutos">Tempo de Atendimento</label>
                        <select name="intervalo_minutos" id="intervalo_minutos" class="form-control">
                            <option value="">Selecione...</option>

                            <?php foreach ($intervalos as $value => $label): ?>
                                <option value="<?= e($value) ?>"
                                    <?= old('intervalo_minutos') == $value ? 'selected' : '' ?>>
                                    <?= e($label) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?= erroInput('intervalo_minutos') ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="hora_fim">Hora de Fim</label>
                        <input type="time" class="form-control <?= hasError('hora_fim') ? 'is-invalid' : '' ?>"
                            name="hora_fim" id="hora_fim" value="<?= old('hora_fim') ?>">
                        <?= erroInput('hora_fim') ?>
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
                    <a href="<?= url('super/unidade') ?>" class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- /.container-fluid -->

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