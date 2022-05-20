<?php
session_start();
$nickname = $_SESSION["nickname"];
$url = $_SERVER['DOCUMENT_ROOT'].'/skins/'.$nickname.'.png';
if(@fopen($url, "r")) {
    $response = array();
    $response[] = array(
        "status"=>"success",
        "message"=>"Файл найден, передача...",
        "data"=>array(
            "url"=>"../skins/$nickname.png"
        )
    );
    echo json_encode($response);
} else {
    $response = array();
    $response[] = array(
        "status"=>"success",
        "message"=>"Файл не найден.",
        "data"=>array(
            "url"=>"../skins/steve.png"
        )
    );
    echo json_encode($response);
}