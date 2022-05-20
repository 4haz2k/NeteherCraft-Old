<?php
require '../DB.php';
if($_GET['hash'] == md5(md5($_GET['nick'] . 'beMISsaKwD3lWNXuVJAPJELWLlEGV0R3' . 'mcrate'))){ //mcrate
    Insert(new DataBase(), htmlspecialchars($_GET['nick']), true);
}

//if ($_POST['signature'] != sha1(htmlspecialchars($_POST['username']).$_POST['timestamp'].'52819ad3c386656cb6e4d51649fe7600')){
//    Insert(new DataBase(), htmlspecialchars($_POST['username']));
//}

if($_GET['token'] == md5($_GET['nickname'].'24ae5defa8b01d751c2565ebce5769c3')){ // mctop
    Insert(new DataBase(), htmlspecialchars($_GET['nickname']), false, true);
}

function Insert($db, $nick, $mcrate = false, $mctop = false){
    $data = @mysqli_fetch_all($db->query("SELECT * FROM `authme` WHERE `username` = '$nick';"));
    if($data){
        $current_votes_now = (int)$data['0']['20'] + 1;
        $current_votes_all = (int)$data['0']['21'] + 1;
        if($db->query("UPDATE `authme` SET `votes` = '$current_votes_now', `all_votes` = '$current_votes_all' WHERE `username` = '$nick';")){
            if(@mysqli_fetch_all($db->query("SELECT * FROM `top_votes` WHERE `username` = '{$nick}'"))){
                if($mcrate){
                    if($db->query("UPDATE `top_votes` SET `mcrate` = `mcrate` + 1 WHERE `username` = '$nick';")){
                        echo 'Success';
                        exit;
                    }
                }
                if($mctop){
                    if($db->query("UPDATE `top_votes` SET `mctop` = `mctop` + 1 WHERE `username` = '$nick';")){
                        echo 'Success';
                        exit;
                    }
                }
            }
            else{
                if($mcrate){
                    if($db->query("INSERT INTO top_votes(`username`, `mcrate`) VALUES('$nick', 1)")){
                        echo 'Success';
                        exit;
                    }
                }
                if($mctop){
                    if($db->query("INSERT INTO top_votes(`username`, `mctop`) VALUES('$nick', 1)")){
                        echo 'Success';
                        exit;
                    }
                }
            }

        }
    }
    else {
        $data = mysqli_fetch_all($db->query("SELECT * FROM `authme` WHERE `realname` = '$nick';"));
        if($data){
            $current_votes_now = (int)$data['0']['20'] + 1;
            $current_votes_all = (int)$data['0']['21'] + 1;
            if($db->query("UPDATE `authme` SET `votes` = '$current_votes_now', `all_votes` = '$current_votes_all' WHERE `realname` = '$nick';")){
                echo 'Success';
                exit;
            }
        }
    }
}
