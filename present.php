<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . "/function.php";
if (isset($_SESSION['nickname']) && !empty($_SESSION['nickname'])):
$function = new Functions();
?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/main.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://cdn.rawgit.com/kimmobrunfeldt/progressbar.js/0.5.6/dist/progressbar.js"></script>
    <script src="/js/progressbar.js"></script>
    <title>Вознаграждения » NetherCraft Project</title>
</head>
<body>
<div id="nether_info_block"></div>
<header>
    <div class="container-fluid account-header">
        <!--Navigation-->
        <div class="row justify-content-around rounded">
            <div class="col text-center" style="margin-left: 220px">
                <a class="navigation-menu" href="/">Главная</a>
                <a class="navigation-menu" href="/forum">Форум</a>
                <a class="navigation-menu" href="/donate">Донат</a>
                <a class="navigation-menu" href="/shop">Магазин</a>
                <a class="navigation-menu" href="/account/index.php">Профиль</a>
                <a class="navigation-menu" href="https://vk.com/im?sel=-201581240">Помощь</a>
            </div>
        </div>
    </div>
</header>
<div class="container-fluid">
    <div class="row justify-content-center align-items-center" style="margin-top: 50px">
        <div class="col-2 text-center" style="margin: 20px">
            <div id="mcrate" class="text-center" style="height: 180px; width: 180px;"></div>
            <div style="margin-top: -105px;">
                <a href="http://mcrate.su/project/9266">
                    <img src="images/mcrate.png" alt=""><br>
                </a>
            </div>
            <div class="present text-center" style="margin-top: 90px; cursor: pointer">
                <div class="text" style="font-size: 15px; text-decoration: none; padding-top: 21px; text-underline: none;" onclick="TakeGift(1)"><img src="images/present.png" alt="Подарочек" style="padding-right: 6px; margin-top: -5px">Получить бонус</div>
            </div>
        </div>
        <div class="col-2 text-center" style="margin: 20px">
            <div id="mctop" class="text-center" style="height: 180px; width: 180px;"></div>
            <div style="margin-top: -105px;">
                <a href="https://mctop.su/servers/6425/">
                    <img src="https://mctop.su/media/projects/6425/tops.png">
                </a>
            </div>
            <div class="present text-center" style="margin-top: 90px; cursor: pointer">
                <div class="text" style="font-size: 15px; text-decoration: none; padding-top: 21px; text-underline: none;" onclick="TakeGift(2)"><img src="images/present.png" alt="Подарочек" style="padding-right: 6px; margin-top: -5px">Получить бонус</div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center align-items-center" style="margin-top: 30px; font-family: NetherCraft_Menu; text-align: center; font-size: 20px">
        Голосуя каждый день в топах в течение 7 дней, Вы получаете возможность забрать особые бонусы.<br>
        О доступности бонуса Вам подскажет шкала вокруг иконки топа.
    </div>
    <div class="row justify-content-around" style="z-index: 1000;">
        <div class="col-8 text-center col-centered background-label-lk blocks-lk text" style="font-size: 20px; padding: 22px 30px 0 30px">
            <p class="ml-3" style="float: left;">Наборы</p>Бонусы<p class="mr-3" style="float: right">Голосов: <?$function->Get_Votes()?></p>
        </div>
    </div>
    <div class="row justify-content-around">
        <div class="col-8 rectangle" style="z-index: 4; margin-top: -40px;">
            <div class="shadow p-4" style="margin: 20px 10px 10px 10px">
                <div class="row text-center" id="gifts">

                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-around rounded" style="margin-top: 100px; height: 600px">
        <div class="col-12">
            <div class="text text-center" style="color: black;">
                Топы сервера
            </div>
        </div>
        <div class="col-6">
            <div class="top_server1 block">
                <span class="text time-top">ТОП ВРЕМЕНИ<img class="image_top" src="images/top/green_line.png" alt=""></span>
                <div class="player head">
                    <div class="place" style="padding-top: 0px;">
                        Место
                    </div>
                    <div class="nickname">
                        Пользователь
                    </div>
                    <div class="time" style="padding-top: 0px;">
                        Время
                    </div>
                </div>
                <?php
                $key = 1;
                $result = $function->SortArrayHours();
                foreach($result as $row){
                    if($key == 11){
                        break;
                    }
                    echo '<div class="player">
                                <div class="place">
                                    <span>'.$key.'</span>
                                </div>
                                <div class="nickname">
                                    <img src="events.php?u='.$row['0'].'&s=40&v=f" alt="">
                                    <span class="title_name">'.$row['2'].'</span>
                                </div>
                                <div class="time">
                                    <img width="15" height="15" src="images/top/chasiki.png" alt="">
                                    <span class="title_name">'.$row['1'].' ч</span>
                                </div>
                            </div>';
                    $key++;
                }?>
            </div>
        </div>
        <div class="col-6">
            <div class="top_server2  block2">
                <span class="text time-top2">ТОП ГОЛОСУЮЩИХ<img class="image_top2" src="images/top/orange_line.png" alt=""></span>
                <div class="player head">
                    <div class="place" style="padding-top: 0px;">
                        Место
                    </div>
                    <div class="nickname">
                        Пользователь
                    </div>
                    <div class="time" style="padding-top: 0px;">
                        Голоса
                    </div>
                </div>
                <?php
                $votes = $function->SortArrayVotes();
                $key = 1;
                foreach($votes as $row){
                    if($key == 11){
                        break;
                    }
                    if($row['20'] == ''){$row['20'] = '0';}
                    echo '<div class="player">
                            <div class="place">
                                <span>'.$key.'</span>
                            </div>
                            <div class="nickname">
                                <img src="events.php?u='.$row['0'].'&s=40&v=f" alt="">
                                <span class="title_name">'.$row['2'].'</span>
                            </div>
                            <div class="time">
                                <span class="title_name">'.$row['3'].'</span>
                            </div>
                        </div>';
                    $key++;
                }?>
            </div>
        </div>
    </div>
    <div class="row justify-content-around rounded bg3" style="margin-top: 350px; height: 600px">
        <div class="col-6 text-center">
            <img src="images/logo.png" width="300" alt="" style="margin-top: 370px; margin-left: -240px;">
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
</body>
<?php else: Header("Location: https://nethercraft.fun/error")?>

<?php endif;?>