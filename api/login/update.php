<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods:PUT');
    header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
    include_once('../../config/db.php');
    include_once('../../main/login.php');

    $db = new db();
    $connect = $db->connect();

    $login = new login($connect);
    $data = json_decode(file_get_contents("php://input"));

    $login->id_user = $data->id_user;
    $login->username = $data->username;
    $login->password = $data->password;
    $login->email = $data->email;

    if($login->update()){
        echo json_encode(array('message','login updated'));
    }else{
        echo json_encode(array('message','login not updated'));
    }

?>
