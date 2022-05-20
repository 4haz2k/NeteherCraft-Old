<?php
require("function.php");
if(isset($_POST['login']) && isset($_POST['password'])){
    $functions = new Functions();
    if($functions->autorize($_POST['login'], $_POST['password'])){
        $response = array();
        $response[] = array(
            "status"=>"success",
            "message"=>"Успешная авторизация",
            "data"=>array(
                "nickname"=>$_POST['login'],
                "redirect"=>"/account/index.php"
            )
        );
        echo json_encode($response);
    }
    else{
        $response = array();
        $response[] = array(
            "status"=>"fail",
            "message"=>"Вход в личный кабинет не был вопроизведен. Возможно, Вы ввели неверный никнейм или пароль, с которыми играете на сервере. <br>Чтобы войти в аккаунт, необходимо ввести данные, которыми Вы авторизуетесь заходя на сервер.",
            "data"=>array(
                "nickname"=>null,
                "redirect"=>null
            )
        );
        echo json_encode($response);
    }
} else { header("Location: http://minecraft/index.php");}
