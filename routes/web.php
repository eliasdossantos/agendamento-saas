<?php

use App\Controllers\HomeController;
use App\Controllers\Super\HomeController as SuperHomeController;
use App\Controllers\Super\UnidadesController;
use Core\Router;

/** @var Router $router */

// ── Raiz ──────────────────────────────────────────────────────────────────────
// $router->get('/', [HomeController::class, 'index'])->name('home');

// ── Raiz ──────────────────────────────────────────────────────────────────────
$router->get('/', [SuperHomeController::class, 'index']);


// ── Área Super Administrador ────────────────────────────────────────────────

$router->group(['prefix' => '/super', 'as' => 'super.', 'middleware' => ['DevelopmentMiddleware']], function (Router $r) {

    // Home
    $r->get('', [SuperHomeController::class, 'index'])->name('super.home');

    // Unidades
    $r->get('/unidade', [UnidadesController::class, 'index'])->name('unidade.index');
    $r->get('/unidade/create', [UnidadesController::class, 'create'])->name('unidade.create');
    $r->post('/unidade', [UnidadesController::class, 'store'])->name('unidade.store');
    $r->get('/unidade/{id}', [UnidadesController::class, 'show'])->name('unidade.show');
    $r->get('/unidade/{id}/edit', [UnidadesController::class, 'edit'])->name('unidade.edit');
    $r->put('/unidade/{id}', [UnidadesController::class, 'update'])->name('unidade.update');
    $r->delete('/unidade/{id}', [UnidadesController::class, 'destroy'])->name('unidade.destroy');

    // Ver Status (Ativar/Desativar)
    $r->post('/unidade/{id}/ver-status', [UnidadesController::class, 'verStatus'])->name('unidade.verstatus');
});
