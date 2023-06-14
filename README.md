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
**Rota que retorna todos os produtos**
```
[GET] - product/getAllProduct
```

**Response**
```
{
    "data": {
        "products": [
            {
                "id": 3,
                "name": "Narciso Delay",
                "price": 1447,
                "description": "Um delay stereo de alta qualidade com uma ampla gama de opções de personalização para dar ao seu som a ambiência perfeita. Com quatros modos de delays diferentes, você pode escolher desde um clássico delay analógico até um delay com pitch bem psicodélico.",
                "product_image": "storage/app/pedalUm.png",
                "avg_assessment": 5
            },
            {
                "id": 2,
                "name": "Helios Overdrive",
                "price": 1447,
                "description": "O Helios Overdrive é um pedal de overdrive analógico com recursos digitais avançados. Com uma ampla gama de opções de personalização, oferece o timbre perfeito para seu som. Desde sutis saturações até drives intensos, o Helios proporciona uma resposta dinâmica e orgânica. Com recursos únicos e versatilidade excepcional, é o pedal de overdrive ideal para elevar sua expressão musical.",
                "product_image": "storage/app/pedalDois.png",
                "avg_assessment": 5
            },
            {
                "id": 1,
                "name": "Kailani Reverb",
                "price": 1447,
                "description": "Um reverb stereo de alta qualidade com uma ampla gama de opções de personalização para dar ao seu som a ambiência perfeita. Com oito modos de reverb diferentes, você pode escolher desde um ambiente natural e espaçoso até um efeito denso e imersivo.",
                "product_image": "storage/app/pedalTres.png",
                "avg_assessment": 4
            }
        ]
    }
}
```


**Rota que retorna os produtos por usuario**
```
[GET] - product/users/Product
```
**Body** Authorization -> Bearer Token


Exemplo de um usuario com 3 produtos

**Response**
```
{
    "data": {
        "product": [
            {
                "id": 1,
                "name": "Kailani Reverb",
                "price": 1447,
                "description": "Um reverb stereo de alta qualidade com uma ampla gama de opções de personalização para dar ao seu som a ambiência perfeita. Com oito modos de reverb diferentes, você pode escolher desde um ambiente natural e espaçoso até um efeito denso e imersivo.",
                "product_image": "storage/app/pedalTres.png",
                "serie_number": 1,
                "resale": 0,
                "buy_date": "2023-06-09"
            },
            {
                "id": 2,
                "name": "Helios Overdrive",
                "price": 1447,
                "description": "O Helios Overdrive é um pedal de overdrive analógico com recursos digitais avançados. Com uma ampla gama de opções de personalização, oferece o timbre perfeito para seu som. Desde sutis saturações até drives intensos, o Helios proporciona uma resposta dinâmica e orgânica. Com recursos únicos e versatilidade excepcional, é o pedal de overdrive ideal para elevar sua expressão musical.",
                "product_image": "storage/app/pedalDois.png",
                "serie_number": 2,
                "resale": 0,
                "buy_date": "2023-06-09"
            },
            {
                "id": 3,
                "name": "Narciso Delay",
                "price": 1447,
                "description": "Um delay stereo de alta qualidade com uma ampla gama de opções de personalização para dar ao seu som a ambiência perfeita. Com quatros modos de delays diferentes, você pode escolher desde um clássico delay analógico até um delay com pitch bem psicodélico.",
                "product_image": "storage/app/pedalUm.png",
                "serie_number": 5,
                "resale": 1,
                "buy_date": "2023-06-09"
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

