<!-- app/Views/back/servicos/index.php -->

<!-- Aqui enviamos para o template principal o título da página -->

<?php View::start('title'); ?>

<?= e($title ?? 'Meus Agendamentos') ?> | Home

<?php View::end(); ?>


<!-- Aqui enviamos para o template principal os estilos -->
<?php View::start('styles'); ?>

<?php View::end(); ?>


<!-- Aqui enviamos para o template principal o conteúdo -->
<?php View::start('content'); ?>

<div class="container pt-5 text-center">

    <h1 class="mt-5">Veja como é fácil criar o seu agendamento</h1>

    <div class="row mt-4">

        <div class="col">
            <div class="card">
                <div class="card-header">
                    Primeiro
                </div>
                <div class="card-body">
                    <h5 class="card-title">Autentique-se</h5>
                    <p class="card-text">Realize o login ou crie sua conta</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Segundo
                </div>
                <div class="card-body">
                    <h5 class="card-title">Escolha a Unidade</h5>
                    <p class="card-text">Onde você gostaria de ser atendido</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Terceiro
                </div>
                <div class="card-body">
                    <h5 class="card-title">Escolha o Serviço</h5>
                    <p class="card-text">O serviço que você deseja atendimento</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Quarto
                </div>
                <div class="card-body">
                    <h5 class="card-title">Escolha a Data</h5>
                    <p class="card-text">Escolha a melhor data e horário</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Pronto
                </div>
                <div class="card-body">
                    <h5 class="card-title">Confirmação</h5>
                    <p class="card-text">Revise os dados e crie o agendamento</p>
                </div>
            </div>
        </div>

    </div>

    <div class="row mt-4">
        <div class="col-m-12">
            <a href="<?= route('agenda.index') ?>" class="btn btn-lg btn-primary mt-2">Criar Agendamento</a>
        </div>
    </div>

</div>

<?php View::end(); ?>


<!-- Aqui enviamos para o template principal os scripts -->
<?php View::start('scripts'); ?>

<?php View::end(); ?>