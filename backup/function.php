<?php
/**
 * Класс со всеми функциями, используемые на сайте<br>
 * Author: Alexey Pavlov<br>
 * Contact: vk.com/zytia
 */
class Functions {
    /**
     * Метод проверки пользователя в базе данных
     * @param $nickname - никнейм игрока, вводимый пользователем
     * @param $password - пароль игрока, вводимый пользователем
     * @return bool Возвращает истину в случае совпадения пароля
     */
    function check_password($nickname,$password) {
        require "DB.php";
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
     * Метод для авторизации
     * @param $nickname - никнейм игрока, вводимый пользователем
     * @param $password - пароль игрока, вводимый пользователем
     */
    function autorize($nickname, $password){
        if($this->check_password($nickname, $password)){
            session_start();
            $_SESSION['nickname'] = $nickname;
            return true;
        }
        else{
            return false;
        }
    }
}