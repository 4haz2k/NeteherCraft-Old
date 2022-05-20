<?php
//Скрипт загрузки скина на сервер
require "function.php";
session_start();
$db = new DataBase();
if(isset($_FILES) && $_FILES['userfile']['error'] == 0) { // Проверяем, загрузил ли пользователь файл
    $nickname = $_SESSION['nickname'];
    $postparams = ['visibility' => 0];
    /* Отправка с url / Send with URL */
    $file = $_FILES['userfile'];
    $validFileType = ['image/jpeg', 'image/png'];
    /* Проверка, является ли скин форматом Minecraft */
    if (!in_array($file['type'], $validFileType)) {
        $response = array();
        $response[] = array(
            "status" => "Success",
            "message" => "Файл должен быть формата изображения!"
        );
        echo json_encode($response);
        exit;
    }
    list($skinWidth, $skinHeight) = getimagesize($file['tmp_name']);
    if (($skinWidth != 64 && $skinHeight != 64) || ($skinWidth != 64 && $skinHeight != 32)) {
        $response = array();
        $response[] = array(
            "status" => "Success",
            "message" => "Загруженный файл не является скином!"
        );
        echo json_encode($response);
        exit;
    }
    $postparams['file'] = new CURLFile($file['tmp_name'], $file['type'], $file['name']);
    $endpointURL = 'https://api.mineskin.org/generate/upload';
    /* cURL to MineSkin API */
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $endpointURL);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postparams);
    $response = curl_exec($ch);
    curl_close($ch);
    if ($response == false) {
        /* cURL ERROR */
        $response = array();
        $response[] = array(
            "status" => "Success",
            "message" => "Неизвестная ошибка!"
        );
        echo json_encode($response);
        exit;
    }

    $json = json_decode($response, true);
    /* Предотвратить дублирование случайного скина SkinsRestorer / Prevent from duplicated casual skin of SkinsRestorer */
    $transformedName = ' ' . $nickname;

    /* MineSkin API возвращает ошибку / MineSkin API returned unusable data */
    if (empty($json['data']['texture']['value']) || empty($json['data']['texture']['signature'])) {
        $response = array();
        $response[] = array(
            "status" => "Success",
            "message" => "Ошибка получения сигнатуры скина!"
        );
        echo json_encode($response);
        exit;
    }

    /* Назначьте данные для помещения в бд SkinsRestorer / Assign data for putting to SkinsRestorer Storage */
    $value = $json['data']['texture']['value'];
    $signature = $json['data']['texture']['signature'];
    $timestamp = "9223243187835955807";

    $db->query("INSERT INTO skins (Nick, Value, Signature, timestamp) VALUES ('$transformedName', '$value', '$signature', '$timestamp') ON DUPLICATE KEY UPDATE Nick = '$transformedName', Value = '$value', Signature = '$signature',timestamp = '$timestamp';");
    /* Storage Writing (Skins Table) */
    $db->query("INSERT INTO players_data_skins (Nick, Skin) VALUES ('$nickname', '$transformedName') ON DUPLICATE KEY UPDATE Nick = '$nickname', Skin = '$transformedName';");
    $_FILES['userfile']['name'] = $_SESSION['nickname'] . ".png";
    $destiation_dir = $_SERVER['DOCUMENT_ROOT'] . '/skins/' . $_FILES['userfile']['name']; // Директория для размещения файла
    move_uploaded_file($_FILES['userfile']['tmp_name'], $destiation_dir); // Перемещаем файл в желаемую директорию
    $response = array();
    $response[] = array(
        "status" => "Success",
        "message" => "Скин успешно загружен!"
    );
    echo json_encode($response);
    exit;
}