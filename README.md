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
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC91c2VyXC9sb2dpbiIsImlhdCI6MTY4NTExNTg0NCwiZXhwIjoxNjg1MTE5NDQ0LCJuYmYiOjE2ODUxMTU4NDQsImp0aSI6IlJxZjBpdDdCMVpyNG94SksiLCJzdWIiOjMsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.vzWN03In1Xp_Ce480uMmZQPY3Jc3Kgi3kkovg2S6Jjg",
        "message": "Login efetuado com sucesso"
    }
}
```
---

**Rota para deletar um usuario**
```
 [Delete] - /user/{id}
```

**Body:** 
Authorization -> Bearer Token

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
**Body** Authorization -> Bearer Token 
```
{
    "nome" : "atualizandousuario",
    "password" : "passwordnovo123"
}
```
**Response**
```
{
    "data": {
        "message": "Usuario atualizado de id 2 atualizado com sucesso"
    }
}
```
---

## Contatos:
**Rota para contate-nos**
```
[POST] - contact/send/contact
```
**Body** Authorization -> Bearer Token
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
**Body** Authorization -> Bearer Token


Exemplo de um usuario com 2 produtos

**Response**
```
{
    "data": {
        "product": [
            {
                "name": "produto3",
                "price": "32.0",
                "description": "testetestetestetestetestetestetestetestetesteteste"
            },
            {
                "name": "produto teste",
                "price": "123123.0",
                "description": "teste produto"
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
**Body** Authorization -> Bearer Token
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
        "message": "Produto vendido para o usuario guilherme"
    }
}
```
---
**Rota para adicionar um comentario no produto**
```
[POST] - api/product/comments
```

**Body** Authorization -> Bearer Token
```
{
    "comment" : "comentario para o produto de id 1",
    "assessment": 5,    
    "product_name" : "produto3"
}
```
**Response**
```
{
    "data": {
        "message": "comentario adicionado para o produto de id 1"
    }
}
``` 
---
**Rota para atualizar um comentario**
```
[POST] - api/product/comments/{id}
```

**Body** Authorization -> Bearer Token
```
{
    "comment " : "alterando comentario"
}
```
**Response**
```
{
    "data": {
        "message": "Comentario de id 1 atualizado"
    }
}
```
---
**Rota para deletar um comentario no produto**
```
[DELETE] - api/product/comments/{id}
```

**Body** Authorization -> Bearer Token


**Response**
```
{
    "data": {
        "message": "Comentario deletado com sucesso"
    }
}
```
---
**Rota para retornar comentarios por produto**
```
[GET] - api/showcomment/{productId}
```

**Response**
```
{
    "data": {
        "comment": [
            {
                "User": "guilherme rudio",
                "comment": "alterando comentario",
                "assessment": "5"
            },
            {
                "User": "guilherme rudio",
                "comment": "teste comentario",
                "assessment": "3"
            }
        ]
    }
}
```
---
**Rota para transferencia de produto**
```
[POST]  - api/trade/product
```

**Body** Authorization -> Bearer Token
```
{
    "new_user": "teste1233@gmail.com",
    "product_name": "produto teste"
}   
```
**Response**
```
{
    "data": {
        "message": "Produto Transferido com sucesso para o usuario guilherme rudio"
    }
}
```
---

