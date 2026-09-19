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

<h1 class="mt-5">Sticky footer with fixed navbar</h1>
<p class="lead">Pin a footer to the bottom of the viewport in desktop browsers with this custom HTML and
    CSS. A fixed navbar has been added with <code class="small">padding-top: 60px;</code> on the <code
        class="small">main &gt; .container</code>.</p>
<p>Back to <a href="/docs/5.0/examples/sticky-footer/">the default sticky footer</a> minus the navbar.</p>

<?php View::end(); ?>


<!-- Aqui enviamos para o template principal os scripts -->
<?php View::start('scripts'); ?>

<?php View::end(); ?>