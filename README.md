# CRUD DE ESCOLAS

Aplicação web do tipo monolitica criada com:
- PHP para o Back-End  versão ^7.4
- HTML, CSS, Javascript para o Front-End
- MySQL/MariaDB para o banco de dados

## Funcionalidades

- CRUD de Alunos
- CRUD de Professores
- CRUD de Cursos
- CRUD de Categorias
- CRUD de Usuárioas

### Passo a passo para executar o projeto

Certifique-se que seu computado tem os software:
- PHP
- MySQL ou MariaDB
- Editor o texto (por exemplo VS code)
- Navegador Web
- Composer (Gerenciador )

#### Clone o projeto
Baixe ou faça o clone do repositorio:
`git clone ...`

Após isso, entre no diretorio que foi gerado.
`cd crud-php-oo`

#### Habilitar as extensões do PHP
Abra o diretório de instalação do PHP, encontre o arquivo *php.
ini-production*, renomeie-o para o **php.ini** e abra-o com algum editor de texto.

Encontre as seguintes linhas e descomente-as removendo ; que precede a linha.
- pdo_mysql
- curl
- mb_string
- openssl

#### Instalar as dependencias

Dentro do diretório da aplicação execute no terminal:

`composer install`

Certifique-se que um diretório chamado **/vendor** foi criado.

### Banco de Dados

> O banco de dados é do tipo relacional e contém as tabelas com até 2 níveis de normatização.

#### Criando o banco de dados

Entre no seu cliente de banco de dados, e execute o comando:

```sql
CREATE DATABASE db_escola;
```
#### Migrar a estrutura do banco de dados
Ainda dentro do cliente de banco de dados, copie e cole o conteúdo do arquivo
**db.sql** e execute.

Certifique-se que as tabelas foram criadas, executando o comando:

```sql
SHOW TABLES;
```

Se o resultado for a lista de tabelas existente, então pronto.

#### Configure as credencias de acesso
Encontre o arquivo **/confg/database.php** e edite-o conforme as credencias
do seu usuário do banco de dados.

### Crie o primeiro usuário de acesso
Dentro do diretório da aplicação, execute no terminal o comando.
`php config/create-admin.php`;

Isso criará um usuáro com as credenciais:
|Nome|Email|Senha|
| -  | -   | -   |
| Administrador | admin@admin.com | 123456 |

### Executando a aplicação 
Para executar e testar a aplicação, dentro do terminal execute:
`php -S localhost:8000 -t public`

Agora acesse o endereço http://localhost:8000 em seu navegador.