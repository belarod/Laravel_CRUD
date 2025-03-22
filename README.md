
# CRUD em Laravel 12

Projeto em Laravel 12 implementa um CRUD básico.
Feito para um teste p/ estágio em desenvolvimento Laravel.




## Deploy

Para fazer o deploy desse projeto, baixe o 7zip e XAMP. Tenha certeza que XAMPP esteja instalado e rodando com Apache e mySQL ativos.

Para clonar o projeto, use:
```bash
  git clone https://github.com/belarod/Laravel_CRUD.git
```

No terminal do diretório do projeto, use:
```bash
  composer install 
```
e depois:
```bash
  Copy-Item .env.example .env
```
Isso criará o arquivo .env, no qual configuraremos o banco de dados com os seguintes dados:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db-laravel-belarod
DB_USERNAME=root
DB_PASSWORD=
```

Acessando http://localhost/phpmyadmin/, crie um banco de dados, mantendo o mesmo nome da configuração do .env.

Após configuração, rode:
```bash
  php artisan migrate
```

Criando a key:
```bash
php artisan key:generate
```

Depois de estabelecer a conexão com o banco de dados e gerar a key de acesso, acionamos o serivor local, rode:

```bash
  php artisan serve
```





## Seed no Banco de dados

```bash
  php artisan db:seed --class=TaskSeeder
```

Isso adicionará 10 insâncias de tarefa no banco de dados.




## Testando a API

*Listando todas as tarefas:
```bash
  Invoke-WebRequest -Uri "http://127.0.0.1:8000/api/tasks" -Method Get
```
Acesse no navegador: http://127.0.0.1:8000/api/tasks

---
*Criando uma nova tarefa:
```bash
  Invoke-RestMethod -Uri http://127.0.0.1:8000/api/tasks -Method POST -ContentType "application/json" -Body '{
    "title": "Aprender Laravel",
    "description": "Estudar controllers e rotas",
    "status": "pendente",
    "due_date": "2025-03-30"}'
```

---
*Alterando uma tarefa (possível apenas com status 'pendente'):
```bash
  Invoke-RestMethod -Uri http://127.0.0.1:8000/api/tasks/11 -Method PUT -ContentType 'application/json' -Body '{
  "title": "aaaaaal",
  "description": "oi!",
  "status": "pendente",
  "due_date": "2025-04-05"}'
```
Caso ocorra o erro 403, verifique o comando do terminal para apontar a um ID que possua o status como 'pendente'.

---
*Deletando uma tarefa (possível apenas com status 'pendente'):
```bash
  Invoke-RestMethod -Uri http://127.0.0.1:8000/api/tasks/11 -Method DELETE
```
Caso ocorra o erro 403, verifique o comando do terminal para apontar a um ID que possua o status como 'pendente'.
