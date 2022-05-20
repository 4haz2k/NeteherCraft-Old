<?php
require "function.php";
$function = new Functions();
$db = new DataBase();
if(isset($_GET['email']) && isset($_GET['hash'])){
    $recovery = mysqli_fetch_all($db->query("SELECT * FROM `pass_recovery` WHERE `email` = '{$function->mysql_escape_mimic($_GET['email'])}' AND `hash` = '{$function->mysql_escape_mimic($_GET['hash'])}'"));
    if(!empty($recovery)){
        $html = '<div class="nether-server-block" style="margin-top: 50px">
    <div class="nether-server-title">
        Восстановление пароля
    </div>
    </div>
    <div class="container justify-content-center" style="margin-top: 20px;">
    <form id="new_pass">
        <div class="form-group">
            <label for="new_password">Введите новый пароль</label>
            <input type="password" class="form-control" id="new_password" aria-describedby="new_password" placeholder="Новый пароль" required>
            <label for="new_password_r">Повторите новый пароль</label>
            <input type="password" class="form-control" id="new_password_r" aria-describedby="new_password_r" placeholder="Повтор нового пароля" required>
            <input type="hidden" value="'.$function->mysql_escape_mimic($_GET['email']).'" id="email">
            <input type="hidden" value="'.$function->mysql_escape_mimic($_GET['hash']).'" id="hash">
        </div>
        <button type="submit" class="btn btn-primary">Восстановить</button>
        <small id="info" class="form-text text-danger"></small>
    </form>
</div>';
    }
    else {
        $html = '<div class="nether-server-block" style="margin-top: 50px">
    <div class="nether-server-title">
        Восстановление пароля
    </div>
</div>
<div class="container justify-content-center" style="margin-top: 20px;">
    <form id="recovery">
        <div class="form-group">
            <label for="exampleInputEmail1">Введите E-mail, привязанный к аккаунту</label>
            <input type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Введите E-mail" required>
        </div>
        <button type="submit" class="btn btn-primary">Восстановить</button>
        <small id="info" class="form-text text-danger"></small>
    </form>
</div>';
    }
}
else {
    $html = '<div class="nether-server-block" style="margin-top: 50px">
    <div class="nether-server-title">
        Восстановление пароля
    </div>
</div>
<div class="container justify-content-center" style="margin-top: 20px;">
    <form id="recovery">
        <div class="form-group">
            <label for="exampleInputEmail1">Введите E-mail, привязанный к аккаунту</label>
            <input type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Введите E-mail" required>
        </div>
        <button type="submit" class="btn btn-primary">Восстановить</button>
        <small id="info" class="form-text text-danger"></small>
    </form>
</div>';
}
?>
<!doctype html>
<html lang="en">
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
    <script src="js/login.js"></script>
    <title>Восстановление пароля » NetherCraft Project</title>
</head>
<header>
    <div class="container-fluid account-header">
        <!--Navigation-->
        <div class="row justify-content-around rounded">
            <div class="col text-center" style="margin-left: 220px">
                <a class="navigation-menu" href="/">Главная</a>
                <a class="navigation-menu" href="">Форум</a>
                <a class="navigation-menu" href="/donate">Донат</a>
                <a class="navigation-menu" href="/shop">Магазин</a>
                <a class="navigation-menu" href="/account/index.php">Профиль</a>
                <a class="navigation-menu" href="https://vk.com/im?sel=-201581240">Помощь</a>
            </div>
        </div>
    </div>
</header>
<body>
<?php echo $html;?>
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
<div class="popup"></div>
</body>
</html>
