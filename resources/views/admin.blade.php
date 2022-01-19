<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель</title>
    <script src="{{ asset('assets/js/vue.js') }}"></script>
    <script src="{{ asset('assets/js/app_admin.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
    <div id="app_admin">
        <div>
            <div>
                <form method="POST" action="{{ route('order_editOrDelete') }}" enctype="multipart/form-data" class="form" style="margin: 10px;">
                    @csrf
                    <table style="border: 1px solid black; border-collapse: collapse;">
                        <tr style="background: rgb(220, 220, 220);">                      <td style="border: 1px solid black;">Выбор</td>                                                                   <td style="border: 1px solid black;">Номер заказа</td>        <td style="border: 1px solid black;">Номер телефона</td>                                                        <td style="border: 1px solid black;">Email</td>                                                        <td style="border: 1px solid black;">Компания</td>         <td style="border: 1px solid black;">Модель</td>                                                       <td style="border: 1px solid black;">Существует ли модель</td>                                                  <td style="border: 1px solid black;">Тип проблемы</td>                                                        <td style="border: 1px solid black;">Статус</td>                                                        <td style="border: 1px solid black;">Дата создания</td>       <td style="border: 1px solid black;">Дата изменения</td> </tr>
                        <tr v-for="li in orders">                                         <td style="border: 1px solid black;"><input type="radio" name="order_line" v-bind:value="li.id_order" id=""></td> <td style="border: 1px solid black;"> @{{ li.id_order}} </td> <td style="border: 1px solid black;">@{{li.contact_number }} </td>                                              <td style="border: 1px solid black;">@{{li.email}}</td>                                                <td style="border: 1px solid black;">@{{ li.company}}</td> <td style="border: 1px solid black;">@{{ li.model}}</td>                                               <td style="border: 1px solid black;">@{{li.existing_model}}</td>                                                <td style="border: 1px solid black;">@{{li.type_problem}}</td>                                                <td style="border: 1px solid black;">@{{li.status}}</td>                                                <td style="border: 1px solid black;">@{{li.created_at}}</td>  <td style="border: 1px solid black;">@{{li.updated_at}}</td> </tr>
                        <tr>                                                              <td style="border: 1px solid black;"></td>                                                                        <td style="border: 1px solid black;"></td>                    <td style="border: 1px solid black;"><input type="radio" name="order_column" value="contact_number" id=""></td> <td style="border: 1px solid black;"><input type="radio" name="order_column" value="email" id=""></td> <td style="border: 1px solid black;"></td>                 <td style="border: 1px solid black;"><input type="radio" name="order_column" value="model" id=""></td> <td style="border: 1px solid black;"><input type="radio" name="order_column" value="existing_model" id=""></td> <td style="border: 1px solid black;"><input type="radio" name="order_column" value="type_problem" id=""></td> <td style="border: 1px solid black;"><input type="radio" name="order_column" value="status" id=""></td> <td style="border: 1px solid black;"></td>                    <td style="border: 1px solid black;"></td> </tr>
                    </table>
                    <p>Изменить на</p>
                    <input type="text" name="edit_on" size="40" class="input-c"><br>
                    <button type="submit" name="button" value="edit">Изменить</button>
                    <button type="submit" name="button" value="delete">Удалить</button>
                    <br><br>
                </form>
            </div>
            <div style="border: 1px solid black;">
                <form method="POST" action="{{ route('Order') }}" enctype="multipart/form-data" class="form" style="margin: 10px;">
                    @csrf
                    <span style="font-size: 16pt;">Создать заказ</span>
                    <p>Контактный телефон:</p>
                    <input type="text" name="contact-number" size="20" class="input-c"><br>
                    <p>Почта:</p>
                    <input type="text" name="email" size="40" class="input-c"><br>
                    <p>Модель устройства:</p>
                    <select name="models">
                        <option disabled selected value="start" >Выберите один из вариантов</option>
                        <optgroup v-for="(phoneList, pl) in phones" :value="pl" :label="phoneList.name">
                            <option v-for="(modellist, ml) in phoneList.models" v-bind:value="modellist.nameModel">@{{modellist.nameModel}}</option>
                        </optgroup>
                        <option value="other">Другое</option>
                    </select><br>
                    <p>Тип неисправности:</p>
                    <textarea name="type" class="textarea-co" maxlength="200"></textarea><br>
                    <button type="submit">Создать</button>
                </form>
            </div>
        </div>
        <div>
            <form method="POST" action="{{ route('question_editOrDelete') }}" enctype="multipart/form-data" class="form" style="margin: 10px;">
                @csrf
                <table style="border: 1px solid black; border-collapse: collapse;">
                    <tr style="background: rgb(220, 220, 220);">                         <td style="border: 1px solid black;">Выбор</td>                                                               <td style="border: 1px solid black;">Номер вопроса</td>          <td style="border: 1px solid black;">Имя</td>                                                         <td style="border: 1px solid black;">Номер телефона</td>                                                        <td style="border: 1px solid black;">Текст вопроса</td>                                                        <td style="border: 1px solid black;">Статус</td>                                                        <td style="border: 1px solid black;">Дата создания</td>       <td style="border: 1px solid black;">Дата изменения</td> </tr>
                    <tr v-for="li in questions">                                         <td style="border: 1px solid black;"><input type="radio" name="quest_line" v-bind:value="li.id_question" id=""></td> <td style="border: 1px solid black;"> @{{ li.id_question}} </td> <td style="border: 1px solid black;"> @{{li.name }} </td>                                             <td style="border: 1px solid black;">@{{ li.contact_number}}</td>                                               <td style="border: 1px solid black;">@{{ li.text_question}}</td>                                               <td style="border: 1px solid black;">@{{ li.status}}</td>                                               <td style="border: 1px solid black;">@{{ li.created_at}}</td> <td style="border: 1px solid black;">@{{ li.updated_at}}</td> </tr>
                    <tr>                                                                 <td style="border: 1px solid black;"></td>                                                                    <td style="border: 1px solid black;"></td>                       <td style="border: 1px solid black;"><input type="radio" name="quest_column" value="name" id=""></td> <td style="border: 1px solid black;"><input type="radio" name="quest_column" value="contact_number" id=""></td> <td style="border: 1px solid black;"><input type="radio" name="quest_column" value="text_question" id=""></td> <td style="border: 1px solid black;"><input type="radio" name="quest_column" value="status" id=""></td> <td style="border: 1px solid black;"></td>                    <td style="border: 1px solid black;"></td> </tr>
                </table>
                <p>Изменить на</p>
                <input type="text" name="edit_on" size="40" class="input-c"><br>
                <button type="submit" name="button" value="edit">Изменить</button>
                <button type="submit" name="button" value="delete">Удалить</button>
            </form>
            <div style="border: 1px solid black;">
                <form method="POST" action="{{ route('Question') }}" enctype="multipart/form-data" class="form" style="margin: 10px;">
                    @csrf
                    <span style="font-size: 16pt;">Создать вопрос</span>
                    <p class="text-co">Ваше имя:</p>
                    <input type="text" size="40" name="name" class="input-c"><br>
                    <p class="text-co">Телефон для связи:</p>
                    <input type="text" size="20" name="contact-number" class="input-c"><br>
                    <p class="text-co">Ваш вопрос:</p>
                    <textarea class="textarea-co" name="text-question" maxlength="200"></textarea><br>
                    <button type="submit">Создать</button>
                </form>
            </div>
        </div>
        <div>
            <table style="border: 1px solid black; border-collapse: collapse; margin: 10px;">
                <tr style="background: rgb(220, 220, 220);">                         <td style="border: 1px solid black;">Код компании</td>            <td style="border: 1px solid black;">Название</td>          <td style="border: 1px solid black;">Высота логотипа</td>              <td style="border: 1px solid black;">Ширина логотипа</td>        <td style="border: 1px solid black;">Картинка компании</td>           <td style="border: 1px solid black;">Модели</td>     </tr>
                <tr v-for="li in phones">    <td style="border: 1px solid black;">@{{li.company_code}}</td>    <td style="border: 1px solid black;">@{{ li.name}} </td>    <td style="border: 1px solid black;"> @{{li.heightLogo }} </td>        <td style="border: 1px solid black;">@{{ li.widthLogo}}</td>     <td style="border: 1px solid black;">@{{ li.imageCompany}}</td>       <td style="border: 1px solid black;"><table>
                    <tr>                         <td>Код модели</td>                                           <td>Название модели</td>                                     <td>Картинка модели путь</td> </tr>
                    <tr v-for="ml in li.models"> <td style="border: 1px solid black;">@{{ml.model_code}}</td>  <td style="border: 1px solid black;">@{{ml.nameModel}}</td>  <td style="border: 1px solid black;">@{{ml.imgModel}}</td> </tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                </table></td> </tr>
            </table>


            <form method="POST" action="{{ route('company_editOrDelete') }}" enctype="multipart/form-data" class="form" style="margin: 10px;">
                @csrf
                <table style="border: 1px solid black; border-collapse: collapse;">
                        <tr>                       <td style="border: 1px solid black;">Выбор</td>                                                                       <td style="border: 1px solid black;">Код компании</td>                <td style="border: 1px solid black;">Название</td>                                                    <td style="border: 1px solid black;">Картинка компании</td>                                                     <td style="border: 1px solid black;">Ширина картинки</td>                                                      <td style="border: 1px solid black;">Высота картинки</td> </tr>
                        <tr v-for="li in company"> <td style="border: 1px solid black;"><input type="radio" name="comp_line" v-bind:value="li.company_code" id=""></td>  <td style="border: 1px solid black;"> @{{ li.company_code}}</td>      <td style="border: 1px solid black;"> @{{li.name }} </td>                                             <td style="border: 1px solid black;">@{{ li.imageCompany}}</td>                                                 <td style="border: 1px solid black;">@{{ li.widthLogo}}</td>                                                   <td style="border: 1px solid black;">@{{ li.heightLogo}}</td> </tr>
                        <tr>                       <td style="border: 1px solid black;"></td>                                                                            <td style="border: 1px solid black;"></td>                            <td style="border: 1px solid black;"><input type="radio" name="comp_column" value="name" id=""></td>  <td style="border: 1px solid black;"><input type="radio" name="comp_column" value="imageCompany" id=""></td>    <td style="border: 1px solid black;"><input type="radio" name="comp_column" value="widthLogo" id=""></td>      <td style="border: 1px solid black;"><input type="radio" name="comp_column" value="heightLogo" id=""></td> </tr>
                </table>
                <p>Изменить на</p>
                <input type="text" name="edit_on" size="40" class="input-c"><br>
                <button type="submit" name="button" value="edit">Изменить</button>
                <button type="submit" name="button" value="delete">Удалить</button>
            </form>


            <form method="POST" action="{{ route('model_editOrDelete') }}" enctype="multipart/form-data" class="form" style="margin: 10px;">
                @csrf
                <table style="border: 1px solid black; border-collapse: collapse;">
                        <tr style="background: rgb(220, 220, 220);">                       <td style="border: 1px solid black;">Выбор</td>                                                                       <td style="border: 1px solid black;">Код модели</td>              <td style="border: 1px solid black;">Код компании</td>                                                           <td style="border: 1px solid black;">Название модели</td>                                                   <td style="border: 1px solid black;">Картинка модели</td> </tr>
                        <tr v-for="li in models">                                          <td style="border: 1px solid black;"><input type="radio" name="model_line" v-bind:value="li.model_code" id=""></td>   <td style="border: 1px solid black;"> @{{ li.model_code}}</td>    <td style="border: 1px solid black;"> @{{ li.company_code}}</td>                                                 <td style="border: 1px solid black;"> @{{li.nameModel }} </td>                                              <td style="border: 1px solid black;">@{{ li.imgModel}}</td> </tr>
                        <tr>                                                               <td style="border: 1px solid black;"></td>                                                                            <td style="border: 1px solid black;"></td>                        <td style="border: 1px solid black;"><input type="radio" name="model_column" value="company_code" id=""></td>    <td style="border: 1px solid black;"><input type="radio" name="model_column" value="nameModel" id=""></td>  <td style="border: 1px solid black;"><input type="radio" name="model_column" value="imgModel" id=""></td> </tr>
                </table>
                <p>Изменить на</p>
                <input type="text" name="edit_on" size="40" class="input-c"><br>
                <button type="submit" name="button" value="edit">Изменить</button>
                <button type="submit" name="button" value="delete">Удалить</button>
            </form>
            <div style="border: 1px solid black;">
                <form method="POST" action="{{ route('company_create') }}" enctype="multipart/form-data" class="form" style="margin: 10px;">
                    @csrf
                    <span style="font-size: 16pt;">Создать компанию</span>
                    <p class="text-co">Название компании:</p>
                    <input type="text" size="40" name="name" class="input-c"><br>
                    <p class="text-co">Картинка компании:</p>
                    <input type="file" name="imageCompany"><br>
                    <p class="text-co">Ширина картинки (90-110px):</p>
                    <input type="text" size="40" name="widthLogo" class="input-c"><br>
                    <p class="text-co">Высота картинки (90-110px):</p>
                    <input type="text" size="40" name="heightLogo" class="input-c"><br>
                    <button type="submit">Создать</button>
                </form>
            </div>
            <div style="border: 1px solid black;">
                <form method="POST" action="{{ route('model_create') }}" enctype="multipart/form-data" class="form" style="margin: 10px;">
                    @csrf
                    <span style="font-size: 16pt;">Создать модель</span>
                    <p class="text-co">Код компании:</p>
                    <input type="text" size="40" name="company_code" class="input-c"><br>
                    <p class="text-co">Название модели:</p>
                    <input type="text" size="40" name="nameModel" class="input-c"><br>
                    <p class="text-co">Картинка компании:</p>
                    <input type="file" name="imgModel"><br>
                    <button type="submit">Создать</button>
                </form>
            </div>
        </div>
        <div style="border: 1px solid black;">
            <form method="POST" action="{{ route('admin_create') }}" enctype="multipart/form-data" class="form" style="margin: 10px;">
                @csrf
                <span style="font-size: 16pt;">Добавить администратора</span>
                <p class="text-co">Логин:</p>
                <input type="text" size="40" name="login" class="input-c"><br>
                <p class="text-co">Пароль:</p>
                <input type="text" size="40" name="password" class="input-c"><br>
                <button type="submit">Добавить</button>
            </form>
        </div>
    </div>
    <style>
        * {
            font-family: Raleway-Medium;
            margin: 0;
        }
        td {
            padding: 6px;
        }
        button {
            border: 1 solid black;
            border-radius: 30px;
            background-color: lightyellow;
            padding: 10px;
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
        }
    </style>
</body>
</html>