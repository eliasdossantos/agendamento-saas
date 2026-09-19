<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= csrf_token() ?>">
    <title><?= View::section('title') ?: 'Meus Agendamentos' ?></title>
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sticky-footer-navbar/">

    <!-- Bootstrap core CSS -->
    <link href="<?= url('front/css/bootstrap.min.css') ?>" rel="stylesheet">

    <meta name="theme-color" content="#7952b3">

    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
    </style>


    <!-- Custom styles for this template -->
    <link href="<?= url('front/css/sticky-footer-navbar.css') ?>" rel="stylesheet">
    <!-- Essa é a seção de estilos, caso queira adicionar algum estilo específico para uma página, utilize a função View::section('styles') no arquivo da view. -->
    <?= View::section('styles') ?>
</head>

<body class="d-flex flex-column h-100">

    <header>
        <!-- Meus Agendamentos -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= url('/') ?>">Meus Agendamentos</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= url('/') ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <!-- Begin page content -->
    <main class="flex-shrink-0">

        <!-- Essa é a seção de conteúdo, caso queira adicionar algum conteúdo específico para uma página, utilize a função View::section('content') no arquivo da view. -->
        <?= View::section('content') ?>

    </main>


    <script src="<?= url('front/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- Essa é a seção de scripts, caso queira adicionar algum script específico para uma página, utilize a função View::section('scripts') no arquivo da view. -->
    <?= View::section('scripts') ?>

</body>

</html>