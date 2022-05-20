<?php
require $_SERVER['DOCUMENT_ROOT']. "/function.php";
$database = new DataBase();
$function = new Functions();
session_start();
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta property="og:title" content="NetherCraft Project">
    <meta property="og:site_name" content="NetherCraft - лучший проект Minecraft">
    <meta property="og:url" content="https://nethercraft.fun">
    <meta property="og:description" content="NetherCraft Project - это проект Minecraft для игры с друзьями, удобным личным кабинетом и интересными квестами!">
    <meta property="og:image" content="/images/img_social.png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.min.js"></script>
    <script src="https://vk.com/js/api/openapi.js?168" type="text/javascript"></script>
    <link rel="stylesheet" href="css/main.css">
    <script src="js/login.js"></script>
    <script src="js/donate.js"></script>
    <script>
        function CopyToBuffer(){
            const textToCopy = 'play.nethercraft.fun'
            navigator.clipboard.writeText(textToCopy)
                .then(() => { alert(`Ip скопирован!`) })
                .catch((error) => { alert(`Copy failed! ${error}`) })
        }
    </script>
    <title>NetherCraft Project</title>
</head>
<body>
    <div class="bg1">
        <div class="container-fluid">
            <header>
                <!--Navigation-->
                <div class="row justify-content-around rounded">
                    <div class="col text-center">
                        <a class="navigation-menu" href="">Главная</a>
                        <a class="navigation-menu" href="/forum">Форум</a>
                        <a class="navigation-menu" href="/donate">Донат</a>
                        <a class="navigation-menu" href="/shop">Магазин</a>
                        <a class="navigation-menu" href="account/index.php">Личный кабинет</a>
                        <a class="navigation-menu" href="https://vk.com/im?sel=-201581240">Помощь</a>
                    </div>
                </div>
            </header>
            <!--Logo-->
            <div class="row justify-content-around rounded">
                <div class="col-4" style="margin: 300px 0 30px 0">
                    <div class="voters">
                        <h3 style="margin-left: 50px">ТОП <br>ГОЛОСУЮЩИХ</h3>
                        <ul class="players">
                        <?php
                        $votes = $function->SortArrayVotes();
                        $key = 0;
                        foreach($votes as $row){
                            if($key == 3){
                                break;
                            }
                            echo '<li>
                                <a href="/" class="color-text">
                                    <div class="cut-wrap">
                                        <div class="cut">
                                            <img src="events.php?u='.$row['0'].'&s=80&v=f" width="80" height="80" alt="1">
                                        </div>
                                    </div>
                                    <div class="player-name" style="padding-left: 10px">
                                        '.$row['2'].'
                                    </div>
                                </a>
                            </li>';
                            $key++;
                        }
                        ?>
                        </ul>
                        <h3 class="text-center" style="padding: 15px 0 0 25px">Голосуй и ты:</h3>
                        <ul class="text-center" style="margin-left: -30px">
                            <li>
                                <a href="http://mcrate.su/project/9266">
                                    <img src="images/mcrate.png" alt=""><br>
                                </a>
                            </li>
                            <li>
                                <a href="https://mctop.su/servers/6425/">
                                    <img src="https://mctop.su/media/projects/6425/tops.png">
                                </a>
                            </li>
                        </ul>
                        <br>
                        <a href="/present.php" style="text-decoration: none;"><div class="present text-center" style="margin-top: -15px">
                                <div class="text" style="font-size: 15px; text-decoration: none; padding-top: 21px; text-underline: none;"><img src="images/present.png" alt="Подарочек" style="padding-right: 6px; margin-top: -5px">Получить бонус</div>
                            </div>
                        </a>
                    </div>
                </div>
            <div class="col-4" style="height: 400px; width: 500px">
                <div style="position: absolute; left: 0; right: 0; margin-top: 20px;  margin-right: 50px">
                    <a href="/">
                        <div id="scene" data-relative-input="true" class="parallax" style="text-align: center; transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; position: relative; pointer-events: none;">
                            <div data-depth="0.08" style="transform: translate3d(-3px, -1.1px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;">
                                <img src="/images/Bezymyanny-6.png" style="margin-top: 0px; margin-right: 0px;" alt="">
                            </div>
                            <div data-depth="0.15" style="right: 0px; transform: translate3d(-9.1px, -3.2px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: absolute; display: block; left: 0px; top: 0px;">
                                <img src="/images/Bezymyanny-5.png" style="margin-top: 0px; margin-left: -10px;" alt="">
                            </div>
    <!--                        <div data-depth="0.10" style="transform: translate3d(-6.1px, -2.1px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: absolute; display: block; left: 0px; top: 0px;">-->
    <!--                            <img src="/images/Bezymyanny-7.png" style="margin-top: 65px; margin-left: 0px;" alt="">-->
    <!--                        </div>-->
    <!--                        <div data-depth="0.07" style="transform: translate3d(-6.1px, -2.1px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: absolute; display: block; left: 0px; top: 0px;">-->
    <!--                            <img src="/images/quads.png" style="width: 80%; height: 80%; margin: 80px; " alt="">-->
    <!--                        </div>-->
                        </div>
                    </a>
                    <script>
                        var scene = document.getElementById('scene');
                        var parallax = new Parallax(scene);
                    </script>
                    <div class="row text-center" style="margin-top: 20px">
                        <div class="col-4">
                            <img src="images/middle_index/players.png" alt="">
                            <div class="main_data">ИГРОКИ</div>
                            <?$server_info = $function->fetch_server_info("play.nethercraft.fun");?>
                            <div class="data_text"><?echo $server_info['players']?></div>
                        </div>
                        <div class="col-4">
                            <img src="images/middle_index/ip.png" alt="">
                            <div class="main_data ip" id="ipadress">PLAY.NETHERCRAFT.FUN</div>
                        </div>
                        <div class="col-4">
                            <img src="images/middle_index/top.png" alt="">
                            <div class="main_data">МАКС ИГРОКОВ</div>
                            <div class="data_text"><?echo $server_info['max_players']?></div>
                        </div>
                        <div class="col-12 text-center">
                            <div class="ip-text" style="cursor: pointer" onclick="CopyToBuffer()">
                                <img src="images/Kirka.png" alt="" style="position: relative; top: 22px; left: -10px">
                                <span class="text" style="font-size: 16px; position: relative; top: 25px;line-height: 2px">НАЧАТЬ ИГРУ</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="col-4" style="margin: 250px 0 30px 0">
                    <?
                    if(isset($_SESSION['nickname']) && !empty($_SESSION['nickname'])):?>
                        <div class="user_autorized">
                            <h3>ПРИВЕТ <?echo $_SESSION['nickname'];?></h3>
                            <img src="events.php?u=<?echo $_SESSION['nickname'];?>&s=60&v=f" alt="" class="">
                            <ul style="display: inline-block; font-size: 16px; margin: 15px 0 0 -7px;" class="text">
                                <li><a href="account/index.php" style="text-decoration: none">Личный кабинет</a></li>
                                <li>Уведомления</li>
                                <li><a href="logout.php" style="text-decoration: none">Выход</a></li>
                            </ul>
                            <!-- /.player -->
                        </div>
                    <?
                    else:
                    ?>
                    <div class="user">
                        <form id="autorize">
                            <h3>ВОЙТИ В ПРОФИЛЬ</h3>
                            <input name="login" id="login_name" class="login" type="text" onblur="javascript:if(this.value==''){this.value='Никнейм'};" onfocus="if(this.value=='Никнейм') {this.value='';}" value="Никнейм">
                            <input name="password" id="login_password" class="password" type="password" onblur="javascript:if(this.value==''){this.value='Пароль'};" onfocus="if(this.value=='Пароль') {this.value='';}" value="Пароль">
                            <button type="submit"></button>
                            <a class="forgot" href="/recovery">Забыли?</a>
                        </form>
                        <!-- /.player -->
                    </div>
                    <? endif;?>
                </div>
        </div>
            <!--News-->
            <?
            $function->News();
            ?>
            <!--Social-->
                <div class="row justify-content-around rounded bg2" style="margin-top: 50px;">
                    <div class="col-6 text-center">
                        <div class="text" style="color: black; margin: 230px 0 10px 0;">DISCORD</div>
                        <iframe src="https://discord.com/widget?id=802906194842615858&theme=dark" width="350" height="500" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
                    </div>
                    <div class="col-6 text-center">
                        <div class="text" style="margin: 230px 0 10px 0;">МЫ ВКОНТАКТЕ</div>
                        <div id="vk_groups" class="text-center"></div>
                        <script type="text/javascript">
                            VK.Widgets.Group("vk_groups", {mode: 4, width: "300", height: "400"}, 201581240);
                        </script>
                    </div>
                </div>
            <!--Top-->
            <div class="row justify-content-around rounded" style="margin-top: 300px; height: 600px">
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
            <div class="row justify-content-around rounded bg3" style="margin-top: 500px; height: 600px">
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
    </div>
    <div class="popup"></div>
    <div id="nether_info_block"></div>
    <footer>
    </footer>
</body>
</html>