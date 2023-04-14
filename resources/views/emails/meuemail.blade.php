<!DOCTYPE html>
<html>
<head>
    <title>Confirmação de Cadastro</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.5;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #fff;
        }
        h1 {
            margin-top: 0;
            font-size: 28px;
            text-align: center;
            color: #333;
        }
        p {
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
        .button:hover {
            background-color: #3e8e41;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Confirmação de Cadastro</h1>
        <p>Olá {{$userName}}</p>
        <p>Seu cadastro foi realizado com sucesso!</p>
        <p>Se você não realizou esse cadastro, ignore este email.</p>
        <div class="footer">
            <p>Este é um email automático, por favor não responda.</p>
        </div>
    </div>
</body>