<?php

/**
 * UnidadeSeeder
 * ─────────────────────────────────────────────────────────────────────────────
 * Popula a tabela `unidades` com dados iniciais.
 *
 * Uso:
 *   php mvc seed:run UnidadeSeeder
 *   — ou —
 *   php database/seeds/UnidadeSeeder.php
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
        // Identificação
        'nome'        => 'Unidade Centro',
        'slug'        => 'unidade-centro',
        'descricao'   => 'Unidade localizada na região central, oferecendo atendimento completo aos usuários.',

        // Contato
        'email'       => 'centro@exemplo.com.br',
        'telefone'    => '(83) 99999-1001',
        'coordenador' => 'Carlos Eduardo Silva',

        // Endereço
        'endereco'    => 'Avenida General Osório',
        'numero'      => '125',
        'complemento' => 'Sala 101',
        'bairro'      => 'Centro',
        'cidade'      => 'João Pessoa',
        'estado'      => 'PB',
        'cep'         => '58010-000',

        // Imagem e serviços
        'imagem'      => 'https://images.unsplash.com/photo-1497366754035-f200968a6e72',
        'servicos'    => '["Atendimento", "Agendamento", "Orientação", "Suporte"]',

        // Configurações de funcionamento
        'hora_inicio'       => '08:00:00',
        'hora_fim'         => '18:00:00',
        'intervalo_minutos' => 30,

        // Status
        'status' => 1,

        // Auditoria
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        // Identificação
        'nome'        => 'Unidade Bancários',
        'slug'        => 'unidade-bancarios',
        'descricao'   => 'Unidade responsável pelo atendimento da região dos Bancários e bairros próximos.',

        // Contato
        'email'       => 'bancarios@exemplo.com.br',
        'telefone'    => '(83) 99999-1002',
        'coordenador' => 'Mariana Alves Costa',

        // Endereço
        'endereco'    => 'Rua Empresário João Rodrigues Alves',
        'numero'      => '450',
        'complemento' => null,
        'bairro'      => 'Bancários',
        'cidade'      => 'João Pessoa',
        'estado'      => 'PB',
        'cep'         => '58051-000',

        // Imagem e serviços
        'imagem'      => 'https://images.unsplash.com/photo-1497366811353-6870744d04b2',
        'servicos'    => '["Atendimento", "Agendamento", "Consultoria"]',

        // Configurações de funcionamento
        'hora_inicio'        => '08:30:00',
        'hora_fim'          => '17:30:00',
        'intervalo_minutos' => 30,

        // Status
        'status' => 1,

        // Auditoria
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        // Identificação
        'nome'        => 'Unidade Mangabeira',
        'slug'        => 'unidade-mangabeira',
        'descricao'   => 'Unidade de atendimento localizada em Mangabeira, com serviços para toda a comunidade da região.',

        // Contato
        'email'       => 'mangabeira@exemplo.com.br',
        'telefone'    => '(83) 99999-1003',
        'coordenador' => 'Rafael Henrique Souza',

        // Endereço
        'endereco'    => 'Avenida Josefa Taveira',
        'numero'      => '850',
        'complemento' => 'Prédio Principal',
        'bairro'      => 'Mangabeira',
        'cidade'      => 'João Pessoa',
        'estado'      => 'PB',
        'cep'         => '58055-000',

        // Imagem e serviços
        'imagem'      => 'https://images.unsplash.com/photo-1497366216548-37526070297c',
        'servicos'    => '["Atendimento", "Agendamento", "Suporte", "Serviços Administrativos"]',

        // Configurações de funcionamento
        'hora_inicio'        => '07:30:00',
        'hora_fim'          => '17:00:00',
        'intervalo_minutos' => 20,

        // Status
        'status' => 1,

        // Auditoria
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        // Identificação
        'nome'        => 'Unidade Torre',
        'slug'        => 'unidade-torre',
        'descricao'   => 'Unidade destinada ao atendimento dos moradores da região da Torre e áreas próximas.',

        // Contato
        'email'       => 'torre@exemplo.com.br',
        'telefone'    => '(83) 99999-1004',
        'coordenador' => 'Juliana Martins Oliveira',

        // Endereço
        'endereco'    => 'Avenida Beira Rio',
        'numero'      => '320',
        'complemento' => null,
        'bairro'      => 'Torre',
        'cidade'      => 'João Pessoa',
        'estado'      => 'PB',
        'cep'         => '58040-000',

        // Imagem e serviços
        'imagem'      => null,
        'servicos'    => '["Atendimento", "Orientação"]',

        // Configurações de funcionamento
        'hora_inicio'        => '08:00:00',
        'hora_fim'          => '16:00:00',
        'intervalo_minutos' => 30,

        // Status
        'status' => 1,

        // Auditoria
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        // Identificação
        'nome'        => 'Unidade Tambaú',
        'slug'        => 'unidade-tambau',
        'descricao'   => 'Unidade localizada na região de Tambaú, com atendimento ao público em horário comercial.',

        // Contato
        'email'       => 'tambau@exemplo.com.br',
        'telefone'    => '(83) 99999-1005',
        'coordenador' => 'Fernando Augusto Lima',

        // Endereço
        'endereco'    => 'Avenida Nossa Senhora dos Navegantes',
        'numero'      => '780',
        'complemento' => 'Loja 02',
        'bairro'      => 'Tambaú',
        'cidade'      => 'João Pessoa',
        'estado'      => 'PB',
        'cep'         => '58039-111',

        // Imagem e serviços
        'imagem'      => 'https://images.unsplash.com/photo-1497366754035-f200968a6e72',
        'servicos'    => '["Atendimento", "Agendamento", "Informações"]',

        // Configurações de funcionamento
        'hora_inicio'        => '09:00:00',
        'hora_fim'          => '18:00:00',
        'intervalo_minutos' => 30,

        // Status
        'status' => 1,

        // Auditoria
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        // Identificação
        'nome'        => 'Unidade Campina Grande',
        'slug'        => 'unidade-campina-grande',
        'descricao'   => 'Unidade regional responsável pelo atendimento dos usuários de Campina Grande e municípios próximos.',

        // Contato
        'email'       => 'campina@exemplo.com.br',
        'telefone'    => '(83) 99999-1006',
        'coordenador' => 'André Luiz Ferreira',

        // Endereço
        'endereco'    => 'Rua Maciel Pinheiro',
        'numero'      => '1120',
        'complemento' => 'Sala 04',
        'bairro'      => 'Centro',
        'cidade'      => 'Campina Grande',
        'estado'      => 'PB',
        'cep'         => '58400-100',

        // Imagem e serviços
        'imagem'      => 'https://images.unsplash.com/photo-1497366754035-f200968a6e72',
        'servicos'    => '["Atendimento", "Agendamento", "Suporte", "Orientação"]',

        // Configurações de funcionamento
        'hora_inicio'        => '08:00:00',
        'hora_fim'          => '18:00:00',
        'intervalo_minutos' => 30,

        // Status
        'status' => 1,

        // Auditoria
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        // Identificação
        'nome'        => 'Unidade Santa Rita',
        'slug'        => 'unidade-santa-rita',
        'descricao'   => 'Unidade de atendimento destinada aos usuários de Santa Rita e região metropolitana.',

        // Contato
        'email'       => 'santarita@exemplo.com.br',
        'telefone'    => '(83) 99999-1007',
        'coordenador' => 'Patrícia Gomes Santos',

        // Endereço
        'endereco'    => 'Rua João Pessoa',
        'numero'      => '215',
        'complemento' => null,
        'bairro'      => 'Centro',
        'cidade'      => 'Santa Rita',
        'estado'      => 'PB',
        'cep'         => '58300-000',

        // Imagem e serviços
        'imagem'      => null,
        'servicos'    => '["Atendimento", "Agendamento", "Serviços Administrativos"]',

        // Configurações de funcionamento
        'hora_inicio'        => '08:00:00',
        'hora_fim'          => '17:00:00',
        'intervalo_minutos' => 30,

        // Status
        'status' => 1,

        // Auditoria
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        // Identificação
        'nome'        => 'Unidade Cabedelo',
        'slug'        => 'unidade-cabedelo',
        'descricao'   => 'Unidade localizada em Cabedelo para atendimento dos usuários da região litorânea.',

        // Contato
        'email'       => 'cabedelo@exemplo.com.br',
        'telefone'    => '(83) 99999-1008',
        'coordenador' => 'Marcelo Antônio Pereira',

        // Endereço
        'endereco'    => 'Rua Duque de Caxias',
        'numero'      => '560',
        'complemento' => 'Sala 02',
        'bairro'      => 'Centro',
        'cidade'      => 'Cabedelo',
        'estado'      => 'PB',
        'cep'         => '58100-000',

        // Imagem e serviços
        'imagem'      => 'https://images.unsplash.com/photo-1497366811353-6870744d04b2',
        'servicos'    => '["Atendimento", "Agendamento", "Orientação", "Suporte"]',

        // Configurações de funcionamento
        'hora_inicio'        => '08:30:00',
        'hora_fim'          => '17:30:00',
        'intervalo_minutos' => 20,

        // Status
        'status' => 1,

        // Auditoria
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        // Identificação
        'nome'        => 'Unidade Recife',
        'slug'        => 'unidade-recife',
        'descricao'   => 'Unidade regional localizada em Recife, oferecendo atendimento aos usuários da capital e região metropolitana.',

        // Contato
        'email'       => 'recife@exemplo.com.br',
        'telefone'    => '(81) 99999-1009',
        'coordenador' => 'Roberto Henrique Almeida',

        // Endereço
        'endereco'    => 'Avenida Conde da Boa Vista',
        'numero'      => '950',
        'complemento' => 'Sala 305',
        'bairro'      => 'Boa Vista',
        'cidade'      => 'Recife',
        'estado'      => 'PE',
        'cep'         => '50060-004',

        // Imagem e serviços
        'imagem'      => 'https://images.unsplash.com/photo-1497366216548-37526070297c',
        'servicos'    => '["Atendimento", "Agendamento", "Consultoria", "Suporte"]',

        // Configurações de funcionamento
        'hora_inicio'        => '08:00:00',
        'hora_fim'          => '18:00:00',
        'intervalo_minutos' => 30,

        // Status
        'status' => 1,

        // Auditoria
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

    [
        // Identificação
        'nome'        => 'Unidade São Paulo',
        'slug'        => 'unidade-sao-paulo',
        'descricao'   => 'Unidade regional localizada em São Paulo para atendimento dos usuários da capital e região metropolitana.',

        // Contato
        'email'       => 'saopaulo@exemplo.com.br',
        'telefone'    => '(11) 99999-1010',
        'coordenador' => 'Ricardo Fernando Mendes',

        // Endereço
        'endereco'    => 'Avenida Paulista',
        'numero'      => '1578',
        'complemento' => 'Conjunto 1204',
        'bairro'      => 'Bela Vista',
        'cidade'      => 'São Paulo',
        'estado'      => 'SP',
        'cep'         => '01310-200',

        // Imagem e serviços
        'imagem'      => null,
        'servicos'    => '["Atendimento", "Agendamento", "Consultoria", "Orientação", "Suporte"]',

        // Configurações de funcionamento
        'hora_inicio'        => '09:00:00',
        'hora_fim'          => '18:00:00',
        'intervalo_minutos' => 15,

        // Status
        'status' => 0,

        // Auditoria
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ],

];

// ── Execução ──────────────────────────────────────────────────────────────────

echo "\n🌱  Seeding tabela `unidades`…\n\n";

$inserted = 0;
$skipped  = 0;

foreach ($records as $record) {
    // Evita duplicatas pelo campo 'name' (ajuste conforme sua tabela)
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM unidades WHERE nome = ?");
    $stmt->execute([$record['nome']]);

    if ((int)$stmt->fetchColumn() > 0) {
        echo "  ⚠  \"{$record['nome']}\" já existe — ignorado.\n";
        $skipped++;
        continue;
    }

    $cols   = implode(', ', array_keys($record));
    $placeh = ':' . implode(', :', array_keys($record));
    $stmt   = $pdo->prepare("INSERT INTO unidades ({$cols}) VALUES ({$placeh})");

    foreach ($record as $k => $v) {
        $stmt->bindValue(":{$k}", $v);
    }

    $stmt->execute();
    echo "  ✓  \"{$record['nome']}\" inserido.\n";
    $inserted++;
}

echo "\n✅  Seed concluído: {$inserted} inseridos, {$skipped} ignorados.\n\n";
