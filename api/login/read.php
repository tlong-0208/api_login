<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../main/login.php');

    $db = new db();
    $connect = $db->connect();

    $login = new login($connect);
    $read = $login->read();

    $num = $read->rowCount();

    if($num>0){
        $login_array = [];
        $login_array['login'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $login_item = array(
                'id_login' => $id_user,
                'username' => $username,
                'password' => $password,
                'email' => $email,
            );
            array_push($login_array['login'],$login_item);
        }
        print(json_encode($login_array));
    }

?>