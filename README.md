## Iniciando a aplicação:
- Alterar o .env com as credencias do seu banco

1 - php artisan key:generate

2 - php artisan migrate --seed

3 - php artisan migrate

4 - php artisan serve

## API
API contém rotas para gerenciamento de usuários, produtos e contatos. As rotas de usuários incluem registro, login, pesquisa, atualização e exclusão de usuários. As rotas de produtos incluem pesquisa, criação, atualização e exclusão de produtos, bem como rotas para gerenciar comentários sobre produtos e vendas de produtos. A rota de contatos permite que um usuário envie uma mensagem de contato.

## Rotas - User 
Todos os responses abaixos são 200

**Rota para cadastro de novos usuarios**
``` 
[POST] - /user/register
```
**Body:**
```
{
    "name":"guilherme",
    "email":"teste120@gmail.com",
    "password":"testandopassword",
    "password_confirmed": "testandopassword"
}
```
**Response:**
```
{
    "data": {
        "message": "Usuario Criado"
    }
}
```
---

**Rota para login**
```
[POST] - /user/login
```
**Body**
```
{
    "email":"teste120@gmail.com",
    "password": "testandopassword"
}
```
**Response**
```
{
    "data": {
        "token": "1|9hbpJa6mT3lMmJpKC74nv9Jn1O0lJ4z3scCH4Eqd",
        "message": "Login efetuado com sucesso"
    }
}
```
---

**Rota para deletar um usuario**
```
 [Delete] - /user/{id}
```

Essa rota necessita do Authorization -> Bearer Token que é gerado ao fazer o login

**Body:** Bearer Token

**Response**
```
{
    "data": {
        "message": "Usuario deletado com sucesso!"
    }
}
```
--- 

**Rota para atualizar um usuario**
```
[PUT] - /user/{id}
```
**Body** 

Authorization -> Bearer Token 
```
{
    "nome" : "atualizandousuario",
    "email" : "guilhermeatualiza@gmail.com",
    "password" : "passwordnovo123"
}
```
**Response**
```
{
    "data": {
        "user": {
            "id": 1,
            "name": "guilherme",
            "email": "guilhermerudio@gmail.com"
        },
        "message": "Usuario atualizado"
    }
}
```
---

## Contatos:
**Rota para contate-nos**
```
[POST] - contact/send/contact
```
**Body**
Authorization -> Bearer Token
```
{
    "category" : "Dúvidas",
    "description" : "teste"
}
```

**Response**
```
{
    "data": {
        "name": "guilherme",
        "category_id": 3,
        "description": "teste"
    },
    "message": "Mensagem enviada!"
}
```
---
## Produto:
**Rota que retorna os produtos por usuario**
```
[GET] - product/users/Product
```
**Body**
Authorization -> Bearer Token
**Response**
```
{
    "data": {
        "product": [
            {
                "id": 1,
                "name": "produto3",
                "price": "32.0",
                "description": "testetestetestetestetestetestetestetestetesteteste",
                "product_image": "evidencia 2.jpg",
                "created_at": "2023-05-19T23:20:53.727000Z",
                "updated_at": "2023-05-19T23:20:53.727000Z"
            }
        ]
    }
}
```
---
**Rota para venda de um produto**
```
[POST] - api/product/sell
```
**Body**
```
{
    "email_user" : "teste123@gmail.com", 
    "product_name" : "produto3",
    "number_serie" : "12345"
}
```
**Response**
```
{
    "data": {
        "selledProduct": {
            "product_id": 1,
            "user_id": 3,
            "buy_date": "2023-05-20",
            "serie_number": "12345",
            "id": 3
        },
        "message": "Produto vendido"
    }
}
```


