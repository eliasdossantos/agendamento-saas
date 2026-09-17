# Sistema de Agendamento Online

> SaaS de agendamento online multi-unidade, construído em PHP puro sobre o [php-mvc](https://github.com/eliasdossantos/php-mvc).

[![PHP](https://img.shields.io/badge/PHP-8.1%2B-777bb4?logo=php)](https://php.net)

---

## Sobre o Projeto

O **Sistema de Agendamento Online** é uma aplicação SaaS que permite que uma empresa cadastre suas **unidades** (filiais, lojas, consultórios etc.), cada uma com seu próprio horário de funcionamento, intervalo entre atendimentos e lista de serviços oferecidos — para que clientes possam marcar horários com essas unidades.

O projeto é construído sobre a base **[php-mvc](https://github.com/eliasdossantos/php-mvc)**, um boilerplate MVC em PHP puro (sem framework pesado) que já resolve a parte estrutural — roteamento, autenticação, validação, banco de dados, migrations, middlewares etc. Este README documenta apenas as regras de negócio e funcionalidades específicas do **sistema de agendamento**; para detalhes sobre a arquitetura interna, o Router, o Query Builder, os comandos de CLI e demais recursos genéricos do boilerplate, consulte o repositório do php-mvc.

---

## Funcionalidades

### Autenticação

- Login e logout
- Cadastro de usuário
- Recuperação de senha (esqueci minha senha / redefinição por token)

### Painel Super Administrador (`/super`)

Área administrativa central do SaaS, com CRUD completo de **Unidades**:

- Listagem, criação, edição, visualização e exclusão de unidades
- Ativar / desativar unidade (`ver-status`)

Cada unidade armazena:

- **Identificação:** nome, slug (para URLs amigáveis), descrição
- **Contato:** e-mail, telefone, coordenador responsável
- **Endereço completo:** rua, número, complemento, bairro, cidade, estado, CEP
- **Configuração de atendimento:** horário de início e fim do expediente, intervalo em minutos entre agendamentos
- **Serviços oferecidos:** armazenados em JSON
- **Imagem** e **status** (ativa/inativa)

### Dashboard

Painel inicial pós-login (`/dashboard`), base para as próximas telas do sistema.

### Segurança

- Middleware de CSRF em formulários
- Rate limiting em rotas sensíveis (ex.: login)
- Middlewares de autenticação, convidado (guest) e controle de papéis (roles)
- Cabeçalhos de segurança HTTP

> ⚠️ **Status atual:** o cadastro e configuração das unidades já está pronto. O fluxo de **agendamento em si** (calendário de horários disponíveis, marcação por parte do cliente final, confirmação/cancelamento) ainda está em desenvolvimento e será a próxima etapa do projeto.

---

## Requisitos

- PHP >= 8.1
- MySQL/MariaDB
- Composer
- Extensões PHP: PDO, mbstring, json

---

## Instalação

```bash
# 1. Instalar dependências
composer install

# 2. Criar o arquivo de ambiente
cp .env.example .env

# 3. Gerar a chave da aplicação
php mvc key:generate

# 4. Configurar o banco de dados no .env
DB_HOST=127.0.0.1
DB_DATABASE=agendamento
DB_USERNAME=root
DB_PASSWORD=

# 5. Rodar as migrations (usuários, unidades, etc.)
php mvc migrate

# 6. Subir o servidor local
composer serve
# ou
php -S localhost:8000 -t public
```

A aplicação ficará disponível em `http://localhost:8000`.

---

## Estrutura de Rotas Principais

```
/                          Home
/login, /registro          Autenticação
/dashboard                 Painel do usuário

/super                     Painel do Super Administrador
/super/unidade             Listagem de unidades
/super/unidade/create      Criar unidade
/super/unidade/{id}        Detalhes da unidade
/super/unidade/{id}/edit   Editar unidade
```

---

## Estrutura do Projeto

Segue a organização padrão do php-mvc:

```
app/
├── Controllers/    # Controllers (HomeController, AuthController, DashboardController, Super/*)
├── Models/         # Models (User, UnidadeModel, PasswordReset)
├── Services/       # Regras de negócio (AuthService, UnidadeService)
├── Repositories/   # Acesso a dados (UserRepository, UnidadeRepository)
├── Middlewares/    # Auth, Csrf, RateLimit, Role, SecurityHeaders...
└── Views/          # Views organizadas por módulo (auth/, back/unidades/, dashboard/...)

database/migrations/  # Migrations SQL versionadas
routes/web.php         # Rotas específicas deste sistema
```

---

## Créditos

Base MVC: [github.com/eliasdossantos/php-mvc](https://github.com/eliasdossantos/php-mvc)

---

## Licença

Software proprietário. Todos os direitos reservados — veja o arquivo [LICENSE](LICENSE).
