<?php
/**
 * Класс со всеми функциями, используемые на сайте<br>
 * Author: Alexey Pavlov<br>
 * Contact: vk.com/zytia
 */
require "DB.php";
require "console.php";
class Functions {
    /**
     * Метод проверки пользователя в базе данных
     * @param $nickname - никнейм игрока, вводимый пользователем
     * @param $password - пароль игрока, вводимый пользователем
     * @return bool Возвращает истину в случае совпадения пароля
     */
    function check_password($nickname,$password): bool
    {
        $data = new DataBase();
        $a = $data->query_select("password", "authme", "username", $nickname);
        if(mysqli_num_rows($a) == 1 ) {
            $password_info=mysqli_fetch_array($a);
            $sha_info = explode("$",$password_info[0]);
        } else { return false; }
        if( $sha_info[1] === "SHA" ) {
            $salt = $sha_info[2];
            $sha256_password = hash('sha256', $password);
            $sha256_password .= $sha_info[2];;
            if( strcasecmp(trim($sha_info[3]),hash('sha256', $sha256_password) ) == 0 ) { return true; } else { return false; }
        } else { return false;}
    }

    /**
     * Генерация соли
     * @param $password - пароль
     * @return string - соль
     */
    function generateSalt($password) {
        $maxCharIndex = strlen($password) - 1;
        $salt = '';
        for ($i = 0; $i < 16; ++$i) {
            $salt .= $password[mt_rand(0, $maxCharIndex)];
        }
        return $salt;
    }

    /**
     * Метод для авторизации
     * @param $nickname - никнейм игрока, вводимый пользователем
     * @param $password - пароль игрока, вводимый пользователем
     * @return bool Возвращает истину в случае совпадения пароля
     */
    function autorize($nickname, $password): bool
    {
        if($this->check_password($nickname, $password)){
            $db = new DataBase();
            $player = @mysqli_fetch_all($db->query("SELECT * FROM `authme` WHERE `username` = '$nickname'; "));
            $hash = $this->randHash($player['0']['1']);
            if($db->query("UPDATE `authme` SET `hash` = '$hash' WHERE `username` = '$nickname'")){
                if($player['0']['18'] == null){
                    $db->query("UPDATE `authme` SET `sum` = '0' WHERE `username` = '$nickname'");
                }
                if($player['0']['19'] == null){
                    $db->query("UPDATE `authme` SET `tokens` = '0' WHERE `username` = '$nickname'");
                }
                if($player['0']['20'] == null){
                    $db->query("UPDATE `authme` SET `votes` = '0' WHERE `username` = '$nickname'");
                }
                if($player['0']['21'] == null){
                    $db->query("UPDATE `authme` SET `all_votes` = '0' WHERE `username` = '$nickname'");
                }
                session_start();
                $_SESSION['nickname'] = $player['0']['1'];
                $_SESSION['user_hash'] = $player['0']['22'];
                return true;
            }
            return false;
        }
        else{
            return false;
        }
    }
    /**
     * hash
     * @param int $len default = 32
     * @return false|string hash
     */
    function randHash($nickname)
    {
        return md5(md5($nickname."FtqRMdZzRer8m9a8QJMNAd+0dOfIUXHACivvKwNtZZI="));
    }

    /**
     * Проверка хеша
     * @return bool
     */
    function CheckHash(){
        if($_SESSION['user_hash'] == $this->randHash($_SESSION['nickname'])){
            return true;
        }
        else{
            unset($_SESSION['nickname']);
            unset($_SESSION['user_hash']);
            session_destroy();
            header('Location: index.php');
        }
    }

    /**
     * Метод проверяет промокод в базе данных
     * @param $promocode - промокод
     * @return bool возвращает истину в случае, если промокод есть
     */
    function CheckPromocode($promocode): bool
    {
        $data = new DataBase();
        $a = $data->query_select("*", "promocodes", "promocode", $promocode);
        if(mysqli_num_rows($a) == 1){
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Проверка на то, использовался ли этот промокод игроком ранее.
     * @param $nickname - Ник игрока
     * @param $promocode - Промокод
     * @return string Возвращает результат проверки
     */
    function CheckIspromocodeActive($nickname, $promocode): string
    {
        $data = new DataBase();
        if($this->CheckPromocode($promocode)){
            $a = $data->query_select2("is_active", "player_promocode", "nickname", $nickname, "promocode", $promocode);
            if(@mysqli_num_rows($a) == 0){
                return "Success";
            }
            else {
                return "Вы уже использовали этот промокод.";
            }
        }
        else{
            return "Такого промокода не существует или срок его действия закончился.";
        }
    }

    /**
     * Таргет об использованном промокоде
     * @param $promocode - промокод
     * @param $nickname - никнейм
     * @return bool Выполнен или нет
     */
    function UsedPromocode($promocode, $nickname): bool
    {
        $data = new DataBase();
        $result = $data->query("INSERT INTO player_promocode(`promocode`, `nickname`, `is_active`) VALUES('$promocode', '$nickname', 'true')");
        if($result == true){return true;} else{return false;}
    }

    /**
     * Добавление награды пользователю
     * @param $promocode - промокод
     * @param $nickname - никнейм
     * @return bool выполнено ли добавление
     */
    function AddData($promocode, $nickname): bool
    {
        $data = new DataBase();
        $money  = $data->query_select("*", "authme", "username", $nickname);
        $money = mysqli_fetch_array($money);
        $currentmoney = (int)$money["tokens"];
        $promocodedata = $data->query_select("*", "promocodes", "promocode", $promocode);
        $promocodedata = mysqli_fetch_array($promocodedata);
        $currentpromocodemoney = (int)$promocodedata["data"];
        $currentmoney += $currentpromocodemoney;
        $result = $data->query_update("tokens", "authme", "username", $nickname, $currentmoney);
        if($result == 1){return true;} else{return false;}
    }

    /**
     * Добавление нового промокода
     * @param $promocode - Промокод
     * @param $data - значение
     * @return bool Выполнен или нет
     */
    function AddPromocode($promocode, $data): bool
    {
        $data = new DataBase();
        $result = $data->query("INSERT INTO promocodes(`promocode`, `data`) VALUES('$promocode', '$data')");
        if($result === true){return true;} else{return false;}
    }

    /**
     * Метод для отображения сообщений
     * @param $nickname - имя пользователя
     * @return array|null Возвращает массив сообщений
     */
    function GetNotification($nickname): ?array
    {
        $data = new DataBase();
        $result = $data->query_select("*", "notifications", "nickname", $nickname);
        $result = @mysqli_fetch_array($result);
        return $result;
    }

    /**
     * Метод для удаления сообщения
     * @param $nickname - никнейм
     * @param $id - айди сообщения
     * @return bool Удалено ли
     */
    function DeleteNotification($nickname, $id): bool
    {
        $data = new DataBase();
        $id = (int)$id;
        $result = $data->query("DELETE FROM `notifications` WHERE `id` = '$id' AND `nickname` = '$nickname'");
        if($result === true){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Получение времени регистрации
     */
    function GetRigistraionTime(){
        $data = new DataBase();
        $nickname = $_SESSION['nickname'];
        $registred = $data->query_select("regdate", "authme", "username", $nickname);
        $registred = @mysqli_fetch_array($registred);
        $time = (int)$registred['regdate'];
        $time = $time / 1000;
        $time = date("d-m-Y H:i:s", $time);
        echo $time;
    }

    /**
     * Получение наигранного времени
     */
    function GetTime(){
        $data = new DataBase();
        $nickname = $_SESSION['nickname'];
        $time = $data->query_select("*", "playtimeplus", "name", $nickname);
        $time = @mysqli_fetch_all($time);
        $time = (int)$time['0']['3'];
        echo sprintf('%02dч %02dмин %02dсек', $time/3600, ($time % 3600)/60, ($time % 3600) % 60);
    }
    /**
     * Получение нормального ника
     */
    function GetTimeHours($nickname, $realname, $votes): array
    {
        $data = new DataBase();
        $time = $data->query_select("*", "playtimeplus", "Name", $nickname);
        $time = mysqli_fetch_all($time);
        $time = (int)$time['0']['3'];
        $time = $time / 3600;
        $time = (int)$time;
        if($votes == null)
            $votes = 0;
        return array($nickname, $time, $realname, (int)$votes);
    }

    /**
     * Создаем массив данных в разбросанном порядке
     * @return array - массив данных(неотсортированный)
     */
    function CreateArray(): array
    {
        $data = new DataBase();
        $result = $data->query("SELECT * FROM `authme`;");
        $result = @mysqli_fetch_all($result);
        $player_data = array();
        foreach ($result as $key) {
            $result = $this->GetTimeHours($key['1'], $key['2'], $key['21']);
            array_push($player_data, $result);
        }
        return $player_data;
    }

    /**
     * Сортировка получаемых данных часов игрока
     * @return array - Готовый к использованию массив
     */
    function SortArrayHours(): array
    {
        $array = $this->CreateArray();
        $size = count($array);
        for ($i = 0; $i < $size-1; $i++)
        {
            $min = $i;

            for ($j = $i + 1; $j < $size; $j++)
            {
                if ($array[$j]['1'] < $array[$min]['1'])
                {
                    $min = $j;
                }
            }

            $temp = $array[$i];
            $array[$i] = $array[$min];
            $array[$min] = $temp;
        }
        $array = array_reverse($array);
        return $array;
    }

    /**
     * Сортировка получаемых данных часов игрока
     * @return array - Готовый к использованию массив
     */
    function SortArrayVotes(): array
    {
        $array = $this->CreateArray();
        $size = count($array);
        for ($i = 0; $i < $size-1; $i++)
        {
            $min = $i;

            for ($j = $i + 1; $j < $size; $j++)
            {
                if ($array[$j]['3'] < $array[$min]['3'])
                {
                    $min = $j;
                }
            }

            $temp = $array[$i];
            $array[$i] = $array[$min];
            $array[$min] = $temp;
        }
        $array = array_reverse($array);
        return $array;
    }

    /**
     * Получение кол-ва монет
     */
    function GetTokens(){
        $data = new DataBase();
        $nickname = $_SESSION['nickname'];
        $tokens = $data->query_select("*","authme","username", $nickname);
        $tokens = @mysqli_fetch_array($tokens);
        echo $tokens['tokens'];
    }

    /**
     * @param $qty - кол-во
     * @param $data - массив данных бд
     * @param $nickname - имя игрока
     * @param $item_id - id предмета
     * @return bool - выполнено или нет
     */
    function UpdateCart($qty, $data, $nickname, $item_id) : bool{
        $qty1 = $data['qty'];
        $qty = (int)$qty + (int)$qty1;
        $db = new DataBase();
        $response = $db->query("UPDATE `cart` SET `qty` = '$qty' WHERE `nickname` = '$nickname' AND `item_id` = '$item_id';");
        if($response){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * @param $item_id - id предмета
     * @param $qty - кол-во
     * @return bool - выполнено или нет
     */
    function CheckCart($item_id, $qty) : bool{
        $item_id = (int)$item_id;
        $db = new DataBase();
        $nickname = $_SESSION['nickname'];
        $result2 = $db->query("SELECT * FROM `cart` WHERE `nickname` = '$nickname' AND `item_id` = '$item_id';");
        $result2 = @mysqli_fetch_array($result2);
        if($result2){
            if($this->UpdateCart($qty, $result2, $nickname, $item_id)){
                return true;
            }
            else{
                return false;
            }
        }
        else {
            return false;
        }
    }

    /**
     * Функция получения суммы корзины и кол-ва предметов в сумме
     * @return array 1 - сумма, 2 - кол-во
     */
    function CartSum() : ?array {
        $db = new DataBase();
        $nickname = $_SESSION['nickname'];
        $result = $db->query_select("*", "cart", "nickname", $nickname);
        $result = @mysqli_fetch_all($result);
        $sum = 0;
        $total = 0;
        foreach($result as $key){
            $result2 = $db->query_select("*", "items", "id", $key['2']);
            $result2 = @mysqli_fetch_array($result2);
            $price = $result2['price'];
            $sum += $key['3'] * $price;
            $total++;
        }
        $response = array(
            "sum" => $sum,
            "total" => $total
        );
        return $response;
    }

    /**
     * Получение корзины
     * @return string - возвращает html код корзины
     */
    function GetItems(): string
    {
        $db = new DataBase();
        $nickname = $_SESSION['nickname'];
        $result = $db->query_select("*", "cart", "nickname", $nickname);
        $result = @mysqli_fetch_all($result);
        $data = '';
        $header = '<table width="100%" cellpadding="0" cellspacing="0" border="0" class="nether-table"><tbody>';
        $footer = '</tbody></table>';
        foreach($result as $key){
            $temp = $db->query_select("*", "items", "id", $key['2']);
            $temp = @mysqli_fetch_array($temp);
            $temp_price = (int)$temp['price'] * (int)$key['3'];
            $data .= '<tr class="item_form_shop_list">
                    <td width="370" class="text-center">
                        <img src="'.$temp['img'].'" width="60px">
                    </td>
                    <td>'.$temp['title'].'</td>
                    <td class="nether-ench-relative-block">
                        <div id="nether_enchantment_block">
                            <pre>

                            </pre>
                        </div>
                    </td>
                    <td>
                        <button class="nether-cart-take-button" block_id="'.$key['2'].'" block_meta="0" block_ench="" block_price="'.$temp['price'].'" onclick="NetherShop.remove_item_amount(this)"></button>
                        <input type="text" placeholder="кол." class="cart-input">
                        <button class="nether-cart-add-button" block_id="'.$key['2'].'" block_meta="0" block_price="'.$temp['price'].'" onclick="NetherShop.add_item_amount(this)"></button>
                    </td>
                    <td>'.$key['3'].' шт ( <span class="nether-balance">'.$temp_price.'</span> монет )</td>
                    <td>
                        <button class="nether-cart-delete-button" block_id="'.$key['2'].'" block_amount="'.$key['3'].'" block_meta="'.$key['5'].'" block_ench="" block_price="'.$temp['price'].'" onclick="NetherShop.delete_item(this)"></button>
                    </td>
                </tr>';
        }
        return $header.$data.$footer;
    }

    /**
     * Получение кол-ва монет
     */
    function GetTokens1(){
        $data = new DataBase();
        $nickname = $_SESSION['nickname'];
        $tokens = $data->query_select("*","authme","username", $nickname);
        $tokens = @mysqli_fetch_array($tokens);
        return $tokens['tokens'];
    }

    /**
     * Выводит число выполненных квестов пользователя
     */
    function GetCompletedQuestsCount(){
        $data = new DataBase();
        $nickname = $_SESSION['nickname'];
        $nickname = $data->query_select("*", "authme", "username", $nickname);
        $nickname = @mysqli_fetch_all($nickname);
        $nickname = $nickname['0']['2'];
        $result = $data->query_select("*", "quests_players", "lastknownname", $nickname);
        $result = @mysqli_fetch_all($result);
        $uuid = $result['0']['0'];
        $result = $data->query_select("*", "quests_player_completedquests", "uuid", $uuid);
        $result = @mysqli_fetch_all($result);
        $count = 0;
        foreach($result as $key){
            $count++;
        }
        echo $count;
    }

    /**
     * Генерация хешированного пароля
     * @param $password - пароль для хеша
     * @return string - хешированный пароль
     */
    function HashPassword($password): string
    {
        $result = $this->generateSalt($password);
        $hash = hash("SHA256",hash("SHA256", $password) . $result );
        return '$'.'SHA'.'$'.$result.'$'.$hash;
    }

    /**
     * Подключение к консоли и отправка команды на сервер
     */

    /**
     * Получение хеша из бд
     * @return mixed
     */
    function GetHashBD(){
        $data = new DataBase();
        $nickname = $_SESSION['nickname'];
        $hash = $data->query_select("*", "authme", "username", $nickname);
        $hash  = @mysqli_fetch_all($hash);
        return $hash['0']['22'];
    }

    /**
     * Вывод склада
     */
    function Storage(){
        $nickname = $_SESSION['nickname'];
        $db = new DataBase();
        $storage =  mysqli_fetch_all($db->query_select("*", "test", "player", $nickname));
        $html = '';
        $count = 0;
        if(!empty($storage)){
            foreach ($storage as $id_item) {
                $item = mysqli_fetch_all($db->query_select("*", "items", "item_meta", $id_item['2']));
                $temp_price = (int)$id_item['3'] * (int)$item['0']['2'];
                $html .= '<tr class="item_form_shop_list">
							<td>'.++$count.'</td>
							<td id="shop_item_icon" class="shop_item_icon"><img src="'.$item['0']['4'].'" width="30px" style="margin: 3px;"></td>
							<td>'.$item['0']['1'].'</td>
							<td class="nether-ench-relative-block"><div id="nether_enchantment_block"><pre></pre></div></td>
							<td class="shop_item_price"><span class="nether-balance">'.$id_item['3'].'</span> шт ( <span class="nether-balance">'.$temp_price.'</span> монеты )</td>
						</tr>';
            }
            echo '<table width="100%" cellpadding="0" cellspacing="0" border="0" class="nether-table nether-storage-table"><tbody>'. $html . '</tbody></table>';
        }
        else{
            echo '
<div class="row">
    <div class="col-12 text-center bg404" style="padding-top: 200px">
        <span class="text" style="font-size: 50px">Ошибка</span><br>
        <span class="text" style="font-size: 25px">Ваш склад пустой!</span>
    </div>
</div>
';
        }
    }

    /**
     * Вывод блока новостей
     */
    function News(){
        $db = new DataBase();
        $news = $db->query("SELECT * FROM `news` ORDER BY `id` DESC");
        $news = @mysqli_fetch_all($news);
        $header = '<div class="row justify-content-around rounded" style="margin-top: 380px">
                <div class="col-12 text-center text" style="color: black;">
                    Новости
                </div>';
        $block1 = '
        <div class="col-4">
                    <div class="back_news1">
                        <span>'.$news['0']['1'].'</span>
                        <img class="image_news" src="'.$news['0']['6'].'" style="width: 450px; height: 180px" alt="">
                        <div class="label_news1">
                            <img class="eye" src="images/news/views.png" alt="">
                            <span>'.$news['0']['4'].'</span>
                            <div class="text_news1">
                                <span>'.$this->trim_text_chars(170, $news['0']['2']).'</span>
                            </div>
                        </div>
                        <a href="/news?id='.$news['0']['0'].'" style="text-decoration: none;">
                            <div class="more text-center" style="margin-top: 500px">
                                <div class="text" style="font-size: 15px; text-decoration: none; padding-top: 21px; text-underline: none;">
                                    Подробнее
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
        ';
        $block2 = '
        <div class="col-4">
                    <div class="back_news1">
                        <span>'.$news['1']['1'].'</span>
                        <img class="image_news" src="'.$news['1']['6'].'" style="width: 450px; height: 180px" alt="">
                        <div class="label_news1">
                            <img class="eye" src="images/news/views.png" alt="">
                            <span>'.$news['1']['4'].'</span>
                            <div class="text_news1">
                                <span>'.$this->trim_text_chars(170, $news['1']['2']).'</span>
                            </div>
                        </div>
                        <a href="/news?id='.$news['1']['0'].'" style="text-decoration: none;">
                            <div class="more text-center" style="margin-top: 500px">
                                <div class="text" style="font-size: 15px; text-decoration: none; padding-top: 21px; text-underline: none;">
                                    Подробнее
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
        ';
        $block3 = '
        <div class="col-4">
                    <div class="back_news1">
                        <span>'.$news['2']['1'].'</span>
                        <img class="image_news" src="'.$news['2']['6'].'" style="width: 450px; height: 180px" alt="">
                        <div class="label_news1">
                            <img class="eye" src="images/news/views.png" alt="">
                            <span>'.$news['2']['4'].'</span>
                            <div class="text_news1">
                                <span>'.$this->trim_text_chars(170, $news['2']['2']).'</span>
                            </div>
                        </div>
                        <a href="/news?id='.$news['2']['0'].'" style="text-decoration: none;">
                            <div class="more text-center" style="margin-top: 500px">
                                <div class="text" style="font-size: 15px; text-decoration: none; padding-top: 21px; text-underline: none;">
                                    Подробнее
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
        ';
        $footer = '<div class="col-12">
                    <a href="/news" style="text-decoration: none; margin: 703px 0 0 786px;">
                        <div class="all_news text-center" style="margin: 680px auto 0 auto">
                            <div class="text_news">
                                ВСЕ НОВОСТИ
                            </div>
                        </div>
                    </a>
                </div>
            </div>';
        echo $header.$block1.$block2.$block3.$footer;
    }

    /**
     * Обрезание строки
     * @param $count - кол-во отображаемых символов
     * @param $text - текст для обрезания
     */
    function trim_text_chars($count, $text) {
        if (mb_strlen($text) > $count) {
            $text = mb_substr($text,0,$count);
            $text .= '...';
        }
        return $text;
    }

    /**
     * Кол-во голосов
     */
    function Get_Votes(){
        $db = new DataBase();
        $nickname = $_SESSION['nickname'];
        $votes = $db->query_select("*", "authme", "username", $nickname);
        $votes = mysqli_fetch_all($votes);
        echo $votes['0']['20'];
    }

    /**
     * Страница новостей
     */
    function News_Page(){
        $db = new DataBase();
        $news = $db->query("SELECT * FROM `news` ORDER BY `id` DESC");
        $news = mysqli_fetch_all($news);
        $block = '';
        foreach($news as $key){
            $date = date('d-m-Y', strtotime($key['5']));
            $block .= '
            <article class="nether-news-content nether-news-shortstory-block">
                <div class="nether-news-title">'. $key['1'] .'</div>
                <div class="nether-news-shortstory">
                    <div style="text-align: center;">
                        <img src="'. $key['6'] .'" alt="">
                    </div>
                    '.$this->trim_text_chars(230, $key['2']) .'
                </div>
                <div class="nether-news-info">
                    <span class="nether-news-info-block">Автор: '. $key['3'] .'</span>
                    <span class="nether-news-info-block">Дата: '. $date .'</span>
                    <span class="nether-news-info-block">Просмотров: '. $key['4'] .'</span>
                    <span class="nether-news-info-button-block"><a href="/news?id='. $key['0'] .'"><button class="black-button">Подробнее…</button></a></span>
                </div>
            </article>
            ';
        }
        echo $block;
    }

    /**
     * Получение новости по id
     * @param $id - идентификатор записи
     */
    function Get_news($id){
        $db = new DataBase();
        $news = @mysqli_fetch_all($db->query_select("*", "news", "id", $id));
        if(!empty($news)){
            $date = date('d-m-Y', strtotime($news['0']['5']));
            $id = $this->mysql_escape_mimic($id);
            $views = (int)$news['0']['4'];
            $views += 1;
            $db->query("UPDATE `news` SET `views` = '$views' WHERE `id` = '$id';");
            echo '<div class="row nether-news-content">
        <div class="col-12 text-center text" style="color: Black; margin-top: 40px; font-family: NetherCraft_Menu">'.$news['0']['1'].'</div>
        <div class="col-12 text-center grow" style="margin-top: 20px; box-sizing: border-box;">
            <img src="'.$news['0']['6'].'" width="50%" height="80%" alt="">
        </div>
        <div class="col-12 text-center" style="max-width: 80%; margin-top: -40px; font-family: NetherCraft_Menu; color: #1f1f1f">
            <span>'.$news['0']['2'].'</span>
        </div>
        <div class="col-12 nether-news-info text-center" style="font-family: NetherCraft_Heavy; margin-top: 40px">
            <span style="margin-right: 20px">Автор: '.$news['0']['3'].'</span>
            <span style="margin-right: 20px; margin-left: 20px">Дата: '.$date.'</span>
            <span style="margin-left: 20px">Просмотров: '.$news['0']['4'].'</span>
        </div>
    </div>';
        }
        else{
            echo '
<div class="row">
    <div class="col-12 text-center bg404" style="margin-top: 60px; padding-top: 200px">
        <span class="text" style="font-size: 50px">Ошибка</span><br>
        <span class="text" style="font-size: 25px">Такой новости не существует!</span>
    </div>
</div>
';
        }
    }

    /**
     * Проверяем ip от callback
     * @return bool
     */
    function CheckIp(){
//        $ip = $_SERVER['REMOTE_ADDR'];
//        if($ip == '31.186.100.49' || $ip == '178.132.203.105' || $ip == '52.29.152.23' || $ip == '52.19.56.234')
//            return true;
//        else
//            return false;
        return true;
    }

    /**
     * Response for UnitPay if handle success
     *
     * @param $message
     *
     * @return string
     */
    public function getSuccessHandlerResponse($message)
    {
        return json_encode(array(
            "result" => array(
                "message" => $message
            )
        ));
    }

    /**
     * Response for UnitPay if handle error
     *
     * @param $message
     *
     * @return string
     */
    public function getErrorHandlerResponse($message)
    {
        return json_encode(array(
            "error" => array(
                "message" => $message
            )
        ));
    }

    function Popular_items(){
        $db = new DataBase();
        return mysqli_fetch_all($db->query("SELECT * FROM `items` ORDER BY `bought_times` DESC;"));
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function mysql_escape_mimic($inp) {
        if(is_array($inp))
            return array_map(__METHOD__, $inp);

        if(!empty($inp) && is_string($inp)) {
            return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);
        }

        return $inp;
    }

    /**
     * get the server status
     *
     * returns an associative array like that:
     *   array('motd' => 'I am a minecraft server','players'=> 3,'max_players'=>10)
     * if either the server is not reachable or doesn't look like a SMP server,
     * false is returned.
     *
     * @param string $ip The IP of the server to query
     * @param integer $port The port to connect to (defaults to default port 25565)
     * @return false or array
     */

    function fetch_server_info($ip, $port=25565) {
        // Create a CURL connection to the API.
        $ch = curl_init('https://mcapi.us/server/status?ip='.$ip.'&port='.$port);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $results = curl_exec($ch);
        curl_close($ch);

        // Unserialize the JSON output
        $data = json_decode($results, true);

        return array(
            'motd'        => $data['motd'],
            'players'     => $data['players']['now'],
            'max_players' => $data['players']['max']
        );
    }

    /**
     * Обновление прсмотров
     * @param $id - айди новости
     * @return bool - если успешно обновили
     */
    function UpdateViews($id){

    }

    /**
     * Кол-во голосов
     */
    function Get_Votes_Gift(){
        $db = new DataBase();
        $nickname = $_SESSION['nickname'];
        $votes = $db->query_select("*", "top_votes", "username", $nickname);
        $votes = @mysqli_fetch_all($votes);
        return $votes['0'];
    }
}