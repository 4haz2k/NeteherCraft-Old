<?php
$ch = curl_init();
$endpointURL = 'https://api.mineskin.org/generate/url';
$postparams = ['visibility' => 0];
$postparams = 'http://textures.minecraft.net/texture/da3db7260dd66a5a2bf9b1672f1c2528c1a20d2e9ac211e21e8b79d615b897cc';
curl_setopt($ch, CURLOPT_URL, $endpointURL);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postparams);
$response = curl_exec($ch);
curl_close($ch);
if($response == false){
    /* cURL ERROR */
    printErrorAndDie(str_replace("%rsn%", L::skcr_error_mscurl, L::skcr_error));
}

$json = json_decode($response, true);
print($json);