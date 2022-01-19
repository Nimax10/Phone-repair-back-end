<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    {{-- Ищем все модели комании Iphone --}}
    @foreach ($models as $model)
        {{ $model->nameModel}} <br>
    @endforeach

    <hr>

    {{-- Ищем по модели Samsung Galaxy S9 компанию-производителя --}}
    {{ $companies->name }}
</body>
</html>
