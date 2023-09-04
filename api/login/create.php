
<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods:POST');
    header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
    include_once('../../config/db.php');
    include_once('../../main/login.php');

    $db = new db();
    $connect = $db->connect();

    $login = new login($connect);
    $data = json_decode(file_get_contents("php://input"));

    $login->username = $data->username;
    $login->password = $data->password;
    $login->email = $data->email;

    if($login->create()){
        echo json_encode(array('message','login created'));
    }else{
        echo json_encode(array('message','login not created'));
    }

?>