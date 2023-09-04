<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../main/login.php');

    $db = new db();
    $connect = $db->connect();

    $login = new login($connect);

    $login->id_user  = isset($_GET['id']) ? $_GET['id'] : die();
    $login->show();

    $login_item = array(
        'id_login' => $login->id_user,
        'username' =>  $login->username,
        'password' =>  $login->password,
        'email' =>  $login->email,
    );
    print_r(json_encode($login_item));

?>
