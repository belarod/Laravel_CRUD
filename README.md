
# CRUD em Laravel 12

Projeto em Laravel 12 implementa um CRUD básico.
Feito para um teste p/ estágio em desenvolvimento Laravel.




## Deploy

Para fazer o deploy desse projeto, tenha certeza que XAMPP esteja instalado e rodando com Apache e mySQL ativos. 

Acessando http://localhost/phpmyadmin/, crie um banco de dados, e o configure no arquivo .env do repositório. Após configuração, rode:

```bash
  php artisan migrate
```

Depois de estabelecer a conexção com o banco de dados, acionamos o serivor local, rode:

```bash
  php artisan serve
```





## Seed no Banco de dados

```bash
  php artisan db:seed --class=TaskSeeder
```

Isso adicionará 10 insâncias de tarefa no banco de dados.




## Testando a API

Listando todas as tarefas:
```bash
  Invoke-WebRequest -Uri "http://127.0.0.1:8000/api/tasks" -Method Get
```
Acesse no navegador: http://127.0.0.1:8000/api/tasks

---
Criando uma nova tarefa:
```bash
  Invoke-RestMethod -Uri http://127.0.0.1:8000/api/tasks -Method POST -ContentType "application/json" -Body '{
    "title": "Aprender Laravel",
    "description": "Estudar controllers e rotas",
    "status": "pendente",
    "due_date": "2025-03-30"}'
```

---
Alterando uma tarefa (possível apenas com status 'pendente'):
```bash
  Invoke-RestMethod -Uri http://127.0.0.1:8000/api/tasks/36 -Method PUT -ContentType 'application/json' -Body '{
  "title": "aaaaaal",
  "description": "oi!",
  "status": "pendente",
  "due_date": "2025-04-05"}'
```
Caso ocorra o erro 403, verifique o comando do terminal para apontar a um ID que possua o status como 'pendente'.

---
Deletando uma tarefa (possível apenas com status 'pendente'):
```bash
  Invoke-RestMethod -Uri http://127.0.0.1:8000/api/tasks/11 -Method DELETE
```
Caso ocorra o erro 403, verifique o comando do terminal para apontar a um ID que possua o status como 'pendente'.
