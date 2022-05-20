<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']. "/function.php";
require $_SERVER['DOCUMENT_ROOT']. "/markup.php";
if(isset($_SESSION['nickname']) && !empty($_SESSION['nickname'])):?>
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
        <script src="../js/three.min.js"></script>
        <script src="../js/skin.min.js"></script>
        <script src="../js/ajax.js"></script>
        <script src="../js/main.js"></script>
        <title>Личный кабинет: <?echo $_SESSION['nickname']?></title>
    </head>
    <header>
        <div class="container-fluid account-header">
        <!--Navigation-->
                <div class="row justify-content-around rounded">
                    <div class="col text-center" style="margin-left: 220px">
                        <a class="navigation-menu" href="">Главная</a>
                        <a class="navigation-menu" href="">Форум</a>
                        <a class="navigation-menu" href="">Донат</a>
                        <a class="navigation-menu" href="">Помощь</a>
                        <a class="navigation-menu" href="">Выход</a>
                    </div>
                </div>
        </div>
        <!--    --><?//HTML::get_header();?>
    </header>
    <body>
        <div class="container-fluid">
            <div class="row justify-content-around rounded">
                <div class="col-1 text-center p-3 blocks-lk">
                    <div class="present text" style="padding-top: 13px; font-size: 20px">Подарки</div>
                </div>
                <div class="col-5 text-center account-label p-3 blocks-lk text" style="font-size: 22px">
                    <div class="account_label_text">Личный кабинет</div>

                </div>
                <div class="col-1 text-center p-3 blocks-lk">
                    <div class="present text" style="padding-top: 13px; font-size: 20px">Магазин</div>
                </div>
            </div>
            <div class="row justify-content-around rounded">

                <div class="col-4 rectangle h-100" >
                    <div class="shadow p-3" style="margin: 20px 10px 10px 10px">
                        <div class="col-12"><p class="text-center account-label-lk text" style="font-size: 16px; padding-top: 19px;">Никнейм: <?echo $_SESSION['nickname']?></p></div>
                        <div class="text-center" id="skinViewerContainer"></div>
                        <div class="form-group col-md-5 text-center">
                            <form id="uploadSkinForm">
                                <div class=" account_text text-center" style="padding-top: 7px;">
                                    <button id='button' class="account_button4" style="color: white;">Выбрать скин</button>
                                </div>
                                <input id="input-file" class="form-control-file" style="text-align:center" name="file" type="file" accept="image/*" required>
                            </form>
                        </div>
                        <p style="text-align: center;font-size: 18px"><b>Информация об аккаунте:</b></p>
                        <p style="text-align: center;font-size: 16px">Дата регистрации: 2020-11-24 13:41:25</p>
                        <p style="text-align: center;font-size: 16px">Наиграно за все время: 0ч</p>
                        <p style="text-align: center;font-size: 16px">Наигранное время за месяц: 0ч</p>
                        <p style="text-align: center;font-size: 16px">Выполнено квестов: 0</p>
                    </div>
                </div>
                <div class="col-4 rectangle">
                    <div class="shadow p-3 " style="margin: 20px 10px 10px 10px">
                        <div class="row text-center">
                            <div class="col-4 account_text" style="padding-top: 5px;"><button class="account_button1" style="color: white">Основные</button></div>
                            <div class="col-4 account_text" style="padding-top: 5px;"><button class="account_button2" style="color: white">Привилегии</button></div>
                            <div class="col-4 account_text" style="padding-top: 5px;"><button class="account_button3" style="color: white">Настройки</button></div>
                        </div>
                        <div class="row" id="menu" style="margin-top: 14px">
                            <div class="col-12 text-center">
                                <span class="text" style="color: black; font-size: 22px">Пополнение баланса</span>
                            </div>
                            <div class="col-12 text-center text" style="font-size: 16px; color: #2f2f2f; margin: 10px 0">
                                Ваш текущий баланс <span class="account-rectangle"><?php echo "123.00"?></span> руб
                            </div>
                            <div class="col-12">
                                <div class="row text-center">
                                    <div class="col-3">
                                        <img src="../images/account/money1.png" width="90" alt="От 300 руб 10% в подарок!"><br>
                                        <div style="font-family: NetherCraft_Menu; font-size: 14px">
                                            От 300 руб<br>
                                            <span style="color: #008f1f">10% в подарок!</span>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <img src="../images/account/money2.png" width="90" alt="От 500 руб 15% в подарок!"><br>
                                        <div style="font-family: NetherCraft_Menu; font-size: 14px">
                                            От 500 руб<br>
                                            <span style="color: #008f1f">15% в подарок!</span>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <img src="../images/account/money3.png" width="90" alt="От 1000 руб 25% в подарок!"><br>
                                        <div style="font-family: NetherCraft_Menu; font-size: 14px">
                                            От 1000 руб<br>
                                            <span style="color: #008f1f">25% в подарок!</span>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <img src="../images/account/money4.png" width="90" alt="От 3000 руб 40% в подарок!">
                                        <div style="font-family: NetherCraft_Menu; font-size: 14px">
                                            От 3000 руб<br>
                                            <span style="color: #008f1f">40% в подарок!</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <form action="">
                                    <input type="text" class="account-form" name="balance" placeholder="Сумма к пополнению">
                                    <button type="submit" class="account_button4 text" style="font-size: 15px; margin-top: -5px">Пополнить</button>
                                </form>
                            </div>
                            <div class="col-12 text-center text" style="font-size: 16px; color: #2f2f2f; margin: 10px 0">
                                Количество монет <span class="account-rectangle"><?php echo "123.00"?></span> монеты
                            </div>
                            <div class="col-12 text-center">
                                <form action="">
                                    <input type="text" class="account-form" name="balance" placeholder="1 рубль = 100 монет">
                                    <button type="submit" class="account_button2 text" style="font-size: 15px; margin-top: -5px">Обменять</button>
                                </form>
                            </div>
                            <div class="col-12 text-center">
                                <span class="text" style="color: black; font-size: 22px">Голосование</span>
                            </div>
                            <div class="col-12 text-center text" style="font-size: 16px; color: #2f2f2f; margin: 10px 0">
                                Голосов за месяц: <span style="color: #01b828"><?php echo "18"?></span>
                            </div>
                            <div class="col-12">
                                <div class="row text-center">
                                    <div class="col-3">
                                        <a href="">
                                            <img src="../images/mcrate.png" alt="">
                                        </a>
                                    </div>
                                    <div class="col-3">
                                        <a href="">
                                            <img src="../images/topcraft.png" alt="">
                                        </a>
                                    </div>
                                    <div class="col-3">
                                        <a href="">
                                            <img src="../images/minecraftrating.png" alt="">
                                        </a>
                                    </div>
                                    <div class="col-3">
                                        <a href="">
                                            <img src="../images/mctop.png" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center mt-3">
                                <div class="row">
                                    <div class="col-6"><button class="account_button4 account_text">Склад</button></div>
                                    <div class="col-6"><button class="account_button4 account_text">Промокод</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-around" style="z-index: 1000;">
                <div class="col-8 text-center col-centered background-label-lk blocks-lk text" style="font-size: 20px; padding: 22px 30px 0 30px">
                        <p class="ml-3" style="float: left;">Наборы</p>Спецпредложения<p class="mr-3" style="float: right">Голосов: 0</p>
                </div>
            </div>
            <div class="row justify-content-around">
                <div class="col-8 rectangle" style="z-index: 4; margin-top: -40px">
                    <div class="shadow p-4" style="margin: 20px 10px 10px 10px">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card mb-4 box-shadow">
                                    <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1761907441c%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1761907441c%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.71875%22%20y%3D%22120.3%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                                    <div class="card-body">
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                            </div>
                                            <small class="text-muted">9 mins</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mb-4 box-shadow">
                                    <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1761907441c%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1761907441c%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.71875%22%20y%3D%22120.3%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                                    <div class="card-body">
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                            </div>
                                            <small class="text-muted">9 mins</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mb-4 box-shadow">
                                    <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1761907441c%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1761907441c%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.71875%22%20y%3D%22120.3%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                                    <div class="card-body">
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                            </div>
                                            <small class="text-muted">9 mins</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mb-4 box-shadow">
                                    <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1761907441c%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1761907441c%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.71875%22%20y%3D%22120.3%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                                    <div class="card-body">
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                            </div>
                                            <small class="text-muted">9 mins</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mb-4 box-shadow">
                                    <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1761907441c%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1761907441c%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.71875%22%20y%3D%22120.3%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                                    <div class="card-body">
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                            </div>
                                            <small class="text-muted">9 mins</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mb-4 box-shadow">
                                    <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1761907441c%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1761907441c%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.71875%22%20y%3D%22120.3%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                                    <div class="card-body">
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                            </div>
                                            <small class="text-muted">9 mins</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <footer>
    </footer>
    </html>
<?php else: Header("Location: http://minecraft")?>

<?php endif;?>
