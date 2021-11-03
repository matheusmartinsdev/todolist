# Sobre

To-do list API feita com Laravel 8 e PHP 8.0.

# Headers

Content/Type: application/json
Accept: application/json

# Objeto

### Enviado

_Para os métodos POST / PATCH_

```json
{
    "text": "Uma tarefa qualquer", //string
    "status": "ativa" //pode ser: ativa / feita / cancelada
}
```

### Retornado

_Para os métodos GET_

```json
{
    "id": 1, //int
    "text": "Uma tarefa qualquer", //string
    "status": "ativa", //pode ser: ativa / feita / cancelada
    "created_at": "2021-10-31T20:56:38.000000Z", //timestamps
    "updated_at": "2021-10-31T20:56:38.000000Z" //timestamps
}
```

# Rotas

## GET: /api/tarefas

-   Lista todas as tarefas

## GET /api/tarefas?status=ativa|feita|cancelada

-   Lista todas as tarefas como status = ativa|feita|cancelada

## GET /api/tarefas/{id}

-   Exibe uma tarefa pelo id, onde {id} é um valor inteiro

## POST /api/tarefas

-   Cria uma nova tarefa de acordo com os campos fornecidos no objeto JSON.

## PATCH /api/tarefas/{id}

-   Edita a tarefa especificada por {id}.

## DELETE /api/tarefas/{id}

-   Deleta a tarefa especificada por {id}.
