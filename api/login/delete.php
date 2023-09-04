<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods:DELETE');
    header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
    include_once('../../config/db.php');
    include_once('../../main/login.php');

    $db = new db();
    $connect = $db->connect();

    $login = new login($connect);
    $data = json_decode(file_get_contents("php://input"));

    $login->id_user = $data->id_user;

    if($login->delete()){
        echo json_encode(array('message','login deleted'));
    }else{
        echo json_encode(array('message','login not deleted'));
    }

?>