<!-- Aqui enviamos para o template principal o conteúdo -->
<?php View::start('title'); ?>
Agendamentos | Admin | <?= e($title ?? '') ?>
<?php View::end(); ?>



<!-- Aqui enviamos para o template principal os estilos -->
<?php View::start('styles'); ?>
<?php View::end(); ?>



<!-- Aqui enviamos para o template principal o conteúdo -->
<?php View::start('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800"><?php echo e($subtitle ?? '') ?></h1>

</div>
<!-- /.container-fluid -->
<?php View::end(); ?>



<!-- Aqui enviamos para o template principal os scripts -->
<?php View::start('scripts'); ?>
<script src="<?= asset('js/demo.js') ?>"></script>
<?php View::end(); ?>