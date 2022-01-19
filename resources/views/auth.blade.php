<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
    <div>
        <div class="form-auth">
            <form method="POST" action="{{ route('CheckAuth') }}" enctype="multipart/form-data" class="form">
                @csrf
                <h1>Войти как администратор</h1>
                <p style="margin-top: 40px;">Логин:</p>
                <input type="text" size="50" name="login"><br>
                <p>Пароль:</p>
                <input type="text" size="50" name="password"><br>
                <button type="submit">Войти</button>
            </form>
        </div>
    </div>
    <style>
        * {
            font-family: Raleway-Medium;
            margin: 0;
        }
        .form-auth {
            margin-top: 50px;
            text-align: center;
        }
        button {
            border: 1 solid black;
            border-radius: 30px;
            background: lightyellow;
            padding: 10px 30px;
            margin: 5px;
            margin-top: 15px;
            transition: background .3s;
        }
        button:hover {
            background: rgb(255, 224, 88);
            cursor: pointer;
        }
        p {
            margin: 2px;
            margin-top: 20px; 
        }
    </style>
</body>
</html>