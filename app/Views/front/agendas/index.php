<!-- app/Views/back/servicos/index.php -->

<!-- Aqui enviamos para o template principal o título da página -->

<?php View::start('title'); ?>

<?= e($title ?? 'Criar Agendamento') ?> | Agendamento

<?php View::end(); ?>


<!-- Aqui enviamos para o template principal os estilos -->
<?php View::start('styles'); ?>

<?php View::end(); ?>


<!-- Aqui enviamos para o template principal o conteúdo -->
<?php View::start('content'); ?>

<div class="container">

    <h1 class="mt-5"><?= e($title ?? '') ?></h1>

    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <!-- Unidade -->
                <div class="col-md-12 mb-4">
                    <p class="lead">
                        Escolha uma Unidade
                    </p>
                    <?= $unidades ?>
                </div>

                <!-- Serviços da Unidade -->
                <div id="mainBoxServicos" class="col-md-12 d-none mb-4">
                    <p class="lead">Escolha o Serviço</p>
                    <div id="boxServicos">

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-2 ms-auto">
            <p class="lead mt-4">Unidade escolhida: <br><span id="chosenUnidadeText" class="text-muted small"></span>
            <p class="lead">Serviço escolhido: <br><span id="chosenServicoText" class="text-muted small"></span>
            <p class="lead">Mês escolhido: <br><span id="chosenMonthText" class="text-muted small"></span>
            <p class="lead">Dia escolhido: <br><span id="chosenDayText" class="text-muted small"></span>
            <p class="lead">Horário escolhido: <br><span id="chosenHourText" class="text-muted small"></span>
            </p>
        </div>
    </div>

</div>

<?php View::end(); ?>


<!-- Aqui enviamos para o template principal os scripts -->
<?php View::start('scripts'); ?>

<script>
    const URL_GET_SERVICOS = '<?= route('agenda.get.unidade.servicos') ?>';

    const mainBoxServicos = document.getElementById('mainBoxServicos');
    const chosenUnidadeText = document.getElementById('chosenUnidadeText');
    const chosenServicoText = document.getElementById('chosenServicoText');
    const chosenMonthText = document.getElementById('chosenMonthText');
    const chosenDayText = document.getElementById('chosenDayText');
    const chosenHourText = document.getElementById('chosenHourText');


    // variáveis de escopo global que ultilizaremos na criação do agendamento
    let unidadeId = null;
    let servicoId = null;
    let chosenMonth = null;
    let chosenDay = null;
    let chosenHour = null;

    const unidades = document.getElementsByName('unidade_id');

    unidades.forEach(element => {
        element.addEventListener('click', (event) => {

            mainBoxServicos.classList.remove('d-none');

            unidadeId = element.value;

            if (!unidadeId) {
                alert('Erro ao determinar a Unidade escolhida');
                return;
            }

            chosenUnidadeText.innerText = element.getAttribute('data-unidade');
            chosenServicoText.innerText = '';
            chosenMonthText.innerText = '';
            chosenDayText.innerText = '';
            chosenHourText.innerText = '';

            getServicos();

        });
    });

    const getServicos = async () => {

        let url = URL_GET_SERVICOS + '?' + setParameters({
            unidadeId: unidadeId
        });

        console.log(url);

    };

    const setParameters = (object) => {
        return (new URLSearchParams(object)).toString();
    };
</script>
<?php View::end(); ?>