<?php
require "function.php";
require_once $_SERVER['DOCUMENT_ROOT'].'/support/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();
$db = new DataBase();
$function = new Functions();
$data = new Functions();
//Система промокодов
if(isset($_POST['promocode']) && !empty($_POST['promocode'] && $function->CheckHash())){
    $nickname = $_SESSION["nickname"];
    $promocode = $_POST['promocode'];
    $result = $data->CheckIspromocodeActive($nickname, $promocode); // Проверка на наличие промокода
    if($result == "Success"){
        if($data->AddData($promocode, $nickname)){ // Обновление баланса пользователя
            if($data->UsedPromocode($promocode, $nickname)){ // таргет об использованном промокоде
                $response = array();
                $response[] = array(
                    "status"=>"success",
                    "message"=>"Промокод успешно активирован."
                );
                echo json_encode($response);
                exit;
            }
            else{
                $response = array();
                $response[] = array(
                    "status"=>"success",
                    "message"=>"Неизвестная ошибка."
                );
                echo json_encode($response);
                exit;
            }
        }
        else{
            $response = array();
            $response[] = array(
                "status"=>"success",
                "message"=>"Неизвестная ошибка."
            );
            echo json_encode($response);
            exit;
        }
    }
    else{
        $response = array();
        $response[] = array(
            "status"=>"success",
            "message"=>$result
        );
        echo json_encode($response);
        exit;
    }
}
//Система получения скина головы
if(isset($_GET['s']) && isset($_GET['u']) && isset($_GET['v'])){
    $size = isset($_GET['s']) ? max(8, min(250, $_GET['s'])) : 48;
    $user = isset($_GET['u']) ? $_GET['u'] : '';
    $view = isset($_GET['v']) ? substr($_GET['v'], 0, 1) : 'f';
    $view = in_array($view, array('f', 'l', 'r', 'b')) ? $view : 'f';

    function get_skin($user)
    {
        // Default Steve Skin: http://assets.mojang.com/SkinTemplates/steve.png
        $output = 'iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAFDUlEQVR42u2a20sUURzH97G0LKMotPuWbVpslj1olJ';
        $output .= 'XdjCgyisowsSjzgrB0gSKyC5UF1ZNQWEEQSBQ9dHsIe+zJ/+nXfM/sb/rN4ZwZ96LOrnPgyxzP/M7Z+X7OZc96JpE';
        $output .= 'ISfWrFhK0YcU8knlozeJKunE4HahEqSc2nF6zSEkCgGCyb+82enyqybtCZQWAzdfVVFgBJJNJn1BWFgC49/VpwGVl';
        $output .= 'D0CaxQiA5HSYEwBM5sMAdKTqygcAG9+8coHKY/XXAZhUNgDYuBSPjJL/GkzVVhAEU5tqK5XZ7cnFtHWtq/TahdSw2';
        $output .= 'l0HUisr1UKIWJQBAMehDuqiDdzndsP2EZECAG1ZXaWMwOCODdXqysLf++uXUGv9MhUHIByDOijjdiSAoH3ErANQD7';
        $output .= '3C7TXXuGOsFj1d4YH4OTJAEy8y9Hd0mCaeZ5z8dfp88zw1bVyiYhCLOg1ZeAqC0ybaDttHRGME1DhDeVWV26u17lR';
        $output .= 'APr2+mj7dvULfHw2q65fhQRrLXKDfIxkau3ZMCTGIRR3URR5toU38HbaPiMwUcKfBAkoun09PzrbQ2KWD1JJaqswj';
        $output .= 'deweoR93rirzyCMBCmIQizqoizZkm2H7iOgAcHrMHbbV9KijkUYv7qOn55sdc4fo250e+vUg4329/Xk6QB/6DtOws';
        $output .= '+dHDGJRB3XRBve+XARt+4hIrAF4UAzbnrY0ve07QW8uHfB+0LzqanMM7qVb+3f69LJrD90/1axiEIs6qIs21BTITo';
        $output .= 'ewfcSsA+Bfb2x67OoR1aPPzu2i60fSNHRwCw221Suz0O3jO+jh6V1KyCMGse9721XdN5ePutdsewxS30cwuMjtC86';
        $output .= '0T5JUKpXyKbSByUn7psi5l+juDlZYGh9324GcPKbkycaN3jUSAGxb46IAYPNZzW0AzgiQ5tVnzLUpUDCAbakMQXXr';
        $output .= 'OtX1UMtHn+Q9/X5L4wgl7t37r85OSrx+TYl379SCia9KXjxRpiTjIZTBFOvrV1f8ty2eY/T7XJ81FQAwmA8ASH1ob';
        $output .= '68r5PnBsxA88/xAMh6SpqW4HRnLBrkOA9Xv5wPAZjAUgOkB+SHxgBgR0qSMh0zmZRsmwDJm1gFg2PMDIC8/nAHIMl';
        $output .= 's8x8GgzOsG5WiaqREgYzDvpTwjLDy8NM15LpexDEA3LepjU8Z64my+8PtDCmUyRr+fFwA2J0eAFYA0AxgSgMmYBMZ';
        $output .= 'TwFQnO9RNAEaHOj2DXF5UADmvAToA2ftyxZYA5BqgmZZApDkdAK4mAKo8GzPlr8G8AehzMAyA/i1girUA0HtYB2Ca';
        $output .= 'IkUBEHQ/cBHSvwF0AKZFS5M0ZwMQtEaEAmhtbSUoDADH9ff3++QZ4o0I957e+zYAMt6wHkhzpjkuAcgpwNcpA7AZD';
        $output .= 'LsvpwiuOkBvxygA6Bsvb0HlaeKIF2EbADZpGiGzBsA0gnwQHGOhW2snRpbpPexbAB2Z1oicAMQpTnGKU5ziFKc4xS';
        $output .= 'lOcYpTnOIUpzgVmgo+XC324WfJAdDO/+ceADkCpuMFiFKbApEHkOv7BfzfXt+5gpT8V7rpfYJcDz+jAsB233r6yyB';
        $output .= 'sJ0mlBCDofuBJkel4vOwBFPv8fyYAFPJ+wbSf/88UANNRVy4Awo6+Ig2gkCmgA5DHWjoA+X7AlM//owLANkX0w035';
        $output .= '9od++pvX8fdMAcj3/QJ9iJsAFPQCxHSnQt8vMJ3v2wCYpkhkAOR7vG7q4aCXoMoSgG8hFAuc/grMdAD4B/kHl9da7';
        $output .= 'Ne9AAAAAElFTkSuQmCC';
        $output = base64_decode($output);
        if ($user != '') {
            $directory = $_SERVER['DOCUMENT_ROOT'].'/skins/'. $user .'.png';
            $result = @file_get_contents($directory);
            if($result != false){
                $output = $result;
            }
        }
        return $output;
    }

    $skin = get_skin($user);

    $im = imagecreatefromstring($skin);
    $av = imagecreatetruecolor($size, $size);

    $x = array('f' => 8, 'l' => 16, 'r' => 0, 'b' => 24);

    imagecopyresized($av, $im, 0, 0, $x[$view], 8, $size, $size, 8, 8);         // Face
    imagecolortransparent($im, imagecolorat($im, 63, 0));                       // Black Hat Issue
    imagecopyresized($av, $im, 0, 0, $x[$view] + 32, 8, $size, $size, 8, 8);    // Accessories

    header('Content-type: image/png');
    imagepng($av);
    imagedestroy($im);
    imagedestroy($av);
}
// Система входа
if(isset($_POST['login']) && isset($_POST['password'])){
    if($data->autorize($_POST['login'], $_POST['password'])){
        $hash = $db->query_select("*", "authme", "username", $_POST['login']);
        $hash = @mysqli_fetch_all($hash);
        $response = array();
        $response[] = array(
            "status"=>"success",
            "message"=>"Успешная авторизация",
            "data"=>array(
                "nickname"=>$_POST['login'],
                "redirect"=>"/account/index.php",
                "hash" =>$hash['0']['22']
            )
        );
        echo json_encode($response);
        exit;
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
        exit;
    }
}
//Система сортировки
if(isset($_POST['action']) && $_POST['action'] == 'sort_items' && $function->CheckHash()){
    if($_POST['category_id'] == '0'){
        $category = '0';
        $data = $db->query("SELECT * FROM items;");
        $data = @mysqli_fetch_all($data);
    }
    else{
        $category = (int)$_POST['category_id'];
        $data = $db->query_select("*", "items", "category", $category);
        if(!$data){
            $response = array();
            $response[] = array(
                "status"=>"Success",
                "data"=>array(
                    "message" => "Такой категории не существует!"
                )
            );
            echo json_encode($response);
            exit;
        }
        $data = @mysqli_fetch_all($data);
    }

    foreach($data as $key){
        $id = $key['0'];
        $img = $key['4'];
        $price = $key['2'];
        $title = $key['1'];
        $item_meta = $key['5'];
        $items .= '
        <div class="nether-item-div">
              <div class="nether-item-icon" id="'.$id.'">
                    <img class="" id="'.$id.'" src="'.$img.'" data-src="'.$img.'">
              </div>
              <div class="nether-item-name nether-div-margin"><span>'.$title.'</span></div>
              <div class="nether-item-price">Цена:&nbsp;&nbsp;<span style="color: #FF892C;">'.$price.'</span> монет</div>
              <div class="buy-div">
                    <input class="nether-buy-input" type="text" id="block_amount" placeholder="кол.">
                    <button class="nether-cart-button nether-menu-button" block_id="'.$id.'" block_ench="" block_meta="'.$item_meta.'" block_price="'.$price.'" onclick="NetherShop.add_to_cart(this)"><span>В корзину</span></button>
              </div>
        </div>
        ';
    }
    switch ($category){
        case '0':
            $category = "<button class=\"exshop-category-button nether-sort-on\" onclick=\"NetherShop.sort_items('0');\">Все категории</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('1');\">Оружие</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('2');\">Броня</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('3');\">Инструменты</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('4');\">Растительность</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('5');\">Алхимия</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('6');\">Шерсть</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('7');\">Красители</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('8');\">Книги</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('9');\">Ресурсы</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('10');\">Блоки</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('11');\">Декор</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('12');\">Еда</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('13');\">Яйца призыва</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('14');\">Разное</button>";
                break;
        case '1':
            $category = "<button class=\"exshop-category-button \" onclick=\"NetherShop.sort_items('0');\">Все категории</button>
                <button class=\"exshop-category-button nether-sort-on\" onclick=\"NetherShop.sort_items('1');\">Оружие</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('2');\">Броня</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('3');\">Инструменты</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('4');\">Растительность</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('5');\">Алхимия</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('6');\">Шерсть</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('7');\">Красители</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('8');\">Книги</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('9');\">Ресурсы</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('10');\">Блоки</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('11');\">Декор</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('12');\">Еда</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('13');\">Яйца призыва</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('14');\">Разное</button>";
            break;
        case '2':
            $category = "<button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('0');\">Все категории</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('1');\">Оружие</button>
                <button class=\"exshop-category-button nether-sort-on\" onclick=\"NetherShop.sort_items('2');\">Броня</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('3');\">Инструменты</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('4');\">Растительность</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('5');\">Алхимия</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('6');\">Шерсть</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('7');\">Красители</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('8');\">Книги</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('9');\">Ресурсы</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('10');\">Блоки</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('11');\">Декор</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('12');\">Еда</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('13');\">Яйца призыва</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('14');\">Разное</button>";
            break;
        case '3':
            $category = "<button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('0');\">Все категории</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('1');\">Оружие</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('2');\">Броня</button>
                <button class=\"exshop-category-button nether-sort-on\" onclick=\"NetherShop.sort_items('3');\">Инструменты</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('4');\">Растительность</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('5');\">Алхимия</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('6');\">Шерсть</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('7');\">Красители</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('8');\">Книги</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('9');\">Ресурсы</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('10');\">Блоки</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('11');\">Декор</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('12');\">Еда</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('13');\">Яйца призыва</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('14');\">Разное</button>";
            break;
        case '4':
            $category = "<button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('0');\">Все категории</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('1');\">Оружие</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('2');\">Броня</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('3');\">Инструменты</button>
                <button class=\"exshop-category-button nether-sort-on\" onclick=\"NetherShop.sort_items('4');\">Растительность</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('5');\">Алхимия</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('6');\">Шерсть</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('7');\">Красители</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('8');\">Книги</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('9');\">Ресурсы</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('10');\">Блоки</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('11');\">Декор</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('12');\">Еда</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('13');\">Яйца призыва</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('14');\">Разное</button>";
            break;
        case '5':
            $category = "<button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('0');\">Все категории</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('1');\">Оружие</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('2');\">Броня</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('3');\">Инструменты</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('4');\">Растительность</button>
                <button class=\"exshop-category-button nether-sort-on\" onclick=\"NetherShop.sort_items('5');\">Алхимия</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('6');\">Шерсть</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('7');\">Красители</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('8');\">Книги</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('9');\">Ресурсы</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('10');\">Блоки</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('11');\">Декор</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('12');\">Еда</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('13');\">Яйца призыва</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('14');\">Разное</button>";
            break;
        case '6':
            $category = "<button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('0');\">Все категории</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('1');\">Оружие</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('2');\">Броня</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('3');\">Инструменты</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('4');\">Растительность</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('5');\">Алхимия</button>
                <button class=\"exshop-category-button nether-sort-on\" onclick=\"NetherShop.sort_items('6');\">Шерсть</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('7');\">Красители</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('8');\">Книги</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('9');\">Ресурсы</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('10');\">Блоки</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('11');\">Декор</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('12');\">Еда</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('13');\">Яйца призыва</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('14');\">Разное</button>";
            break;
        case '7':
            $category = "<button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('0');\">Все категории</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('1');\">Оружие</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('2');\">Броня</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('3');\">Инструменты</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('4');\">Растительность</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('5');\">Алхимия</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('6');\">Шерсть</button>
                <button class=\"exshop-category-button nether-sort-on\" onclick=\"NetherShop.sort_items('7');\">Красители</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('8');\">Книги</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('9');\">Ресурсы</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('10');\">Блоки</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('11');\">Декор</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('12');\">Еда</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('13');\">Яйца призыва</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('14');\">Разное</button>";
            break;
        case '8':
            $category = "<button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('0');\">Все категории</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('1');\">Оружие</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('2');\">Броня</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('3');\">Инструменты</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('4');\">Растительность</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('5');\">Алхимия</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('6');\">Шерсть</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('7');\">Красители</button>
                <button class=\"exshop-category-button nether-sort-on\" onclick=\"NetherShop.sort_items('8');\">Книги</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('9');\">Ресурсы</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('10');\">Блоки</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('11');\">Декор</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('12');\">Еда</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('13');\">Яйца призыва</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('14');\">Разное</button>";
            break;
        case '9':
            $category = "<button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('0');\">Все категории</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('1');\">Оружие</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('2');\">Броня</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('3');\">Инструменты</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('4');\">Растительность</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('5');\">Алхимия</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('6');\">Шерсть</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('7');\">Красители</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('8');\">Книги</button>
                <button class=\"exshop-category-button nether-sort-on\" onclick=\"NetherShop.sort_items('9');\">Ресурсы</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('10');\">Блоки</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('11');\">Декор</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('12');\">Еда</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('13');\">Яйца призыва</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('14');\">Разное</button>";
            break;
        case '10':
            $category = "<button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('0');\">Все категории</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('1');\">Оружие</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('2');\">Броня</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('3');\">Инструменты</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('4');\">Растительность</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('5');\">Алхимия</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('6');\">Шерсть</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('7');\">Красители</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('8');\">Книги</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('9');\">Ресурсы</button>
                <button class=\"exshop-category-button nether-sort-on\" onclick=\"NetherShop.sort_items('10');\">Блоки</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('11');\">Декор</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('12');\">Еда</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('13');\">Яйца призыва</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('14');\">Разное</button>";
            break;
        case '11':
            $category = "<button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('0');\">Все категории</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('1');\">Оружие</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('2');\">Броня</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('3');\">Инструменты</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('4');\">Растительность</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('5');\">Алхимия</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('6');\">Шерсть</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('7');\">Красители</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('8');\">Книги</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('9');\">Ресурсы</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('10');\">Блоки</button>
                <button class=\"exshop-category-button nether-sort-on\" onclick=\"NetherShop.sort_items('11');\">Декор</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('12');\">Еда</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('13');\">Яйца призыва</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('14');\">Разное</button>";
            break;
        case '12':
            $category = "<button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('0');\">Все категории</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('1');\">Оружие</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('2');\">Броня</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('3');\">Инструменты</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('4');\">Растительность</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('5');\">Алхимия</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('6');\">Шерсть</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('7');\">Красители</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('8');\">Книги</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('9');\">Ресурсы</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('10');\">Блоки</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('11');\">Декор</button>
                <button class=\"exshop-category-button nether-sort-on\" onclick=\"NetherShop.sort_items('12');\">Еда</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('13');\">Яйца призыва</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('14');\">Разное</button>";
            break;
        case '13':
            $category = "<button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('0');\">Все категории</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('1');\">Оружие</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('2');\">Броня</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('3');\">Инструменты</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('4');\">Растительность</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('5');\">Алхимия</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('6');\">Шерсть</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('7');\">Красители</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('8');\">Книги</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('9');\">Ресурсы</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('10');\">Блоки</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('11');\">Декор</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('12');\">Еда</button>
                <button class=\"exshop-category-button nether-sort-on\" onclick=\"NetherShop.sort_items('13');\">Яйца призыва</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('14');\">Разное</button>";
            break;
        case '14':
            $category = "<button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('0');\">Все категории</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('1');\">Оружие</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('2');\">Броня</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('3');\">Инструменты</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('4');\">Растительность</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('5');\">Алхимия</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('6');\">Шерсть</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('7');\">Красители</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('8');\">Книги</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('9');\">Ресурсы</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('10');\">Блоки</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('11');\">Декор</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('12');\">Еда</button>
                <button class=\"exshop-category-button\" onclick=\"NetherShop.sort_items('13');\">Яйца призыва</button>
                <button class=\"exshop-category-button nether-sort-on\" onclick=\"NetherShop.sort_items('14');\">Разное</button>";
            break;

    }
    $response = array();
    $response[] = array(
        "status"=>"Success",
        "data"=>array(
            "message" => "Успешно!",
            "items" => $items,
            "category" => $category
        )
    );
    echo json_encode($response);
    exit;
}

//Система добавления в корзину
if(isset($_POST['action']) && $_POST['action'] == 'add_to_cart' && $function->CheckHash()){
    $item_id = (int)$_POST['block_id'];
    $result = $db->query_select("*", "items", "id", $item_id);
    $result = @mysqli_fetch_all($result);
    if($result){ // исключаем ошибку
        $qty = (int)$_POST['block_amount'];
        if($qty == 0){
            $qty = 1;
        }
        if($function->CheckCart($item_id, $qty)){
            $sum = $function->CartSum();
            $response = array();
            $response[] = array(
                "status"=>"Success",
                "data"=>array(
                    "message" => "Товар добавлен в корзину.",
                    "count_items" => $sum['total'],
                    "cart_sum" => $sum['sum']
                )
            );
            echo json_encode($response);
            exit;
        }
        else {
            $nickname = $_SESSION['nickname'];
            $add_to_cart = $db->query("INSERT INTO cart(`nickname`, `item_id`, `qty`) VALUES ('$nickname', '$item_id', '$qty');");
            if ($add_to_cart) {
                $sum = $function->CartSum();
                $response = array();
                $response[] = array(
                    "status" => "Success",
                    "data" => array(
                        "message" => "Товар добавлен в корзину.",
                        "count_items" => $sum['total'],
                        "cart_sum" => $sum['sum']
                    )
                );
                echo json_encode($response);
                exit;
            } else {
                $response = array();
                $response[] = array(
                    "status" => "Fail",
                    "data" => array(
                        "message" => "Неизвестная ошибка!"
                    )
                );
                echo json_encode($response);
                exit;
            }
        }
    }
    else{
        $response = array();
        $response[] = array(
            "status"=>"Fail",
            "data"=>array(
                "message" => "Такого товара не сущеcтвует!"
            )
        );
        echo json_encode($response);
        exit;
    }
}

//Отображение корзины
if(isset($_POST['action']) && $_POST['action'] == 'get_cart' && $function->CheckHash()){
    $price_items = $data->CartSum();
    $total_cart = $data->GetTokens1();
    if($price_items['sum'] == 0){
        $response = array();
        $response[] = array(
            "status" => "Success",
            "data" => array(
                "items" => '<div class="row">
    <div class="col-12 text-center bg404" style="padding-top: 200px">
        <span class="text" style="font-size: 50px">Ошибка</span><br>
        <span class="text" style="font-size: 25px">Ваша корзина пустая!</span>
    </div>
</div>',
                "count_items" => "0",
                "cart_sum" => "0",
                "balance" => $total_cart
            )
        );
        echo json_encode($response);
        exit;
    }
    else {
        $response = array();
        $response[] = array(
            "status" => "Success",
            "data" => array(
                "items" => $data->GetItems(),
                "count_items" => $price_items['total'],
                "cart_sum" => $price_items['sum'],
                "balance" => $total_cart
            )
        );
        echo json_encode($response);
        exit;
    }
}

//Удаление товара из корзины
if(isset($_POST['action']) && $_POST['action'] == 'delete_cart_item' && $function->CheckHash()){
    $id = (int)$_POST['block_id'];
    $block_amount = (int)$_POST['block_amount'];
    $nickname = $_SESSION['nickname'];
    $result = $db->query("DELETE FROM `cart` WHERE `nickname` = '$nickname' AND `item_id` = '$id' AND `qty` = '$block_amount';");
    if($result){
        $price_items = $data->CartSum();
        $total_cart = $data->GetTokens1();
        $response = array();
        $response[] = array(
            "status"=>"Success",
            "data"=>array(
                "count_items" => $price_items['total'],
                "cart_sum" => $price_items['sum'],
                "balance" => $total_cart
            )

        );
        echo json_encode($response);
        exit;
    }
}

//Добавить товар
if(isset($_POST['action']) && $_POST['action'] == 'add_item_amount' && $function->CheckHash()) {
    $item_id = (int)$_POST['block_id'];
    $block_amount = (int)$_POST['block_amount'];
    $nickname = $_SESSION['nickname'];
    $result = $db->query_select2("*", "cart", "item_id", $item_id, "nickname", $nickname);
    $result = @mysqli_fetch_array($result);
    $qty = (int)$result['qty'];
    if($block_amount == null){
        $block_amount = 1;
    }
    $qty += $block_amount;
    if($db->query("UPDATE `cart` SET `qty` = '$qty' WHERE `nickname` = '$nickname' AND `item_id` = '$item_id';")){
        $response = array();
        $response[] = array(
            "status"=>"Success",
            "message"=>"Количество товара увеличено"
        );
        echo json_encode($response);
        exit;
    }
}

//убрать товар в количестве
if(isset($_POST['action']) && $_POST['action'] == 'remove_item_amount' && $function->CheckHash()) {
    $item_id = (int)$_POST['block_id'];
    $block_amount = (int)$_POST['block_amount'];
    $nickname = $_SESSION['nickname'];
    $result = $db->query_select2("*", "cart", "item_id", $item_id, "nickname", $nickname);
    $result = @mysqli_fetch_array($result);
    $qty = (int)$result['qty'];
    if($block_amount == null){
        $block_amount = 1;
    }
    $qty -= $block_amount;
    if($qty == 0 || $qty < 1){
        if($db->query("DELETE FROM `cart` WHERE `nickname` = '$nickname' AND `item_id` = '$item_id';")){
            $price_items = $data->CartSum();
            $total_cart = $data->GetTokens1();
            $response = array();
            $response[] = array(
                "status"=>"Success",
                "message"=>"Количество товара уменьшено",
                "data"=>array(
                    "items" => $data->GetItems(),
                    "count_items" => $price_items['total'],
                    "cart_sum" => $price_items['sum'],
                    "balance" => $total_cart
                )

            );
            echo json_encode($response);
            exit;
        }
    }
    else{
        if($db->query("UPDATE `cart` SET `qty` = '$qty' WHERE `nickname` = '$nickname' AND `item_id` = '$item_id';")){
            $response = array();
            $response[] = array(
                "status"=>"Success",
                "message"=>"Количество товара уменьшено",
                "data"=>array(
                    "items" => null
                )
            );
            echo json_encode($response);
            exit;
        }
    }
}

//оплатить товары
if(isset($_POST['action']) && $_POST['action'] == 'buy_cart_items' && $function->CheckHash()) {
    $nickname = $_SESSION['nickname'];
    $balance = (int)$data->GetTokens1();
    $current_cart = $data->CartSum();
    if($current_cart['total'] == 0){
        $response = array();
        $response[] = array(
            "status" => "Success",
            "message" => "Ваша корзина пустая!"
        );
        echo json_encode($response);
        exit;
    }
    if($balance >= $current_cart['sum']){
        $items = $db->query_select("*", "cart", "nickname", $nickname);
        $items = @mysqli_fetch_all($items);
        $item = $db->query("SELECT * FROM `items`");
        $item = @mysqli_fetch_all($item);
        foreach($items as $key){
            foreach($item as $current){
                if($key['2'] == $current['0']){
                    $current_item = $current['5'];
                    $amount = $key['3'];
                    if($db->query("INSERT INTO `test`(`player`, `item`, `amount`) VALUES ('$nickname', '$current_item', '$amount');")){
                        $temp = $key['2'];
                        if($db->query("DELETE FROM `cart` WHERE `item_id` = '$temp'")){
                            $balance = $balance - (int)$key['3'] * (int)$current['2'];
                            if($db->query("UPDATE `authme` SET `tokens` = '$balance' WHERE `username` = '$nickname';")){
                                $bought_times = (int)$current['6'] + (int)$key['3'];
                                if($db->query("UPDATE `items` SET `bought_times` = '$bought_times' WHERE `id` = '$temp';")) {
                                    break;
                                }
                            }
                        }
                    }
                }
            }
        }
        $price_items = $data->CartSum();
        $response = array();
        $response[] = array(
            "status" => "Success",
            "message" => "Успешная оплата!",
            "data" => array(
                "balance" => $data->GetTokens1(),
                "count_items" => $price_items['total'],
                "cart_sum" => $price_items['sum']
            )
        );
        echo json_encode($response);
        exit;
    }
    else{
        $response = array();
        $response[] = array(
            "status" => "Success",
            "message" => "Недостаточно средств!"
        );
        echo json_encode($response);
        exit;
    }
}

//Обмен денег на монеты
if(isset($_POST['action']) && $_POST['action'] == 'trade_tokens' && $function->CheckHash()){
    $nickname = $_SESSION['nickname'];
    $result = $db->query_select("*", "authme", "username", $nickname);
    $result = @mysqli_fetch_all($result);
    $money = (int)$_POST['amount'];
    if($money != 0) {
        if ($_POST['amount'] != "") {
            $balance = (int)$result['0']['18'];
            if ($money > $balance) {
                $response = array();
                $response[] = array(
                    "status" => "Success",
                    "message" => "Недостаточно средств, пополните баланс"
                );
                echo json_encode($response);
                exit;
            } else {
                $tokens = $money * 100;
                $money = (int)$result['0']['18'] - $money;
                $tokens = $tokens + (int)$result['0']['19'];
                if ($db->query("UPDATE `authme` SET `tokens` = '$tokens', `sum` = '$money' WHERE `username` = '$nickname';")) {
                    $response = array();
                    $response[] = array(
                        "status" => "Success",
                        "message" => "Баланс обновлен."
                    );
                    echo json_encode($response);
                    exit;
                } else {
                    $response = array();
                    $response[] = array(
                        "status" => "Success",
                        "message" => "Неизвестная ошибка"
                    );
                    echo json_encode($response);
                    exit;
                }
            }

        } else {
            $response = array();
            $response[] = array(
                "status" => "Success",
                "message" => "Введите количество!"
            );
            echo json_encode($response);
            exit;
        }
    }
    else {
        $response = array();
        $response[] = array(
            "status" => "Success",
            "message" => "Значение должно быть числом!"
        );
        echo json_encode($response);
        exit;
    }
}
//Система смены пароля
if(isset($_POST['action']) && $_POST['action'] == 'change_password' && $function->CheckHash()) {
    $nickname = $_SESSION['nickname'];
    $current_password = (string)$_POST['current'];
    $future_password = (string)$_POST['future'];
    $future_password_r = $_POST['future_r'];
    $result = $db->query_select("*", "authme", "username", $nickname);
    $result = @mysqli_fetch_all($result);
    $password = $result['0']['3'];
    if($future_password == $future_password_r){
        if($function->check_password($nickname, $current_password)){
            $password = $function->HashPassword($future_password);
            if($db->query("UPDATE `authme` SET `password` = '$password' WHERE `username` = '$nickname';")){
                $response = array();
                $response[] = array(
                    "status" => "Success",
                    "message" => "Пароль успешно изменен"
                );
                echo json_encode($response);
                exit;
            }
            else{
                $response = array();
                $response[] = array(
                    "status" => "Success",
                    "message" => "Неизвестная ошибка"
                );
                echo json_encode($response);
                exit;
            }
        }
        else{
            $response = array();
            $response[] = array(
                "status" => "Success",
                "message" => "Введенный пароль не совпадает со старым паролем"
            );
            echo json_encode($response);
            exit;
        }
    }
    else{
        $response = array();
        $response[] = array(
            "status" => "Success",
            "message" => "Повторный пароль введен неверно"
        );
        echo json_encode($response);
        exit;
    }
}
//Система смены почты
if(isset($_POST['action']) && $_POST['action'] == 'change_email' && $function->CheckHash()) {
    $nickname = $_SESSION['nickname'];
    $email = $function->mysql_escape_mimic($_POST['email']);
    if($db->query("UPDATE `authme` SET `email` = '$email' WHERE `username` = '$nickname';")){
        $response = array();
        $response[] = array(
            "status" => "Success",
            "message" => "Почта успешно изменена"
        );
        echo json_encode($response);
        exit;
    }
    else{
        $response = array();
        $response[] = array(
            "status" => "Success",
            "message" => "Неизвестная ошибка"
        );
        echo json_encode($response);
        exit;
    }
}
//время привилегии
if(isset($_POST['action']) && $_POST['action'] == 'duration' && $function->CheckHash()){
    switch($_POST['group']){
        case 'Dibbyk':
            switch($_POST['duration']){
                case '1':
                    $response = array();
                    $response[] = array(
                        "status" => "Success",
                        "message" => "Успешно",
                        "data"=> array(
                            "date" => '<div id="group-duration" style="margin: 10px; font-family: NetherCraft_Menu; font-size: 16px">Статус будет действителен до <span style="color: #FF892C">'.date("d-m-Y", strtotime("+1 month")).'</span></div>',
                            "price" => '<div style="margin: 10px;"><div class="kit_price" style="font-size: 18px;">Цена:&nbsp;&nbsp;<span><s>50</s> 20</span> руб.</div></div>'
                        )
                    );
                    echo json_encode($response);
                    exit;
                case '2':
                    $response = array();
                    $response[] = array(
                        "status" => "Success",
                        "message" => "Успешно",
                        "data"=> array(
                            "date" => '<div id="group-duration" style="margin: 10px; font-family: NetherCraft_Menu; font-size: 16px">Статус будет действителен до <span style="color: #FF892C">'.date("d-m-Y", strtotime("+2 month")).'</span></div>',
                            "price" => '<div style="margin: 10px;"><div class="kit_price" style="font-size: 18px;">Цена:&nbsp;&nbsp;<span><s>100</s> 40</span> руб.</div></div>'
                        )
                    );
                    echo json_encode($response);
                    exit;
                case '3':
                    $response = array();
                    $response[] = array(
                        "status" => "Success",
                        "message" => "Успешно",
                        "data"=> array(
                            "date" => '<div id="group-duration" style="margin: 10px; font-family: NetherCraft_Menu; font-size: 16px">Статус будет действителен до <span style="color: #FF892C">'.date("d-m-Y", strtotime("+3 month")).'</span></div>',
                            "price" => '<div style="margin: 10px;"><div class="kit_price" style="font-size: 18px;">Цена:&nbsp;&nbsp;<span><s>150</s> 60</span> руб.</div></div>'
                        )
                    );
                    echo json_encode($response);
                    exit;
                default:
                    $response = array();
                    $response[] = array(
                        "status" => "Fail",
                        "message" => "Такой длительности не существует",
                        "data"=> array(
                            "date" => null,
                            "price" => null
                        )
                    );
                    exit;
            }
        case 'Laraye':
            switch($_POST['duration']){
                case '1':
                    $response = array();
                    $response[] = array(
                        "status" => "Success",
                        "message" => "Успешно",
                        "data"=> array(
                            "date" => '<div id="group-duration" style="margin: 10px; font-family: NetherCraft_Menu; font-size: 16px">Статус будет действителен до <span style="color: #FF892C">'.date("d-m-Y", strtotime("+1 month")).'</span></div>',
                            "price" => '<div style="margin: 10px;"><div class="kit_price" style="font-size: 18px;">Цена:&nbsp;&nbsp;<span><s>120</s> 48</span> руб.</div></div>'
                        )
                    );
                    echo json_encode($response);
                    exit;
                case '2':
                    $response = array();
                    $response[] = array(
                        "status" => "Success",
                        "message" => "Успешно",
                        "data"=> array(
                            "date" => '<div id="group-duration" style="margin: 10px; font-family: NetherCraft_Menu; font-size: 16px">Статус будет действителен до <span style="color: #FF892C">'.date("d-m-Y", strtotime("+2 month")).'</span></div>',
                            "price" => '<div style="margin: 10px;"><div class="kit_price" style="font-size: 18px;">Цена:&nbsp;&nbsp;<span><s>240</s> 96</span> руб.</div></div>'
                        )
                    );
                    echo json_encode($response);
                    exit;
                case '3':
                    $response = array();
                    $response[] = array(
                        "status" => "Success",
                        "message" => "Успешно",
                        "data"=> array(
                            "date" => '<div id="group-duration" style="margin: 10px; font-family: NetherCraft_Menu; font-size: 16px">Статус будет действителен до <span style="color: #FF892C">'.date("d-m-Y", strtotime("+3 month")).'</span></div>',
                            "price" => '<div style="margin: 10px;"><div class="kit_price" style="font-size: 18px;">Цена:&nbsp;&nbsp;<span><s>360</s> 144</span> руб.</div></div>'
                        )
                    );
                    echo json_encode($response);
                    exit;
                default:
                    $response = array();
                    $response[] = array(
                        "status" => "Fail",
                        "message" => "Такой длительности не существует",
                        "data"=> array(
                            "date" => null,
                            "price" => null
                        )
                    );
                    exit;
            }
        case 'Satana':
            switch($_POST['duration']){
                case '1':
                    $response = array();
                    $response[] = array(
                        "status" => "Success",
                        "message" => "Успешно",
                        "data"=> array(
                            "date" => '<div id="group-duration" style="margin: 10px; font-family: NetherCraft_Menu; font-size: 16px">Статус будет действителен до <span style="color: #FF892C">'.date("d-m-Y", strtotime("+1 month")).'</span></div>',
                            "price" => '<div style="margin: 10px;"><div class="kit_price" style="font-size: 18px;">Цена:&nbsp;&nbsp;<span><s>240</s> 96</span> руб.</div></div>'
                        )
                    );
                    echo json_encode($response);
                    exit;
                case '2':
                    $response = array();
                    $response[] = array(
                        "status" => "Success",
                        "message" => "Успешно",
                        "data"=> array(
                            "date" => '<div id="group-duration" style="margin: 10px; font-family: NetherCraft_Menu; font-size: 16px">Статус будет действителен до <span style="color: #FF892C">'.date("d-m-Y", strtotime("+2 month")).'</span></div>',
                            "price" => '<div style="margin: 10px;"><div class="kit_price" style="font-size: 18px;">Цена:&nbsp;&nbsp;<span><s>480</s> 192</span> руб.</div></div>'
                        )
                    );
                    echo json_encode($response);
                    exit;
                case '3':
                    $response = array();
                    $response[] = array(
                        "status" => "Success",
                        "message" => "Успешно",
                        "data"=> array(
                            "date" => '<div id="group-duration" style="margin: 10px; font-family: NetherCraft_Menu; font-size: 16px">Статус будет действителен до <span style="color: #FF892C">'.date("d-m-Y", strtotime("+3 month")).'</span></div>',
                            "price" => '<div style="margin: 10px;"><div class="kit_price text-center" style="font-size: 18px;">Цена:&nbsp;&nbsp;<span><s>720</s> 288</span> руб.</div></div>'
                        )
                    );
                    echo json_encode($response);
                    exit;
                default:
                    $response = array();
                    $response[] = array(
                        "status" => "Fail",
                        "message" => "Такой длительности не существует",
                        "data"=> array(
                            "date" => null,
                            "price" => null
                        )
                    );
                    echo json_encode($response);
                    exit;
            }
        default:
            $response = array();
            $response[] = array(
                "status" => "Fail",
                "message" => "Такой привилегии не существует!",
                "data"=> array(
                    "date" => null,
                    "price" => null
                )
            );
            echo json_encode($response);
            exit;
    }
}

//Отображение наборов
if(isset($_POST['action']) && $_POST['action'] == 'kit_load' && $function->CheckHash()){
    $kits = $db->query("SELECT * FROM `kits`");
    $kits = mysqli_fetch_all($kits);
    $result = '';
    foreach($kits as $key){
        $temp = (int)$key['3'] - 10 * 20; // курс 20 голосов максимум, 20 монет = 1 голос
        $result .= '                            <div class="col-4">
                                <div class="kit_form">
                                    <div class="kit_icon">
                                        <img class="" src="'.$key['6'].'" data-src="'.$key['6'].'" width="110px">
                                    </div>
                                    <div class="kit_title"><span>'.$key['1'].'</span></div>

                                    <div class="kit_price">Цена:&nbsp;&nbsp;<span>'.$key['3'].'</span> монет.</div>
                                    <div class="kit_description">
                                        '.$key['2'].'
                                    </div>
                                    <div class="kit_golosa_price"><b>Цена с учетом<br> использования голосов: <span class="kit_orange_dis">'.$temp.'</span> монет</b></div>
                                    <div class="kit_button">
                                        <button class="excalibur-green-button excalibur-button" onclick="NetherKits.more('.$key['0'].');">
                                            <span>Подробнее</span>
                                        </button>
                                    </div>
                                </div>
                            </div>';
    }
    $response = array();
    $response[] = array(
        "status" => "Success",
        "data" => $result
    );
    echo json_encode($response);
}

//Подробное отображение набора
if(isset($_POST['action']) && $_POST['action'] == 'get_kit' && $function->CheckHash()){
    $id = (int)$_POST['kit_id'];
    $result = $db->query("SELECT * FROM `kits` WHERE `id` = '$id'");
    $result = @mysqli_fetch_all($result);
    if($result['0']['8'] == "command" or $result['0']['8'] == "db"){
        $commands = $db->query("SELECT * FROM `commands` WHERE `id` = '{$result['0']['9']}'");
        $commands = @mysqli_fetch_all($commands);
        $items = '<div class="kit_special_items"> <img src="'.$commands['0']['2'].'" style="margin-right: 7px" width="25px" class="kit_img_items"/>'.$commands['0']['1'].'</div>';

        $response = array();
        $response[] = array(
            "status" => "Success",
            "data" => array(
                "title" => $result['0']['1'],
                "image" => $result['0']['6'],
                "votes_count" => "20",
                "price" => $result['0']['3'],
                "items" => $items
            )
        );
        echo json_encode($response);
    }
    else{
        $qty = explode("/", $result['0']['7']);

        $data = array();
        foreach($qty as $key){
            $temp = explode("-", $key);
            array_push($data, $temp);
        }
        foreach($data as $item){
            $temp1 = $item['0'];
            $item_got = $db->query_select("*", "items", "id", $temp1);
            $item_got = @mysqli_fetch_all($item_got);
            $temp_item = '<div class="kit_special_items"> <img src="'.$item_got['0']['4'].'" style="margin-right: 7px" width="25px" class="kit_img_items"/>'.$item_got['0']['1'].' - '.$item['1'].' шт </div>';
            $items .= $temp_item;
        }
        $response = array();
        $response[] = array(
            "status" => "Success",
            "data" => array(
                "title" => $result['0']['1'],
                "image" => $result['0']['6'],
                "votes_count" => "20",
                "price" => $result['0']['3'],
                "items" => $items
            )
        );
        echo json_encode($response);
    }


}

//Калькулятор наборов
if(isset($_POST['action']) && $_POST['action'] == 'calculate_price' && $function->CheckHash()){
    $kit_id = (int)$_POST['kit_id'];
    $result = $db->query_select("*", "kits", "id", $kit_id);
    $result = @mysqli_fetch_all($result);
    $votes = (int)$_POST['votes'];
    if($votes == 0){$votes = 1;}
    if($votes > 150){$votes = 150;}
    $votes_price = $votes * 20;
    $amount = (int)$_POST['amount'];
    $price = (int)$result['0']['3'];
    $price = $price * $amount - $votes_price;
    $response = array();
    $response[] = array(
        "status" => "Success",
        "data" => array(
            "end_price" => $price,
            "vote_price" => $votes,
            "count_of_votes" => "20",
            "kit_count_votes" => $_POST['votes'],
        )
    );
    echo json_encode($response);
}

//Покупка доната
if(isset($_POST['action']) && $_POST['action'] == 'buy_donate' && $function->CheckHash()){
    $duration = $_POST['duration'];
    $group = $_POST['group'];
    $nickname = $_SESSION['nickname'];
    $user = $db->query_select("*", "authme", "username", $nickname);
    $user = @mysqli_fetch_all($user);
    $balance = (int)$user['0']['18'];
    $date = date('l jS \of F Y h:i:s A');
    switch($group){
        case 'Dibbyk':
            switch($_POST['duration']){
                case '1':
                    $price = 20;
                    break;
                case '2':
                    $price = 40;
                    break;
                case '3':
                    $price = 60;
                    break;
                default:
                    $response = array();
                    $response[] = array(
                        "status" => "Fail",
                        "message" => "Такой длительности не существует",
                        "data"=> array(
                            "date" => null,
                            "price" => null
                        )
                    );
                    exit;
            }
            break;
        case 'Laraye':
            switch($_POST['duration']){
                case '1':
                    $price = 48;
                    break;
                case '2':
                    $price = 96;
                    break;
                case '3':
                    $price = 144;
                    break;
                default:
                    $response = array();
                    $response[] = array(
                        "status" => "Fail",
                        "message" => "Такой длительности не существует",
                        "data"=> array(
                            "date" => null,
                            "price" => null
                        )
                    );
                    exit;
            }
            break;
        case 'Satana':
            switch($_POST['duration']){
                case '1':
                    $price = 96;
                    break;
                case '2':
                    $price = 192;
                    break;
                case '3':
                    $price = 288;
                    break;
                default:
                    $response = array();
                    $response[] = array(
                        "status" => "Fail",
                        "message" => "Такой длительности не существует",
                        "data"=> array(
                            "date" => null,
                            "price" => null
                        )
                    );
                    echo json_encode($response);
                    exit;
            }
            break;
        default:
            $response = array();
            $response[] = array(
                "status" => "Fail",
                "message" => "Такой привилегии не существует!",
                "data"=> array(
                    "date" => null,
                    "price" => null
                )
            );
            echo json_encode($response);
            exit;
    }
    $server = new Rcon('135.181.169.120');
    if(@$server->connect()){
        if($balance >= $price){
            $balance -= $price;
            if($db->query("INSERT `payment_history`(`nickname`, `groupp`, `duration`, `price`, `time`) VALUES ('$nickname', '$group', '$duration', '$price', '$date');")){
                if($db->query("UPDATE `authme` SET `sum` = '$balance' WHERE `username` = '$nickname';")){
                    $command = 'lp user '. $nickname .' group addtemp '. $group .' '.$duration.'month world=nethercraft2 world=nethercraft3 world=nethercraft world=world_hub world=nethercraft_the_end world=nethercraft_nether world=nethercraft2_the_end world=nethercraft2_nether world=nethercraft3_the_end world=nethercraft3_nether ';
                    $server->sendCommand($command);
                    $server->disconnect();
                    $response = array();
                    $response[] = array(
                        "status" => "Success",
                        "message" => "Успешная оплата, для активации перезайдите на сервер!"
                    );
                    echo json_encode($response);
                    exit;
                }
                else{
                    $response = array();
                    $response[] = array(
                        "status" => "Success",
                        "message" => "Не удалось обновить баланс, обратитесь к администрации"
                    );
                    echo json_encode($response);
                    exit;
                }
            }
            else{
                $response = array();
                $response[] = array(
                    "status" => "Success",
                    "message" => "Непредвиденная ошибка, повторите позже"
                );
                echo json_encode($response);
                exit;
            }
        }
        else{
            $response = array();
            $response[] = array(
                "status" => "Success",
                "message" => "Недостаточно средств, пополните счет"
            );
            echo json_encode($response);
            exit;
        }
    }
    else{
        $response = array();
        $response[] = array(
            "status" => "Success",
            "message" => "На данный момент сервер выключен, пожалуйста, повторите попытку позже"
        );
        echo json_encode($response);
        exit;
    }
}

//Отображение склада
if(isset($_POST['action']) && $_POST['action'] == 'storage' && $function->CheckHash()){
    $nickname = $_SESSION['nickname'];
    $storage =  mysqli_fetch_all($db->query_select("*", "test", "player", $nickname));
    $html = '';
    if(!empty($storage)){
        foreach ($storage as $id_item) {
            $item = mysqli_fetch_all($db->query_select("*", "items", "item_meta", $id_item['3']));
            $temp_price = (int)$id_item['4'] * (int)$item['0']['2'];
            $html .= '<tr class="item_form_shop_list">
							<td>1</td>
							<td id="shop_item_icon" class="shop_item_icon"><img src="'.$item['0']['4'].'" width="30px" style="margin: 3px;"></td>
							<td>'.$item['0']['1'].'</td>
							<td class="exshop-ench-relative-block"><div id="exshop_enchantment_block"><pre></pre></div></td>
							<td class="shop_item_price"><span class="nether-balance">'.$id_item['4'].'</span> шт ( <span class="nether-balance">'.$temp_price.'</span> монет )</td>
						</tr>';
        }
        echo '<table width="100%" cellpadding="0" cellspacing="0" border="0" class="exshop-table exshop-storage-table"><tbody>'. $html . '</tbody></table>';
    }
}

//ADMIN PANEL: добавление игрового предмета в бд
if(isset($_POST['action']) && $_POST['action'] == 'items_upload' && $_SESSION['nickname'] == 'zytia' && $function->CheckHash()){
    $destiation_dir = $_SERVER['DOCUMENT_ROOT'] . '/images/items/' . $_FILES['img']['name']; // Директория для размещения файла
    move_uploaded_file($_FILES['img']['tmp_name'], $destiation_dir); // Перемещаем файл в желаемую директорию
    $directory = '/images/items/' . $_FILES['img']['name'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $item_meta = $_POST['item_meta'];
    if($db->query("INSERT INTO `items`(`title`, `price`, `category`, `img`, `item_meta`) VALUES ('$title', '$price', '$category', '$directory' ,'$item_meta');")){
        $response = array();
        $response[] = array(
            "status" => "Success",
            "message" => "Предмет добавлен"
        );
        echo json_encode($response);
        exit;
    }
    else{
        $response = array();
        $response[] = array(
            "status" => "Fail",
            "message" => "Ошибка в запросе"
        );
        echo json_encode($response);
        exit;
    }
}

//ADMIN PANEL: добавление набора
if(isset($_POST['action']) && $_POST['action'] == 'kit_upload' && $_SESSION['nickname'] == 'zytia' && $function->CheckHash()){
    $destiation_dir = $_SERVER['DOCUMENT_ROOT'] . '/images/kits/' . $_FILES['img']['name']; // Директория для размещения файла
    move_uploaded_file($_FILES['img']['tmp_name'], $destiation_dir); // Перемещаем файл в желаемую директорию
    $directory = '/images/kits/' . $_FILES['img']['name'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $votes = $_POST['votes'];
    $items = $_POST['items'];
    $type = $_POST['type'];
    $command = $_POST['command'];
    $item_meta = $_POST['item_meta'];
    if($db->query("INSERT INTO `kits`(`title`, `description`, `price`, `price_votes`, `advanced_description`, `img`, `items`, `type`, `command`) VALUES ('$title', '$description', '$price', '$votes', '' , '$directory', '$items', '$type', '$command');")){
        $response = array();
        $response[] = array(
            "status" => "Success",
            "message" => "Набор добавлен"
        );
        echo json_encode($response);
        exit;
    }
    else{
        $response = array();
        $response[] = array(
            "status" => "Fail",
            "message" => "Ошибка в запросе"
        );
        echo json_encode($response);
        exit;
    }
}

//ADMIN PANEL: добавление новости
if(isset($_POST['action']) && $_POST['action'] == 'news_upload' && $_SESSION['nickname'] == 'zytia' && $function->CheckHash()){
    $destiation_dir = $_SERVER['DOCUMENT_ROOT'] . '/images/news_img/' . $_FILES['img']['name']; // Директория для размещения файла
    move_uploaded_file($_FILES['img']['tmp_name'], $destiation_dir); // Перемещаем файл в желаемую директорию
    $directory = '/images/news_img/' . $_FILES['img']['name'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = date('Y-m-d');
    if($db->query("INSERT INTO `news`(`title`, `description`, `auhor`, `date`, `img`) VALUES ('$title', '$description', 'NetherCraft', '$date', '$directory');")){
        $response = array();
        $response[] = array(
            "status" => "Success",
            "message" => "Новость опубликованна"
        );
        echo json_encode($response);
        exit;
    }
    else{
        $response = array();
        $response[] = array(
            "status" => "Fail",
            "message" => "Ошибка в запросе"
        );
        echo json_encode($response);
        exit;
    }
}

//Создание платежа
if(isset($_POST['action']) && $_POST['action'] == 'create_payment' && $function->CheckHash()){
    if(is_numeric($_POST['money'])){
        $nickname = $_SESSION['nickname'];
        $secretKey = "fbe8666c2b216fbe65100f4883a8fc2c";
        $money = (int)$_POST['money'];
        $date = date("Y-m-d");
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $uniq = substr(str_shuffle($permitted_chars), 0, 15);
        if($db->query("INSERT INTO `payments`(`user`, `unique_hash`, `money`, `date`) VALUES ('$nickname', '$uniq', '$money', '$date')")){
            $hashStr = $uniq.'{up}'.'RUB'.'{up}'.'Пополнение баланса NetherCraft'.'{up}'.$money.'{up}'.$secretKey;
            $signature = hash('sha256', $hashStr);
            $response = array();
            $response[] = array(
                "status" => "Success",
                "data" => array(
                    "sum" => $money,
                    "account" => $uniq,
                    "signature" => $signature
                )
            );
            echo json_encode($response);
            exit;
        }
        else{
            $response = array();
            $response[] = array(
                "status" => "Fail",
                "message" => "Неизвестная ошибка, повторите попытку позже"
            );
            echo json_encode($response);
            exit;
        }
    }
    else{
        $response = array();
        $response[] = array(
            "status" => "Fail",
            "message" => "Денежная сумма должна быть числом"
        );
        echo json_encode($response);
        exit;
    }
}

//Password recovery
if(isset($_POST['action']) && $_POST['action'] == 'recovery'){
    $email = $_POST['email'];
    $reg = @mysqli_fetch_all($db->query("SELECT * FROM `authme` WHERE `email` = '$email'"));
    if(!empty($reg)){
        $user = $reg['0']['1'];
        $hash = $data->generateRandomString(15);
        if($db->query("INSERT INTO `pass_recovery`(`user`, `email`, `hash`) VALUES ('$user', '$email', '$hash')")){
            $mail = new PHPMailer();
            try{
                $mail->CharSet = 'UTF-8';
                // Настройки SMTP
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPDebug = 0;
                $mail->Host = 'ssl://server251.hosting.reg.ru';
                $mail->Port = 465;
                $mail->Username = 'support@nethercraft.fun';
                $mail->Password = '4Y1t2Y6r';
                // От кого
                $mail->setFrom('support@nethercraft.fun', 'NetherCraft Technical Support');
                // Кому
                $mail->addAddress($email, $reg['0']['2']);
                // Тема письма
                $mail->Subject = "Восстановление пароля";
                // Тело письма
                $body = 'Здравствуйте, '.$reg['0']['2'].'!<br>
                        <br>
                        Вы отправили запрос на восстановление пароля личного кабинета '.$email.'. Для того чтобы задать новый пароль, перейдите по ссылке https://nethercraft.fun/recovery?email='.$email.'&hash='.$hash.'.<br>
                        <br>
                        Пожалуйста, проигнорируйте данное письмо, если оно попало к Вам по ошибке.<br>
                        <br>
                        С уважением,<br>
                        Technical Support NetherCraft Project';
                $mail->msgHTML($body);

                $mail->send();
                $response = array();
                $response[] = array(
                    "status" => "Success",
                    "message" => "Письмо отправлено на указанный адрес, проверьте почтовый ящик"
                );
                echo json_encode($response);
                exit;
            }
            catch (Exception $e){
                $response = array();
                $response[] = array(
                    "status" => "Fail",
                    "message" => "Почтовая служба временно недоступна, повторите позже"
                );
                echo json_encode($response);
                exit;
            }
        }
    }
    else{
        $response = array();
        $response[] = array(
            "status" => "Fail",
            "message" => "Данный почтовый ящик не привзяан к аккаунтам или введен неверно, проверьте введенные данные"
        );
        echo json_encode($response);
        exit;
    }
}

if(isset($_POST['action']) && $_POST['action'] == 'new_pass'){
    $future_password = $_POST['new_pass'];
    $future_password_r = $_POST['new_pass_r'];
    $result = $db->query("SELECT * FROM `pass_recovery` WHERE `email` = '{$data->mysql_escape_mimic($_POST['email'])}' AND `hash` = '{$data->mysql_escape_mimic($_POST['hash'])}'");
    $result = @mysqli_fetch_all($result);
    if(!empty($result)){
        if($future_password == $future_password_r){
            $password = $function->HashPassword($future_password);
            if($db->query("UPDATE `authme` SET `password` = '$password' WHERE `username` = '{$result['0']['1']}';")){
                if($db->query("DELETE FROM `pass_recovery` WHERE `email` = '{$data->mysql_escape_mimic($_POST['email'])}' AND `hash` = '{$data->mysql_escape_mimic($_POST['hash'])}';")){
                    $response = array();
                    $response[] = array(
                        "status" => "Success",
                        "message" => "Пароль успешно изменен",
                        "redirect" => "https://nethercraft.fun"
                    );
                    echo json_encode($response);
                    exit;
                }
            }
            else{
                $response = array();
                $response[] = array(
                    "status" => "Fail",
                    "message" => "Неизвестная ошибка"
                );
                echo json_encode($response);
                exit;
            }
        }
        else{
            $response = array();
            $response[] = array(
                "status" => "Fail",
                "message" => "Повторный пароль введен неверно"
            );
            echo json_encode($response);
            exit;
        }
    }
    else{
        $response = array();
        $response[] = array(
            "status" => "Fail",
            "message" => "Данной заявки на восстановление не найдено!"
        );
        echo json_encode($response);
        exit;
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'kit_buy' && $function->CheckHash()){
    $kit_id = (int)$_POST['kit_id'];
    $amount = (int)$_POST['amount'];
    $nickname = $_SESSION['nickname'];
    $user = @mysqli_fetch_all($db->query("SELECT * FROM `authme` WHERE `username` = '$nickname';"));
    if($amount <= 0){
        $amount = 1;
    }
    $max_votes = $amount * 20;
    $votes = (int)$_POST['votes'];
    if($user['0']['20'] < $votes){
        $response = array();
        $response[] = array(
            "status" => "Fail",
            "message" => "У вас недостаточно голосов!"
        );
        echo json_encode($response);
        exit;
    }
    if($votes > $max_votes){
        $response = array();
        $response[] = array(
            "status" => "Fail",
            "message" => "Вы не можете использовать больше ".$max_votes."-ти голосов!"
        );
        echo json_encode($response);
        exit;
    }
    if($amount > $votes){
        $response = array();
        $response[] = array(
            "status" => "Fail",
            "message" => "На один набор должен быть как минимум 1 голос!"
        );
        echo json_encode($response);
        exit;
    }
    if($votes < 1){
        $response = array();
        $response[] = array(
            "status" => "Fail",
            "message" => "Количество голосов не может быть равно нулю!"
        );
        echo json_encode($response);
        exit;
    }
    $sale = (int)$_POST['votes'] * 20;
    $kit = @mysqli_fetch_all($db->query_select("*", "kits", "id", $kit_id));
    $items = explode("/", $kit['0']['7']);
    foreach($items as $key){
        $key = explode("-", $key);
    }
    if((int)$user['0']['19'] >= ((int)$kit['0']['3']- $sale) * $amount ){
        if($kit['0']['8'] == "command"){
            $commands = $db->query("SELECT * FROM `commands` WHERE `id` = '{$kit['0']['9']}'");
            $commands = @mysqli_fetch_all($commands);
            $command = @str_replace("%player%", $nickname, (string)$commands['0']['3']);
            $server = new Rcon('play.nethercraft.fun');
            if(@$server->connect()){
                for($i = 0; $i < $amount; $i++){
                    $server->sendCommand($command);
                    sleep(1);
                }
            }
            else{
                $response = array();
                $response[] = array(
                    "status" => "Success",
                    "message" => "На данный момент сервер выключен, пожалуйста, повторите попытку позже"
                );
                echo json_encode($response);
                exit;
            }
        }
        elseif ($kit['0']['8'] == "db"){
            $commands = $db->query("SELECT * FROM `commands` WHERE `id` = '{$kit['0']['9']}'");
            $commands = @mysqli_fetch_all($commands);

            $command = @str_replace("%player%", $nickname, (string)$commands['0']['3']);

            $ddd = @mysqli_fetch_all($db->query("SELECT * FROM `playtimeplus` WHERE `Name` = '$nickname'"));
            $command = @str_replace("%uuid%", $ddd['0']['1'], $command);

            if(!$db->query($command)){
                $response = array();
                $response[] = array(
                    "status" => "Success",
                    "message" => "Не удалось выполнить покупку."
                );
                echo json_encode($response);
                exit;
            }
        }
        else{
            $item = $db->query("SELECT * FROM `items`");
            $item = @mysqli_fetch_all($item);
            foreach($items as $key){
                foreach($item as $current){
                    if($key['0'] == $current['0']){
                        $current_item = $current['5'];
                        $amount_item = (int)$key['2'] * $amount;
                        $db->query("INSERT INTO `test`(`player`, `item`, `amount`) VALUES ('$nickname', '$current_item', '$amount_item');");
                    }
                }
            }
        }
        $current_tokens = (int)$user['0']['19'] - ((int)$kit['0']['3'] - $sale) * $amount;
        $current_votes = (int)$user['0']['20'] - $votes;
        if($db->query("UPDATE `authme` SET `tokens` = '$current_tokens', `votes` = '$current_votes' WHERE `username` = '$nickname';")){
            $response = array();
            $response[] = array(
                "status" => "Success",
                "message" => "Успешная оплата!",
                "data" => array(
                    "balance" => $data->GetTokens1()
                )
            );
            echo json_encode($response);
            exit;
        }
        else{
            $response = array();
            $response[] = array(
                "status" => "Success",
                "message" => "Не удалось списать средства.",
                "data" => array(
                    "balance" => $data->GetTokens1()
                )
            );
            echo json_encode($response);
            exit;
        }
    }
    else{
        $response = array();
        $response[] = array(
            "status" => "Fail",
            "message" => "На вашем счете недосточно средств для покупки такого кол-ва наборов!"
        );
        echo json_encode($response);
        exit;
    }
}

if(isset($_POST['action']) && $_POST['action'] == 'gifts' && $function->CheckHash()){
    $result = @mysqli_fetch_all($db->query("SELECT * FROM `top_votes` WHERE `username` = '{$_SESSION['nickname']}'"));
    if(!empty($result)){
        $response = array();
        $response[] = array(
            "status" => "Success",
            "mcrate" => $result['0']['2'] / 7  >= 1 ? 1 : $result['0']['2'] / 7,
            "mctop" => $result['0']['3'] / 7  >= 1 ? 1 : $result['0']['3'] / 7
        );
        echo json_encode($response);
        exit;
    }
    else{
        $response = array();
        $response[] = array(
            "status" => "Success",
            "mcrate" => 0.0,
            "mctop" => 0.0
        );
        echo json_encode($response);
        exit;
    }
}

if(isset($_POST['action']) && $_POST['action'] == 'take_gift' && $function->CheckHash()){
    $nickname = $_SESSION['nickname'];
    $votes = $function->Get_Votes_Gift();

    switch ((int)$_POST['id']){
        case 1:
            if((int)$votes['2'] >= 7){
                if($db->query("INSERT INTO `test`(`player`, `item`, `amount`) VALUES 
                                                              ('$nickname', '264', '10'), 
                                                              ('$nickname', '266', '10'), 
                                                              ('$nickname', '265', '10'), 
                                                              ('$nickname', '263', '20');")){
                    if($db->query("UPDATE `top_votes` SET `mcrate` = `mcrate` - 7 WHERE `username` = '$nickname'")){
                        $response = array();
                        $response[] = array(
                            "status" => "Success",
                            "message" => "Подарок получен. Напишите /cart all в игре."
                        );
                        echo json_encode($response);
                        exit;
                    }
                }
            }
            else{
                $response = array();
                $response[] = array(
                    "status" => "Fail",
                    "message" => "Недостаточно голосов в MCRate."
                );
                echo json_encode($response);
                exit;
            }
            break;
        case 2:
            if((int)$votes['3'] >= 7){
                if($db->query("INSERT INTO `test`(`player`, `type`, `item`, `amount`) VALUES 
                                                              ('$nickname', '264', '10'), 
                                                              ('$nickname', '266', '10'), 
                                                              ('$nickname', '265', '10'), 
                                                              ('$nickname', '263', '20');")){
                    if($db->query("UPDATE `top_votes` SET `mctop` = `mctop` - 7 WHERE `username` = '$nickname'")){
                        $response = array();
                        $response[] = array(
                            "status" => "Success",
                            "message" => "Подарок получен. Напишите /cart all в игре."
                        );
                        echo json_encode($response);
                        exit;
                    }
                }
            }
            else{
                $response = array();
                $response[] = array(
                    "status" => "Fail",
                    "message" => "Недостаточно голосов в MCTop."
                );
                echo json_encode($response);
                exit;
            }
            break;
        default:
            $response = array();
            $response[] = array(
                "status" => "Fail",
                "message" => "Такого мониторинга не существует."
            );
            echo json_encode($response);
            exit;
    }
}

if(isset($_POST['action']) && $_POST['action'] == 'gifts_load' && $function->CheckHash()){
    $items = @mysqli_fetch_all($db->query("SELECT * FROM `gifts`;"));
    $result = '';
    foreach ($items as $item){
        $result .= '<div class="col-3">
                        <div class="nether-item-div">
                            <div class="nether-item-icon" id="'.$item['0'].'">
                                <img class="" id="'.$item['0'].'" src="'.$item['4'].'" data-src="'.$item['4'].'">
                            </div>
                            <div class="nether-item-name nether-div-margin"><span>'.$item['1'].'</span></div>
                            <div class="nether-item-price">Цена:&nbsp;&nbsp;<span style="color: #FF892C;">'.$item['2'].'</span> голосов</div>
                            <div class="buy-div">
                                <input class="nether-buy-input" type="text" id="gift_amount" placeholder="кол.">
                                <button class="nether-cart-button nether-menu-button" gift_id="'.$item['0'].'" onclick="Gifts.BuyGift(this)"><span style="margin-left: -10px">Купить</span></button>
                            </div>
                        </div>
                    </div>';
    }

    $response = array();
    $response[] = array(
        "status" => "Success",
        "data" => $result
    );
    echo json_encode($response);
    exit;
}

if(isset($_POST['action']) && $_POST['action'] == 'buy_gift' && $function->CheckHash()){

    if(!isset($_POST['id'])){
        $response = array();
        $response[] = array(
            "status" => "Fail",
            "message" => "Не получен id подарка"
        );
        echo json_encode($response);
        exit;
    }

    $id = $_POST['id'];

    $nickname = $_SESSION['nickname'];
    $items = @mysqli_fetch_all($db->query("SELECT * FROM `gifts` WHERE `id` = {$id};"));
    $item = @mysqli_fetch_all($db->query("SELECT * FROM `items`"));
    $user = @mysqli_fetch_all($db->query("SELECT `votes` FROM `authme` WHERE `username` = '$nickname'"));

    $amount = (int)$_POST['gift_amount'];

    if($amount <= 0){
        $amount = 1;
    }

    $price = $items['0']['2'] * $amount;

    if($user['0']['0'] < $price){
        $response = array();
        $response[] = array(
            "status" => "Fail",
            "message" => "Недостаточно голосов"
        );
        echo json_encode($response);
        exit;
    }

    $items = explode("/", $items['0']['3']);

    $array_items = array();

    foreach ($items as $key){
        $key = array_push($array_items, explode("-", $key));
    }
    foreach ($array_items as $array_item){
        $amount_item = $amount * $array_item['1'];
        foreach ($item as $value){
            if((int)$array_item['0'] == (int)$value['0']){
                if($db->query("INSERT INTO `test`(`player`,  `item`, `amount`) VALUES ('$nickname', '{$value['5']}', '$amount_item');")){
                    continue;
                }
            }
        }
    }

    if($db->query("UPDATE `authme` SET `votes` = `votes` - {$price} WHERE `username` = '$nickname'")){
        $response = array();
        $response[] = array(
            "status" => "Success",
            "message" => "Успешная покупка. Напишите /cart all в игре"
        );
        echo json_encode($response);
        exit;
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'get_discord' && $function->CheckHash()){
    $nickname = $_SESSION['nickname'];
    $code = mt_rand();
    $data = $db->query("SELECT * FROM `discord_codes` WHERE `nickname` = '{$nickname}'");
    if(!empty($data)){
        $db->query("UPDATE `discord_codes` SET `code` = '{$code}' WHERE `nickname` = '$nickname'");
        $response = array();
        $response[] = array(
            "status" => "Success",
            "code" => "$code"
        );
        echo json_encode($response);
        exit;
    }
    else{
        $db->query("INSERT INTO `discord_codes`(`nickname`,  `code`) VALUES ('$nickname', '$code');");
        $response = array();
        $response[] = array(
            "status" => "Success",
            "code" => "$code"
        );
        echo json_encode($response);
        exit;
    }

}