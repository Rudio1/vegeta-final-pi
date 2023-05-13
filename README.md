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
    "data": [],
    "message": "Usuario Criado",
    "status": true
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
        "token": "58|dL6y7dXVKqcUa9iZqx660u0eIbtADH8HOK4at25w"
    },
    "message": "Login efetuado com sucesso",
    "status": true
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
    "data": [],
    "message": "Usuario deletado com sucesso!",
    "status": true
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
        "id": 2,
        "name": "guilhermeteste",
        "email": "guilhermeatualiza@gmail.com"
    },
    "message": "Usuario atualizado",
    "status": true
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
