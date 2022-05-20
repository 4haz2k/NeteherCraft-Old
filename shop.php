<?php session_start();
require "function.php";
if(isset($_SESSION['nickname']) && !empty($_SESSION['nickname'])):
$functions = new Functions();
?>
<!doctype html>
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
    <script src="js/shop.js"></script>
    <title>Магазин » NetherCraft Project</title>
</head>
<body>
<header>
    <div class="container-fluid account-header">
        <!--Navigation-->
        <div class="row justify-content-around rounded">
            <div class="col text-center" style="margin-left: 220px">
                <a class="navigation-menu" href="/">Главная</a>
                <a class="navigation-menu" href="/forum">Форум</a>
                <a class="navigation-menu" href="/donate">Донат</a>
                <a class="navigation-menu" href="/account/index.php">Профиль</a>
                <a class="navigation-menu" href="https://vk.com/im?sel=-201581240">Помощь</a>
                <a class="navigation-menu" href="../logout.php">Выход</a>
            </div>
        </div>
    </div>
</header>
<div id="nether_info_block"></div>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 text-center account-label p-3 blocks-lk text" style="font-size: 22px">
            <div class="account_label_text">Магазин</div>
        </div>
        <div class="col-12 text-center text" style="font-size: 22px; color: orange; margin-bottom: 40px">
            <div class="account_label_text">Самые популярные товары</div>
        </div>
        <div class="row" style="margin-right: 60px">
            <?php
            $popular_items = $functions->Popular_items();
            $count = 1;
            foreach ($popular_items as $item){
                if($count == 5){
                    break;
                }
                echo '<div class="col-3">            
                        <div class="nether-item-div nether-item-div-featured">
                            <div class="nether-item-icon" id="'.$item['0'].'">
                                <img class="" id="'.$item['0'].'" src="'.$item['4'].'" data-src="'.$item['4'].'">
                            </div>
                            <div class="nether-item-name nether-div-margin nether-featured-item-name"><span>'.$item['1'].'</span></div>
                            <div class="nether-item-price">Цена:&nbsp;&nbsp;<span style="color: #FF892C;">'.$item['2'].'</span> монет</div>
                            <div class="buy-div">
                                <input class="nether-buy-input" type="text" id="block_amount" placeholder="кол.">
                                <button class="nether-cart-button nether-menu-button" block_id="'.$item['0'].'" block_ench="" block_meta="'.$item['5'].'" block_price="'.$item['2'].'" onclick="NetherShop.add_to_cart(this)"><span>В корзину</span></button>
                            </div>
                        </div>             
                      </div>';
                $count++;
            }
            ?>
        </div>
        <div class="row" style="width: 80%">
            <div class="nether-container1" id="sort_list">
            </div>
        </div>
        <div class="row" style="width: 70%; margin-bottom: 50px; margin-left: 77px">
            <div class="nether-container" id="item_list">
            </div>
        </div>
    </div>
</div>
<div id="nether_menu"><div class="nether-bottom-menu">
        <div class="nether-menu-div">
            <ul class="nether-menu-ul">
                <li style="width: 44px!important;">
                    <div class="nether-menu-avatar-div">
                        <img src="events.php?u=<?echo $_SESSION['nickname']?>&s=80&v=f">
                    </div>
                </li>
                <li style="width: 273px!important; text-align: left; position: relative; left: 20px;"><?echo $_SESSION['nickname']?></li>
                <li style="width: 273px!important; text-align: left;">
                    Ваш баланс
                    <span class="nether-balance"><?php $functions->GetTokens();?></span> монет <a href="/account/index" class="nether-add-money"></a></li>
                <li style="width: 200px!important;">Корзина <div id="cart_item_amount">0</div></li>
                <li style="width: 100px!important;" class="nether-cart-price"><span class="nether-balance" id="cart_price">0</span> монет</li>
                <li style="width: 185px!important;"><a href="/cart"><button class="nether-green-pitted-button nether-menu-button"><span>Корзина</span></button></a></li>
                <li style="width: 185px!important;"><a href="/storage"><button class="nether-orange-pitted-button nether-menu-button"><span>Склад</span></button></a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row justify-content-around rounded bg3" style="margin-top: 100px; height: 600px">
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
</html>
<?php else: Header("Location: https://nethercraft.fun/error")?>

<?php endif;?>