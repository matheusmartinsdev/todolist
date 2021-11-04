<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Sobre

To-do list API feita com Laravel 8 e PHP 8.0.

Sistema de autenticação com Laravel Sanctum para gerência de usuários, onde um token é fornecido ao criar usuário ou logar-se.

Este README divide as rotas e objetos de exemplo em _usuarios_ e _tasks_, onde _usuarios_ diz respeito aos modelos de rotas e objetos relacionadas ao sistema de usuários, e _tasks_ está relacionado as operações que um usuário pode realizar sobre suas tasks **quando está autenticado via token**.

# Headers

**Content/Type:** application/json

**Accept:** application/json

# Rotas - /usuarios

As rotas abaixo são para registrar um novo usuário e logar no sistema através de token.

## POST: /api/usuarios

-   Cadastra um usuário e retorna um token de acesso

### Enviado

```json
{
    "name": "Matheus Martins", //required|string|max:255
    "email": "email@exemplo.com", //required|string|e-mail|max:255
    "password": "123123", //required|password|min:6
    "password_confirmation": "123123" //required|password|confirmed|min:6
}
```

### Retornado

```json
{
    "data": {
        "id": 1,
        "nome": "Matheus Martins",
        "email": "email@exemplo.com",
        "created_at": "2021-11-04T00:02:16.000000Z",
        "updated_at": "2021-11-04T00:02:16.000000Z",
        "token": "1|XEiXoVvcEzbOBLxD4bR9X9jIGFAIG1AJQsjeRvkE" //Token para autenticação em seu cliente HTTP como Baerer Token
    }
}
```

## POST: /api/usuarios/login

-   Realiza login no sistema e retorna um token

### Enviado

```json
{
    "email": "email@exemplo.com", //required|string|e-mail|max:255
    "password": "123123" //required|password|min:6
}
```

### Retornado

```json
{
    "data": {
        "token": "2|MNr5EqF3Jn08dzPARGIm8fW0FUFcjrGuNkNioSxB"
    }
}
```

## POST: /api/usuarios/logout

-   Desloga-se do sistema e exclui todos os tokens atribuídos ao usuário.

### Retornado

```json
{
    "mensagem": "Deslogado com sucesso"
}
```

# Rotas - /tarefas

As rotas abaixo são para cadastrar uma nova tarefa para o usuário logado.

## GET: /api/tarefas

-   Lista todas as tarefas do usuário logado

### Retornado

```json
{
    "data": [
        {
            "id": 1,
            "text": "Tarefa de exemplo",
            "status": "ativa",
            "created_at": "2021-11-03T23:00:23.000000Z",
            "updated_at": "2021-11-03T23:48:41.000000Z"
        },
        {
            "id": 6,
            "text": "Mais uma tarefa de exemplo",
            "status": "ativa",
            "created_at": "2021-11-03T23:26:03.000000Z",
            "updated_at": "2021-11-03T23:26:03.000000Z"
        },
        {
            "id": 7,
            "text": "Outra tarefa",
            "status": "cancelada",
            "created_at": "2021-11-04T00:21:20.000000Z",
            "updated_at": "2021-11-04T00:21:20.000000Z"
        },
        {
            "id": 8,
            "text": "Mais uma tarefa",
            "status": "feita",
            "created_at": "2021-11-04T00:21:31.000000Z",
            "updated_at": "2021-11-04T00:21:31.000000Z"
        }
    ]
}
```

## GET /api/tarefas?status=ativa|feita|cancelada

-   Lista todas as tarefas classificadas com 'status' = ativa|feita|cancelada

**Exemplo onde status=ativa** - lista todas as tarefas ativas do usuário logado.

### Retornado

```json
{
    "data": [
        {
            "id": 1,
            "text": "Tarefa de exemplo",
            "status": "ativa",
            "created_at": "2021-11-03T23:00:23.000000Z",
            "updated_at": "2021-11-03T23:48:41.000000Z"
        },
        {
            "id": 6,
            "text": "Mais uma Tarefa de exemplo",
            "status": "ativa",
            "created_at": "2021-11-03T23:26:03.000000Z",
            "updated_at": "2021-11-03T23:26:03.000000Z"
        }
    ]
}
```

## GET /api/tarefas/{id}

-   Exibe uma tarefa pelo id, onde {id} é um valor inteiro

**Exemplo onde id = 1 (/api/tarefas/1)** - lista a tarefa de id 1 **se esta pertencer ao usuário logado**.

```json
{
    "data": [
        {
            "id": 1,
            "text": "Tarefa de exemplo",
            "status": "ativa",
            "created_at": "2021-11-03T23:00:23.000000Z",
            "updated_at": "2021-11-03T23:48:41.000000Z"
        }
    ]
}
```

## POST /api/tarefas

-   Cria uma nova tarefa de acordo com os campos fornecidos no objeto JSON.

```json
{
    "text": "Mais uma tarefa", //required|string|max:255
    "status": "ativa" //required|enum: ativa|feita|cancelada
}
```

### Retornado

```json
{
    "data": {
        "id": 8,
        "text": "Mais uma tarefa",
        "status": "feita",
        "created_at": "2021-11-04T00:21:31.000000Z",
        "updated_at": "2021-11-04T00:21:31.000000Z"
    }
}
```

## PATCH /api/tarefas/{id}

-   Edita a tarefa especificada por {id}.

**Exemplo: /api/tarefas/1 - atualizando o 'text' da tarefa 1**

### Enviado

```json
{
    "text": "Tarefa de exemplo ATUALIZADA"
}
```

### Retornado

```json
{
    "data": {
        "id": 1,
        "text": "Tarefa de exemplo ATUALIZADA",
        "status": "ativa",
        "created_at": "2021-11-03T23:00:23.000000Z",
        "updated_at": "2021-11-04T00:25:12.000000Z"
    }
}
```

## DELETE /api/tarefas/{id}

-   Deleta a tarefa especificada por {id}.

**Exemplo: deletando a tarefa de id 8**

### Retornado

```json
{
    "data": {
        "id": 8,
        "text": "Mais uma tarefa",
        "status": "feita",
        "created_at": "2021-11-04T00:21:31.000000Z",
        "updated_at": "2021-11-04T00:27:32.000000Z"
    }
}
```
