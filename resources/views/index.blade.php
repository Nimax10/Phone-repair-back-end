<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="{{ asset('assets/js/vue.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}" defer></script>
    <title>Ремонт сотовых телефонов</title>
    <style>
        .fade-enter-active, .fade-leave-active {
            transition: opacity .5s;
        }
        .fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */ {
            opacity: 0;
        }
        .list-enter-active, .list-leave-active {
            transition: all 1s;
        }
        .list-enter, .list-leave-to /* .list-leave-active до версии 2.1.8 */ {
            opacity: 0;
            transform: translateY(30px);
        }
    </style>
</head>
<body>
    <div id="app">
        <transition name="fade" mode="out-in">
            <div class="callback" v-if="callback === true">
                <div>
                    <div style="background-color: white; display: flex; justify-content: center; padding: 10px 0; align-items: center; position: relative;">
                        <span style="font-size: 16pt; font-family: Raleway-Bold;">Заказ ремонта</span>
                        <img src="assets/css/img/logos/1487086345-cross_81577.svg" alt="cross" style="position: absolute; top: 19%; right: 5px; height: 60%; cursor: pointer;" v-on:click="callback = false">
                    </div>
                    <div class="callback-menu">
                        <div style="width: 90%; margin: 20px auto 0 auto;">
                            <form method="POST" action="{{ route('Order') }}" enctype="multipart/form-data" class="form">
                                @csrf
                                <p class="text-c">Контактный телефон:</p>
                                <input type="text" name="contact-number" size="20" class="input-c"><br>
                                <p class="text-c">Почта:</p>
                                <input type="text" name="email" size="40" class="input-c"><br>
                                <p class="text-c">Модель устройства:</p>
                                <select name="models" class="input-c">
                                    <option disabled selected value="start" >Выберите один из вариантов</option>
                                    <optgroup v-for="(phoneList, pl) in phones" :value="pl" :label="phoneList.name">
                                        <option v-for="(modellist, ml) in phoneList.models" v-bind:value="modellist.nameModel" :selected="currentPhone === pl && currentModel === ml">@{{modellist.nameModel}}</option>
                                    </optgroup>
                                    <option value="other">Другое</option>
                                </select><br>
                                <p class="text-c">Тип неисправности:</p>
                                <textarea class="textarea-c" name="type" maxlength="200"></textarea><br>
                                <button type="submit" class="button-c">Отправить</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
        <div class="header">
            <div class="sec-logo-info">
                <div class="logo-info-item">
                    <img src="assets/css/img/logos/logo.png" 
                        alt="logo" 
                        width="90" 
                        height="90" 
                        v-on:click="currentPage = 'main-page'" 
                        style="cursor: pointer;">
                    <span id="text-logo">Ремонт сотовых телефонов</span>
                </div>
                <div class="logo-info-item">
                    <img src="assets/css/img/logos/place-icon.png" 
                        alt="place-icon" 
                        width="60" 
                        height="60">
                    <span style="width: 150px; margin-left: 10px;"><b>Владикавказ</b>,<br>Армянская<br>ул.,38</span>
                </div>
                <div class="logo-info-item">
                    <img src="assets/css/img/logos/link-icon.png" 
                        alt="link-icon" 
                        width="45" 
                        height="45">
                    <span style="width: 150px; margin-left: 10px;"><b>Телефон</b><br>+7 (495) 896-95-69</span>
                </div>
                <div class="logo-info-item">
                    <img src="assets/css/img/logos/clock-icon.png" 
                        alt="clock-icon" 
                        width="45" 
                        height="45">
                    <span style="width: 150px; margin-left: 10px;"><b>Ежедневно</b>,<br>10.00-20.00</span>
                </div>
                <button class="transition-buttons" 
                    v-on:click="callback = true"
                    v-bind:class="{ activeButton: callback === true}">Обратный звонок</button>
            </div>
            <div class="sec-links">
                <nav class="width-seventeen links">
                    <a><button class="transition-buttons" 
                        v-on:click="currentPage = 'first-aid'" 
                        v-bind:class="{ activeButton: currentPage === 'first-aid'}">Первая помощь</button></a>
                    <a><button class="transition-buttons" 
                        v-on:click="currentPage = 'about-us'" 
                        v-bind:class="{ activeButton: currentPage === 'about-us'}">О нас</button></a>
                    <a><button class="transition-buttons" 
                        v-on:click="currentPage = 'guarantee'" 
                        v-bind:class="{ activeButton: currentPage === 'guarantee'}">Гарантия</button></a>
                    <a><button class="transition-buttons" 
                        v-on:click="currentPage = 'contacts'" 
                        v-bind:class="{ activeButton: currentPage === 'contacts'}">Контакты</button></a>
                    <a><button class="transition-buttons" 
                        v-on:click="currentPage = 'phone-repair'; currentPhone = null; currentModel = null; typeRepair = 0" 
                        v-bind:class="{ activeButton: currentPage === 'phone-repair'}">Ремонт телефонов</button></a>
                </nav>
            </div>
            <img src="assets/css/img/logos/free-icon-menu-button-60510.png" 
                class="burg-button" 
                alt="menu-burger" 
                height="40" width="40"
                v-on:click="burgMenu = true">
            <transition name="fade" mode="out-in">
                <div class="burg" key="burg" v-if="burgMenu === true">
                    <img src="assets/css/img/logos/1487086345-cross_81577.svg" alt="cross" style="position: absolute; top: 5px; right: 5px; height: 40px; cursor: pointer; background: white; padding: 2px;" v-on:click="burgMenu = false">
                    <nav class="burg-links">
                        <a><button class="transition-buttons" 
                            v-on:click="burgMenu = false; currentPage = 'first-aid'" 
                            v-bind:class="{ activeButton: currentPage === 'first-aid'}">Первая помощь</button></a>
                        <a><button class="transition-buttons" 
                            v-on:click="burgMenu = false; currentPage = 'about-us'" 
                            v-bind:class="{ activeButton: currentPage === 'about-us'}">О нас</button></a>
                        <a><button class="transition-buttons" 
                            v-on:click="burgMenu = false; currentPage = 'guarantee'" 
                            v-bind:class="{ activeButton: currentPage === 'guarantee'}">Гарантия</button></a>
                        <a><button class="transition-buttons" 
                            v-on:click="burgMenu = false; currentPage = 'contacts'" 
                            v-bind:class="{ activeButton: currentPage === 'contacts'}">Контакты</button></a>
                        <a><button class="transition-buttons" 
                            v-on:click="burgMenu = false; currentPage = 'phone-repair'; currentPhone = null; currentModel = null; typeRepair = 0" 
                            v-bind:class="{ activeButton: currentPage === 'phone-repair'}">Ремонт телефонов</button></a>
                        <button class="transition-buttons" 
                            v-on:click="burgMenu = false; callback = true"
                            v-bind:class="{ activeButton: callback === true}">Обратный звонок</button>
                    </nav>
                </div>
            </transition>
        </div>
            <div key="main" class="main">
                <transition name="fade" mode="out-in">
                    <div key="main-page" class="main-page" v-if="currentPage === 'main-page'">
                        <div class="width-seventeen margin m-one">
                            <div class='m-bookmark'>Ремонт телефонов</div>
                            <transition name="fade" mode="out-in">
                                <img key="image-one" class="m-ome-img" 
                                src="assets/css/img/images/d5bad3c1ae2404b542b8354b4cea90e0.jpg" 
                                alt="repair-image" 
                                v-if="currentImageMain === 0" 
                                >
                                <img key="image-two" class="m-ome-img" 
                                src="assets/css/img/images/unnamed.jpg" 
                                alt="repair-image" 
                                v-if="currentImageMain === 1" 
                                >
                                <img key="image-three" class="m-ome-img" 
                                src="assets/css/img/images/zapchasti-dlya-mobilnyh-telefonov-nokia-photo-2.jpg" 
                                alt="repair-image" 
                                style="filter: blur(3px);" 
                                v-if="currentImageMain === 2" 
                                >
                                <img key="image-four" class="m-ome-img" 
                                src="assets/css/img/images/zapchasti-samsung.jpg" 
                                alt="repair-image" 
                                style="filter: blur(3px);" 
                                v-if="currentImageMain === 3" 
                                >
                            </transition>
                            <div class="m-description"><span style="width: 95%;">Срочный ремонт сотовых телефонов и смартфонов в сервисном центре города Владикавказ, Армянская ул.,38. Бесплатная диагностика и консультации по номеру +7 (495) 896-95-69. У нас большой опыт в ремонте телефонов Meizu, Xiaomi, BlackBerry, Sony Xperia, Samsung, LG, Asus, Iphone и других. Предоставляем услугу курьера и подменный телефон на время ремонта.</span></div>
                        </div>
                        <div style="background: linear-gradient(to right, white 10%, rgb(225, 225, 225) 30%, rgb(225, 225, 225) 70%, white 90%);">
                            <div class="width-seventeen margin m-two">
                                <div style="padding: 40px 0 40px 0;">
                                    <div style="display: flex; flex-wrap: wrap; justify-content: space-around;">
                                        <div>
                                            <p class="m-t-img" ><img src="assets/css/img/logos/bookmark_icon-icons.com_54415 (1).svg" 
                                                alt="logo-orig-co" 
                                                width="100" 
                                                height="100" 
                                                style="margin-bottom: 15px;"></p>
                                            <span class="text-m">Оригинальные комплектующие</span>
                                        </div>
                                        <div>
                                            <p class="m-t-img" ><img src="assets/css/img/logos/bookmark_icon-icons.com_54415 (1).svg" 
                                                alt="logo-orig-co" 
                                                width="100" 
                                                height="100" 
                                                style="margin-bottom: 15px;"></p>
                                            <span class="text-m">Ремонт в присутствии клиента</span>
                                        </div>
                                        <div>
                                            <p class="m-t-img" ><img src="assets/css/img/logos/bookmark_icon-icons.com_54415 (1).svg" 
                                                alt="logo-orig-co" 
                                                width="100" 
                                                height="100" 
                                                style="margin-bottom: 15px;"></p>
                                            <span class="text-m">Гарантия на все виды ремонта</span>
                                        </div>
                                        <div>
                                            <p class="m-t-img" ><img src="assets/css/img/logos/bookmark_icon-icons.com_54415 (1).svg" 
                                                alt="logo-orig-co" 
                                                width="100" 
                                                height="100" 
                                                style="margin-bottom: 15px;"></p>
                                            <span class="text-m">Бесплатная диагностика</span>
                                        </div>
                                        <div>
                                            <p class="m-t-img" ><img src="assets/css/img/logos/bookmark_icon-icons.com_54415 (1).svg" 
                                                alt="logo-orig-co" 
                                                width="100" 
                                                height="100" 
                                                style="margin-bottom: 15px;"></p>
                                            <span class="text-m">Доставка вашего телефона курьером</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="width-seventeen margin m-three">
                            <img src="assets/css/img/images/Smartfon-v-ruke-t.png" 
                                alt="Smartfon-v-ruke" 
                                height="200" 
                                style="border-radius: 60px;">
                            <div style="width: 75%;">
                                <h2>Срочный ремонт сотовых телефонов и смартфонов</h2>
                                <p style="font-size: 13pt; margin-top: 30px; text-align: center;">Ваш сотовый телефон с некоторых пор не реагирует на нажатие клавиш, работает замедленно или вообще отказывается работать? Скорее всего, ему необходима помощь специалиста, который поможет решить любую проблему в работе вашего мобильного телефона. Если вы не знаете, к кому обратиться за квалифицированной помощью по ремонту сотовых телефонов – обратитесь к нам, и мы сможем в кратчайшие сроки вернуть ваш сотовый телефон в привычный для вас режим работы.</p>
                            </div>
                        </div>
                    </div>

                    <div key="first-aid" class="first-aid" v-if="currentPage === 'first-aid'">
                        <div class="breadcrumbs">
                            <ul class="breadcrumb">
                                <li><a v-on:click="currentPage = 'main-page'">Главная</a></li>
                                <li>Первая помощь</li>
                            </ul>
                        </div>

                        <div class="width-seventeen margin">
                            <h1>Первая помощь</h1>
                            <p class="margin" style="font-size: 14pt;">В некоторых случаях мобильное устройство можно попробовать реанимировать в домашних условиях, используя подручные средства, но это не гартирует положительного исхода.</p>
                            <div class="margin a-one">
                                <h3>Что делать если аппарат попал в воду или на него пролили воду:</h3>
                                <div style="display: flex; margin-top: 15px; align-items: center; flex-wrap: wrap; justify-content: center;">
                                    <img src="assets/css/img/images/1414067471[1].png" alt="drowning-water" width="200" height="200" style="border-radius: 15px;">
                                    <ol style="margin: 40px;">
                                        <li>Необходимо сразу-же вынуть аккумулятор</li>
                                        <li>Аккуратно разобрать устройство</li>
                                        <li>Просушить в течении 15-20 минут обычным феном</li>
                                        <li>После просушки дать устройству остыть в течении 30 минут</li>
                                        <li>Собрать аппарат и попробовать включить</li>
                                    </ol>
                                </div>
                                <div class="text-warn"><span style="display: block; margin-left: 20px;">Как правило такой способ при немедленном его решении помогает процентов на 70. Но если вы промедлите с сушкой или будете пробовать включать мокрый телефон можете моментально получить короткое замыкание платы что в дальнейшем встанет вам в кругленькую сумму при её ремонте или даже невозможности ремонта!</span></div>
                            </div>
                            <div class="margin a-two">
                                <h3>Что делать если аппарат попал в воду или на него пролили воду:</h3>
                                <div style="display: flex; margin-top: 15px; align-items: center; flex-wrap: wrap; justify-content: center;">
                                    <ol style="margin: 40px; margin-top: 0;">
                                        <li>Вынуть аккумулятор</li>
                                        <li>Разобрать устройство</li>
                                        <li>Прочистить проспиртованной зубной щёткой все электронные компоненты кроме Экранов и Сенсоров</li>
                                        <li>Также очистить от остатков жидкости все корпусные запчасти</li>
                                        <li>Собрать устройство и пробовать включить</li>
                                    </ol>
                                    <img src="assets/css/img/images/1414067703[1].png" alt="drowning-water" width="200" height="200" style="border-radius: 15px;">
                                </div>
                                <div class="text-warn"><span style="display: block; margin-left: 20px;">Такой способ помогает спасти устройство на некоторое время, т.к. спиртом полностью все соли или сахар удалить не получится, для этого уже нужно полоскать плату в специальном растворе на УЗ ванне, ну а если этого не сделать то через какое-то время соли начнут разъедать детали, на плате или нарушат плотность текстолита или так-же могут прислать вам короткое замыкание.</span></div>
                            </div>
                            <div class="margin a-three">
                                <h4>Проблемы с аккумулятором:</h4>
                                <div style="display: flex; margin-top: 15px; align-items: center; flex-wrap: wrap; justify-content: center;">
                                    <img src="assets/css/img/images/1414068101[1].png" alt="drowning-water" width="200" height="200" style="border-radius: 15px;">
                                    <ol style="margin: 40px;">
                                        <li>Устройство не включается и при подключении ЗУ не заряжается</li>
                                        <li>Устройство при подключении ЗУ долго заряжается или не заряжается вообще</li>
                                        <li>Устройство быстро разряжается и заряжается</li>
                                        <li>Устройство неравномерно показывает процент заряда</li>
                                        <li>Устройство выдаёт ошибки во время подключения к ЗУ</li>
                                    </ol>
                                </div>
                                <div class="text-warn"><span style="display: block; margin-left: 20px;">В этом случае можно попробовать заменить батарейку, т.к. аккумулятор вещь недолговечная и часто выходит из строя, вызывая сбои и неисправности в телефоне. Но и это не обещает исцелению аппарата.</span></div>
                            </div>
                            <div class="margin a-four">
                                <h4>Проблемы с операционной системой устройства:</h4>
                                <div style="display: flex; margin-top: 15px; align-items: center; flex-wrap: wrap; justify-content: center;">
                                    <ol style="margin: 40px; margin-top: 0;">
                                        <li>Аппарат сильно глючит и долго открывает нужные приложения, проги или игры</li>
                                        <li>Аппарат после перезагрузки или выключения очень долго грузит ОС или вообще не может её загрузить</li>
                                        <li>При включении на экране нет никаких признаков жизни кроме подсветки экрана</li>
                                        <li>Нужные вам приложения вдруг перестали открываться или неправильно работать</li>
                                        <li>Аппарат выдаёт ошибки на запрашиваемые вами команды или сам посебе</li>
                                    </ol>
                                    <img src="assets/css/img/images/1414068196[1].png" alt="drowning-water" width="200" height="200" style="border-radius: 15px; right: 0;">
                                </div>
                                <div class="text-warn"><span style="display: block; margin-left: 20px;">В данном случае можно попробовать комбинацию клавиш Hard Reset (жёсткое форматирование) ОС (для каждого устройства свой определённый набор клавиш инструкцию по сбросу которого можно найти в интернете). Все ваши данные на внутренней памяти устройства удалятся!</span></div>
                            </div>
                            <div class="margin a-warning">
                                <img src="assets/css/img/logos/OOjs_UI_icon_alert-warning.svg" alt="icon-warning" height="80">
                                <span style="font-family: Raleway-Bold;">ВНИМАНИЕ!<br>Указанные способы не всегда могут помочь устройству.</span>
                            </div>
                        </div>
                    </div>
                    <div key="about-us" class="about-us" v-if="currentPage === 'about-us'">
                        <div class="breadcrumbs">
                            <ul class="breadcrumb">
                                <li><a v-on:click="currentPage = 'main-page'">Главная</a></li>
                                <li>О нас</li>
                            </ul>
                        </div>

                        <div class="width-seventeen margin">
                            <h1>Услуги по ремонту сотовых телефонов</h1>
                            <p class="margin" style="font-size: 14pt;">Работаем с 20010 года. <br> Наш сервисный центр осуществляет послегарантийный ремонт различных моделей телефонов, смартфонов следующих производителей:</p>
                            <ul class="u-ul">
                                <li class="u-li">Apple iPhone</li>
                                <li class="u-li">Samsung</li>
                                <li class="u-li">Xiaomi</li>
                                <li class="u-li">Meizu</li>
                                <li class="u-li">Huawei</li>
                            </ul>
                            <div class="text-warn"><span style="display: block; margin-left: 20px;">Меняем стёкла на любых телефонах и планшетах, отдельно от дисплея, с применением профессионального оборудования по заводской технологии.</span></div>
                            <p class="margin" style="font-size: 14pt;">Курьер забирает телефон и привозит в наш сервис бесплатно по Владикавказу. Если нужен курьер в обратную сторону стоимость 300 руб. <br> Ремонт осуществляется с применением как оригинальных запчастей так и копий качества AAA не менее качественных. На все виды проведенного ремонта предоставляется гарантия. <br> В разделе Контакты указаны все координаты для связи с нашим сервисным центром. В этом разделе вы также сможете ознакомиться со схемой проезда в наш сервисный центр. Наши специалисты всегда рады помочь вашему мобильному устройству!</p>
                            <div class="text-warn"><span style="display: block; margin-left: 20px;">Проводится предварительная бесплатная диагностика устройства. <br> Основной перечень выполняемых ремонтных работ вы найдете в разделе, соответствующем вашей марке мобильного устройства. Если среди указанного списка устройств нет вашей модели свяжитесь с нами любым удобным для вас способом, и мы обязательно постараемся вам помочь.</span></div>
                            <p class="margin" style="font-size: 14pt;">Среднее время ремонта телефона в компонентных неисправностях занимает от 30-ти минут до2-х часов в зависимости от сложности поломки или проделываемой работы. <br><br> <span style="font-family: Raleway-Bold;">На более серьезные поломки, требующие  длительного выявления ремонт осуществляется от 1-ого дня до 1-ой недели. Диагностика в нашем сервисном центре бесплатная даже при отказе от ремонта.</span></p>
                            <div style="display: flex; width: 80%; margin: 20px auto 0 auto; justify-content: center; flex-wrap: wrap;">
                                <img src="assets/css/img/images/1.jpg" alt="foto" width="400" height="250" style="border-radius: 30px; margin: 10px;">
                                <img src="assets/css/img/images/3.jpg" alt="foto" width="400" height="250" style="border-radius: 30px; margin: 10px;">
                            </div>
                        </div>
                    </div>
                    <div key="guarantee" class="guarantee" v-if="currentPage === 'guarantee'">
                        <div class="breadcrumbs">
                            <ul class="breadcrumb">
                                <li><a v-on:click="currentPage = 'main-page'">Главная</a></li>
                                <li>О нас</li>
                            </ul>
                        </div>

                        <div class="width-seventeen margin">
                            <h1>Гарантия</h1>
                            <p class="margin" style="font-size: 14pt;">Гарантийный ремонт осуществляется каждый день кроме Субботы и Воскресенья. <br><br> Дисплеи и Тачскрины со следами падений, трещин, придавливаний, нагревов, сильных царапин, самостоятельного разбора, бесплатной гарантийной замене НЕ ПОДЛЕЖАТ. <br><br> Замена мелких деталей таких как разговорные микрофоны, слуховые и полифонические динамики, межплатные шлейфы, компонентные шлейфы 2 недели. <br> Прошивка и обновление программного обеспечения, русификация , разлочка под оператора, снятие защитных кодов телефона без гарантии. <br><br> Самостоятельный разбор, падение телефона на твёрдую поверхность, затопление телефона жидкостями, сильный нагрев телефона, явные повреждения на корпусе, автоматически СНИМАЕТ ГАРАНТИЮ на произведённую работу и заменяемую деталь.</p>
                            <div class="text-warn">
                                <ul style="display: block; width: 90%; margin: 0 auto;">
                                    <li>На все выполненные работы в нашем сервисном центре по ремонту сотовых телефонов, смартфонов или iPhone наша организация предоставляет гарантию от 2-х недель.</li>
                                    <li>Замена экранов, сенсоров и стёкол для телефонов гарантия 14 дней. </li>
                                    <li>Пайка системных разъёмов, перекатка микросхем, восстановление шлейфов, системных коннекторов, наплатных кнопок, восстановление материнских плат 2 недели.</li>
                                    <li>На телефоны которые восстановили после воды гарантия не распростроняется.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div key="contacts" class="contacts" v-if="currentPage === 'contacts'">
                        <div class="breadcrumbs">
                            <ul class="breadcrumb">
                                <li><a v-on:click="currentPage = 'main-page'">Главная</a></li>
                                <li>Контакты</li>
                            </ul>
                        </div>

                        <div class="width-seventeen margin">
                            <h1>Контакты</h1>
                            <div class="margin" style="display: flex; flex-wrap: wrap; justify-content: space-around;">
                                <div>
                                    <h3>Информация:</h3>
                                    <span style="margin-top: 20px;">Владикавказ, <br>Армянская ул.,38,<br>Компьютерный корпус</span>
                                    <span>Телефон: +7 (495) 896-95-69 <br> Email: <a href="mailto:info@vladrepmob.ru">info@vladrepmob.ru</a> <br>Ежедневно с 10 до 20</span>
                                </div>
                                <div class="contacts-menu">
                                    <div style="margin: 0 auto 0 auto; background: rgb(235, 235, 235); padding: 20px;">
                                        <form method="POST" action="{{ route('Question') }}" enctype="multipart/form-data" class="form">
                                            @csrf
                                            <span style="font-size: 16pt; font-family: Raleway-Bold;">Задать вопрос</span>
                                            <p class="text-co">Ваше имя:</p>
                                            <input type="text" size="40" name="name" class="input-c"><br>
                                            <p class="text-co">Телефон для связи:</p>
                                            <input type="text" size="20" name="contact-number" class="input-c"><br>
                                            <p class="text-co">Ваш вопрос:</p>
                                            <textarea class="textarea-co" name="text-question" maxlength="200"></textarea><br>
                                            <button type="submit" class="button-co">Отправить</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div key="phone-repair" class="phone-repair" v-if="currentPage === 'phone-repair' && currentPhone === null && currentModel === null">
                        <div class="breadcrumbs">
                            <ul class="breadcrumb">
                                <li><a v-on:click="currentPage = 'main-page'">Главная</a></li>
                                <li>Ремонт телефонов</li>
                            </ul>
                        </div>

                        <div class="width-seventeen margin">
                            <h1>Ремонт телефонов и смартфонов</h1>
                            <p class="margin" style="font-size: 14pt;">Срочный ремонт сотовых телефонов и смартфонов в сервисном центре города Владикавказ, Армянская ул.,38.<br>Бесплатная диагностика и консультации +7 (495) 896-95-69<br>У нас большой опыт в ремонте телефонов iPhone, Samsung, Xiaomi, Meizu, Huawei. Предоставляем услугу курьера и подменный телефон на время ремонта.</p>
                            <div>
                                <div class="pr-list-phones margin" v-for="(phone, idP) in phones" style="display: flex; margin-top: 40px;">
                                    <img :src="phone.imageCompany" alt="image-company" :width="phone.widthLogo" :height="phone.heightLogo" v-on:click="currentPhone = idP;">
                                    <div class="imgs-ph-mod" v-for="(model, idM) in phone.models" style="width: 60%;">
                                        <img class="margin" :src="model.imgModel" alt="image-model" width="50" height="67" v-on:click="currentPhone = idP; currentModel = idM">
                                        <a class="margin" v-on:click="currentPhone = idP; currentModel = idM">@{{ model.nameModel }}</a>
                                    </div>
                                    <a style="width: 20%;" v-on:click="currentPhone = idP;">Другие модели @{{ phone.name }}</a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div key="phone-models" class="phone-models" v-if="currentPage === 'phone-repair' && currentPhone !== null && currentModel === null">
                        <div class="breadcrumbs">
                            <ul class="breadcrumb">
                                <li><a v-on:click="currentPage = 'main-page'">Главная</a></li>
                                <li><a v-on:click="currentPage = 'phone-repair'; currentPhone = null; currentModel = null; typeRepair = 0">Ремонт телефонов</a></li>
                                <li>@{{ phones[currentPhone].name }}</li>
                            </ul>
                        </div>
                        <div class="width-seventeen margin">
                            <h1>Ремонт телефонов @{{ phones[currentPhone].name }} в день обращения</h1>
                            <p class="margin" style="font-size: 14pt;">Сервисный центр по ремонту телефонов @{{ phones[currentPhone].name }}: замена стекла отдельно от дисплея, экрана, тачскрина, аккумулятора, разъема питания (зарядки), задней крышки, динамиков, микрофона, ремонт после воды.<br>Срочный ремонт @{{ phones[currentPhone].name }} в Владикавказе. Большинство работ занимает не более одного часа, услуги курьера, собственный склад запчастей, подменный телефон.<br>Бесплатная диагностика и консультация по ремонту, звоните: +7 (495) 896-95-69</p>
                            <button class="leave-request margin" v-on:click="callback = true">Оставить заявку</button>
                            <div class="margin">
                                <h2>Выберите вашу модель</h2>
                                <div class="p-m-list-models">
                                    <div v-for="(model, idM) in phones[currentPhone].models">
                                        <p class="margin" style="text-align: center;"><img :src="model.imgModel" alt="image-model" width="50" height="67" v-on:click="currentModel = idM"></p>
                                        <a class="margin" v-on:click="currentModel = idM">@{{ model.nameModel }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="phone-models-price margin">
                                <h2>Цены на ремонт @{{ phones[currentPhone].name }}</h2>
                                <table style="width: 70%; margin: 20px auto 0 auto; border-collapse: collapse;">
                                    <tr style="background-color: rgb(228, 228, 228);"> <td>Вид работ</td> <td>Стоимость работ</td></tr>
                                    <tr> <td>Диагностика</td> <td>Бесплатно</td> </tr>
                                    <tr v-for="li in typesRepair"> 
                                        <td>@{{ li.name }}</td> <td>@{{ li.price }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div key="model-phone" class="model-phone" v-if="currentPage === 'phone-repair' && currentPhone !== null && currentModel !== null">
                        <div class="breadcrumbs">
                            <ul class="breadcrumb">
                                <li><a v-on:click="currentPage = 'main-page'">Главная</a></li>
                                <li><a v-on:click="currentPage = 'phone-repair'; currentPhone = null; currentModel = null; typeRepair = 0">Ремонт телефонов</a></li>
                                <li><a v-on:click="currentModel = null; typeRepair = 0">@{{ phones[currentPhone].name}}</a></li>
                                <li>@{{ phones[currentPhone].models[currentModel].nameModel}}</li>
                            </ul>
                        </div>
                        <div class="width-seventeen margin" id="phone-rep-desc">
                            <h1>Ремонт @{{ phones[currentPhone].models[currentModel].nameModel}} в день обращения</h1>
                            <p class="margin" style="font-size: 14pt;">Сервисный центр по ремонту @{{ phones[currentPhone].models[currentModel].nameModel}}: замена стекла, экрана, ремонт после воды, не заряжается, быстро разряжается, не включается, ремонт кнопки включения, замена задней крышки, аккумулятора, разъёма зарядки.<br>Профессиональное оборудование и опытные мастера, смогут переклеить разбитое стекло отдельно от дисплея в день обращения!<br>Бесплатная диагностика и консультации по телефону</p>
                            <div class="phone margin">
                                <img :src="phones[currentPhone].models[currentModel].imgModel" alt="image-phone" width="150">
                                <div class="phone-text">
                                    <transition name="fade" mode="out-in">
                                        <div v-for="(type, idT) in typesRepair" :key="idT" v-if="typeRepair === idT">
                                            <h1>@{{ type.name }}</h1>
                                            <p class="margin"> @{{ type.description }}</p>
                                            <ul class="margin" style="margin-left: 20px;">
                                                <li>@{{ type.price }}</li>
                                                <li v-if="type.info_one !== null">@{{ type.info_one }}</li>
                                                <li v-if="type.info_two !== null">@{{ type.info_two }}</li>
                                            </ul>
                                        </div>
                                    </transition>
                                    <button class="leave-request margin" v-on:click="callback = true">Заказать ремонт</button>
                                </div>
                            </div>
                            <div class="list-types margin">
                                <button class="type-repair" v-for="(type, idT) in typesRepair" v-on:click="typeRepair = idT" v-bind:class="{ activeButton: idT === typeRepair}"><a href="#phone-rep-desc" style="text-decoration: none; color: black;">@{{ type.name }}</a></button>
                            </div>
                            <div class="phone-models-price-two margin">
                                <h2>Цены на ремонт @{{ phones[currentPhone].models[currentModel].nameModel }}</h2>
                                <table style="width: 70%; margin: 20px auto 0 auto; border-collapse: collapse;">
                                    <tr style="background-color: rgb(228, 228, 228);"> <td>Вид работ</td> <td>Стоимость работ</td> <td>Описание</td></tr>
                                    <tr> <td>Диагностика</td> <td>Бесплатно</td> <td>Диагностика бесплатная даже при отказе от ремонта</td></tr>
                                    <tr v-for="li in typesRepair"> 
                                        <td>@{{ li.name }}</td> 
                                        <td>@{{ li.price }}</td>
                                        <td>@{{ li.description }}</td>
                                    </tr>
                                </table>
                                <div class="text-warn"><span style="display: block; margin-left: 20px; font-size: 13pt;">В списке представлены основные ремонтные процедуры, проводимые с @{{ phones[currentPhone].models[currentModel].nameModel }}. Что бы выполнить ремонт @{{ phones[currentPhone].models[currentModel].nameModel }} вы можете подъехать в наш сервисный центр, либо заказать бесплатного курьера по Владикавказу. Гарантия на все выполненные работы. Цены указаны за работу без учета стоимости запчастей.</span></div>
                                <div class="margin">
                                    <h2>Выберите вашу модель</h2>
                                    <div class="p-m-list-models">
                                        <div v-for="(model, idM) in phones[currentPhone].models">
                                            <p class="margin" style="text-align: center;"><a href="#phone-rep-desc"><img :src="model.imgModel" alt="image-model" width="50" height="67" v-on:click="currentModel = idM"></a></p>
                                            <a href="#phone-rep-desc" class="margin" v-on:click="currentModel = idM">@{{ model.nameModel }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </transition>
            </div>
            <div class="margin map">
                <div>
                    <h4 style="margin: 10px 0 0 0px;">Информация:</h4>
                    <span style="margin-top: 20px;">Владикавказ, <br>Армянская ул.,38,<br>Компьютерный корпус</span>
                    <span>Телефон: +7 (495) 896-95-69 <br> Email: <a href="mailto:info@vladrepmob.ru">info@vladrepmob.ru</a> <br>Ежедневно с 10 до 20</span>
                </div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1458.4756804679432!2d44.687466850657096!3d43.02141093800086!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x405aa081168e643f%3A0xdb308a9281f033c6!2z0JDRgNC80Y_QvdGB0LrQsNGPINGD0LsuLCAzOCwg0JLQu9Cw0LTQuNC60LDQstC60LDQtywg0KDQtdGB0L8uINCh0LXQstC10YDQvdCw0Y8g0J7RgdC10YLQuNGPLdCQ0LvQsNC90LjRjywg0KDQvtGB0YHQuNGPLCAzNjIwMDc!5e0!3m2!1sru!2sro!4v1638010590138!5m2!1sru!2sro" style="border:0; width: 100%; height: 100%; z-index: 1;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
        <div class="footer">
            <div class="width-seventeen" style="margin: 0 auto; display: flex; flex-wrap: wrap; justify-content: space-around;">
                <div class="f-copyright">
                    <span class="f-text">Владикавказкий ремонтный сервис - профессиональный ремонт мобильных телефонов в короткие сроки с качественным обслуживанием</span>
                    <a href="mailto:info@vladrepmob.ru">info@vladrepmob.ru</a>
                </div>
                <div class="f-address">
                    <span class="f-text">Владикавказ, Армянская ул.,38, Компьютерный корпус<br>Телефон: +7 (495) 896-95-69</span>
                    <span>Ежедневно с 10 до 20</span>
                </div>
                <div class="f-links">
                    <span class="f-text" style="font-size: 11pt; margin-bottom: 10px; font-family: Raleway-Bold; ">Связь:</span>
                    <a href="http://facebook.com" style="font-size: 11pt;">Facebook</a><br>
                    <a href="http://vk.com" style="font-size: 11pt;">Vk</a><br>
                    <a href="http://instagram.com" style="font-size: 11pt;">Instagram</a><br>
                </div>
            </div>
        </div>
    </div>
    {{-- <script src="{{ asset('assets/js/app.js') }}" defer></script> --}}
</body>
</html>