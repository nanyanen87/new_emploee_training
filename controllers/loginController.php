<?php
if (isset($_POST["name"])) {

    $user_name = htmlspecialchars($_GET["name"]);
    //なんやかんや確認してから↓
    session_start();
    session_regenerate_id(true); //session_idを新しく生成し、置き換える
    $_SESSION["email"] = "nan.hanaoka@gmail.com";
    $response["message"] = 'ログインに成功しました';

    header('Location: /');
}