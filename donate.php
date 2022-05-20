<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/main.css">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="js/three.min.js"></script>
    <script src="js/skin.min.js"></script>
    <script src="js/ajax.js"></script>
    <title>Список возможности игроков Диббук, Ларайе, Сатана » NetherCraft Project</title>
</head>
<body>
<header>
    <div class="container-fluid account-header">
        <!--Navigation-->
        <div class="row justify-content-around rounded">
            <div class="col text-center" style="margin-left: 220px">
                <a class="navigation-menu" href="/">Главная</a>
                <a class="navigation-menu" href="">Форум</a>
                <a class="navigation-menu" href="/shop">Магазин</a>
                <a class="navigation-menu" href="/account/index">Профиль</a>
                <a class="navigation-menu" href="https://vk.com/im?sel=-201581240">Помощь</a>
            </div>
        </div>
    </div>
</header>
<div class="container-fluid">
    <div class="row" style="margin: 0 300px">
        <div class="col-12" id="donate_table">
            <table class="table">
                <thead>
                    <tr>
                        <th style="vertical-align: middle">Возможности</th>
                        <th style="color: green; text-align: center">
                            <img src="/images/account/dibbyk.png" alt="" width="10" height="30" class="fr-fic fr-dii" style="height: auto;"><br>
                            Диббук
                        </th>
                        <th style="color: orange; text-align: center">
                            <img src="/images/account/laraye.png" alt="" width="10" height="30" class="fr-fic fr-dii" style="height: auto"><br>
                            Ларайе
                        </th>
                        <th style="color: red; text-align: center">
                            <img src="/images/account/satana.png" alt="" width="10" height="30" class="fr-fic fr-dii" style="height: auto"><br>
                            Сатана
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4">
                            <b>Киты</b><br>
                            Вспомогательные наборы
                            <b>(/kit)</b><br>
                        </td>
                    </tr>
                    <tr>
                        <td data-target="#dibbyk" data-toggle="modal" style="cursor: pointer">
                            <img src="images/donate/info.png" width="20" alt="" class="fr-fic fr-dii mr-2" style="margin: 0">
                            <b>/kit dibbyk</b>
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                    </tr>
                    <tr>
                        <td data-target="#laraye" data-toggle="modal" style="cursor: pointer">
                            <img src="images/donate/info.png" width="20" alt="" class="fr-fic fr-dii mr-2" style="margin: 0">
                            <b>/kit laraye</b>
                        </td>
                        <td>
                            <img src="images/donate/no.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                    </tr>
                    <tr>
                        <td data-target="#satana" data-toggle="modal" style="cursor: pointer">
                            <img src="images/donate/info.png" width="20" alt="" class="fr-fic fr-dii mr-2" style="margin: 0">
                            <b>/kit satana</b>
                        </td>
                        <td>
                            <img src="images/donate/no.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/no.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Префикс</b><br>
                            Возможность установки индивидуального префикса перед ником
                        </td>
                        <td>
                            <span style="font-weight: bold; color: green; vertical-align: middle">
                                [Диббук]
                            </span>
                        </td>
                        <td>
                            <span style="font-weight: bold; color: orange; vertical-align: middle">
                                [Ларайе]
                            </span>
                        </td>
                        <td>
                            <span style="font-weight: bold; color: red; vertical-align: middle"">
                                [Сатана]
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Иммунитет к исключению с сервера</b><br>
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Полет</b><br>
                            Доступ к команде <b>(/gfly)</b>
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Доступ к отдельному чату для данной привилегии</b><br>
                        </td>
                        <td>
                            <b>/dibbyk</b>
                        </td>
                        <td>
                            <b>/laraye</b>
                        </td>
                        <td>
                            <b>/satana</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Вход на заполненный сервер</b><br>
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Позиционирование на карте</b><br>
                            Команды <b>(/compass)</b> и <b>(/getpos)</b>
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Прыжок</b><br>
                            Прыжок на заданную высоту <b>(/jump)</b>
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Количество домов</b><br>
                            Команды <b>/sethome (название)</b> и <b>/home (название)</b>
                        </td>
                        <td style="vertical-align: middle">
                            <b>2</b>
                        </td>
                        <td style="vertical-align: middle">
                            <b>4</b>
                        </td>
                        <td style="vertical-align: middle">
                            <b>6</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Смерть</b><br>
                            Команда, чтобы убить себя <b>(/slay)</b>
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Телепортация</b><br>
                            Возможность телепортироваться к другим игрокам <b>(/tpa)</b>
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Потушить себя</b><br>
                            Если Вы горите, то можете потушить себя <b>(/ext)</b>
                        </td>
                        <td>
                            <img src="images/donate/no.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Пополнение здоровья и еды</b><br>
                            Команды: <b>(/heal)</b> и <b>(/feed)</b>. <i>Задержка 15 минут</i>
                        </td>
                        <td>
                            <img src="images/donate/no.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Фейерверки</b><br>
                            Возможность получения фейерверков  <b>(/firework)</b>
                        </td>
                        <td>
                            <img src="images/donate/no.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Общение</b><br>
                            Доступ к командам <b>(/me)</b> и <b>(/ignore)</b>
                        </td>
                        <td>
                            <img src="images/donate/no.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Удаленный крафт</b><br>
                            Доступ к команде <b>(/craft)</b>
                        </td>
                        <td>
                            <img src="images/donate/no.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Сохранение опыта и предметов после смерти </b><br>
                        </td>
                        <td>
                            <img src="images/donate/no.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Скорость полета в режиме /gfly</b><br>
                            Команда <b>(/gflyspeed)</b>
                        </td>
                        <td>
                            <img src="images/donate/no.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Иммунитет к муту</b><br>
                        </td>
                        <td>
                            <img src="images/donate/no.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Иммунитет к предупреждению</b><br>
                        </td>
                        <td>
                            <img src="images/donate/no.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Телепорт к своему региону</b><br>
                            Команда: <b>/region teleport (регион)</b>
                        </td>
                        <td>
                            <img src="images/donate/no.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Возможность изменения флагов своего региона</b><br>
                            Команда: <b>/region flag (регион)</b>.
                        </td>
                        <td colspan="3">
                            <div data-toggle="modal" data-target="#flags" style="cursor: pointer; margin-top: 10px">
                                <img src="images/donate/info.png" width="20" alt="" class="fr-fic fr-dii mr-2" style="margin: 0">
                                <b>Значение флагов</b>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Удаленный эндер-сундук</b><br>
                            Команда: <b>(/enderchest)</b>
                        </td>
                        <td>
                            <img src="images/donate/no.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/no.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Неограниченное использование /heal и /feed</b><br>
                        </td>
                        <td>
                            <img src="images/donate/no.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/no.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Своя погода и время</b><br>
                            Команды: <b>(/pweather)</b> и <b>(/ptime)</b>
                        </td>
                        <td>
                            <img src="images/donate/no.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/no.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Посмотреть список ВСЕХ регионов</b><br>
                            Команда: <b>(/rg list)</b>
                        </td>
                        <td>
                            <img src="images/donate/no.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/no.png" alt="" class="fr-fic fr-dii">
                        </td>
                        <td>
                            <img src="images/donate/yes.png" alt="" class="fr-fic fr-dii">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row justify-content-around rounded bg3" style="margin-top: 100px; height: 600px">
        <div class="col-6 text-center">
            <img src="/images/logo.png" width="300" alt="" style="margin-top: 370px; margin-left: -240px;">
        </div>
        <div class="col-6" style="margin-top: 360px; margin-left: -30px;">
            <div class="col-12" style="padding-left: 90px;"><span class="text text-center" style="font-size: 21px;">© 2021 NETHERCRAFT.FUN</span></div>
            <div class="col-12" style="margin-top: 40px;margin-left: -150px;">
                <span class="text" style="font-size: 21px;">ИНФОРМАЦИЯ</span><br>
                <span class="text" style="font-family: NetherCraft_Menu; font-size: 16px;">Наш проект не имеет никакого отношения к Mojang AB. Все пожертвования являются добровольными, идут на улучшение проекта и средства за них не могут быть возвращены.</span>
            </div>
        </div>
    </div>
</div>
<!-- Flags -->
<div class="modal fade" id="flags" tabindex="-1" role="dialog" aria-labelledby="flagstitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="flagstitle">Список флагов, которые можно устанавливать</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 3%">
                <b>Обычные игроки:</b><br>
                <span style="margin-left: 10px"><u>pvp</u> - включить/выключить режим PVP</span><br>
                <span style="margin-left: 10px"><u>explosion</u> - включить/выключить взрывы</span><br>
                <span style="margin-left: 10px"><u>blocks-interact</u> - список блоков, с которыми можно взаимодействовать</span><br>
                <br>
                <b>Диббук:</b><br>
                <span style="margin-left: 10px"><u>mob-spawning</u> - полный запрет спавна мобов</span><br>
                <span style="margin-left: 10px"><u>deny-spawn</u> - запретить отдельным мобам спавн</span><br>
                <br>
                <b>Ларайе:</b><br>
                <span style="margin-left: 10px"><u>mob-spawning</u> - полный запрет спавна мобов</span><br>
                <span style="margin-left: 10px"><u>deny-spawn</u> - запретить отдельным мобам спавн</span><br>
                <span style="margin-left: 10px"><u>allow-spawn</u> - разрешить отдельным мобам спавн</span><br>
                <br>
                <b>Сатана:</b><br>
                <span style="margin-left: 10px"><u>mob-spawning</u> - полный запрет спавна мобов</span><br>
                <span style="margin-left: 10px"><u>deny-spawn</u> - запретить отдельным мобам спавн</span><br>
                <span style="margin-left: 10px"><u>allow-spawn</u> - разрешить отдельным мобам спавн</span><br>
                <span style="margin-left: 10px"><u>invincible</u> - бессмертие в регионе</span><br>
                <br>
                <i><u>allow-spawn имеет приоритет над deny-spawn</u></i>
            </div>
        </div>
    </div>
</div>
<!--Dibbyk-->
<div class="modal fade" id="dibbyk" tabindex="-1" role="dialog" aria-labelledby="dibbykTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dibbykTitle">Набор предметов: Диббук</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 3%">
                <div class="text-center"><img src="images/donate/dibbyk.png" alt="" style="border-radius: 3px;"><br><br></div>
                <b>Зачарованные предметы:</b><br>
                <span style="margin-left: 10px"><b>Кожанный шлем</b> - Защита 2, Подводное дыхание 1</span><br>
                <span style="margin-left: 10px"><b>Кожанный нагрудник</b> - Защита 2</span><br>
                <span style="margin-left: 10px"><b>Кожанные поножи</b> - Защита 2</span><br>
                <span style="margin-left: 10px"><b>Кожанные ботинки</b> - Защита 2</span><br>
                <span style="margin-left: 10px"><b>Железный меч</b> - Острота 1</span><br>
                <span style="margin-left: 10px"><b>Железная кирка</b> - Эффективность 1</span><br>
                <span style="margin-left: 10px"><b>Каменный топор</b> - Эффективность 1</span>
                <br>
                <br>
                <i><u>Задержка 24 часа</u></i>
            </div>
        </div>
    </div>
</div>

<!--Laraye-->
<div class="modal fade" id="laraye" tabindex="-1" role="dialog" aria-labelledby="larayeTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="larayeTitle">Набор предметов: Ларайе</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 3%">
                <div class="text-center"><img src="images/donate/laraye.png" alt="" style="border-radius: 3px;"><br><br></div>
                <b>Зачарованные предметы:</b><br>
                <span style="margin-left: 10px"><b>Кожанный шлем</b> - Защита 4, Подводное дыхание 1</span><br>
                <span style="margin-left: 10px"><b>Кожанный нагрудник</b> - Защита 4</span><br>
                <span style="margin-left: 10px"><b>Кожанные поножи</b> - Защита 4</span><br>
                <span style="margin-left: 10px"><b>Кожанные ботинки</b> - Защита 4</span><br>
                <span style="margin-left: 10px"><b>Железный меч</b> - Острота 3</span><br>
                <span style="margin-left: 10px"><b>Трезубец</b> - Верность 3, Тягун 2, Прочность 2</span>
                <br>
                <b>Зелья:</b><br>
                <span style="margin-left: 10px"><b>Зелье силы 2</b> - длительность 1:30</span><br>
                <span style="margin-left: 10px"><b>Взрывное зелье урона 2</b></span><br>
                <span style="margin-left: 10px"><b>Оседающее зелье регенерации</b> - длительность 0:45</span><br>
                <br>
                <i><u>Задержка 24 часа</u></i>
            </div>
        </div>
    </div>
</div>

<!--Satana-->
<div class="modal fade" id="satana" tabindex="-1" role="dialog" aria-labelledby="satanaTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="satanaTitle">Набор предметов: Сатана</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 3%">
                <div class="text-center"><img src="images/donate/satana.png" alt="" style="border-radius: 3px;"><br><br></div>
                <b>Зачарованные предметы:</b><br>
                <span style="margin-left: 10px"><b>Железный шлем</b> - Защита от снарядов 2, Защита 2, Шипы 2</span><br>
                <span style="margin-left: 10px"><b>Железный нагрудник</b> - Защита от снарядов 2, Защита 2, Шипы 2</span><br>
                <span style="margin-left: 10px"><b>Железные поножи</b> - Защита от снарядов 2, Защита 2, Шипы 2</span><br>
                <span style="margin-left: 10px"><b>Железные ботинки</b> - Защита от снарядов 2, Защита 2, Шипы 2</span><br>
                <span style="margin-left: 10px"><b>Алмазный меч</b> - Острота 3, Добыча 2, Заговор огня 2, Прочность 3</span><br>
                <span style="margin-left: 10px"><b>Лук</b> - Сила 5, Бесконечность, Огненные стрелы, Прочность 3</span><br>
                <span style="margin-left: 10px"><b>Арбалет</b> - Тройной выстрел, Быстрая зарядка 3</span><br>
                <br>
                <i><u>Задержка 24 часа</u></i>
            </div>
        </div>
    </div>
</div>
</body>
</html>

