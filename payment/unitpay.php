<?php
require $_SERVER['DOCUMENT_ROOT'].'/function.php';
require $_SERVER['DOCUMENT_ROOT'].'/DB.php';
$data = new Functions();
$database = new DataBase();

if(isset($_GET)){
    if($data->CheckIP()){
        list($method, $params) = array($_GET['method'], $_GET['params']);
        switch ($method) {
            // Just check order (check server status, check order in DB and etc)
            case 'check':
                $payment = @mysqli_fetch_all($database->query("SELECT * FROM `payments` WHERE `unique_hash` = '".$params['account']."';"));
                if($payment['0']['5'] == '' and !empty($payment)){
                    echo $data->getSuccessHandlerResponse("Проверка проведенна. Готово к оплате.");
                    exit;
                }
                else{
                    echo $data->getSuccessHandlerResponse("No data in DB");
                    exit;
                }
            // Method Pay means that the money received
            case 'pay':
                // Please complete order
                $payment = @mysqli_fetch_all($database->query("SELECT * FROM `payments` WHERE `unique_hash` = '".$params['account']."';"));
                if($payment['0']['5'] == ''){
                    $player = @mysqli_fetch_all($database->query_select("*", "authme", "username", $payment['0']['1']));
                    if((int)$payment['0']['3'] >= 3000){
                        $money = ceil((int)$payment['0']['3'] * 1.4 + (int)$player['0']['18']);
                    }
                    elseif((int)$payment['0']['3'] >= 1000){
                        $money = ceil((int)$payment['0']['3'] * 1.25 + (int)$player['0']['18']);
                    }
                    elseif((int)$payment['0']['3'] >= 500){
                        $money = ceil((int)$payment['0']['3'] * 1.15 + (int)$player['0']['18']);
                    }
                    elseif((int)$payment['0']['3'] >= 300){
                        $money = ceil((int)$payment['0']['3'] * 1.1 + (int)$player['0']['18']);
                    }
                    else{
                        $money = (int)$payment['0']['3'] + (int)$player['0']['18'];
                    }
                    if($database->query("UPDATE `authme` SET `sum` = '$money' WHERE `username` = '".$payment['0']['1']."';")){
                        if($database->query("UPDATE `payments` SET `ispayed` = 'true', `UnitpayId` = '".$params['unitpayId']."' WHERE `unique_hash` = '".$payment['0']['2']."';")){
                            echo $data->getSuccessHandlerResponse("Успешная оплата");
                            exit;
                        }
                        else{
                            echo $data->getErrorHandlerResponse("Не выполнен запрос в базу данных с обновлением");
                            exit;
                        }
                    }
                    else{
                        echo $data->getErrorHandlerResponse("Не обновлены деньги пользователя");
                        exit;
                    }
                }
                else{
                    echo $data->getErrorHandlerResponse("Указанный хеш пользователя не найден");
                    exit;
                }
            // Method Error means that an error has occurred.
            case 'error':
                // Please log error text.
                $payment = @mysqli_fetch_all($database->query("SELECT * FROM `payments` WHERE `unique_hash` = '".$params['account']."';"));
                if($payment['0']['5'] == ''){
                        if($database->query("UPDATE `payments` SET `ispayed` = 'diclined', `UnitpayId` = '".$params['unitpayId']."' WHERE `unique_hash` = '".$payment['0']['2']."';")){
                            echo $data->getSuccessHandlerResponse("Пользователь отклонил платеж.");
                            exit;
                        }
                }
                echo $data->getSuccessHandlerResponse("No data in DB");
                exit;
        }
    }
    else{
        echo $data->getSuccessHandlerResponse("Invalid server IP: {$_SERVER['REMOTE_ADDR']}");
        exit;
    }
}
else{
    echo $data->getSuccessHandlerResponse("Bad GET response");
    exit;
}