<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']. "/function.php";
require $_SERVER['DOCUMENT_ROOT']. "/markup.php";

$database = new DataBase();
if(isset($_SESSION['nickname']) && !empty($_SESSION['nickname'])){
    $nickname = $_SESSION['nickname'];
    $data = $database->query_select("*", "authme", "username", $nickname);
    if(mysqli_num_rows($data) == 1 ) {
        $data = mysqli_fetch_array($data);
        $response[] = array(
            "status"=>"success",
            "message"=>"Успешно получены данные",
            "data"=>array(
                "money" => $data["sum"],
                "tokens" => $data["tokens"],
                "month_votes" => $data["all_votes"]
            )
        );
        echo json_encode($response);
    }
    else {
        $response[] = array(
            "status" => "fail",
            "message" => "Вход не был выполнен.",
            "data" => array(
                "money" => 0,
                "tokens" => 0,
                "month_votes" => 0
            )
        );
        echo json_encode($response);
    }
}
else{
    $response[] = array(
        "status"=>"fail",
        "message"=>"Вход не был выполнен.",
        "data"=>array()
    );
    echo json_encode($response);
}




