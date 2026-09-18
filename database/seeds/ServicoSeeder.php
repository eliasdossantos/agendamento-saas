<?php

/**
 * ServicoSeeder
 * ─────────────────────────────────────────────────────────────────────────────
 * Popula a tabela `servicos` com dados iniciais.
 *
 * Uso:
 *   php mvc seed:run ServicoSeeder
 *   — ou —
 *   php database/seeds/ServicoSeeder.php
 */

// Bootstrap mínimo (sem precisar do framework completo)
define('ROOT_PATH',    dirname(__DIR__, 2));
define('CONFIG_PATH',  ROOT_PATH . '/config');
define('STORAGE_PATH', ROOT_PATH . '/storage');

// Carrega .env manualmente
$envFile = ROOT_PATH . '/.env';
if (file_exists($envFile)) {
    foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#')) continue;
        if (!str_contains($line, '=')) continue;
        [$k, $v] = array_map('trim', explode('=', $line, 2));
        $_ENV[$k] = $v;
        putenv("{$k}={$v}");
    }
}

$config = require CONFIG_PATH . '/database.php';
$conn   = $config['connections'][$config['default']];

$dsn = sprintf(
    'mysql:host=%s;port=%s;dbname=%s;charset=%s',
    $conn['host'],
    $conn['port'],
    $conn['database'],
    $conn['charset']
);

try {
    $pdo = new PDO($dsn, $conn['username'], $conn['password'], [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    ]);
} catch (PDOException $e) {
    die("❌  Conexão falhou: " . $e->getMessage() . "\n");
}

// ── Dados para inserir ────────────────────────────────────────────────────────

$records = [

    [
        'nome'       => 'Corte de Cabelo',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Corte Masculino',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Corte Feminino',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Corte Infantil',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Barba Tradicional',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Barba Modelada',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Barba Completa',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Corte + Barba',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Sobrancelha',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Sobrancelha na Navalha',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Hidratação Capilar',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Escova',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Progressiva',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Coloração',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Luzes',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Platinado',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Lavagem Capilar',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Penteado',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Depilação Facial',
        'status'     => 0,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Relaxamento Capilar',
        'status'     => 0,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Corte Degradê',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Corte Social',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Corte Navalhado',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Corte Americano',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Corte Mullet',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Corte Black Power',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Corte Moicano',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Barba Express',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Barba com Toalha Quente',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Barba Desenhada',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Bigode',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Bigode Modelado',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Camuflagem de Barba',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Camuflagem de Cabelos Brancos',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Pigmentação Capilar',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Descoloração Capilar',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Tratamento Anti-Frizz',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Reconstrução Capilar',
        'status'     => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Massagem Capilar',
        'status'     => 0,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        'nome'       => 'Detox Capilar',
        'status'     => 0,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

];

// ── Execução ──────────────────────────────────────────────────────────────────

echo "\n🌱  Seeding tabela `servicos`…\n\n";

$inserted = 0;
$skipped  = 0;

foreach ($records as $record) {
    // Evita duplicatas pelo campo 'name' (ajuste conforme sua tabela)
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM servicos WHERE nome = ?");
    $stmt->execute([$record['nome']]);

    if ((int)$stmt->fetchColumn() > 0) {
        echo "  ⚠  \"{$record['nome']}\" já existe — ignorado.\n";
        $skipped++;
        continue;
    }

    $cols   = implode(', ', array_keys($record));
    $placeh = ':' . implode(', :', array_keys($record));
    $stmt   = $pdo->prepare("INSERT INTO servicos ({$cols}) VALUES ({$placeh})");

    foreach ($record as $k => $v) {
        $stmt->bindValue(":{$k}", $v);
    }

    $stmt->execute();
    echo "  ✓  \"{$record['nome']}\" inserido.\n";
    $inserted++;
}

echo "\n✅  Seed concluído: {$inserted} inseridos, {$skipped} ignorados.\n\n";
