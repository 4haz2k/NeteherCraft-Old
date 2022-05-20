<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']. "/function.php";
if(isset($_SESSION['nickname']) && !empty($_SESSION['nickname'])):
    $operator = new Functions(); ?>
    <!doctype html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/main.css">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        <script src="https://widget.unitpay.money/unitpay.js"></script>
        <script src="../js/three.min.js"></script>
        <script src="../js/skin.min.js"></script>
        <script src="../js/ajax.js"></script>
        <script src="../js/main.js"></script>
        <script src="../js/data.js?version=2.2.3"></script>
        <script src="../js/donate.js"></script>
        <script type="text/javascript">
            function select_status(element) {
                var element = $(element);
                $('#selected_duration').removeAttr('style');
                $('#selected_duration').attr('id', '');
                $('#lk-final-group-price').html('');
                $('#selected_status').css("opacity", "0.5");
                $('#selected_status').attr('id', '');
                element.css("opacity", "1");
                element.attr('id', 'selected_status');
                $('#buy_button').attr('onclick', 'LkAjax.group_buy(\'' + element.attr('status') + '\');');
                $("#group-price").html(null);
                $("#group-duration").html(null);
            }
            function storage(){
                window.location.href = "/storage";
            }
        </script>
        <title>Личный кабинет: <?echo $_SESSION['nickname']?> » NetherCraft Project</title>
    </head>
    <header>
        <div class="container-fluid account-header">
        <!--Navigation-->
                <div class="row justify-content-around rounded">
                    <div class="col text-center" style="margin-left: 220px">
                        <a class="navigation-menu" href="/">Главная</a>
                        <a class="navigation-menu" href="/forum">Форум</a>
                        <a class="navigation-menu" href="/donate">Донат</a>
                        <a class="navigation-menu" href="/shop">Магазин</a>
                        <a class="navigation-menu" href="https://vk.com/im?sel=-201581240">Помощь</a>
                        <a class="navigation-menu" href="../logout.php">Выход</a>
                    </div>
                </div>
        </div>
    </header>
    <body>
    <div id="nether_info_block"></div>
        <div class="container-fluid">
            <div class="row justify-content-around rounded">
                <div class="col-1 text-center p-3 blocks-lk">
                    <a href="/present" style="text-decoration: none;">
                        <div class="present text" style="padding-top: 13px; font-size: 20px">Подарки</div>
                    </a>
                </div>
                <div class="col-5 text-center account-label p-3 blocks-lk text" style="font-size: 22px">
                    <div class="account_label_text">Личный кабинет</div>
                </div>
                <div class="col-1 text-center p-3 blocks-lk">
                    <a href="/shop" style="text-decoration: none;">
                        <div class="present text" style="padding-top: 13px; font-size: 20px">Магазин</div>
                    </a>
                </div>
            </div>
            <div class="row justify-content-around rounded">

                <div class="col-4 rectangle h-100">
                    <div class="shadow p-3" style="margin: 20px 10px 10px 10px">
                        <div class="col-12"><p class="text-center account-label-lk text" style="font-size: 16px; padding-top: 19px;">Никнейм: <?echo $_SESSION['nickname']?></p></div>
                        <div class="text-center" id="skinViewerContainer"></div>
                        <div class="form-group col-md-5 text-center">
                            <form id="uploadSkinForm" enctype="multipart/form-data">
                                <div class=" account_text text-center" style="padding-top: 7px;">
                                    <button id='button' class="account_button4" style="color: white;">Выбрать скин</button>
                                    <button id='button_upload' class="account_button2" style="color: white; margin-top: 10px">Установить скин</button>
                                </div>
                                <input id="input-file" class="form-control-file" style="text-align:center" name="file" type="file" accept="image/*" required>
                            </form>
                        </div>
                        <p style="text-align: center;font-size: 18px"><b>Информация об аккаунте:</b></p>
                        <p style="text-align: center;font-size: 16px">Дата регистрации: <?php $operator->GetRigistraionTime()?></p>
                        <p style="text-align: center;font-size: 16px">Наиграно за все время: <?php $operator->GetTime()?></p>

                    </div>
                </div>
                <div class="col-4 rectangle">
                    <div class="shadow p-3 " style="margin: 20px 10px 10px 10px">
                        <div class="row text-center">
                            <div class="col-4 account_text" style="padding-top: 5px;"><button onclick="GetMain();" class="account_button1" style="color: white">Основные</button></div>
                            <div class="col-4 account_text" style="padding-top: 5px;"><button onclick="GetStatus();" class="account_button2" style="color: white">Привилегии</button></div>
                            <div class="col-4 account_text" style="padding-top: 5px;"><button onclick="GetSettings();" class="account_button3" style="color: white">Настройки</button></div>
                        </div>
                        <div class="row" id="menu" style="margin-top: 14px"></div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-around" style="z-index: 1000;">
                <div class="col-8 text-center col-centered background-label-lk blocks-lk text" style="font-size: 20px; padding: 22px 30px 0 30px">
                        <p class="ml-3" style="float: left;">Наборы</p>Спецпредложения<p class="mr-3" style="float: right">Голосов: <?$operator->Get_Votes()?></p>
                </div>
            </div>
            <div class="row justify-content-around">
                <div class="col-8 rectangle" style="z-index: 4; margin-top: -40px;">
                    <div class="shadow p-4" style="margin: 20px 10px 10px 10px">
                        <div class="row text-center" id="kits"></div>
                    </div>
                </div>
            </div>
        </div>
    <div id="NetherPopupBackgroundlk" onclick="CloseLKExcaliburPopup();" class="kit" style="display: none;"></div>
    <div id="NetherPopupWindowlk" class="kit">
        <div class="NetherPopupContent">
            <div id="kit_popup_container">
                <div class="kit_popup_title">Вы выбрали
                    <span id="kit_title"></span>
                </div>
                <div class="kit_popup_container">
                    <div class="kit_popup_img">
                        <img id="kit_src_image" width="100px">
                    </div>
                    <div class="kit_popup_list_items">
                        <div class="kit_popup_title_list_items">В набор входит:</div>
                        <div id="kit_items"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div>
                    <div class="kit_text_of_center">Потратить голоса</div>
                    <div class="kit_text_of_votes">
                        <div style="text-align: center;">1 голос =
                            <span id="kit_vote_pop"></span>
                            монет
                        </div>
                    </div>
                    <div class="kit_text_of_votes">
                        <div style="text-align: center;">Вы можете использовать до
                            <span id="count_of_votes"></span>
                            голосов
                        </div>
                    </div>
                    <div class="kit_input_of_center">
                        <div style="display: inline-block;">
                            <input type="text" placeholder="Количество" onkeyup="NetherKits.calculate_price();" id="kit_amount" class="kit_input">
                            <p style="font-size: 16px;">(Введите количество наборов)</p>
                        </div>
                        <div style="display: inline-block;">
                            <input type="text" placeholder="Голоса" onkeyup="NetherKits.calculate_price();" id="kit_count_votes" class="kit_input">
                            <p style="font-size: 16px;">(Введите количество голосов)</p>
                        </div>
                    </div>
                    <div class="kit_text_of_votes" style="font-size: 16px;">
                        <div style="text-align: center;">
                            Конечная общая стоимость:<br><span id="end_coins_price"></span> монет и <span id="end_vote_price">0</span> голосов
                        </div>
                    </div>
                </div>
                <div id="kit_popup_price_view_small" class="kit_popup_price_view_small"></div>
                <div class="kit_popup_btn">
                    <button onclick="NetherKits.kit_buy(this);" class="kit_popup_btn_class">Купить себе этот набор</button>
                </div>
            </div>
        </div>
    </div>
    <div class="popup"></div>
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
    </body>
    <footer>
    </footer>
    </html>
<?php else: Header("Location: https://nethercraft.fun/error")?>

<?php endif;?>
