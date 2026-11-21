
# TaskManager

[![PHP](https://img.shields.io/badge/Backend-PHP-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![HTML5](https://img.shields.io/badge/Frontend-HTML5-E34F26?logo=html5&logoColor=white)](https://developer.mozilla.org/pt-BR/docs/Web/HTML)
[![CSS3](https://img.shields.io/badge/Frontend-CSS3-1572B6?logo=css3&logoColor=white)](https://developer.mozilla.org/pt-BR/docs/Web/CSS)
[![JavaScript](https://img.shields.io/badge/Frontend-JavaScript-F7DF1E?logo=javascript&logoColor=black)](https://developer.mozilla.org/pt-BR/docs/Web/JavaScript)
[![MySQL](https://img.shields.io/badge/Database-MySQL-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Composer](https://img.shields.io/badge/Dependencies-Composer-885630?logo=composer&logoColor=white)](https://getcomposer.org/)
[![Apache](https://img.shields.io/badge/Server-Apache-D22128?logo=apache&logoColor=white)](https://httpd.apache.org/)
[![XAMPP](https://img.shields.io/badge/Environment-XAMPP-FB7A24?logo=xampp&logoColor=white)](https://www.apachefriends.org/)
[![Git](https://img.shields.io/badge/Version_Control-Git-F05032?logo=git&logoColor=white)](https://git-scm.com/)
[![GitHub](https://img.shields.io/badge/Hosting-GitHub-181717?logo=github&logoColor=white)](https://github.com/)
[![Status](<https://img.shields.io/badge/Status-Em%20Desenvolvimento-yellow>)]()

## 📦 Sobre o Projeto

O **TaskManager** é uma aplicação web desenvolvida em PHP, com o objetivo de oferecer um ambiente para gerenciamento e organização de tarefas.

O projeto utiliza uma arquitetura baseada em MVC, com separação adicional da camada de serviços (Services), buscando organizar as responsabilidades da aplicação e facilitar sua manutenção e expansão.

A aplicação conta com sistema de autenticação, conexão com banco de dados e estrutura própria de roteamento, controladores e renderização de Views.

## ⚙️ Funcionalidades

- **Autenticação de usuários:** sistema de login com validação de credenciais.
- **Segurança de senhas:** utilização de funções de hash para armazenamento e verificação de senhas.
- **Conexão com banco de dados:** integração com MySQL através de PDO.
- **Roteamento:** gerenciamento de requisições HTTP GET e POST.
- **Gerenciamento de Views:** renderização de páginas e transferência de dados entre Controllers e Views.
- **Tratamento de erros:** gerenciamento centralizado de erros e exceções.
- **Configuração de ambiente:** utilização de variáveis de ambiente através do arquivo `.env`.

## 🛠️ Tecnologias

| Categoria      | Tecnologia | Finalidade                                 |
| -------------- | ---------- | ------------------------------------------ |
| Backend        | PHP        | Linguagem principal da aplicação.        |
| Frontend       | HTML5      | Estruturação das páginas.               |
| Frontend       | CSS3       | Estilização das interfaces.              |
| Frontend       | JavaScript | Interatividade da aplicação.             |
| Banco de dados | MySQL      | Armazenamento e gerenciamento dos dados.   |
| Dependências  | Composer   | Gerenciamento de dependências e autoload. |
| Biblioteca     | PHP dotenv | Gerenciamento de variáveis de ambiente.   |
| Servidor       | Apache     | Servidor web da aplicação.               |
| Ambiente       | XAMPP      | Ambiente local de desenvolvimento.         |
| Versionamento  | Git        | Controle de versão do código-fonte.      |
| Hospedagem     | GitHub     | Hospedagem do repositório.                |

## 🏗️ Arquitetura

```text
taskmanager/
│
├── App/
│   ├── Controllers/
│   │   ├── HomeController.php
│   │   └── AuthController.php
│   │
│   ├── Core/
│   │   ├── Connection.php
│   │   ├── Controller.php
│   │   ├── defines.php
│   │   ├── ErrorHandler.php
│   │   ├── Helper.php
│   │   ├── Model.php
│   │   └── Router.php
│   │
│   ├── Models/
│   │   └── UsersModel.php
│   │
│   ├── Services/
│   │   └── AuthService.php
│   │
│   └── Views/
│       ├── auth/
│       ├── errors/
│       └── home/
│
├── Public/
│   ├── index.php
│   └── Assets/
│       ├── css/
│       └── js/
│
├── vendor/
│
├── .env
├── .gitignore
├── .htaccess
├── composer.json
└── composer.lock
```

O projeto utiliza uma adaptação da arquitetura MVC para **MVCS**, separando as responsabilidades entre:

- **Models:** interação com o banco de dados e manipulação dos dados.
- **Views:** apresentação das interfaces da aplicação.
- **Controllers:** recebimento das requisições e comunicação entre as camadas.
- **Services:** implementação das regras de negócio.
- **Core:** componentes centrais da aplicação, como Router, Controller base, conexão e tratamento de erros.

## 🚀 Instalação

### Pré-requisitos

- [PHP](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [XAMPP](https://www.apachefriends.org/)
- MySQL

### 1. Clone o repositório

```bash
git clone https://github.com/waldaotto/taskmanager.git
```

### 2. Entre na pasta do projeto

```bash
cd taskmanager
```

### 3. Instale as dependências

```bash
composer install
```

### 4. Configure as variáveis de ambiente

Crie um arquivo `.env` na raiz do projeto:

```env
APP_NAME=TaskManager
APP_ENV=local
APP_DEBUG=true

DB_HOST=localhost
DB_PORT=3306
DB_DB=taskmanager
DB_USER=root
DB_PASSWORD=
```

Ajuste as credenciais de acordo com a configuração do seu MySQL.

### 5. Configure o banco de dados

Crie um banco de dados MySQL com o nome definido na variável `DB_DATABASE`.

Execute os scripts SQL necessários para criar as tabelas da aplicação.

### 6. Configure o servidor Apache

Coloque o projeto no diretório `htdocs` do XAMPP:

```text
C:\xampp\htdocs\taskmanager
```

Inicie os serviços Apache e MySQL pelo painel do XAMPP.

<h3>7. Configure Vhosts</h3>

<h3><wbr>

<h3><wbr>

Na configuração de hosts da sua maquina, configure:

```WINDOWS
127.0.0.1 taskmanager
```

### 8. Acesse a aplicação

```text
http://localhost/taskmanager
```

## 🗺️ Roadmap

- [X] Estrutura inicial da aplicação.
- [X] Configuração do Composer e autoload PSR-4.
- [X] Sistema de roteamento HTTP.
- [X] Classe base para Controllers e Models.
- [X] Sistema de renderização de Views.
- [X] Conexão com banco de dados utilizando PDO.
- [X] Estrutura de Models.
- [X] Estrutura de Services.
- [X] Configuração de variáveis de ambiente.
- [X] Tratamento centralizado de erros e exceções.
- [X] Implementação inicial da autenticação.
- [ ] Gerenciamento de tarefas (CRUD).
- [ ] Gerenciamento de categorias.
- [ ] Painel de gerenciamento de tarefas.
- [ ] Painel de calendario;
- [ ] Gerenciamento de tarefas por calendario(CRUD));

## 📌 Status

**Em desenvolvimento.**

O projeto está em desenvolvimento, com sua estrutura principal implementada e o sistema de autenticação em construção. Novas funcionalidades serão adicionadas progressivamente.

## 📄 Licença

Licença ainda não definida.
