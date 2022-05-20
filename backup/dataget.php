<?php
/* Initialize Data for sending to MineSkin API */
$postparams = ['visibility' => 0];
if ($_POST['isSlim'] == 'true') {
    $postparams['model'] = 'slim';
}
$file = $_FILES['file'];
$validFileType = ['image/jpeg', 'image/png'];
/* Проверка, является ли скин форматом Minecraft */
if (!in_array($file['type'], $validFileType)) {
    echo 'Пожалуйста, загрузите файл формата JPEG или PNG!';
}
list($skinWidth, $skinHeight) = getimagesize($file['tmp_name']);
if (($skinWidth != 64 && $skinHeight != 64) || ($skinWidth != 64 && $skinHeight != 32)) {
    echo 'Это не действительный скин Minecraft!';
}
$postparams['file'] = new CURLFile($file['tmp_name'], $file['type'], $file['name']);
$endpointURL = 'https://api.mineskin.org/generate/upload';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $endpointURL);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postparams);
$response = curl_exec($ch);
curl_close($ch);
if($response == false){
    /* cURL ERROR */
    echo 'fail';
}

$json = json_decode($response, true);
var_dump($json);
?>