<?php

use App\Controllers\HomeController;
use App\Controllers\Super\HomeController as SuperHomeController;
use App\Controllers\Super\ServicosController;
use App\Controllers\Super\UnidadesController;
use App\Controllers\Super\UnidadesServicosController;
use Core\Router;

/** @var Router $router */

// ── Raiz ──────────────────────────────────────────────────────────────────────
// $router->get('/', [HomeController::class, 'index'])->name('home');

// ── Raiz ──────────────────────────────────────────────────────────────────────
$router->get('/', [SuperHomeController::class, 'index']);


// ── Área Super Administrador ────────────────────────────────────────────────

$router->group(['prefix' => '/super', 'as' => 'super.', 'middleware' => ['DevelopmentMiddleware']], function (Router $r) {

    // ── Home do Super Admin ──────────────────────────────────────────────────
    $r->get('', [SuperHomeController::class, 'index'])->name('home');

    // ── Área UNIDADES
    $r->group(['prefix' => '/unidade', 'as' => 'unidade.'], function (Router $r) {

        $r->get('', [UnidadesController::class, 'index'])->name('index');
        $r->get('/create', [UnidadesController::class, 'create'])->name('create');
        $r->post('', [UnidadesController::class, 'store'])->name('store');
        $r->get('/{id}', [UnidadesController::class, 'show'])->name('show');
        $r->get('/{id}/edit', [UnidadesController::class, 'edit'])->name('edit');
        $r->put('/{id}', [UnidadesController::class, 'update'])->name('update');
        $r->delete('/{id}', [UnidadesController::class, 'destroy'])->name('destroy');
        $r->post('/{id}/ver-status', [UnidadesController::class, 'verStatus'])->name('verstatus');

        $r->get('/{unidadeId}/servicos', [UnidadesServicosController::class, 'servicos'])->name('servicos');
        $r->post('/{unidadeId}/servicos', [UnidadesServicosController::class, 'atualizarServicos'])->name('servicos.update');
    });


    // ── Área SERVIÇOS
    $r->group(['prefix' => '/servico', 'as' => 'servico.'], function (Router $r) {

        $r->get('', [ServicosController::class, 'index'])->name('index');
        $r->get('/create', [ServicosController::class, 'create'])->name('create');
        $r->post('', [ServicosController::class, 'store'])->name('store');
        $r->get('/{id}', [ServicosController::class, 'show'])->name('show');
        $r->get('/{id}/edit', [ServicosController::class, 'edit'])->name('edit');
        $r->put('/{id}', [ServicosController::class, 'update'])->name('update');
        $r->delete('/{id}', [ServicosController::class, 'destroy'])->name('destroy');
        $r->post('/{id}/ver-status', [ServicosController::class, 'verStatus'])->name('verstatus');
    });
});
